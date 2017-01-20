<?php get_header(); ?>

        <section id="occasions" class="section-padding regular-section">
            <div class="container">
                <h2>Entertainment for any occasion</h2>
                <div class="row">
                    <div class="grey-stripe col-xs-6 col-xs-offset-3"></div>
                </div>
                <p class="between-stripes"><?php echo strip_tags(category_description('8')); ?></p>
                <div class="row">
                    <div class="grey-stripe col-xs-2 col-xs-offset-5"></div>
                </div>
                <div class="occ-types">
                    <div class="row">
                        <?php $service = new WP_Query(array('post_type' => 'service', 'order' => 'ASC', 'posts_per_page' => 4)); ?>
                        <?php if ($service->have_posts()) : ?>
                            <?php while ($service->have_posts()) : $service->the_post();?>
                                <div class="col-md-3 col-xs-6">
                                    <?php $permalink = get_category_link(8); ?>
                                    <a href="<?php echo substr($permalink, 0, strlen($permalink) - 1); ?>#<?php echo $post->post_name ?>">
                                        <div class="occasion">
                                            <h3><?php the_title(); ?></h3>
                                            <div class="light-grey-stripe"></div>
                                            <div class="occasion-short-desc">
                                                <?php the_excerpt(); ?>
                                            </div>
                                            <div class="occasion-logo">
                                                <?php the_post_thumbnail();?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </section>
        <section id="shortly-about" class="section-padding regular-section">
            <div class="container">
                <div class="row table">
                    <div class="col-md-3 table-cell">
                        <p class="shortly-about-header">About me</p>
                    </div>
                    <div class="col-md-5 table-cell">
                        <div class="shortly-about-text">
                            <?php $service = new WP_Query(array('page_id' => 28)); ?>
                            <?php if ($service->have_posts()) : ?>
                                <?php while ($service->have_posts()) : $service->the_post();?>
                                    <?php the_content(); ?>
                                <?php endwhile; ?>
                            <?php else: ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

         <section id="portfolio-main" class="section-padding regular-section">
            <div class="container">
                <h2>Portfolio</h2>
                <div class="row">
                    <div class="grey-stripe col-xs-6 col-xs-offset-3"></div>
                </div>
                <?php $options = get_option('ag_main_gallery'); ?>
                <p class="between-stripes"><?php echo strip_tags(category_description('9')); ?></p>
                <div class="row">
                    <div class="grey-stripe col-xs-2 col-xs-offset-5"></div>
                </div>



                <div class="colorbox-gallery">

                    <?php for($i = 1; $i < 10; $i++): ?>

                    <?php $options = get_option('ag_main_gallery'); ?>

                    <div class="grid <?php if ($options['ag_main_gallery_pic_video_id'.$i] == 2) echo 'video'; ?>">
                		<figure class="effect-bubba">
                            <?php $src = wp_get_attachment_image_src($options['ag_main_gallery_img_id'.$i], 'full');  ?>
                            <img src="<?php echo $src[0]; ?>" alt="" />
                            <?php
                                if ($options['ag_main_gallery_pic_video_id'.$i] == 2) { $href = $options['ag_main_gallery_link_id'.$i]; $caption = 'Play Video'; $link_class = 'colorbox-video'; }
                                else { $href = $src[0]; $caption = 'Check It';  $link_class = 'colorbox-group';}
                            ?>
                            <a class="<?php echo $link_class; ?>" href="<?php echo $href ?>">
                    			<figcaption>
                    				<p><?php echo $caption; ?></p>
                    			</figcaption>
                                <div class="figcaption2"></div>
                                <div class="figcaption3"></div>
                            </a>
                		</figure>
                	</div>

                    <?php endfor; ?>

                </div>
                <div class="look-all-occasions">
                    <a href="<?php echo get_category_link('9'); ?>">Take a look at all our parties</a>
                </div>
                <h2>Future events</h2>
                <div class="row">
                    <div class="grey-stripe col-xs-6 col-xs-offset-3"></div>
                </div>
                <div class="row main-future-occ-block">
                    <?php $events = new WP_Query(array('post_type' => 'events', 'order' => 'DESC', 'posts_per_page' => 2)); ?>
                    <?php if ($events->have_posts()): while ($events->have_posts()): $events->the_post();?>
                    <div class="main-future-occ col-md-6">
                        <a href="<?php the_permalink(); ?>">
                            <div class="future-occ-img">
                                <?php the_post_thumbnail();?>
                            </div>
                        </a>
                        <div class="future-occ-info">
                            <a href="<?php the_permalink(); ?>">
                                <h3><?php the_title(); ?></h3>
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
                <div class="look-all-occasions">
                    <a href="<?php echo get_category_link('10'); ?>">All events we've done</a>
                </div>
            </div>
         </section>

         <section id="why-we" class="section-padding regular-section">
            <div class="container">
                <h2>Why Us</h2>
                <div class="row">
                    <div class="grey-stripe col-xs-6 col-xs-offset-3"></div>
                </div>
                <?php $options = get_option('ag_why_we'); ?>
                <p class="between-stripes"><?php echo esc_attr($options['ag_why_we_slogan_text_id'])  ?></p>
                <div class="row">
                    <div class="grey-stripe col-xs-2 col-xs-offset-5"></div>
                </div>

                <div class="why-we-block">
                    <div class="row">

                        <?php for($i = 1; $i < 5; $i++): ?>

                        <div class="why-we-item col-sm-3 col-xs-6">
                            <div class="why-we-img">
                                <?php $src = wp_get_attachment_image_src($options['ag_why_we_img_id'.$i], 'full');  ?>
                                <img src="<?php echo $src[0]; ?>" alt="" />
                            </div>
                            <p><?php echo $options['ag_why_we_desc_id'.$i]; ?></p>
                        </div>

                        <?php endfor; ?>
                    </div>
                </div>
            </div>

         </section>

         <section id="testimonials" class="section-padding regular-section">
            <div class="container">
                <h2>Testimonials</h2>
                <div class="row">
                    <div class="grey-stripe col-xs-6 col-xs-offset-3"></div>
                </div>
                <div class="reviews-carousel">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <?php $i = 0; ?>
                        <?php $testimonials = new WP_Query(array('post_type' => 'testimonials', 'order' => 'ASC')); ?>
                        <ol class="carousel-indicators">
                            <?php if ($testimonials->have_posts()): while ($testimonials->have_posts()): $testimonials->the_post();?>
                                <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" <?php if ($i == 0) echo 'class="active"'; ?>></li>
                                <?php $i++; ?>
                            <?php endwhile; ?>

                            <?php else: ?>

                            <?php endif; ?>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <?php $i = 1; ?>
                            <?php $testimonials = new WP_Query(array('post_type' => 'testimonials', 'order' => 'ASC')); ?>
                            <?php if ($testimonials->have_posts()): while ($testimonials->have_posts()): $testimonials->the_post();?>

                            <div class="item <?php if ($i == 1) echo 'active' ?>">
                                <div class="testimonial-item row">
                                    <div class="col-sm-offset-1 col-sm-3">
                                        <div class="testimonial-img">
                                            <?php the_post_thumbnail();?>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <h3><?php the_title(); ?></h3>
                                        <p class="testimonial-date"><?php echo get_post_meta($post->ID, 'testimonial_date', true); ?></p>
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            </div>

                            <?php $i++; ?>
                            <?php endwhile; ?>

                            <?php else: ?>

                            <?php endif; ?>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <div></div>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <div></div>
                        </a>
                    </div>
                </div>
            </div>
         </section>

         <section id="iband-main" class="section-padding regular-section">
            <div class="container">
                <h2>Iband creative group</h2>
                <div class="row">
                    <div class="grey-stripe col-xs-6 col-xs-offset-3"></div>
                </div>
                <p class="between-stripes"><?php echo $iband_names = get_post_meta(4, 'iband_short_desc', true);  ?></p>
                <div class="row">
                    <div class="grey-stripe col-xs-2 col-xs-offset-5"></div>
                </div>
                <div class="iband-group-block row">

                    <?php
                    $iband_names = get_post_meta(4, 'iband_names', true);
                    $iband_positions = get_post_meta(4, 'iband_positions', true);
                    $iband_main_imgs = get_post_meta(4, 'iband_main_imgs', true);
                    $iband_desc_imgs = get_post_meta(4, 'iband_desc_imgs', true);
                    ?>
                    <?php for ($i = 0; $i < 6; $i++): ?>

                    <div class="col-xs-4 col-md-2 iband-member">
                        <div class="iband-member-face">
                            <?php $src = wp_get_attachment_image_src($iband_main_imgs[$i], 'full');  ?>
                            <img src="<?php echo $src[0]; ?>" alt="" />
                        </div>
                        <p class="iband-rank"><?php echo $iband_positions[$i] ?></p>
                        <p class="iband-stars">***</p>
                        <p class="iband-name"><?php echo $iband_names[$i] ?></p>
                    </div>
                    <?php endfor; ?>

                </div>
                <div class="look-all-occasions">
                    <a href="<?php echo get_permalink(4); ?>">Meet the team</a>
                </div>
            </div>
         </section>

<?php get_footer(); ?>