<?php

/*
Template Name: Portfolio Template
*/

 ?>

<?php get_header('secondary'); ?>

        <section id="portfolio-page" class="section-padding regular-section">
            <div class="container">
                <h2>Portfolio</h2>
                <div class="row">
                    <div class="grey-stripe col-xs-6 col-xs-offset-3"></div>
                </div>
                <?php
                    if (is_category()) $cat_name = 'All Pictures';
                    else $cat_name = get_the_title(get_queried_object_id());
                ?>
                <button data-toggle="collapse" data-target="#collapsePortfolioMenu" type="submit" class="order btn btn-default"><?php echo $cat_name; ?>&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></button>
                <ul class="portfolio-page-menu" id="collapsePortfolioMenu">
                    <li>
                        <a <?php if (is_category()) echo "class='portfolio-active'" ?> href="<?php echo get_category_link( 9 ); ?>">All Pictures</a>
                    </li>
                    <?php $cur_id = get_queried_object_id(); ?>
                    <?php $service = new WP_Query(array('post_type' => 'portfolio', 'order' => 'ASC', 'post__not_in' => array(43))); ?>
                    <?php if ($service->have_posts()) : ?>
                        <?php while ($service->have_posts()) : $service->the_post();?>
                            <li>
                                <a <?php if ($cur_id == get_the_ID()) echo "class='portfolio-active'" ?> href="<?php echo get_permalink( get_the_ID()); ?>"><?php the_title(); ?></a>
                            </li>
                        <?php endwhile; ?>
                    <?php else: ?>
                    <?php endif; ?>
                    <li>
                        <a <?php if ($cur_id == 43) echo "class='portfolio-active'" ?> href="<?php echo get_permalink(43); ?>">Video</a>
                    </li>
                </ul>
                <div class="black-border"></div>
                <div class="row">
                    <div class="grey-stripe col-xs-2 col-xs-offset-5"></div>
                </div>

                <div class="colorbox-gallery">
                <?php if (is_category()): ?>

                    <?php if ($service->have_posts()) : ?>
                        <?php while ($service->have_posts()) : $service->the_post();?>
                            <?php the_content(); ?>
                        <?php endwhile; ?>
                    <?php else: ?>
                    <?php endif; ?>

                <?php else: ?>
                    <?php if (have_posts()): while (have_posts()): the_post();?>
                        <?php $post_id =  $post->ID; ?>
                    <?php endwhile; ?>
                    <?php else: ?>
                    <?php endif; ?>

                    <?php if ($post_id == 43) : ?>

                        <?php $link_metas = get_post_meta($post_id, 'videolink', true);
                        $img_metas = get_post_meta($post_id, 'videoimg', true); ?>


                        <?php for ($i = 0; $i < count($link_metas); $i++) : ?>
                        <div class="grid video">
                    		<figure class="effect-bubba">
                                <?php $src = wp_get_attachment_image_src($img_metas[$i], 'full');  ?>
                                <img src="<?php echo $src[0]; ?>" alt="" />
                                <a class="colorbox-video" href="<?php echo $link_metas[$i]; ?>">
                        			<figcaption>
                        				<p>Play video</p>
                        			</figcaption>
                                    <div class="figcaption2"></div>
                                    <div class="figcaption3"></div>
                                    <div class="figcaption4"></div>
                                </a>
                    		</figure>
                    	</div>
                        <?php endfor; ?>

                    <?php else: ?>

                        <?php if (have_posts()): while (have_posts()): the_post();?>
                            <?php the_content(); ?>
                        <?php endwhile; ?>

                        <?php else: ?>

                        <?php endif; ?>

                    <?php endif; ?>

                <?php endif; ?>
                </div>



            </div>
        </section>

       <?php get_footer(); ?>