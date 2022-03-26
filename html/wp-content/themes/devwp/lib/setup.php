<?php

namespace DevWp\Setup;

/**
 * Theme setup
 */
function setup()
{

	remove_action('wp_head', 'rel_canonical');
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
	remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
	remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
	remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
	remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
	remove_action('wp_head', 'index_rel_link', 10, 0); // index link
	remove_action('wp_head', 'parent_post_rel_link', 10, 0); // prev link
	remove_action('wp_head', 'start_post_rel_link', 10, 0); // start link
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
	remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

	add_image_size('64x64', 64, 64, true);
	add_image_size('150x150', 150, 150, true);
	add_image_size('450x275', 450, 275, true);
	add_image_size('750w', 750);

	// Enable HTML5 markup support
	// http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
	add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);
	add_theme_support('post-thumbnails');

	// Allow svgs to get uploaded via media library
	add_filter('upload_mimes', function ($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	});

}

add_action('after_setup_theme', __NAMESPACE__ . '\\setup');
