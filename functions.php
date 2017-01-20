<?php

include dirname(__FILE__).'/functions/video-add.php';
include dirname(__FILE__).'/functions/main-gallery-admin.php';
include dirname(__FILE__).'/functions/why-we-admin.php';
include dirname(__FILE__).'/functions/iband-admin.php';
include dirname(__FILE__).'/functions/contacts-admin.php';
include dirname(__FILE__).'/functions/gl-ajax.php';

/**
* styles and scripts loading
*/

function load_style_script() {
    wp_enqueue_script('jquery-google',  'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
    wp_enqueue_script('bootstrap-gl',  get_template_directory_uri().'/js/bootstrap.min.js', array('jquery-google'), null, true);
    wp_enqueue_script('validator-gl',  get_template_directory_uri().'/js/validator.min.js', array('jquery-google'), null, true);
    wp_enqueue_script('colorbox-gl',  get_template_directory_uri().'/js/jquery.colorbox-min.js', array('jquery-google'), null, true);
    wp_enqueue_script('scripts-gl',  get_template_directory_uri().'/js/scripts.js', array('jquery-google'), null, true);
    wp_localize_script('scripts-gl', 'agajax', array('url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('agajax')));

    wp_enqueue_style('fonts-gl', 'https://fonts.googleapis.com/css?family=Droid+Serif:400,400i,700,700i|Open+Sans+Condensed:300,300i,700|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&subset=cyrillic');
    wp_enqueue_style('bootstrap-style-gl', get_template_directory_uri().'/css/bootstrap.min.css');
    wp_enqueue_style('colorbox-gl', get_template_directory_uri().'/css/colorbox.css');
    wp_enqueue_style('hover-effects-gl', get_template_directory_uri().'/css/hover-effects.css');
    wp_enqueue_style('style-gl', get_template_directory_uri().'/style.css');
    wp_enqueue_style('font-awesome-gl', get_template_directory_uri().'/css/font-awesome/css/font-awesome.min.css');
}

add_action('wp_enqueue_scripts', 'load_style_script');

function admin_load_style_script() {
    wp_enqueue_script('admin-jquery-google',  'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
    wp_enqueue_script('media-select',  get_template_directory_uri().'/js/media-select.js', array('jquery'), null, true);
    wp_enqueue_script('admin-scripts',  get_template_directory_uri().'/js/admin-scripts.js', array('jquery'), null, true);
    if ($_GET['post'] == 43) wp_localize_script('admin-scripts', 'img', array('url' => get_bloginfo('template_url').'/img/no-image.jpg', 'hide' => 1));
    else wp_localize_script('admin-scripts', 'img', array('url' => get_bloginfo('template_url').'/img/no-image.jpg', 'hide' => 0));
    wp_enqueue_style('my-admin', get_template_directory_uri().'/css/my-admin.css');
    if ( ! did_action( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
    }
}

add_action('admin_enqueue_scripts', 'admin_load_style_script');

add_action('wp_ajax_ag_me', 'ag_ajax_more_events');//Ajax check string
add_action('wp_ajax_nopriv_ag_me', 'ag_ajax_more_events');  //Ajax check string

add_action('wp_ajax_ag_contacts', 'ag_ajax_contact_form');//Ajax check string
add_action('wp_ajax_nopriv_ag_contacts', 'ag_ajax_contact_form');  //Ajax check string

/**
* menu
**/

register_nav_menus(array(
    'header_menu' => 'Header Menu'
));

/**
*   post-thumbnails support
**/

add_theme_support('post-thumbnails');

/**
 * deleting width and height of pictures
 */
add_filter('image_send_to_editor', 'udalit_attributi_razmerov_kartinki', 10);
add_filter('post_thumbnail_html', 'udalit_attributi_razmerov_kartinki', 10);

function udalit_attributi_razmerov_kartinki($ishodnik) {
  $ishodnik = preg_replace('/(width|height)="\d*"\s/', "", $ishodnik);
  return $ishodnik;
}


/**
* new post - service
**/

add_action('init', 'gl_service');

function gl_service() {
    register_post_type('service', array(
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes'),
        'menu_position' => 100,
        'menu_icon' => 'dashicons-hammer',
        'labels' => array(
            'name' => 'Services',
            'all_items' => 'All Servicess',
            'add_new' => 'New Service',
            'add_new_item' => 'Add New Service',
        ),
        'taxonomies' => array(
            'category'
        )
    ));
}

/**
* template router
**/

add_filter( 'template_include', 'include_template_function_service', 1 );

function include_template_function_service( $template_path ) {

    global $post;

    if ( is_category('our-service')) {
        $template_path = get_template_directory().'/service.php';
    }
    if ( is_category('portfolio')) {
        $template_path = get_template_directory().'/portfolio.php';
    }
    if ( is_category('events')) {
        $template_path = get_template_directory().'/events.php';
    }
    if ( is_single() && $post->post_type == 'portfolio') {
        $template_path = get_template_directory().'/portfolio.php';
    }
    if ( is_single() && $post->post_type == 'events') {
        $template_path = get_template_directory().'/single-event.php';
    }
    if (is_page(4)) {
        $template_path = get_template_directory().'/iband.php';
    }
    if ( is_category('partners')) {
        $template_path = get_template_directory().'/partners.php';
    }
    return $template_path;

}

/**
* new post - portfolio
**/

add_action('init', 'gl_porfolio');

function gl_porfolio() {


    register_post_type('portfolio', array(
        'public' => true,
        'supports' => array('title', 'editor'),
        'menu_position' => 101,
        'menu_icon' => 'dashicons-format-gallery',
        'labels' => array(
            'name' => 'Portfolio',
            'all_items' => 'All Portfolios',
            'add_new' => 'New Portfolio',
            'add_new_item' => 'Add New Portfolio',
        ),
        'taxonomies' => array(
            'category'
        )
    ));
}

/**
* new post - events
**/

add_action('init', 'gl_events');

function gl_events() {


    register_post_type('events', array(
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes'),
        'menu_position' => 104,
        'menu_icon' => 'dashicons-calendar-alt',
        'labels' => array(
            'name' => 'Events',
            'all_items' => 'All Events',
            'add_new' => 'New Event',
            'add_new_item' => 'Add New Event',
        ),
        'taxonomies' => array(
            'category'
        )
    ));
}

/**
* new post - testimonials
**/

add_action('init', 'gl_testimonials');

function gl_testimonials() {


    register_post_type('testimonials', array(
        'public' => true,
          'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'menu_position' => 102,
        'menu_icon' => 'dashicons-id-alt',
        'labels' => array(
            'name' => 'Testimonials',
            'all_items' => 'All Testimonials',
            'add_new' => 'New Testimonial',
            'add_new_item' => 'Add New Testimonial',
        )
    ));
}

/**
* new post - partners
**/

add_action('init', 'gl_partners');

function gl_partners() {

    register_post_type('partners', array(
        'public' => true,
          'supports' => array('title', 'editor', 'thumbnail'),
        'menu_position' => 103,
        'menu_icon' => 'dashicons-businessman',
        'labels' => array(
            'name' => 'Partners',
            'all_items' => 'All Partners',
            'add_new' => 'New Partner',
            'add_new_item' => 'Add New Partner',
        ),
        'taxonomies' => array(
            'category'
        )
    ));
}

/**
* gallery shortcode
**/

function portfolio_gallery($attr, $text='') {
    $img_src = explode(",", $attr['ids']);
    // шаблон удаления атрибутов ширины и высоты
    $pattern = '#(width|height)="\d+"#';
    $return = '';
    foreach ($img_src as $item) {
        $image_url = wp_get_attachment_image_src($item, 'full');
        // вырезаем атрибуты ширины и высоты
        $image_url = preg_replace($pattern, '', $image_url[0]);
        //формируем вывод картинок
        $return.= '<div class="grid">
                		<figure class="effect-bubba">
                            <img src="'.$image_url.'" alt="" />
                            <a class="colorbox-group" href="'.$image_url.'">
                    			<figcaption>
                    				<p>check it</p>
                    			</figcaption>
                                <div class="figcaption2"></div>
                                <div class="figcaption3"></div>
                                <div class="figcaption4"></div>
                            </a>
                		</figure>
                	</div>';
    }
    echo $return;
}

add_shortcode('gallery', 'portfolio_gallery');

/**
* Ajax check
**/

function ag_ajax_check(){
    if (!wp_verify_nonce($_POST['security']['nonce'], 'wfmajax')) {
        die('NO');
    }
    if (preg_match('/^#[a-z0-9]+$/i', $_POST['formData'] )) {
        echo 'Подходит';
    }
    else {
        echo 'Не подходит';
    }
    die();
}

function short_soc_link ($link) {
    $prefixes = array('https://www.', 'http://www.', 'https://', 'http://');
    foreach ($prefixes as $value) {
        if (strpos($link, $value) !== false) {
            $short_link = substr($link, strlen($value), strlen($link) - strlen($value));
            return $short_link;
        }
    }
}

/**
* remov
ing width and height from images
**/
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
    $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
    return $html;
}

/**
* Removing links from dashboard
**/


add_action( 'admin_menu', 'ag_remove_menu_items' );

function ag_remove_menu_items() {
    $user_id = get_current_user_id();
    if ($user_id == 2) {
        remove_menu_page('edit-comments.php');
        remove_menu_page('edit.php');
        remove_menu_page('upload.php');
        remove_menu_page('themes.php');
        remove_menu_page('plugins.php');
        remove_menu_page('tools.php');
        remove_menu_page('options-general.php');
        remove_menu_page('users.php');
        remove_menu_page('index.php');
        remove_menu_page('edit.php?post_type=cfs');
    }
}

/**
* Dashboard menu separator adding
**/

add_action( 'admin_menu', 'add_admin_menu_separator' );

function add_admin_menu_separator() {

	global $menu;

	$menu[ 107 ] = array(
		0	=>	'',
		1	=>	'read',
		2	=>	'separator107',
		3	=>	'',
		4	=>	'wp-menu-separator'
	);

}

/**
* Dashboard main page redirect
**/

add_action( 'admin_menu', 'dash_redirect' );

function dash_redirect() {
    $cur_page = $_SERVER['REQUEST_URI'];
    if ($cur_page == '/wp-admin/index.php' || $cur_page == '/wp-admin/' || $cur_page == '/wp-admin') {
        header('Location:'.get_site_url().'/wp-admin/edit.php?post_type=page');
        exit;
    }
}





 ?>