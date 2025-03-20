<?php
/*
 Template Name: Blog
 */
get_header(); 
?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Latest Blog Posts</h1>

    <div class="row">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-md-4">
                    <div class="card blog-card mb-4 shadow-sm">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                            </a>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="<?php the_permalink(); ?>" class="text-dark"><?php the_title(); ?></a>
                            </h5>
                            <p class="card-text"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <p class="text-center">No posts found.</p>
        <?php endif; ?>
    </div>

    <div class="pagination justify-content-center">
        <?php echo paginate_links(); ?>
    </div>
</div>

<?php get_footer(); ?>
