<?php

/********************************************************
 * SETTINGS POST TYPE
 *
 * uses advanced custom fields!
 *******************************************************/

define('POSTTYPE_SETTINGS', 'settings');
define('SLUG_SETTINGS', 'settings');
define('SETTINGS_META_PREFIX', 'SETTINGS_META_');

// Register Custom Post Types
add_action('init', 'register_custom_post_settings_init');
function register_custom_post_settings_init() {
    // Register Settings
    $labels = array(
        'name'               => 'Settings',
        'singular_name'      => 'Setting',
        'menu_name'          => 'Settings'
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_icon'          => 'dashicons-list-view',
        'rewrite'            => array('slug' => SLUG_SETTINGS),
        'supports'           => array('title', 'revisions', 'post-formats', 'page-attributes'),
        'taxonomies'         => array( 'category' ),
    );
    register_post_type(POSTTYPE_SETTINGS, $args);
}
