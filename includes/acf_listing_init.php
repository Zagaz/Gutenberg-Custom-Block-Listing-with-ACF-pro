<?php 

add_action('acf/init', 'acf_hero_init');
function acf_hero_init()
{

    $block_render_template = dirname(__DIR__) . '/blocks/listing/listing.php';

    if (function_exists('acf_register_block_type')) {
        $plugin_url = plugin_dir_url(dirname(__DIR__) . '/acf_listing.php');
        acf_register_block_type(array(
     
            'render_template'   => $block_render_template,
            'category'          => 'formatting',
            'icon'              => 'superhero-alt',
            'keywords'          => array('acf','listing', 'quote', 'posts'),
            'enqueue_style'     => $plugin_url . 'assets/css/style.css',
                'supports'          => array(
                'anchor' => true,
                'customClassName' => true,
            ),
        ));
    }
}
