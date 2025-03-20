<?php get_header(); ?>

<?php
while ( have_posts() ) : the_post();
?>

<section class="details">
    <div class="container">
        <h1 class="title"><?php the_title(); ?></h1>
        
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="thumbnail">
                <?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ); ?>
            </div>
        <?php endif; ?>
        <div class="content">
            <?php the_content(); ?>
        </div>
        
        <div class="navigation">
            <div class="previous"><?php previous_post_link('%link', 'Previous'); ?></div>
            <div class="next"><?php next_post_link('%link', 'Next'); ?></div>
        </div>
    </div>
</section>

<?php
endwhile;
?>

<?php get_footer(); ?>
