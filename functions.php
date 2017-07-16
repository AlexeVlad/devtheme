<?php

function fm_register_my_menus() {
    register_nav_menus(
            array(
                'header-menu' => __('Header Menu'),
            )
    );
}

add_action('init', 'fm_register_my_menus');

function fm_init_sidebars() {
    register_sidebar(array(
        'name' => 'sidebar',
        'id' => 'sidebar',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ));
}

add_action('init', 'fm_init_sidebars');

add_theme_support('post-thumbnails');
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    //set_post_thumbnail_size( 150, 150 );
}

if (function_exists('add_image_size')) {
    add_image_size('test', 960, 419, true);
}

add_action('wp_enqueue_scripts', 'trigger_custom_scripts');

function trigger_custom_scripts() {
    wp_enqueue_script('jquery');

    wp_register_script('jquery_modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array('jquery'));
    wp_enqueue_script('jquery_modernizr');

    wp_register_script('jquery_custom', get_template_directory_uri() . '/js/custom.js', array('jquery'));
    wp_enqueue_script('jquery_custom');

    wp_register_style('css_wordpress', get_template_directory_uri() . '/css/wordpress.css');
    wp_enqueue_style('css_wordpress');
}
/*image upload plroblem solver */
add_filter( 'wp_image_editors', 'change_graphic_lib' );

function change_graphic_lib($array) {
  return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
}
/* end image upload plroblem solver */
include_once 'cpt/test.php';
include 'helper/helper.php';
include 'inc/breadcrumbs.php';
include 'inc/widget-class.php';
include 'inc/widget-links/widget-links.php';
include 'inc/options.php';
include 'inc/comment.php';