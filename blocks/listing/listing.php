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
<pre>
    <?php
    // var_dump($block); // Debugging line to check block attributes
    // var_dump($is_preview); // Debugging line to check if in preview mode
    ?>
</pre>
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

// Create class attribute allowing for custom "className" and "align" values
$classes = 'hero-block';

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
        The root
        <div class="<?php echo esc_attr($blockClass . '-type'); ?>">
            here goes the Type Title
            <h1 class="<?php echo esc_attr($blockClass . '-type-title'); ?>"> the type name</h1>
        </div>

        <div class="<?php echo esc_attr($blockClass . '-inputs'); ?>">
        
            <div class="<?php echo esc_attr($blockClass . '-selector'); ?>">
                the selector
            </div>
            <div class="<?php echo esc_attr($blockClass . '-search'); ?>">
                the search
            </div>
        </div>
        <div class="<?php echo esc_attr($blockClass . '-grid'); ?>">
            here goes the grid and php listing
        </div>

        <div class="<?php echo esc_attr($blockClass . '-pagination'); ?>">
            here goes the pagination
        </div>

    </div>


</div>
















//=========
<?php // This will display the event listing block content
?>
<?php
$post_type = 'event'; // Custom post type slug
$posts_per_page = -1; // Number of posts to display, -1 for all
// Query for events
$events = new WP_Query(array(
    'post_type' => $post_type,
    'posts_per_page' => $posts_per_page,
));








//==========================================

// Check if there are any events to display
// if ($events->have_posts()) {
//     echo '<ul class="event-list">';
//     while ($events->have_posts()) {
//         $events->the_post();
//         echo '<li>' . get_the_title() . '</li>';
//     }
//     echo '</ul>';
// } else {
//     echo '<p>No events found.</p>';
// }

// // Reset post data
// wp_reset_postdata();
?>
</div>