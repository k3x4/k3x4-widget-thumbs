<?php
/**
* Plugin Name: k3x4 widget thumbs
* Plugin URI: https://knz.gr
* Description: Widget preview imgs (amazing plugin)
* Version: 1.0
* Author: k3x4
* Author URI: https://knz.gr
**/

add_action('admin_enqueue_scripts', function($hook){
    $screen = get_current_screen();
    if($screen->id == 'widgets'){
        wp_enqueue_script( 'k3x4-widget-thumbs', plugin_dir_url( __FILE__ ) . 'js/admin.js', ['jquery'], null, true);
    }
});

add_action( 'wp_ajax_k3x4_widgets_imgs', function(){
    $elems = $_POST['ids'];

    $i = 0;
    foreach ($elems as $elem) {
        $meta = get_post_meta($elem['attachId'], '_wp_attachment_metadata', true);
        $elems[$i++]['attachUrl'] = wp_upload_dir()['baseurl'] . '/' . dirname($meta['file']) . '/' . $meta['sizes']['thumbnail']['file'];
    }

    echo json_encode($elems);

    wp_die();
});

add_action('admin_head', function(){
    ?>
    <style>
        #widgets-right .widget[id*="media_image"] .widget-top,
        #widgets-right .widget[id*="media_image"] .widget-top .inject-img,
        #widgets-right .widget[id*="media_image"] .widget-top .ui-sortable-handle{
            width: auto;
            height: 100px;
        }
        #widgets-right .widget[id*="media_image"] .widget-top .inject-img{
            display: inline-block;
            float: left;
        }
    </style>
    <?php
});