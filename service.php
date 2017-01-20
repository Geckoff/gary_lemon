<?php

/*
Template Name: Service Template
*/

 ?>

<?php get_header('secondary'); ?>

        <section id="our-service-page" class="section-padding regular-section">
            <div class="container">
                <h2><?php echo single_cat_title(); ?></h2>
                <div class="row">
                    <div class="grey-stripe col-xs-6 col-xs-offset-3"></div>
                </div>
                <p class="between-stripes"><?php echo strip_tags(category_description('8')); ?></p>
                <div class="row">
                    <div class="grey-stripe col-xs-2 col-xs-offset-5"></div>
                </div>

                <div class="our-service-block">
                    <?php $service = new WP_Query(array('post_type' => 'service', 'order' => 'ASC', 'posts_per_page' => 4)); ?>
                    <?php if ($service->have_posts()) : ?>
                        <?php $even = 1; ?>
                        <?php while ($service->have_posts()) : $service->the_post();?>
                            <a name="<?php echo $post->post_name; ?>"></a>
                            <div class="our-service-item <?php if ($even % 2 == 0) echo 'even-item' ?> row">
                                <div class="col-md-4 col-sm-3 <?php if ($even % 2 == 0) echo 'col-md-push-8 col-sm-push-9'; ?> our-service-item-logo">
                                    <h3><?php the_title(); ?></h3>
                                    <div class="row">
                                        <div class="grey-stripe col-xs-2 col-xs-offset-5"></div>
                                    </div>
                                    <?php the_post_thumbnail();?>
                                </div>
                                <div class="col-md-8 col-sm-9 <?php if ($even % 2 == 0) echo 'col-md-pull-4 col-sm-pull-3'; ?> our-service-item-desc">
                                    <?php the_content(); ?>
                                    <div class="look-all-occasions">
                                        <a href="<?php echo get_permalink(get_post_meta($post->ID, 'tied_portfolio', true)); ?>"><?php the_title(); ?> We Ran</a>
                                    </div>
                                </div>
                            </div>
                            <?php $even++; ?>
                        <?php endwhile; ?>
                    <?php else: ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>

       <?php get_footer(); ?>