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


// Initialize $classes to avoid undefined variable warning
$classes = '';
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




<div class="acf-listing" id="<?php echo esc_attr($blockID); ?>">
    <div class="acf-listing-wrapper">
        <div class="acf-listing-type">
            <?php if (!$post_type_name || !empty($post_type_name)) : ?>
                <h1 class="acf-listing-type-title">
                    List of:
                    <?php $post_type_name = ucfirst($post_type_name); echo esc_html($post_type_name); ?>
                </h1>
            <?php endif; ?>
        </div>
        <div class="acf-listing-inputs">
            <select class="acf-listing-selector acf-listing-selector">
                <option value="">Select an option</option>
                <?php
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
            <div class="acf-listing-number-items-wrapper">
                <p>Number of Items</p>
                <select class="acf-listing-selector acf-listing-number-items">
                    <option value="4">4</option>
                    <option value="8">8</option>
                    <option value="12">12</option>
                    <option value="16">16</option>
                    <option value="20">20</option>
                </select>
            </div>
            <div class="acf-listing-order-wrapper">
                <p>Order:</p>
                <select class="acf-listing-selector acf-listing-order">
                    <option value="newer">Newest first</option>
                    <option value="older">Oldest first</option>
                </select>
            </div>
            <input type="text" class="acf-listing-search acf-listing-text" placeholder="Search..." />
        </div>
        <div class="acf-listing-grid">
            <div class="acf-listing-grid-inner">
                <?php
                if ($events->have_posts()) {
                    while ($events->have_posts()) {
                        $events->the_post();
                        include dirname(dirname(__FILE__)) . '/includes/acf-listing-card.php';
                    }
                } else {
                    echo '<p>No events found.</p>';
                }
                ?>
            </div>
            <div class="acf-listing-pagination">
                <?php // Pagination goes here ?>
            </div>


        </div>
    </div>
</div>
<?php
wp_reset_postdata();
?>