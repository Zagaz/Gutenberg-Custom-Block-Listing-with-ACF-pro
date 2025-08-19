<?php 

// Only register block if ACF Pro is active
add_action('acf/init', 'acf_listing_block_init');
function acf_listing_block_init() {
    if (!function_exists('acf_register_block_type')) {
        // Show admin notice if ACF Pro is missing
        add_action('admin_notices', function() {
            echo '<div class="notice notice-error is-dismissible"><p><strong>ACF Pro is required:</strong> Please install and activate the Advanced Custom Fields Pro plugin for the Listing Block to work.</p></div>';
        });
        return;
    }

    $block_name = defined('ACF_LISTING_BLOCK_NAME') ? ACF_LISTING_BLOCK_NAME : 'acf-listing';
    $block_title = defined('ACF_LISTING_BLOCK_TITLE') ? ACF_LISTING_BLOCK_TITLE : 'ACF Listing';
    $block_description = defined('ACF_LISTING_BLOCK_DESCRIPTION') ? ACF_LISTING_BLOCK_DESCRIPTION : 'A dynamic listing block using ACF Pro.';
    $block_text_domain = defined('ACF_LISTING_BLOCK_TEXT_DOMAIN') ? ACF_LISTING_BLOCK_TEXT_DOMAIN : 'acf-block-listing';
    $block_icon = defined('ACF_LISTING_BLOCK_ICON') ? ACF_LISTING_BLOCK_ICON : 'superhero-alt';
    $block_render_template = dirname(__DIR__) . '/blocks/listing/listing.php';
    $plugin_url = plugin_dir_url(dirname(__DIR__) . '/acf_listing.php');
    
    
    acf_register_block_type(array(
        'name'              => $block_name,
        'title'             => __($block_title, $block_text_domain),
        'description'       => __($block_description, $block_text_domain),
        'render_template'   => $block_render_template,
        'category'          => 'formatting',
        'icon'              => $block_icon,
        'keywords'          => array('acf','listing', 'quote', 'posts'),
        'enqueue_style'     => $plugin_url . 'assets/css/style.css',
        'supports'          => array(
            'anchor' => true,
            'customClassName' => true,
        ),
    ));
}
