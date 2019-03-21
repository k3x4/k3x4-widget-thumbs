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
    $ids = $_POST['ids'];
    $ids = explode(',', $ids);

    $urls = [];
    foreach ($ids as $id) {
        $meta = get_post_meta($id, '_wp_attachment_metadata', true);
        $urls[] = [
            'id' => $id,
            'url' => wp_upload_dir()['baseurl'] . '/' . dirname($meta['file']) . '/' . $meta['sizes']['thumbnail']['file']
        ];
    }

    echo json_encode($urls);

    wp_die();
});