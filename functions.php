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
    // localization
    wp_localize_script("eagle-script","ajaxObj",[
        "ajax_url"=>admin_url("admin-ajax.php"),
        'nonce' => wp_create_nonce('subscriber'),
    ]);
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
        add_theme_support("widgets");

    //Thumbnail featured image
    add_theme_support("post-thumbnails");
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
        </div>
        <div>
            <button id="add-hero-slider-row">Add Row</button>
        </div>
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


function create_review_slider_admin_menu() {
    add_theme_page(
        'Review Slider',
        'Review Slider',
        'manage_options',
        'review_slider-menu',
        'review_slider_menu_callback'
    );
}

add_action('admin_menu', 'create_review_slider_admin_menu');

function review_slider_menu_callback() {
    settings_errors();
    ?>
    <div class="wrap">
        <h1>Review Slider</h1>
        <form method="post" action="options.php">
            <?php settings_fields('review_slider-menu-group'); ?>
            <?php do_settings_sections('review_slider-menu'); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function review_slider_menu_settings() {
    add_settings_section(
        'review_slider_menu_section',
        'Slider Repeater Field',
        'review_slider_menu_section_callback',
        'review_slider-menu'
    );

    add_settings_field(
        'review_slider_repeater_field',
        'Repeater Fields',
        'review_slider_repeater_field_callback',
        'review_slider-menu',
        'review_slider_menu_section'
    );

    register_setting('review_slider-menu-group', 'review_slider_repeater_field');
}
add_action('admin_init', 'review_slider_menu_settings');


function review_slider_menu_section_callback()
{
    echo 'Add repeater field items:';
}

function review_slider_repeater_field_callback()
{
    $repeater_data = get_option('review_slider_repeater_field');
    ?>
        <div id="review_slider-repeater-container">
            <?php
            if (!empty($repeater_data)) {
                foreach ($repeater_data as $index => $data) {
                    ?>
                            <div class="review_slider-repeater-row">
                                <div style="margin-bottom:5px">
                                    <input type="hidden" name="review_slider_repeater_field[<?php echo $index; ?>][image_id]"
                                        value="<?php echo $data['image_id']; ?>" class="image-id">
                                    <img src="<?php echo wp_get_attachment_url((int)$data['image_id']); ?>" width="100">
                                    <button class="upload-image-button button">Upload Image</button>
                                </div>
                                <input type="text" name="review_slider_repeater_field[<?php echo $index; ?>][heading]" placeholder="Heading" value="<?php echo $data['heading']; ?>">
                                <input type="text" name="review_slider_repeater_field[<?php echo $index; ?>][sub_heading]" placeholder="Sub heading" value="<?php echo $data['sub_heading']; ?>">
                                <input type="text" name="review_slider_repeater_field[<?php echo $index; ?>][paragraph]" placeholder="Paragraph" value="<?php echo $data['paragraph']; ?>">
                                <button class="remove-row button">Remove</button>
                            </div>
                            <?php
                }
            } else {
                ?>
                    <div class="review_slider-repeater-row">
                        <div style="margin-bottom:5px">
                            <input type="hidden" name="review_slider_repeater_field[0][image_id]" value="" class="image-id">
                            <img src="" width="100" style="display:none;">
                            <button class="upload-image-button button">Upload Image</button>
                        </div>
                        <input type="text" name="review_slider_repeater_field[0][heading]" placeholder="Heading" value="">
                        <input type="text" name="review_slider_repeater_field[0][sub_heading]" placeholder="Sub heading" value="">
                        <input type="text" name="review_slider_repeater_field[0][paragraph]" placeholder="Paragraph" value="">
                        <button class="remove-row button">Remove</button>
                    </div>
                    <?php
            }
            ?>
        </div>
        <div style="margin-top:5px">
            <button class="button button-primary" id="add-review-slider-row">Add Row</button>
        </div>
        <?php
}


function save_review_slider_repeater_data($option_name, $option_value)
{
    if ($option_name == 'review_slider_repeater_field') {
        $repeater_data = array();
        foreach ($option_value as $index => $data) {
            if (!empty($data['heading'])) {
                $repeater_data[$index] = array(
                    'heading' => sanitize_text_field($data['heading']),
                );
            }
            if (!empty($data['sub_heading'])) {
                $repeater_data[$index] = array(
                    'sub_heading' => sanitize_text_field($data['sub_heading']),
                );
            }
            if (!empty($data['paragraph'])) {
                $repeater_data[$index] = array(
                    'paragraph' => sanitize_text_field($data['paragraph']),
                );
            }
            // if (!empty($data['image_id'])) {
            //     $repeater_data[$index] = array(
            //         'image_id' => sanitize_text_field($data['image_id']),
            //     );
            // }
        }
        update_option('review_slider_repeater_field', $repeater_data);
    }
}
add_filter('pre_update_option_save_review_slider_repeater_data', 'save_review_slider_repeater_data', 10, 2);


function metric_custumizer($wp_customize) {
    $wp_customize->add_section('eagle_homepage_metrics', array(
        'title' => __('Our Metrics'),
        'priority' => 3,
    ));

    // ---First area ----
    $wp_customize->add_setting('eagle_metric_first_value_text', array(
        'default' => '1000+',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('eagle_metric_first_value_text', array(
        'label' => __('First Area Value', 'eagle'),
        'section' => 'eagle_homepage_metrics',
        'settings' => 'eagle_metric_first_value_text',
    ));

    $wp_customize->selective_refresh->add_partial('eagle_metric_first_value_text', array(
        'selector' => '.eagle_metric_first_value_text'
    ));

    $wp_customize->add_setting('eagle_metric_first_desc_value_text', array(
        'default' => 'Years of Business',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('eagle_metric_first_desc_value_text', array(
        'label' => __('First Area Desc', 'eagle'),
        'section' => 'eagle_homepage_metrics',
        'settings' => 'eagle_metric_first_desc_value_text',
    ));
    $wp_customize->selective_refresh->add_partial('eagle_metric_first_desc_value_text', array(
        'selector' => '.eagle_metric_first_desc_value_text'
    ));

    // ---Second area ----

    $wp_customize->add_setting('eagle_metric_second_value_text', array(
        'default' => '20000+',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('eagle_metric_second_value_text', array(
        'label' => __('Second Area Value', 'eagle'),
        'section' => 'eagle_homepage_metrics',
        'settings' => 'eagle_metric_second_value_text',
    ));

    $wp_customize->selective_refresh->add_partial('eagle_metric_second_value_text', array(
        'selector' => '.eagle_metric_second_value_text'
    ));

    $wp_customize->add_setting('eagle_metric_second_desc_value_text', array(
        'default' => 'Projects Delivered',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('eagle_metric_second_desc_value_text', array(
        'label' => __('Second Area Desc', 'eagle'),
        'section' => 'eagle_homepage_metrics',
        'settings' => 'eagle_metric_second_desc_value_text',
    ));

    $wp_customize->selective_refresh->add_partial('eagle_metric_second_desc_value_text', array(
        'selector' => '.eagle_metric_second_desc_value_text'
    ));


    // ---Third area ----

    $wp_customize->add_setting('eagle_metric_third_value_text', array(
        'default' => '10000+',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('eagle_metric_third_value_text', array(
        'label' => __('Third Area Value', 'eagle'),
        'section' => 'eagle_homepage_metrics',
        'settings' => 'eagle_metric_third_value_text',
    ));

    $wp_customize->selective_refresh->add_partial('eagle_metric_third_value_text', array(
        'selector' => '.eagle_metric_third_value_text'
    ));

    $wp_customize->add_setting('eagle_metric_third_desc_value_text', array(
        'default' => 'Satisfied Customers',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('eagle_metric_third_desc_value_text', array(
        'label' => __('Third Area Desc', 'eagle'),
        'section' => 'eagle_homepage_metrics',
        'settings' => 'eagle_metric_third_desc_value_text',
    ));

    $wp_customize->selective_refresh->add_partial('eagle_metric_third_desc_value_text', array(
        'selector' => '.eagle_metric_third_desc_value_text'
    ));

    // ---Forth area ----

    $wp_customize->add_setting('eagle_metric_forth_value_text', array(
        'default' => '1500+',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('eagle_metric_forth_value_text', array(
        'label' => __('Forth Area Value', 'eagle'),
        'section' => 'eagle_homepage_metrics',
        'settings' => 'eagle_metric_forth_value_text',
    ));

    $wp_customize->selective_refresh->add_partial('eagle_metric_forth_value_text', array(
        'selector' => '.eagle_metric_forth_value_text'
    ));

    $wp_customize->add_setting('eagle_metric_forth_desc_value_text', array(
        'default' => 'Cups of Coffee',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('eagle_metric_forth_desc_value_text', array(
        'label' => __('Forth Area Desc', 'eagle'),
        'section' => 'eagle_homepage_metrics',
        'settings' => 'eagle_metric_forth_desc_value_text',
    ));

    $wp_customize->selective_refresh->add_partial('eagle_metric_forth_desc_value_text', array(
        'selector' => '.eagle_metric_forth_desc_value_text'
    ));

    /**
     * Footer Section One
     */

    
    $wp_customize->add_section('eagle_footer_section_one', array(
        'title' => __('Footer 1'),
        'priority' => 100,
    ));

    $wp_customize->selective_refresh->add_partial('eagle_footer_section_address', array(
        'selector' => '.eagle_footer_section_address'
    ));

    //  Section Title
    $wp_customize->add_setting('eagle_footer_section_title', array(
        'default' => __('Contact Us', 'eagle'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('eagle_footer_section_title', array(
        'label' => 'Section title',
        'section' => 'eagle_footer_section_one',
        'settings' => 'eagle_footer_section_title',
    ));

    //  Address
    $wp_customize->add_setting('eagle_footer_section_address', array(
        'default' => __('Your business address, State', 'eagle'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('eagle_footer_section_address', array(
        'label' => 'Address',
        'section'=>'eagle_footer_section_one',
        'settings' => 'eagle_footer_section_address',
    ));

    //  Phone
    $wp_customize->add_setting('eagle_footer_section_phone', array(
        'default' => __('+01 1234567890', 'eagle'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('eagle_footer_section_phone', array(
        'label' => 'Phone',
        'section' => 'eagle_footer_section_one',
        'settings' => 'eagle_footer_section_phone',
    ));

    //  Email
    $wp_customize->add_setting('eagle_footer_section_email', array(
        'default' => __('demo@gmail.com', 'eagle'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('eagle_footer_section_email', array(
        'label' => 'Email',
        'section' => 'eagle_footer_section_one',
        'settings' => 'eagle_footer_section_email',
    ));

    /**
     * Socials
     */
    $wp_customize->add_section('eagle_footer_socials', array(
        'title' => __('Socials'),
        'priority' => 100,
    ));

    //  Facebook
    $wp_customize->add_setting('eagle_footer_social_facebook', array(
        'default' => __('#', 'eagle'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('eagle_footer_social_facebook', array(
        'label' => 'Facebook',
        'section' => 'eagle_footer_socials',
        'settings' => 'eagle_footer_social_facebook',
    ));

    //  Twitter
    $wp_customize->add_setting('eagle_footer_social_twitter', array(
        'default' => __('#', 'eagle'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('eagle_footer_social_twitter', array(
        'label' => 'Twitter',
        'section' => 'eagle_footer_socials',
        'settings' => 'eagle_footer_social_twitter',
    ));

    //  Linkedin
    $wp_customize->add_setting('eagle_footer_social_linkedin', array(
        'default' => __('#', 'eagle'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('eagle_footer_social_linkedin', array(
        'label' => 'Linkedin',
        'section' => 'eagle_footer_socials',
        'settings' => 'eagle_footer_social_linkedin',
    ));

    //  Youtube
    $wp_customize->add_setting('eagle_footer_social_youtube', array(
        'default' => __('#', 'eagle'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('eagle_footer_social_youtube', array(
        'label' => 'Youtube',
        'section' => 'eagle_footer_socials',
        'settings' => 'eagle_footer_social_youtube',
    ));
    
}

add_action("customize_register", 'metric_custumizer' );

function register_footer_widget()
{
    register_sidebar(array(
        'name' => 'Footer Widget',
        'id' => 'footer-widget',
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
    ));

    register_sidebar(array(
        'name' => 'Footer Widget 2',
        'id' => 'footer-widget-2',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
    ));
}
add_action('widgets_init', 'register_footer_widget');

//shortcode
function eagle_footer_shortcode()
{
    return '<h5>
              Newsletter
            </h5>
            <p id="sub-error" class="text-danger"></p>
            <p id="sub-success" class="text-success"></p>
            <form id="subscriber">
              <input type="text" id="sub-email" name="email" placeholder="Enter your email">
              <button>
                Subscribe
          </button>';
}

add_shortcode('subscribe_form', 'eagle_footer_shortcode');

add_action("wp_ajax_eagle_subscribe_form_action",'eagle_subscribe_form_action' );
add_action("wp_ajax_nopeagle_subscribe_form_action", 'eagle_subscribe_form_action');

function eagle_subscribe_form_action()  {
    check_ajax_referer("subscriber");

    if(!is_email($_POST["email"])){
        wp_send_json_error("Please enter a valid email address", 400);
    }
    $email = sanitize_email($_POST["email"]);
    $subscriber = array(
        'user_email' => $email,
        'user_login' => $email,
        'role' => 'subscriber',
    );

    // Check if the user already exists
    $user = get_user_by('email', $email);
    if ($user) { 
        wp_send_json_error("This email address already added", 400);
    }

    $user_id = wp_create_user($subscriber['user_login'], wp_generate_password(), $subscriber['user_email']);
    if (!is_wp_error($user_id)) {
            // Set the user role
        $user = new WP_User($user_id);
        $user->set_role('subscriber');
        wp_send_json_success("Thank you for Subscribing to our Newsletter");
    }else{
        wp_send_json_error("There was an error. Please try again", 400);
    }
    wp_die();
}

function add_gallery_meta_box()
{
    add_meta_box(
        'gallery_meta_box',
        'Gallery',
        'gallery_meta_box_callback',
        'page',
        'side',
        'low'
    );
}
add_action('add_meta_boxes', 'add_gallery_meta_box');

function gallery_meta_box_callback($post)
{
    wp_nonce_field('gallery_meta_box', 'gallery_meta_box_nonce');
    $get_gallery_ids = get_post_meta($post->ID, 'gallery_ids', true);
    ?>
        <div id="gallery-metabox">
            <ul id="gallery-images">
                <?php
                if ($get_gallery_ids) {
                    $gallery_ids = explode(',', $get_gallery_ids);
                    foreach ($gallery_ids as $id) {
                        $image = wp_get_attachment_image_src($id, 'thumbnail');
                        ?>
                                <li style="width: 80px;">
                                    <img src="<?php echo $image[0]; ?>" alt="">
                                    <input type="hidden" value="<?php echo $id; ?>">
                                </li>
                                <?php
                    }
                }
                ?>
            </ul>
            <button class="button" id="add-gallery-image">Add Image</button>
            <input type="hidden" id="gallery-ids" name="gallery_ids" value="<?php echo $get_gallery_ids; ?>">
        </div>
        <?php
}

function eagle_save_gallery_meta_box($post_id)
{
    if (!isset($_POST['gallery_meta_box_nonce']) || !wp_verify_nonce($_POST['gallery_meta_box_nonce'], 'gallery_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['gallery_ids'])) {
        $gallery_ids = implode(',', [$_POST['gallery_ids']]);
        update_post_meta($post_id, 'gallery_ids', $gallery_ids);
    } else {
        delete_post_meta($post_id, 'gallery_ids');
    }
}
add_action('save_post', 'eagle_save_gallery_meta_box');

function eagle_create_contact_post_type()
{
    register_post_type(
        'contact',
        array(
            'labels' => array(
                'name' => __('Contacts'),
                'singular_name' => __('Contact')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail')
        )
    );
}
add_action('init', 'eagle_create_contact_post_type');


add_action("wp_ajax_eagle_contact_form_action",'eagle_contact_form_action' );
add_action("wp_ajax_nopriv_eagle_contact_form_action", "eagle_contact_form_action");

function eagle_contact_form_action() : void {
    check_ajax_referer("subscriber");

    if (!is_email($_POST["email"])) {
        wp_send_json_error("Please enter a valid email address", 400);
    }

    $email = sanitize_email($_POST["email"]);
    $name = sanitize_text_field($_POST["name"]);
    $phone = sanitize_text_field($_POST['phone']);
    $message = sanitize_text_field($_POST['message']);

    if (empty($name)|| empty($phone)|| empty($message)) {
        wp_send_json_error("All fields are Required", 400);
    }

    $post_id = wp_insert_post(
        array(
            'post_title' => $email,
            'post_content' => "Message:=> $message \n Phone:=>  $phone \n Email:=> $name",
            'post_type' => 'contact',
            'post_status' => 'publish'
        )
    );

    if (is_wp_error($post_id)) {
        wp_send_json_error("There was an Error, Please refreash page and try again", 500);
    }else{
        wp_send_json_success("Thank you for contacting us. You will get an email from us shortly");
    }
    wp_die();
}