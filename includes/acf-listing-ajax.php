<?php
// You shall not pass!
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * AJAX handler for filtering events by taxonomy term.
 * This function receives the selected term via AJAX and returns the filtered event cards HTML.
 */
add_action('wp_ajax_acf_listing_filter', 'acf_listing_filter_callback');
add_action('wp_ajax_nopriv_acf_listing_filter', 'acf_listing_filter_callback');


function acf_listing_filter_callback()
{
    // Get the selected term slug and search string from AJAX request
    $term_slug = isset($_POST['term']) ? sanitize_text_field($_POST['term']) : '';


    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    $number = isset($_POST['number']) ? intval($_POST['number']) : -1;
    $order = isset($_POST['order']) ? sanitize_text_field($_POST['order']) : 'newer';

    $args = array(
        'post_type' => 'event',
        'posts_per_page' => $number,
        'orderby' => 'date',
        'order' => ($order === 'older' ? 'ASC' : 'DESC'),
    );

    // If a term is selected, filter by taxonomy term
    if (!empty($term_slug)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'events',
                'field'    => 'slug',
                'terms'    => $term_slug,
                // search words
                'relation' => 'OR',
                'meta_query' => array(
                    array(
                        'key'     => 'event_keywords',
                        'value'   => $search,
                        'compare' => 'LIKE'
                    )
                )
            ),
        );
    }

    // If a search string is provided, filter by title/content
    if (!empty($search)) {
        $args['s'] = $search;
    }

    $events = new WP_Query($args);

    ob_start();
    $blockClass = 'acf-listing'; // Assuming this is the class used in the listing block
    if ($events->have_posts()) {
        while ($events->have_posts()) {
            $events->the_post();
            $taxonomies = get_the_terms(get_the_ID(), 'events');
            $term_name = array();
            if (!empty($taxonomies) && !is_wp_error($taxonomies)) {
                foreach ($taxonomies as $taxonomy) {
                    $term_name[] = $taxonomy->name;
                }
            }
            require dirname(__FILE__) . '/acf-listing-card.php';
        }
    } else {
        echo '<p>No events found.</p>';
    }

    wp_reset_postdata();
    $html = ob_get_clean();
    wp_send_json_success(['html' => $html]);
}
