<?php get_header(); ?>

<main id="main-content">
    <div class="container">
        <h1><?php bloginfo('name'); ?></h1>

        <?php if (have_posts()) : ?>
            <div class="post-list">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p class="meta">Posted on <?php echo get_the_date(); ?> by <?php the_author(); ?></p>
                        <div class="excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="pagination">
                <?php the_posts_pagination(); ?>
            </div>
        <?php else : ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
