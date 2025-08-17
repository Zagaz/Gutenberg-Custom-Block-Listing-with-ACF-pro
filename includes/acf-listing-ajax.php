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
    // Get the selected term slug from AJAX request
    $term_slug = isset($_POST['term']) ? sanitize_text_field($_POST['term']) : '';

    $args = array(
        'post_type' => 'event',
        'posts_per_page' => -1,
    );

    // If a term is selected, filter by taxonomy term
    if (!empty($term_slug)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'events',
                'field'    => 'slug',
                'terms'    => $term_slug,
            ),
        );
    }

    $events = new WP_Query($args);

    ob_start();
    // Once the option is selected, the AJAX will use the <select> element 
    //to filter the cards below and update the grid item (Cards).
    $blockClass = 'acf-listing';
    if ($events->have_posts()) {
        while ($events->have_posts()) {
            $events->the_post();
            // get the taxonomy terms
            $taxonomies = get_the_terms(get_the_ID(), 'events');
            $term_name = [];
            foreach ($taxonomies as $taxonomy) {
                $term_name[] = $taxonomy->name;
            }
            

            // Get render the cards
            require dirname(__FILE__) . '/acf-listing-card.php';
        }
    } else {
        echo '<p>No events found.</p>';
    }



    wp_reset_postdata();
    $html = ob_get_clean();

    // Return the HTML for the grid
    wp_send_json_success(['html' => $html]);
}
