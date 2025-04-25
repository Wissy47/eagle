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

// Register custom theme support
function eagle_register_theme_support() {
    // Register Menu
    $locations = array('primary' => 'Primary Menu', "footer" => "Footer Menu");
    register_nav_menus( $locations );

    // Title tag
    add_theme_support("title-tag");

    // logo
    add_theme_support("custom-logo", array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		));
}
add_action('after_setup_theme', 'eagle_register_theme_support');


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

function add_hero_slider_metabox() {
    $screen = get_current_screen();
    if ($screen->id == 'page' && get_the_ID() == 23) {
        add_meta_box(
            'hero_slider_repeater',
            'Hero Slider Repeater',
            'hero_slider_repeater_callback',
            'page',
            'advanced',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'add_hero_slider_metabox');


/**
 * Fires when enqueuing scripts for all admin pages.
 *
 * @param string $hook_suffix The current admin page.
 */
add_action("admin_enqueue_scripts",function(): void {
    wp_enqueue_script('eagle-admin-script', get_template_directory_uri() . '/assets/js/admin.js', array('jquery'), false, true);
    wp_enqueue_media();
} );

function hero_slider_repeater_callback()
{
    wp_nonce_field('hero_slider_repeater_nonce', 'hero_slider_repeater_nonce');
    $repeater_data = get_post_meta(get_the_ID(), 'hero_slider_repeater_data', true);
    ?>
        <div id="hero_slider-repeater-container">
            <?php
            if (!empty($repeater_data)) {
                foreach ($repeater_data as $index => $data) {
                    ?>
                    <div class="hero_slider-repeater-row">
                        <input type="text" name="hero_slider_repeater_data[<?php echo $index; ?>][top_heading]" placeholder="Top Heading"  value="<?php echo $data['top_heading']; ?>">
                        <input type="text" name="hero_slider_repeater_data[<?php echo $index; ?>][major_heading]" placeholder="Major Heading"  value="<?php echo $data['major_heading']; ?>">
                        <input type="text" name="hero_slider_repeater_data[<?php echo $index; ?>][paragraph]" placeholder="Paragraph"  value="<?php echo $data['paragraph']; ?>">
                        <input type="text" name="hero_slider_repeater_data[<?php echo $index; ?>][button_text]" placeholder="Button text"  value="<?php echo $data['button_text']; ?>">
                        <input type="text" name="hero_slider_repeater_data[<?php echo $index; ?>][button_url]" placeholder="Button URL"  value="<?php echo $data['button_url']; ?>">
                        <button class="remove-row">Remove</button>
                    </div>
                            <?php
                }
            } else {
                ?>
                    <div class="hero_slider-repeater-row">
                        <input type="text" name="hero_slider_repeater_data[0][top_heading]" placeholder="Top Heading" value="">
                        <input type="text" name="hero_slider_repeater_data[0][major_heading]" placeholder="Major Heading" value="">
                        <input type="text" name="hero_slider_repeater_data[0][paragraph]" placeholder="Paragraph" value="">
                        <input type="text" name="hero_slider_repeater_data[0][button_text]" placeholder="Button text" value="">
                        <input type="text" name="hero_slider_repeater_data[0][button_url]" placeholder="Button URL" value="">
                        <button class="remove-row">Remove</button>
                    </div>
                    <?php
            }
            ?>
            <button id="add-row">Add Row</button>
        </div>
        <script>
            jQuery(document).ready(function ($) {
                var index = <?php echo !empty($repeater_data) ? count($repeater_data) : 1; ?>;
                $('#add-row').click(function (e) {
                    e.preventDefault();
                    var row =
                    `<div class="hero_slider-repeater-row">
                        <input type="text" name="hero_slider_repeater_data[${index}][top_heading]" placeholder="Top Heading" value="">
                        <input type="text" name="hero_slider_repeater_data[${index}][major_heading]" placeholder="Major Heading" value="">
                        <input type="text" name="hero_slider_repeater_data[${index}][paragraph]" placeholder="Paragraph" value="">
                        <input type="text" name="hero_slider_repeater_data[${index}][button_text]" placeholder="Button text" value="">
                        <input type="text" name="hero_slider_repeater_data[${index}][button_url]" placeholder="Button URL" value="">
                        <button class="remove-row">Remove</button>
                    </div>`;
                    $('#hero_slider-repeater-container').append(row);
                    index++;
                });
                $(document).on('click', '.remove-row', function (e) {
                    e.preventDefault();
                    $(this).closest('.hero_slider-repeater-row').remove();
                });
            });
        </script>
        <?php
}

function save_hero_slider_repeater_data($post_id)
{
    if (!isset($_POST['hero_slider_repeater_nonce']) || !wp_verify_nonce($_POST['hero_slider_repeater_nonce'], 'hero_slider_repeater_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['hero_slider_repeater_data'])) {
        update_post_meta($post_id, 'hero_slider_repeater_data', $_POST['hero_slider_repeater_data']);
    } else {
        delete_post_meta($post_id, 'hero_slider_repeater_data');
    }
}
add_action('save_post', 'save_hero_slider_repeater_data');