<?php
if (!defined('ABSPATH')) exit;

function ironfit_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'ironfit'),
    ));
}
add_action('after_setup_theme', 'ironfit_setup');

function ironfit_scripts() {
    wp_enqueue_style('ironfit-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800;900&display=swap', array(), null);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', array(), '6.5.0');
    wp_enqueue_style('ironfit-tailwind', get_template_directory_uri() . '/assets/css/tailwind.css', array(), '1.0.0');
    wp_enqueue_style('ironfit-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_style('ironfit-admin-bar', get_template_directory_uri() . '/assets/css/admin-bar.css', array(), '1.0.0');
    wp_enqueue_style('ironfit-slider', get_template_directory_uri() . '/assets/css/slider.css', array(), '1.0.0');
    wp_enqueue_script('ironfit-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
    wp_localize_script('ironfit-main', 'ironfitAjax', array(
        'url'   => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ifc_booking_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'ironfit_scripts');

function ironfit_preconnect_hints() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com" />' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />' . "\n";
    echo '<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin />' . "\n";
}
add_action('wp_head', 'ironfit_preconnect_hints', 1);

function ironfit_register_widgets() {
    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'ironfit'),
        'id'            => 'footer-widgets',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'ironfit_register_widgets');

function ironfit_admin_bar_body_class($classes) {
    if (is_admin_bar_showing()) {
        $classes[] = 'admin-bar';
    }
    return $classes;
}
add_filter('body_class', 'ironfit_admin_bar_body_class');