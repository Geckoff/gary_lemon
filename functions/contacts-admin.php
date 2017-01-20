<?php
/**
* Contacts
**/

 add_action('admin_menu', 'ag_contacts_menu');
add_action('admin_init','ag_contacts');

function ag_contacts_menu() {
    //$page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position
    add_menu_page('Contacts', 'Contacts', 'manage_options', 'ag-contacts', 'ag_contacts_layout', 'dashicons-phone', 1110);
}

function ag_contacts() {
    // $option_group, $option_name, $sanitize_callback
    register_setting('ag_contacts_group', 'ag_pe', 'ag_contacts_sanitize');
    add_settings_section('ag_contacts_pe_id', 'Main Contacts', '', 'ag-contacts');
    add_settings_field('ag_phone_id', 'Phone Number', 'ag_contact_cb', 'ag-contacts', 'ag_contacts_pe_id', array('label_for' =>'ag_phone_id', 'type' => 'ag_phone_id'));
    add_settings_field('ag_email_id', 'Email', 'ag_contact_cb', 'ag-contacts', 'ag_contacts_pe_id', array('label_for' =>'ag_email_id', 'type' => 'ag_email_id'));

    register_setting('ag_contacts_group', 'ag_social_networks', 'ag_contacts_sanitize');
    add_settings_section('ag_contacts_social_id', 'Social Networks', '', 'ag-contacts');
    add_settings_field('ag_facebook_id', 'Facebook', 'ag_soc_net_cb', 'ag-contacts', 'ag_contacts_social_id', array('label_for' =>'ag_facebook_id', 'network' => 'ag_facebook_id'));
    add_settings_field('ag_instagram_id', 'Instagram', 'ag_soc_net_cb', 'ag-contacts', 'ag_contacts_social_id', array('label_for' =>'ag_instagram_id', 'network' => 'ag_instagram_id'));
    add_settings_field('ag_twitter_id', 'Twitter', 'ag_soc_net_cb', 'ag-contacts', 'ag_contacts_social_id', array('label_for' =>'ag_twitter_id', 'network' => 'ag_twitter_id'));
}

function ag_contact_cb($data) {
    $type = $data['type'];
    $option = get_option('ag_pe');
    echo "<input type='text' name='ag_pe[".$type."]' value='".esc_attr($option[$type])."' class='regular-text'>";
}

function ag_soc_net_cb($data) {
    $network = $data['network'];
    $option = get_option('ag_social_networks');
    echo "<input type='text' name='ag_social_networks[".$network."]' value='".esc_attr($option[$network])."' class='regular-text'>";
}

function ag_contacts_sanitize($options) {
    if (!is_array($options)) {
        $options = strip_tags(esc_attr($options));
        return $options;
    }
    else {
        $clean_options = array();
        foreach ($options as $k => $v) {
            $clean_options[$k] = strip_tags(esc_attr($v));
        }
        return $clean_options;
    }
}

function ag_contacts_layout() {
    ?>
    <div class="wrap">
        <h2>Contacts</h2>
        <form action="options.php" method="post">
            <?php settings_fields('ag_contacts_group'); ?>
            <!--<?php do_settings_fields('ag-contacts', 'ag_contacts_social_id'); ?>  -->
            <?php do_settings_sections('ag-contacts'); ?>

            <?php submit_button(); ?>
        </form>
    </div>


    <?php
}

?>