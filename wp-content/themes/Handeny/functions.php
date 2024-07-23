<?php

// Styles and Scripts
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style( 'styles', get_template_directory_uri() . '/assets/styles/style.min.css' );

    wp_enqueue_script( 'app', get_template_directory_uri() . '/assets/js/app.min.js', [], 'null', 'in_footer' );

});

function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu'),
        )
    );
}

add_action('init', 'register_my_menus');