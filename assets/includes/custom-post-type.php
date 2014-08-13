<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

// let's create the function for the custom type
function custom_post() { 
	// creating (registering) the custom type 
	register_post_type( 'portfolio-work', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Portfolio' ), /* This is the Title of the Group */
			'singular_name' => __( 'Portfolio Item' ), /* This is the individual type */
			'all_items' => __( 'All Portfolio Items' ), /* the all items menu item */
			'add_new' => __( 'Add New' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Portfolio Item' ), /* Add New Display Title */
			'edit' => __( 'Edit' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Portfolio Items' ), /* Edit Display Title */
			'new_item' => __( 'New Portfolio Item' ), /* New Display Title */
			'view_item' => __( 'View Portfolio Item' ), /* View Display Title */
			'search_items' => __( 'Search Portfolio' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Portfolio items and their associated categories' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 5, /* this is what order you want it to appear in on the left hand side menu */ 
			'has_archive' => false, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite'	=> array('with_front' => false ), /* you can specify its url slug */
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail')
		) /* end of options */
	); /* end of register post type */
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
	register_taxonomy( 'portfolio-work-cat', 
		array('portfolio-work'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
		'rewrite'	=> array('with_front' => false, 'slug'=>'portfolio' ), /* you can specify its url slug */
			'labels' => array(
				'name' => __( 'Portfolio Categories' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Portfolio Category' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Portfolio Categories' ), /* search title for taxomony */
				'all_items' => __( 'All Portfolio Categories' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Portfolio Category' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Portfolio Category:' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Portfolio Category' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Portfolio Category' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Portfolio Category' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Portfolio Category Name' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			

		)
	);

?>
