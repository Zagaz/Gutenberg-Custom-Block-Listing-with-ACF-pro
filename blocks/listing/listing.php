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
    // var_dump the acf post type


    ?>
</pre>

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

        <div class="<?php echo esc_attr($blockClass . '-inputs'); ?>">

            <select class="<?php echo esc_attr($blockClass . '-selector'); ?>">
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

            <input type="text" class="<?php echo esc_attr($blockClass . '-search'); ?>" placeholder="Search..." />

        </div>
        <div class="<?php echo esc_attr($blockClass . '-grid'); ?>">
            <div class="<?php echo esc_attr($blockClass . '-grid-inner'); ?>">
                <?php
                if ($events->have_posts()) {
                    while ($events->have_posts()) {
                        $events->the_post();
                ?>
                        <div class="<?php echo esc_attr($blockClass . '-grid-item'); ?>">
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php the_title(); ?>" class="<?php echo esc_attr($blockClass . '-grid-item-image'); ?>" />

                            <h2 class="<?php echo esc_attr($blockClass . '-grid-item-title'); ?>"><?php the_title(); ?></h2>
                            <div class="<?php echo esc_attr($blockClass . '-grid-item-excerpt'); ?>"><?php the_excerpt(); ?></div>
                        </div>
                <?php
                    }
                } else {
                    echo '<p>No events found.</p>';
                }
                ?>
            </div>
        </div>

        <div class="<?php echo esc_attr($blockClass . '-pagination'); ?>">
            Here goes the pagination
        </div>

    </div>



</div>

<div class="<?php echo esc_attr($blockClass . '-pagination'); ?>">
    Here goes the pagination
</div>

</div>


</div>
<?php
wp_reset_postdata();
?>
</div>