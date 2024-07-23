<?php

// Styles and Scripts
add_action('wp_enqueue_scripts', function() {
    // Styles
    wp_enqueue_style( 'styles', get_template_directory_uri() . '/assets/styles/style.min.css' );

    // Scripts
    wp_enqueue_script( 'app', get_template_directory_uri() . '/assets/js/app.min.js', [], 'null', 'in_footer' );
});

// Register Custom Post Types
add_action( 'init', function() {
    register_post_type( 'blog', [
        'labels' => [
            'name'               => 'Blog Posts',
            'singular_name'      => 'Blog Post',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Blog Post',
            'edit_item'          => 'Edit Blog Post',
            'new_item'           => 'New Blog Post',
            'all_items'          => 'All Blog Posts',
            'view_item'          => 'View Blog Post',
            'search_items'       => 'Search Blog Posts',
            'not_found'          => 'No Blog Posts found',
            'not_found_in_trash' => 'No Blog Posts found in Trash',
            'menu_name'          => 'Blog'
        ],
        'public'              => true,
        'supports'            => [ 'title', 'editor', 'thumbnail' ],
        'taxonomies'          => [ 'category' ],
        'has_archive'         => true,
        'rewrite'             => [ 'slug' => 'blog' ],
    ] );
});

function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu'),
        )
    );
}

add_action('init', 'register_my_menus');