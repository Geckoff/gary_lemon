<?php
/**
* Main page gallery
**/

add_action('admin_menu', 'ag_main_gallery_menu');
add_action('admin_init','ag_main_gallery');

function ag_main_gallery_menu() {
    //$page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position
    add_menu_page('Main Gallery', 'Main Gallery', 'manage_options', 'ag-main-gallery', 'ag_main_gallery_layout', 'dashicons-images-alt2', 1107);
}

function ag_main_gallery() {
    // $option_group, $option_name, $sanitize_callback
    register_setting('ag_main_gallery_group', 'ag_main_gallery', 'ag_main_gallery_sanitize');
    add_settings_section('ag_main_gallery_slogan_section_id', 'Slogan', '', 'ag-main-gallery');
    add_settings_field('ag_main_gallery_slogan_id', 'Your slogan', 'ag_main_gallery_slogan_cb', 'ag-main-gallery', 'ag_main_gallery_slogan_section_id', array('label_for' =>'ag_main_gallery_slogan_id'));
    for ($i = 1; $i < 10; $i++) {
        add_settings_section('ag_main_gallery_id'.$i, 'Block '.$i, '', 'ag-main-gallery');
        add_settings_field('ag_main_gallery_pic_video_id'.$i, 'Type', 'ag_main_gallery_pic_video_cb', 'ag-main-gallery', 'ag_main_gallery_id'.$i, array('label_for' =>'ag_main_gallery_pic_video_id'.$i, 'id' => $i));
        add_settings_field('ag_main_gallery_img_id'.$i, 'Image', 'ag_main_gallery_img_cb', 'ag-main-gallery', 'ag_main_gallery_id'.$i, array('label_for' =>'ag_main_gallery_img_id'.$i, 'id' => $i));
        add_settings_field('ag_main_gallery_link_id'.$i, 'Link', 'ag_main_gallery_link_cb', 'ag-main-gallery', 'ag_main_gallery_id'.$i, array('label_for' =>'ag_main_gallery_link_id'.$i, 'id' => $i));
    }

}

function ag_main_gallery_slogan_cb() {
    $options = get_option('ag_main_gallery');
    ?>
        <input type="text" style="width: 85%;" class='regular-text' name="ag_main_gallery[ag_main_gallery_slogan_id]" id="ag_main_gallery_slogan_id" value="<?php echo esc_attr($options['ag_main_gallery_slogan_id'])  ?>"  />
    <?php

}

function ag_main_gallery_pic_video_cb($args) {
    $id = $args['id'];
    $options = get_option('ag_main_gallery');
    ?>
    <select class='main-portfolio-settings' name="ag_main_gallery[ag_main_gallery_pic_video_id<?php echo $id; ?>]">
        <option value="1" <?php selected( $options['ag_main_gallery_pic_video_id'.$id], 1 );  ?>>Image</option>
        <option value="2" <?php selected( $options['ag_main_gallery_pic_video_id'.$id], 2 );  ?>>Video</option>
    </select>

    <?php

}

function ag_main_gallery_img_cb($args) {
    $id = $args['id'];
    $options = get_option('ag_main_gallery');
    ?>
    <div class="portfolio-video-insert">
        <div class="video-add-block">
            <div class="choose-image-cell">
                <input type="hidden" name="ag_main_gallery[ag_main_gallery_img_id<?php echo $id; ?>]" value="<?php echo esc_attr($options['ag_main_gallery_img_id'.$id])  ?>" />
                <button type="button" class="button choose-image" >Choose Image</button>
                <div class="img-container">
                    <?php $src = wp_get_attachment_image_src($options['ag_main_gallery_img_id'.$id]);  ?>
                    <img src="<?php echo $src[0]; ?>" alt="" />
                </div>
            </div>
        </div>
    </div>
    <?php
}

function ag_main_gallery_link_cb($args) {
    $id = $args['id'];
    $options = get_option('ag_main_gallery');
    ?>
        <input class="regular-text main-portfolio-link" type="text" class='regular-text' name="ag_main_gallery[ag_main_gallery_link_id<?php echo $id; ?>]" id="ag_main_gallery_link_id<?php echo $id; ?>" value="<?php echo esc_attr($options['ag_main_gallery_link_id'.$id])  ?>"  />
    <?php
}

function ag_main_gallery_sanitize($options) {
    $clean_options = array();
    foreach ($options as $k => $v) {
        $clean_options[$k] = strip_tags(esc_attr($v));
    }
    return $clean_options;

}

function ag_main_gallery_layout() {
    ?>
    <div class="wrap">
        <h2>Main Page Gallery</h2>
        <form action="options.php" method="post">
            <?php settings_fields('ag_main_gallery_group'); ?>
            <?php do_settings_sections('ag-main-gallery'); ?>
            <?php submit_button(); ?>
        </form>
    </div>


    <?php
}



?>