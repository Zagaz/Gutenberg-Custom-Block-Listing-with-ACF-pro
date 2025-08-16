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
?>
            <div class="<?php echo esc_attr($blockClass . '-grid-item'); ?>">
                <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php the_title(); ?>" class="<?php echo esc_attr($blockClass . '-grid-item-image'); ?>" />
                <?php else : ?>
                    <!-- Use lorem picsum tandom image image  -->
                    <?php $random_id = rand(1, 1000); ?>
                    <img src="<?php echo esc_url('https://picsum.photos/480/360?random=' . $random_id); ?>" alt="<?php the_title(); ?>" class="<?php echo esc_attr($blockClass . '-grid-item-image'); ?>" />

                <?php endif; ?>

                <h2 class="<?php echo esc_attr($blockClass . '-grid-item-title'); ?>"><?php the_title(); ?></h2>
                <div class="<?php echo esc_attr($blockClass . '-grid-item-excerpt'); ?>"><?php the_excerpt(); ?></div>
            </div>
<?php
        }
    } else {
        echo '<p>No events found.</p>';
    }


    
    wp_reset_postdata();
    $html = ob_get_clean();

    // Return the HTML for the grid
    wp_send_json_success(['html' => $html]);
}
