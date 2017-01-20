<?php

if ($_GET['post'] == 43) {
add_action( 'admin_init', 'my_admin' );
}

function my_admin() {
    add_meta_box( 'video_add_metabox',
        'Add Video',
        'display_video_add_metabox',
        'portfolio', 'normal', 'high'
    );
}

function display_video_add_metabox( $video ) {
    /**
    * Retrieving serialized meta fields
    **/

    $link_metas = get_post_meta($video->ID, 'videolink', true);
    $img_metas = get_post_meta($video->ID, 'videoimg', true);


    ?>
    <div class="portfolio-video-insert">
        <table>
            <tr>
                <th>Link</th>
                <th>Image</th>
                <th>delete</th>
            </tr>
            <?php for ($i = 0; $i < count($link_metas); $i++): ?>
            <tr class="video-add-block">
                <td class="choose-link-cell">
                    <input type="text" name="videolink<?php echo $i+1; ?>" value="<?php echo $link_metas[$i]; ?>">
                </td>
                <td class="choose-image-cell">
                    <input type="hidden" name="videoimg<?php echo $i+1; ?>" value="<?php echo $img_metas[$i]; ?>" />
                    <button type="button" class="button choose-image" >Choose Image</button>
                    <div class="img-container">
                        <?php $src = wp_get_attachment_image_src($img_metas[$i], 'full');  ?>
                        <img src="<?php echo $src[0]; ?>" alt="" />
                    </div>
                </td>
                <td class="delete-cell">
                    <button type="button" class="button delete-video"><span class="dashicons dashicons-no"></span></button>
                </td>

            </tr>
            <?php endfor; ?>

        </table>
        <button type="button" id="add-video-row" class="button add-video"><span class="dashicons dashicons-plus"></span> Add New Video</button>
    </div>
    <?php
}


add_action( 'save_post', 'add_movie_review_fields', 10, 2 );

function add_movie_review_fields( $video_id, $video ) {

    if ( $video_id == 43 ) {

        $metas = array();
        $empty_ids = array();
        $id = 0;

        /**
        * Saving empty fields ids
        **/

        foreach ($_POST as $name => $value) {
            if (preg_match("/videolink/i", $name)) {
                $metas[$name] = $value;
                if ($value == '') {
                    $id = (int)substr($name, 9, strlen($name));
                    $empty_ids[] = $id;
                }
            }
            if (preg_match("/videoimg/i", $name)) {
                $metas[$name] = $value;
                if ($value == '') {
                    $id = (int)substr($name, 8, strlen($name));
                    $empty_ids[] = $id;
                }
            }
        }


        $empty_ids = array_unique($empty_ids);

        $final_metas = array();
        $negative = false;

        $link_metas = array();
        $img_metas = array();

        /**
        * Getting rid of pairs of fields, where at least one field is empty and saving populated fields in 2 arrays
        **/

        foreach($metas as $name => $value) {
            if (preg_match("/videolink/i", $name)) $start = 9;
            else $start = 8;
            $id = (int)substr($name, $start, strlen($name));
            foreach ($empty_ids as $empty_id) {
                if ($id == $empty_id) {
                    $negative = true;
                }
            }
            if (!$negative) {
                if ($start == 9) $link_metas[] = $value;
                else $img_metas[] = $value;
            }
            $negative = false;
        }

        /**
        * Saving serialized meta fields
        **/

        update_post_meta( $video_id, 'videolink', $link_metas );
        update_post_meta( $video_id, 'videoimg', $img_metas );

    }
} ?>