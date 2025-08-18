<?php

/**
 * Hero Block Template
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block content (empty string).
 * @param bool $is_preview True during backend preview render.
 * @param int $post_id The post ID the block is rendering content against.
 */
?>


<?php

$post_type = 'event'; // Custom post type slug
$posts_per_page = -1; // Number of posts to display, -1 for all

// Query for events
$events = new WP_Query(array(
    'post_type' => $post_type,
    'posts_per_page' => $posts_per_page,
));

$post_type_taxonomies = get_object_taxonomies($post_type, 'names');
$post_type_name = $events->query['post_type'];

?>

<?php
// Create id attribute allowing for custom "anchor" value
$id = 'listing-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Block
$block_name = 'acf-listing'; // Block name (should be lowercase and without spaces)

// Handle text alignment
$block_align_text = isset($block['align_text']) ? $block['align_text'] : 'left';
$block_align = $block_name . '-text-align-' . $block_align_text;


// Add editor and preview classes if in editor

if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}


?>
<?php
// Checks if in preview mode (Backend)
$check_id_preview = $is_preview ? ' is-preview' : '';
$class_attr = $block_name . '-wrapper' . $check_id_preview;

?>
<?php
$blockClass = 'acf-listing';
$blockID = 'listing-' . $block['id'];

?>
<div class="<?php echo esc_attr($blockClass . ' ' . $check_id_preview);  ?>" id="<?php echo esc_attr($blockID); ?>">

    <div class="<?php echo esc_attr($blockClass . '-wrapper'); ?>" style="<?php echo esc_attr($style); ?>">

        <div class="<?php echo esc_attr($blockClass . '-type'); ?>">
            <?php
            if (!$post_type_name || !empty($post_type_name)) : ?>
                <h1 class="<?php echo esc_attr($blockClass . '-type-title'); ?>">
                    List of:
                    <?php
                    $post_type_name = ucfirst($post_type_name);
                    echo esc_html($post_type_name);
                    ?>
                </h1>
            <?php endif; ?>
        </div>

        <?php // This is the INPUTS section  
        ?>
        <div class="<?php echo esc_attr($blockClass . '-inputs'); ?>">

            <?php //  the ajax must use the <select> element from this select 
            ?>

            <!-- The AJAX will use this <select> to filter the cards below -->
            <select class="<?php echo esc_attr($blockClass . '-selector acf-listing-selector'); ?>">
                <option value="">Select an option</option>
                <?php
                // here I need the list of the terms related to 'events' post type.
                $post_type_taxonomies = get_object_taxonomies('event', 'names');
                foreach ($post_type_taxonomies as $taxonomy) {
                    $terms = get_terms(array(
                        'taxonomy' => $taxonomy,
                        'hide_empty' => true,
                    ));
                    if (!empty($terms) && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            echo '<option value="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
                        }
                    }
                }
                ?>
            </select>

            <?php // The Number of Items 
            ?>
            <div class="<?php echo esc_attr($blockClass . '-number-items-wrapper'); ?>">
                <p>Number of Items</p>
                <select class="<?php echo esc_attr($blockClass . '-selector' .' '.$blockClass . '-number-items'); ?>">
                    <option value="4">4</option>
                    <option value="8">8</option>
                    <option value="12">12</option>
                    <option value="16">16</option>
                    <option value="20">20</option>
                </select>
            </div>

            <?php  // Order: Older or Newer
            ?>
            <div class="<?php echo esc_attr($blockClass . '-order-wrapper'); ?>">
                <p>Order:</p>
                <select class="<?php echo esc_attr($blockClass . '-selector' .' '.$blockClass . '-order'); ?>">
                    <option value="newer">Newest first</option>
                    <option value="older">Oldest first</option>
                </select>
            </div>

            <?php // The Search 
            ?>
            <input type="text" class="<?php echo esc_attr($blockClass . '-search' .' '.$blockClass . '-text'); ?>" placeholder="Search..." />
        </div>


        <?php // THE GRID -  The fetch data from ajax inpacts in this grid  
        ?>
        <div class="<?php echo esc_attr($blockClass . '-grid'); ?>">
            <div class="<?php echo esc_attr($blockClass . '-grid-inner'); ?>">
                <?php
                if ($events->have_posts()) {
                    while ($events->have_posts()) {
                        $events->the_post();
                        // Use acf-listing shared card template for rendering
                        include dirname(dirname(__FILE__)) . '/includes/acf-listing-card.php';
                    }
                } else {
                    echo '<p>No events found.</p>';
                }
                ?>
            </div>
            <div class="<?php echo esc_attr($blockClass . '-pagination'); ?>">
                <button class="<?php echo esc_attr($blockClass . '-pagination-button'); ?>">Previous</button>
                <button class="<?php echo esc_attr($blockClass . '-pagination-button'); ?>">Next</button>
            </div>
        </div>

    </div>
    
</div>
<?php
wp_reset_postdata();
?>