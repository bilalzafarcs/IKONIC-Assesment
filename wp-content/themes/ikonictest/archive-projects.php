<?php
get_header();
?>

<section class="bg-light pt-3">
    <div class="container">
       
        <div class="row mt-4">
            <div class="col-lg-4 col-12 mb-4">
            <div class="filter-container">
    <h4><i class="fas fa-filter"></i> Filter by Date</h4>
    <div class="filter-group">
        <form method="GET" action="" class="mb-4">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="start_date"><i class="far fa-calendar-alt"></i> Start Date:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control filter-input" value="<?php echo esc_attr($_GET['start_date'] ?? ''); ?>">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="end_date"><i class="far fa-calendar-alt"></i> End Date:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control filter-input" value="<?php echo esc_attr($_GET['end_date'] ?? ''); ?>">
                </div>
                <div class="col-md-12 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary filter-btn w-100">
                        <i class="fas fa-search"></i> Apply Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

            </div>

            <div class="col-lg-8 col-12">
                <div class="filter-content">
                    <?php
                    $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
                    $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

                    $args = array(
                        'post_type'      => 'projects',
                        'posts_per_page' => -1,
                        'meta_query'     => array(
                            'relation' => 'AND',
                        ),
                    );

                      // Filtering for Start date
                    if (!empty($start_date)) {
                        $args['meta_query'][] = array(
                            'key'     => 'project_start_date',
                            'value'   => date('Ymd', strtotime($start_date)),
                            'compare' => '>=',
                            'type'    => 'NUMERIC',
                        );
                    }

                    // Filtering for End date
                    if (!empty($end_date)) {
                        $args['meta_query'][] = array(
                            'key'     => 'project_end_date',
                            'value'   => date('Ymd', strtotime($end_date)),
                            'compare' => '<=',
                            'type'    => 'NUMERIC',
                        );
                    }

                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post();
                            $image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                            ?>
                            <div class="content-item">
                                <div class="project-card">
                                    <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>">
                                    <div class="project-details">
                                        <h5><?php the_title(); ?></h5>
                                        <p><?php the_excerpt();?></p>
                                        <p><strong>Start Date:</strong> <?php echo esc_html(date('F j, Y', strtotime(get_field('project_start_date')))); ?></p>
                                        <p><strong>End Date:</strong> <?php echo esc_html(date('F j, Y', strtotime(get_field('project_end_date')))); ?></p>
                                        <div class="btn-container">
                                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p class="text-center">No projects found.</p>';
                    endif;
                    ?>
                </div>
                <div class="pagination justify-content-center">
        <?php 
        echo paginate_links(array(
            'prev_text' => '<i class="fa-solid fa-chevron-left"></i>',
            'next_text' => '<i class="fa-solid fa-chevron-right"></i>',
            'before_page_number' => '<span class="btn btn-pagination">',
            'after_page_number'  => '</span>',
        )); 
        ?>
    </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
