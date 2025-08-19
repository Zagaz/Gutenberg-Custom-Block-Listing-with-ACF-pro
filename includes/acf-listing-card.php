<?php
// This is the vcards 
?>
<div class="<?php echo esc_attr($blockClass . '-grid-item'); ?>">
      <?php 
         $term_tags = "";
        if (count($term_name) > 1) {
            $term_tags = '<i class="fa-solid fa-tags"></i>';
        } else {
            $term_tags = '<i class="fa-solid fa-tag"></i>';
        }
    ?>

    <div class="<?php echo esc_attr($blockClass . '-grid-item-tags'); ?>">
        <?php if (!empty($term_name)) : ?>
            <?php echo wp_kses_post($term_tags); ?>
            <div class="<?php echo esc_attr($blockClass . '-grid-item-term'); ?>">
                <?php echo esc_html(implode(', ', $term_name)); ?>
            </div>
        <?php endif; ?>

    </div>
    <?php if (has_post_thumbnail()) : ?>
        <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php the_title(); ?>" class="<?php echo esc_attr($blockClass . '-grid-item-image'); ?>" />
    <?php else : ?>
        <!-- Use lorem picsum random image -->
        <?php $random_id = rand(1, 1000); ?>
        <img src="<?php echo esc_url('https://picsum.photos/480/360?random=' . $random_id); ?>" alt="<?php the_title(); ?>" class="<?php echo esc_attr($blockClass . '-grid-item-image'); ?>" />
    <?php endif; ?>
  

    <h2 class="<?php echo esc_attr($blockClass . '-grid-item-title'); ?>"><?php the_title(); ?></h2>
    <div class="<?php echo esc_attr($blockClass . '-grid-item-excerpt'); ?>"><?php the_excerpt(); ?></div>

    <!-- Example: Render the ACF 'block_field' value -->

    <p>
        ACF Field data:
        <?php 
        $acf_field = get_field('block_field') ? get_field('block_field') : 'Default Value';
        echo esc_html($acf_field); ?>
        
    </p>

<?php 


?>

</div>  