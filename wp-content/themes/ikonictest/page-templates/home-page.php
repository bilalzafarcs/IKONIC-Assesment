<?php
/*
 Template Name: Home
 */
get_header(); 
?>
<section id="target-audience" class="bg-light">
    <div class="container">
        <div class="row mt-4">
            <div class="row">
                <?php
                $args = array(
                    'post_type'      => 'projects',
                    'posts_per_page' => -1, 
                );
                $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            $description = get_field('project_description');
            ?>
                <div class="col-md-4 col-12 mb-4">
                    <div class="card mb-4 box-shadow">
                        <?php if ($image) : ?>
                        <img class="card-img-top" src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>"
                            style="height: 225px; width: 100%; display: block;">
                        <?php else : ?>
                        <img class="card-img-top" src="https://via.placeholder.com/348x225" alt=""
                            style="height: 225px; width: 100%; display: block;">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php the_title(); ?></h5>
                            <p class="card-text"><?php echo esc_html(wp_trim_words($description, 20)); ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="<?php the_permalink(); ?>"
                                        class="btn btn-sm btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile;
        wp_reset_postdata();
    endif;
    ?>
            </div>

        </div>
    </div>
</section>

<?php 

get_footer();