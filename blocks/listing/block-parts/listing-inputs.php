
        <div class="<?php echo esc_attr($blockClass . '-inputs'); ?>">

            <?php //  the ajax must use the <select> element from this select 
            ?>

            <!-- The AJAX will use this <select> to filter the cards below -->
            <select class="<?php echo esc_attr($blockClass . '-selector acf-listing-selector'); ?>">
                <option value="" >Select an option</option>
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
