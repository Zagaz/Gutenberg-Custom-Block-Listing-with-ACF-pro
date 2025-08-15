<?php
/**
 * Hero Block Template
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block content (empty string).
 * @param bool $is_preview True during backend preview render.
 * @param int $post_id The post ID the block is rendering content against.
 */

// Create id attribute allowing for custom "anchor" value
$id = 'listing-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Block
$block_name = 'acf-listing'; // Block name (should be lowercase and without spaces)

// Handle text alignment
$block_align_text = isset($block['align_text']) ? $block['align_text'] : 'left';
$block_align = $block_name . '-text-align-' . $block_align_text;

// Create class attribute allowing for custom "className" and "align" values
$classes = 'hero-block';

// Add editor and preview classes if in editor
$is_preview = isset($block['is_preview']) && $block['is_preview'];
$is_editor = $is_preview ? ' is-editor' : '';
$preview_class = $is_preview ? ' is-preview' : '';

if( !empty($block['className']) ) {
    $classes .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $classes .= ' align' . $block['align'];
}


?>
<div class="<?php echo esc_attr($block_name .'-wrapper' ); ?><?php echo esc_attr($is_editor); ?>" style="<?php echo esc_attr($style); ?>">
<?php // This will display the event listing block content ?>
<?php
// Query for events
$events = new WP_Query(array(
    'post_type' => 'event',
    'posts_per_page' => -1,
));

// Check if there are any events to display
if ($events->have_posts()) {
    echo '<ul class="event-list">';
    while ($events->have_posts()) {
        $events->the_post();
        echo '<li>' . get_the_title() . '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>No events found.</p>';
}

// Reset post data
wp_reset_postdata();
?>
</div>

