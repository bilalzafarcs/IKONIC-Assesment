<?php
/**
 * Plugin Name: Unused Media Cleaner
 */

if (!defined('ABSPATH')) {
    exit;
}

// hook to dislay in menu
add_action('admin_menu', 'umc_add_menu');

function umc_add_menu() {
    add_menu_page(
        'Unused Media Cleaner',
        'Unused Media',
        'manage_options',
        'unused-media-cleaner',
        'umc_display_unused_media',
        'dashicons-trash',
        20
    );
}

// function to get all unused media
function umc_get_unused_media() {
    global $wpdb;
    // query to check if image not used in post-thumbnai,post-content,custom-field
    $query = "
        SELECT p.ID, p.guid 
        FROM {$wpdb->prefix}posts p
        WHERE p.post_type = 'attachment' 
        AND p.ID NOT IN (
        -- Check if media is used as a featured image
        SELECT meta_value FROM {$wpdb->prefix}postmeta WHERE meta_key = '_thumbnail_id'
        ) 
        AND NOT EXISTS (
        -- Check if media is used in post/page content
        SELECT 1 FROM {$wpdb->prefix}posts WHERE post_content LIKE CONCAT('%', p.guid, '%')
        ) 
        AND NOT EXISTS (
        -- Check if media ID is used in ACF fields or other custom fields
        SELECT 1 FROM {$wpdb->prefix}postmeta WHERE meta_value = p.ID AND meta_value REGEXP '^[0-9]+$'
        ) 
        AND NOT EXISTS (
        -- Check if media URL is stored in ACF fields or other custom fields
        SELECT 1 FROM {$wpdb->prefix}postmeta WHERE meta_value LIKE CONCAT('%', p.guid, '%')
        );
    ";

    return $wpdb->get_results($query);
}

// displays the unused media files
function umc_display_unused_media() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have permission to access this page.', 'unused-media-cleaner'));
    }

    $unused_media = umc_get_unused_media();
    ?>
    <div class="wrap">
        <h2>Unused Media Files</h2>
        <?php if (!$unused_media) : ?>
            <p>No unused media found.</p>
        <?php else : ?>
            <table class="widefat">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>URL</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($unused_media as $media) : ?>
                        <tr id="media-<?php echo esc_attr($media->ID); ?>">
                            <td><?php echo esc_html($media->ID); ?></td>
                            <td><img src="<?php echo esc_url($media->guid); ?>" width="50" height="50" style="object-fit:cover;"></td>
                            <td><a href="<?php echo esc_url($media->guid); ?>" target="_blank"><?php echo esc_url($media->guid); ?></a></td>
                            <td>
                                <button class="button umc-delete-media" data-id="<?php echo esc_attr($media->ID); ?>" data-nonce="<?php echo wp_create_nonce('umc_delete_media_nonce'); ?>">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <script>
        jQuery(document).ready(function($) {
            $('.umc-delete-media').click(function() {
                var button = $(this);
                var mediaID = button.data('id');
                var nonce = button.data('nonce');

                if (confirm("Are you sure you want to delete this media file?")) {
                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'umc_delete_media',
                            media_id: mediaID,
                            nonce: nonce
                        },
                        beforeSend: function() {
                            button.text('Deleting...').prop('disabled', true);
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#media-' + mediaID).fadeOut();
                            } else {
                                alert(response.data);
                            }
                        },
                        error: function() {
                            alert('An error occurred.');
                        }
                    });
                }
            });
        });
    </script>
    <?php
}

add_action('wp_ajax_umc_delete_media', 'umc_delete_media_callback');

function umc_delete_media_callback() {
    //  nonce verification
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'umc_delete_media_nonce')) {
        wp_send_json_error('Security check failed.');
    }

    // user capability check
    if (!current_user_can('manage_options')) {
        wp_send_json_error('You do not have permission to perform this action.');
    }

    // validate and sanitize media ID
    $media_id = isset($_POST['media_id']) ? intval($_POST['media_id']) : 0;
    if (!$media_id) {
        wp_send_json_error('Invalid media ID.');
    }

    //  delete media attempt
    if (wp_delete_attachment($media_id, true)) {
        wp_send_json_success('Media deleted successfully.');
    } else {
        wp_send_json_error('Failed to delete media.');
    }
}
