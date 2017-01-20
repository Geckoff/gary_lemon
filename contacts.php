<?php

/*
Template Name: Contacts Template
*/

 ?>

<?php get_header('secondary'); ?>

        <section id="contacts-page" class="section-padding regular-section">
            <div class="container">
                <h2>Contacts Us</h2>
                <div class="row">
                    <div class="grey-stripe col-xs-6 col-xs-offset-3"></div>
                </div>
                <p class="between-stripes"><?php echo get_post_meta($post->ID, 'contacts_short_desc', true);  ?></p>
                <div class="row">
                    <div class="grey-stripe col-xs-2 col-xs-offset-5"></div>
                </div>

                <div class="row contacts-block">
                    <div class="col-sm-3 left-contact-block">
                        <p class="left-contact-block-title" >Contacts</p>
                        <?php $pe = get_option('ag_pe'); ?>
                        <p class="contact-phones-item"><span>Phone</span><?php echo esc_attr($pe['ag_phone_id']);  ?></p>
                        <p class="contact-phones-item"><span>Email</span><?php echo esc_attr($pe['ag_email_id']);  ?></p>
                        <p class="left-contact-block-title" >Social nets</p>
                        <?php $social = get_option('ag_social_networks'); ?>
                        <p class="contact-phones-item"><a href="<?php echo esc_attr($social['ag_facebook_id']);  ?>"><?php echo short_soc_link($social['ag_facebook_id']);  ?></a></p>
                        <p class="contact-phones-item"><a href="<?php echo esc_attr($social['ag_instagram_id']);  ?>"><?php echo short_soc_link($social['ag_instagram_id']);  ?></a></p>
                        <p class="contact-phones-item"><a href="<?php echo esc_attr($social['ag_twitter_id']);  ?>"><?php echo short_soc_link($social['ag_twitter_id']);  ?></a></p>
                        <div class="contact-left-desc">
                            <?php if (have_posts()): while (have_posts()): the_post();?>
                                <?php the_content(); ?>
                            <?php endwhile; ?>
                            <?php else: ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-sm-9 right-contact-block">
                        <div class="contacts-form-garik">
                            <img src="<?php bloginfo('template_url') ?>/img/garik-big.png" alt="" />
                        </div>
                        <form id="myForm2" role="form" data-toggle="validator" class="garik-form">
                            <h2>Leave a Request</h2>
                            <div class="form-group">
                                <p>Your Name</p>
                                <input type="text" name="name" class="form-control"  placeholder="Name"  required />
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group">
                                <p>Your Phone Number</p>
                                <input type="tel" name="name" class="form-control" placeholder="970 111 1111"  required />
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group">
                                <p>Your Comment</p>
                                <textarea class="form-control" id="comment" rows="3" placeholder="Comment"></textarea>
                            </div>
                            <button type="submit" class="order btn btn-default">Leave Request</button>
                        </form>

                    </div>
                </div>



            </div>
        </section>

        <?php get_footer(); ?>