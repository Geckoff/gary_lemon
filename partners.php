<?php

/*
Template Name: Partners Template
*/

 ?>

<?php get_header('secondary'); ?>

        <section id="partners-page" class="section-padding regular-section">
            <div class="container">
                <h2>Partners</h2>

                <?php $partners = new WP_Query(array('post_type' => 'partners')); ?>

                <?php if ($partners->have_posts()): while ($partners->have_posts()): $partners->the_post();?>

                <div class="partner-block">
                    <div class="row">
                        <div class="grey-stripe col-xs-6 col-xs-offset-3"></div>
                    </div>
                    <p class="between-stripes"><?php the_title(); ?></p>
                    <div class="row">
                        <div class="grey-stripe col-xs-2 col-xs-offset-5"></div>
                    </div>
                    <div class="partner-block-text">
                        <?php the_content(); ?>
                    </div>
                    <div class="partner-img">
                        <?php the_post_thumbnail();?>
                    </div>
                </div>

                <?php endwhile; ?>

                <?php else: ?>

                <?php endif; ?>

            </div>
        </section>

        <?php get_footer(); ?>