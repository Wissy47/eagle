<?php 

// enqueue css and js files
function eagle_enqueue_css_js() {
    // css files link
    wp_enqueue_style( 'eagle-bootstrap', get_template_directory_uri().'/assets/css/bootstrap.css',array(),false,'all' );
    wp_enqueue_style('eagle-style', get_template_directory_uri() . '/assets/css/style.css', array(), false, 'all');
    wp_enqueue_style('eagle-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), false, 'all');
    wp_enqueue_style('eagle-font', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700&display=swap', array(), null, 'all');
    wp_enqueue_style('eagle-owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), null, 'all');
    // js file link
    wp_enqueue_script('jquery');
    wp_enqueue_script('eagle-bootstrap-script', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'), false, true);
    wp_enqueue_script('slider-script', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js',array('jquery'), false, true);
    wp_enqueue_script('eagle-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery', 'slider-script'), false, true);
}
add_action('wp_enqueue_scripts', 'eagle_enqueue_css_js');

// register a menu
function eagle_register_menu() {
    $locations = array('primary' => 'Primary Menu', "footer" => "Footer Menu");
    register_nav_menus( $locations );
}
add_action('after_setup_theme', 'eagle_register_menu');


add_filter('nav_menu_css_class',function( $classes, $items, $args ) {
   if ($args->theme_location === 'primary') {
        $classes[] = 'nav-item';
    }
    return $classes;
}, 10, 3 );
add_filter('nav_menu_link_attributes', function($atts, $item, $args) {
    // Custom attributes can be added here
    $atts['class'] = 'nav-link';
    return $atts;
}, 10, 3);

