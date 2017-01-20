<?php

/*
Template Name: Single Event Template
*/

 ?>

<?php get_header('secondary'); ?>

        <?php if (have_posts()): while (have_posts()): the_post();?>

        <section id="single-event-page" class="section-padding regular-section">
            <div class="container">
                <h2><?php the_title(); ?></h2>

                <div class="partner-block">
                    <div class="row">
                        <div class="grey-stripe col-xs-6 col-xs-offset-3"></div>
                    </div>
                    <p class="between-stripes"><?php echo get_post_meta($post->ID, 'event_date', true); ?></p>
                    <div class="row">
                        <div class="grey-stripe col-xs-2 col-xs-offset-5"></div>
                    </div>
                    <div class="partner-block-text">
                        <?php the_content(); ?>
                    </div>
                </div>

            </div>
        </section>

        <?php endwhile; ?>

        <?php else: ?>

        <?php endif; ?>

        <?php get_footer(); ?>