<?php
/*
 Template Name: Home
 */
get_header(); 
?>

<section id="latest-projects" class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-4 section-heading">Latest Projects</h2>
        <div class="row">
            <?php
            $args = array(
                'post_type'      => 'projects',
                'orderby'        => 'date',
                'order'          => 'DESC',
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    $description = get_field('project_description') ?: get_the_excerpt();
            ?>
                    <div class="col-md-4 col-12 mb-4">
                        <div class="card box-shadow">
                            <img class="card-img-top" src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>"
                                style="height: 225px; width: 100%; display: block;">
                            <div class="card-body">
                                <h5 class="card-title"><?php the_title(); ?></h5>
                                <p class="card-text"><?php echo esc_html(wp_trim_words($description, 20)); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
            <?php 
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p class="text-center">No projects found.</p>';
            endif;
            ?>
        </div>
    </div>
</section>

<?php 
get_footer();
