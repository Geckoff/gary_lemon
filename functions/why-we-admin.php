<?php

/**
* Why We Block
**/

add_action('admin_menu', 'ag_why_we_menu');
add_action('admin_init','ag_why_we');

function ag_why_we_menu() {
    //$page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position
    add_menu_page('Why We', 'Why We', 'manage_options', 'ag-why-we', 'ag_why_we_layout', 'dashicons-universal-access', 1108);
}

function ag_why_we() {
    // $option_group, $option_name, $sanitize_callback
    register_setting('ag_why_we_group', 'ag_why_we', 'ag_why_we_sanitize');
    add_settings_section('ag_why_we_slogan_id', 'Slogan', '', 'ag-why-we');
    add_settings_field('ag_why_we_slogan_text_id', 'Slogan Text', 'ag_why_we_slogan_text_cb', 'ag-why-we', 'ag_why_we_slogan_id', array('label_for' =>'ag_why_we_slogan_text_id'));
    for ($i = 1; $i < 5; $i++) {
        add_settings_section('ag_why_we_id'.$i, 'Block '.$i, '', 'ag-why-we');
        add_settings_field('ag_why_we_img_id'.$i, 'Image', 'ag_why_we_img_cb', 'ag-why-we', 'ag_why_we_id'.$i, array('label_for' =>'ag_why_we_img_id'.$i, 'id' => $i));
        add_settings_field('ag_why_we_desc_id'.$i, 'Description', 'ag_why_we_desc_cb', 'ag-why-we', 'ag_why_we_id'.$i, array('label_for' =>'ag_why_we_desc_id'.$i, 'id' => $i));
    }

}

function ag_why_we_slogan_text_cb() {
    $options = get_option('ag_why_we');
    ?>
        <input type="text" style="width: 85%;" class='regular-text' name="ag_why_we[ag_why_we_slogan_text_id]" id="ag_why_we_slogan_text_id" value="<?php echo esc_attr($options['ag_why_we_slogan_text_id'])  ?>"  />
    <?php

}

function ag_why_we_img_cb($args) {
    $id = $args['id'];
    $options = get_option('ag_why_we');
    ?>
    <div class="why-we-settings portfolio-video-insert">
        <div class="video-add-block">
            <div class="choose-image-cell">
                <input type="hidden" name="ag_why_we[ag_why_we_img_id<?php echo $id; ?>]" value="<?php echo esc_attr($options['ag_why_we_img_id'.$id])  ?>" />
                <button type="button" class="button choose-image" >Choose Image</button>
                <div class="img-container">
                    <?php $src = wp_get_attachment_image_src($options['ag_why_we_img_id'.$id]);  ?>
                    <img src="<?php echo $src[0]; ?>" alt="" />
                </div>
            </div>
        </div>
    </div>
    <?php
}

function ag_why_we_desc_cb($args) {
    $id = $args['id'];
    $options = get_option('ag_why_we');
    ?>
        <textarea name="ag_why_we[ag_why_we_desc_id<?php echo $id; ?>]" id="ag_why_we_desc_id<?php echo $id; ?>" cols="50" rows="3"><?php echo esc_attr($options['ag_why_we_desc_id'.$id])  ?></textarea>
        <!--<input class="regular-text main-portfolio-link" type="text" class='regular-text' name="ag_main_gallery[ag_main_gallery_link_id<?php echo $id; ?>]" id="ag_main_gallery_link_id<?php echo $id; ?>" value="<?php echo esc_attr($options['ag_main_gallery_link_id'.$id])  ?>"  />-->
    <?php
}

function ag_why_we_sanitize($options) {
    $clean_options = array();
    foreach ($options as $k => $v) {
        $clean_options[$k] = strip_tags(esc_attr($v));
    }
    return $clean_options;

}

function ag_why_we_layout() {
    ?>
    <div class="wrap">
        <h2>Why We Main Page Block</h2>
        <form action="options.php" method="post">
            <?php settings_fields('ag_why_we_group'); ?>
            <?php do_settings_sections('ag-why-we'); ?>
            <?php submit_button(); ?>
        </form>
    </div>


    <?php
}


?>