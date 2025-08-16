<?php
/**
 * Card template for ACF Listing (shared by block and AJAX)
 * Usage: include this file inside the loop to render a single card.
 * Variables required: $blockClass (string)
 */
?>
<div class="<?php echo esc_attr($blockClass . '-grid-item'); ?>">
    <?php if (has_post_thumbnail()) : ?>
        <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php the_title(); ?>" class="<?php echo esc_attr($blockClass . '-grid-item-image'); ?>" />
    <?php else : ?>
        <!-- Use lorem picsum random image -->
        <?php $random_id = rand(1, 1000); ?>
        <img src="<?php echo esc_url('https://picsum.photos/480/360?random=' . $random_id); ?>" alt="<?php the_title(); ?>" class="<?php echo esc_attr($blockClass . '-grid-item-image'); ?>" />
    <?php endif; ?>
    <h2 class="<?php echo esc_attr($blockClass . '-grid-item-title'); ?>"><?php the_title(); ?></h2>
    <div class="<?php echo esc_attr($blockClass . '-grid-item-excerpt'); ?>"><?php the_excerpt(); ?></div>
</div>
