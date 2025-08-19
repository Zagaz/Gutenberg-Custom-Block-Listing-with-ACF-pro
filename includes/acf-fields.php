<?php 

add_action( 'init', function() {
	register_taxonomy( 'events', array('event'), array(
		'labels' => array(
			'name' => 'Events',
			'singular_name' => 'event',
			'menu_name' => 'Events',
			'all_items' => 'All Events',
			'edit_item' => 'Edit event',
			'view_item' => 'View event',
			'update_item' => 'Update event',
			'add_new_item' => 'Add New event',
			'new_item_name' => 'New event Name',
			'parent_item' => 'Parent event',
			'parent_item_colon' => 'Parent event:',
			'search_items' => 'Search Events',
			'not_found' => 'No events found',
			'no_terms' => 'No events',
			'filter_by_item' => 'Filter by event',
			'items_list_navigation' => 'Events list navigation',
			'items_list' => 'Events list',
			'back_to_items' => '← Go to events',
			'item_link' => 'event Link',
			'item_link_description' => 'A link to a event',
		),
		'public' => true,
		'hierarchical' => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
	) );
} );


add_action( 'init', function() {
	register_post_type( 'event', array(
		'labels' => array(
			'name' => 'Events',
			'singular_name' => 'Event',
			'menu_name' => 'Events',
			'all_items' => 'All Events',
			'edit_item' => 'Edit Event',
			'view_item' => 'View Event',
			'view_items' => 'View Events',
			'add_new_item' => 'Add New Event',
			'add_new' => 'Add New Event',
			'new_item' => 'New Event',
			'parent_item_colon' => 'Parent Event:',
			'search_items' => 'Search Events',
			'not_found' => 'No events found',
			'not_found_in_trash' => 'No events found in Trash',
			'archives' => 'Event Archives',
			'attributes' => 'Event Attributes',
			'insert_into_item' => 'Insert into event',
			'uploaded_to_this_item' => 'Uploaded to this event',
			'filter_items_list' => 'Filter events list',
			'filter_by_date' => 'Filter events by date',
			'items_list_navigation' => 'Events list navigation',
			'items_list' => 'Events list',
			'item_published' => 'Event published.',
			'item_published_privately' => 'Event published privately.',
			'item_reverted_to_draft' => 'Event reverted to draft.',
			'item_scheduled' => 'Event scheduled.',
			'item_updated' => 'Event updated.',
			'item_link' => 'Event Link',
			'item_link_description' => 'A link to a event.',
		),
		'public' => true,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-admin-post',
		'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
		'taxonomies' => array('events'),
		'delete_with_user' => false,
	) );
} );

// Register ACF fields programmatically for standalone use
if( function_exists('acf_add_local_field_group') ) {
	acf_add_local_field_group(array(
		'key' => 'group_event_fields',
		'title' => 'Event Fields',
		'fields' => array(
			array(
				'key' => 'field_event_keywords',
				'label' => 'Event Keywords',
				'name' => 'event_keywords',
				'type' => 'text',
			),
			// Add more fields as needed
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
				),
			),
		),
	));
}

