<?php

/*
Template Name: Iband Template
*/

 ?>

<?php get_header('secondary'); ?>

        <section id="iband-page" class="section-padding regular-section">
            <div class="container">
                <h2>Iband Creatve Group</h2>
                <div class="row">
                    <div class="grey-stripe col-xs-6 col-xs-offset-3"></div>
                </div>
                <p class="between-stripes"><?php echo $iband_names = get_post_meta(4, 'iband_short_desc', true);  ?></p>
                <div class="row">
                    <div class="grey-stripe col-xs-2 col-xs-offset-5"></div>
                </div>
                <div class="regular-page-text">
                    <?php echo $post->post_content; ?>
                </div>
                <div class="best-celeb-button">
                    <button data-toggle="modal" data-target="#myModal" type="submit" class="order btn btn-default">Request awesome party</button>
                </div>
                <div class="iband-page-members-block row">
                    <?php
                        $iband_names = get_post_meta(4, 'iband_names', true);
                        $iband_positions = get_post_meta(4, 'iband_positions', true);
                        $iband_main_imgs = get_post_meta(4, 'iband_main_imgs', true);
                        $iband_desc_imgs = get_post_meta(4, 'iband_desc_imgs', true);
                    ?>
                    <?php for ($i = 0; $i < 6; $i++): ?>
                    <div class="col-sm-2 col-xs-4 iband-page-member">
                        <div class="iband-page-member-face">
                            <?php $src = wp_get_attachment_image_src($iband_desc_imgs[$i], 'full');  ?>
                            <img src="<?php echo $src[0]; ?>" alt="" />
                        </div>
                        <p class="iband-page-member-name"><?php echo $iband_names[$i] ?></p>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </section>

        <?php get_footer(); ?>