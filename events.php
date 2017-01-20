<?php

/*
Template Name: Event Template
*/

 ?>

<?php get_header('secondary'); ?>

        <section id="events-page" class="section-padding regular-section">
            <div class="container">
                <h2>Events</h2>
                <div class="row">
                    <div class="grey-stripe col-xs-6 col-xs-offset-3"></div>
                </div>

                <div class="row main-future-occ-block">

                    <?php $events = new WP_Query(array('post_type' => 'events', 'order' => 'DESC', 'posts_per_page' => 8)); ?>
                    <?php if ($events->have_posts()): while ($events->have_posts()): $events->the_post();?>
                        <div class="main-future-occ col-md-6">
                            <a href="<?php the_permalink(); ?>">
                                <div class="future-occ-img">
                                    <?php the_post_thumbnail();?>
                                </div>
                            </a>
                            <div class="future-occ-info">
                                <a href="<?php the_permalink(); ?>">
                                    <h3><?php the_title();?> </h3>
                                </a>
                                <p class="occ-date"><?php echo CFS()->get('event_date'); ?></p>
                                <div class="light-grey-stripe"></div>
                                <p class="fut-occ-text"><?php echo strip_tags(get_the_excerpt()); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>

                    <?php else: ?>

                    <?php endif; ?>

                </div>
                <div class="row">
                    <div class="grey-stripe col-xs-6 col-xs-offset-3"></div>
                </div>
                <button type="submit" page='1' class="order btn btn-default more-events"><span>More Events...</span><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></button>
            </div>
        </section>

        <?php get_footer(); ?>