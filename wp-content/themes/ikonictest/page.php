<?php get_header(); ?>

<main id="main-content">
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1><?php the_title(); ?></h1>
                <div class="page-content">
                    <?php the_content(); ?>
                </div>
            </article>

            <?php
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>

        <?php endwhile; else : ?>
            <p>Sorry, the page you are looking for does not exist.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
