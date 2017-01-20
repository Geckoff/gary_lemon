<?php

function ag_ajax_more_events() {
    if(!wp_verify_nonce($_POST['security'], 'agajax')) {
        die('Security error');
    }

    $offset = (int)$_POST['page'] * 8;
    $posts = new WP_Query(array('post_type' => 'events', 'posts_per_page' => 8, 'offset' => $offset, 'order' => 'DESC'));

    $next = true;
    $next_posts = new WP_Query(array('post_type' => 'events', 'posts_per_page' => 8, 'offset' => $offset + 8, 'order' => 'DESC'));
    if (empty($next_posts->posts)) $next = false;

    $code = '';
    $events = array();
    foreach ($posts->posts as $value) {
        $title = $value->post_title;
        $excerpt = $value->post_excerpt;
        $premalink = get_permalink($value->ID);
        $event_date = get_post_meta($value->ID, 'event_date', true);
        $thumbnail = get_the_post_thumbnail($value->ID);
        $code .= '<div class="main-future-occ col-md-6">
                        <a href="'.$premalink.'">
                            <div class="future-occ-img">
                                '.$thumbnail.'
                            </div>
                        </a>
                        <div class="future-occ-info">
                            <a href="'.$premalink.'">
                                <h3>'.$title.'</h3>
                            </a>
                            <p class="occ-date">'.$event_date.'</p>
                            <div class="light-grey-stripe"></div>
                            <p class="fut-occ-text">'.$excerpt.'</p>
                        </div>
                    </div>';
    }

    $response = json_encode(array('code' => $code, 'next' => $next));

    echo $response;

    die;
}


function ag_ajax_contact_form() {
    if(!wp_verify_nonce($_POST['security'], 'agajax')) {
        die('Security error');
    }

    $form_data = array();

    $title = 'gary_form';
    foreach ($_POST['formData'] as $name => $value) {
        $value = strip_tags(htmlspecialchars($value));
        $form_data[$name] = $value;
    }
    $files = '';

    $data = (object) array(
        'title' => $title,
        'posted_data' => $form_data,
        'uploaded_files' => $files);

    // Call hook to submit data
    do_action_ref_array('cfdb_submit', array(&$data));

    $to = 'ag-geck@yandex.ru';
    $subject = "New order from {$form_data['name']}";
    $message = "You have got new order from {$form_data['name']}. Phone number: {$form_data['phone']}.<br>
                Comment: {$form_data['comment']}";

    wp_mail( $to, $subject, $message);

    echo 'Форма ушла';

    die;
}





 ?>