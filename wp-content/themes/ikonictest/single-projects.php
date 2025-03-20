<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<section class="project-details py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="project-title display-4"><?php the_title(); ?></h1>
                <hr class="w-25 mx-auto mb-4">
            </div>
        </div>

        <div class="row">
            <?php if ( has_post_thumbnail() ) : ?>
            <div class="col-md-8 mx-auto text-center mb-4">
                <div class="project-thumbnail">
                    <?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid rounded shadow' ) ); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="project-meta bg-light p-4 rounded shadow-sm">
                    <h3 class="text-center mb-4">Project Details</h3>
                    <ul class="list-group list-group-flush">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong><i class="fas fa-project-diagram"></i> Project Name:</strong>
                                <?php echo esc_html(get_field('project_name')); ?>
                            </li>
                            <li class="list-group-item">
                                <strong><i class="far fa-calendar-alt"></i> Start Date:</strong>
                                <?php 
                                //changing the date format
                                $start_date = get_field('project_start_date'); 
                                $start_date = date('F j, Y', strtotime($start_date));
                                echo esc_html($start_date);
                                ?>
                            </li>
                            <li class="list-group-item">
                                <strong><i class="fas fa-flag-checkered"></i> End Date:</strong>
                                <?php 
                                $end_date = get_field('project_end_date');
                                $end_date = date('F j, Y', strtotime($end_date)); 
                                echo esc_html($end_date);
                                ?>
                            </li>


                            <li class="list-group-item">
                                <strong><i class="fas fa-link"></i> Project URL:</strong>
                                <a href="<?php echo esc_url(get_field('project_url')); ?>" target="_blank">
                                    <?php echo esc_html(get_field('project_url')); ?>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <strong><i class="fas fa-align-left"></i> Description:</strong>
                                <?php echo esc_html(get_field('project_description')); ?>
                            </li>
                        </ul>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto mt-4">
                <div class="project-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>