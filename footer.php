<section id="footer" class="section-padding regular-section">
            <div class="footer-block container">
                <?php $pe = get_option('ag_pe'); ?>
                <div class="col-xs-3 footer-item">
                    <p><span class="footer-item-name">Phone</span>  <span><?php echo esc_attr($pe['ag_phone_id']);  ?></span></p>
                </div>
                <div class="col-xs-3 footer-item">
                    <p><span class="footer-item-name">E-mail</span>  <span><?php echo esc_attr($pe['ag_email_id']);  ?></span></p>
                </div>
                <div class="col-xs-3 footer-item">
                    <?php $social = get_option('ag_social_networks'); ?>
                    <ul class="soc-net">
                        <li>
                            <a href="<?php echo esc_attr($social['ag_facebook_id']);  ?>">
                                <img src="<?php bloginfo('template_url') ?>/img/facebook.jpg" alt="" />
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_attr($social['ag_instagram_id']);  ?>">
                                <img src="<?php bloginfo('template_url') ?>/img/inst.jpg" alt="" />
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_attr($social['ag_twitter_id']);  ?>">
                                <img src="<?php bloginfo('template_url') ?>/img/tiwtter.jpg" alt="" />
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-3 footer-item">
                    <a href="">
                        <img src="<?php bloginfo('template_url') ?>/img/fpro.png" alt="" />
                    </a>
                </div>
            </div>
         </section>

        <?php wp_footer(); ?>
    </body>
</html>