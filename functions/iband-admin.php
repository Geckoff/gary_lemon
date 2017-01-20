<?php
/**
* Iband Team
**/

if ($_GET['post'] == 4) {
add_action( 'admin_init', 'iband_team' );
add_action( 'admin_init', 'iband_team_short' );
}

function iband_team() {
    add_meta_box( 'member_add_metabox',
        'Iband Members',
        'iband_members_metabox',
        'page', 'normal', 'high'
    );
}

function iband_team_short() {
    add_meta_box( 'iband_short_desc',
        'Short Description',
        'iband_short_desc_metabox',
        'page', 'normal', 'high'
    );
}

function iband_short_desc_metabox($iband) {

    $short_desc = get_post_meta($iband->ID, 'iband_short_desc', true);

    ?>
        <textarea style='width: 100%' name="iband_short_desc" id="" cols="30" rows="3"><?php echo $short_desc; ?></textarea>
    <?php
}

function iband_members_metabox( $iband ) {
    /**
    * Retrieving serialized meta fields
    **/

    $iband_names = get_post_meta($iband->ID, 'iband_names', true);
    $iband_positions = get_post_meta($iband->ID, 'iband_positions', true);
    $iband_main_imgs = get_post_meta($iband->ID, 'iband_main_imgs', true);
    $iband_desc_imgs = get_post_meta($iband->ID, 'iband_desc_imgs', true);


    ?>
    <div class="iband_members_edit">
        <table>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Main Page Image</th>
                <th>Description Image</th>
            </tr>
            <?php for ($i = 0; $i < 6; $i++): ?>
            <tr>
                <td>
                    <input type="text" name="iband_name<?php echo $i+1 ?>" value="<?php echo $iband_names[$i]; ?>">
                </td>
                <td>
                    <input type="text" name="iband_position<?php echo $i+1 ?>" value="<?php echo $iband_positions[$i]; ?>">
                </td>
                <td class="choose-image-cell">
                    <input type="hidden" name="iband_main_img<?php echo $i+1; ?>" value="<?php echo $iband_main_imgs[$i]; ?>" />
                    <button type="button" class="button choose-image" >Choose Image</button>
                    <div class="img-container">
                        <?php $src = wp_get_attachment_image_src($iband_main_imgs[$i], 'full');  ?>
                        <img src="<?php echo $src[0]; ?>" alt="" />
                    </div>
                </td>
                <td class="choose-image-cell">
                    <input type="hidden" name="iband_desc_img<?php echo $i+1; ?>" value="<?php echo $iband_desc_imgs[$i]; ?>" />
                    <button type="button" class="button choose-image" >Choose Image</button>
                    <div class="img-container">
                        <?php $src = wp_get_attachment_image_src($iband_desc_imgs[$i], 'full');  ?>
                        <img src="<?php echo $src[0]; ?>" alt="" />
                    </div>
                </td>
            </tr>
            <?php endfor; ?>
        </table>
    </div>
    <?php
}


add_action( 'save_post', 'iband_members_save', 10);

function iband_members_save( $page_id ) {

    if ( $page_id == 4 ) {

        $metas = array(
            'iband_name' => array(),
            'iband_position' => array(),
            'iband_main_img' => array(),
            'iband_desc_img' => array()
        );

        /*$fields = array('iband_name' => $iband_names, 'iband_position' => $iband_positions, 'iband_main_img' => $iband_main_imgs, 'iband_desc_img' => $iband_desc_imgs);*/

        foreach ($_POST as $name => $value) {
            foreach ($metas as $field => $array) {
                if (preg_match("/".$field."/i", $name)) {
                    $value = htmlspecialchars($value);
                    array_push($metas[$field], $value);
                }
            }
        }

        $short_desc = htmlspecialchars($_POST['iband_short_desc']);

        update_post_meta( $page_id, 'iband_names', $metas['iband_name'] );
        update_post_meta( $page_id, 'iband_positions', $metas['iband_position'] );
        update_post_meta( $page_id, 'iband_main_imgs', $metas['iband_main_img'] );
        update_post_meta( $page_id, 'iband_desc_imgs', $metas['iband_desc_img'] );
        update_post_meta( $page_id, 'iband_short_desc', $short_desc );


    }
}


 ?>