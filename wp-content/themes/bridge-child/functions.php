<?php

// enqueue the child theme stylesheet

Function wp_schools_enqueue_scripts() {
wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css'  );
wp_enqueue_style( 'childstyle' );
}
add_action( 'wp_enqueue_scripts', 'wp_schools_enqueue_scripts', 11);


add_action( ‘init’, ‘blockusers_init’ ); // Restrict simple user to access the admin panel
function blockusers_init() {
	if ( is_admin() && ! current_user_can( ‘administrator’ ) && ! ( defined( ‘DOING_AJAX’ ) && DOING_AJAX ) ) {
		wp_redirect( home_url() );
		exit;
	}
}

add_action('after_setup_theme', 'remove_admin_bar');  // Remove admin bar from front end for a simple user
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  show_admin_bar(false);
	}
}



function my_plugin_body_class($classes) {
	if(is_user_logged_in()){
		$classes[] = 'loggedin_user';
		return $classes;
	}
	else{
		$classes[] = 'loggedout_user';
		return $classes;
	}
}
add_filter('body_class', 'my_plugin_body_class'); // Add login and logout class in body tag




function user_name_func( $atts ) {
	if(is_user_logged_in()){
		global $current_user;
		return $current_user->first_name;
	}
	else{
		return "";
	}
}
add_shortcode( 'user_name', 'user_name_func' ); // add shortcode of getting username

add_filter('wp_nav_menu_items', 'do_shortcode');


?>