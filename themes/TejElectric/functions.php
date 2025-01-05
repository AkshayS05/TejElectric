<?php
// Enqueue Styles and Scripts
function electrical_theme_enqueue_assets() {
    // Enqueue the main stylesheet
    wp_enqueue_style('theme-style', get_stylesheet_uri());
    wp_enqueue_style(
        'font-awesome', 
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css',
        array(), 
        null
    );
    // Enqueue header CSS
  
    wp_enqueue_style(
        'header-styles',
        get_template_directory_uri() . '/css/header.css',
        array('theme-style'),
        '1.0.0',
        'all'
    );

    // Enqueue hero section CSS
    wp_enqueue_style(
        'hero-section-styles',
        get_template_directory_uri() . '/css/hero-section.css',
        array('theme-style', 'header-styles'),
        '1.0.0',
        'all'
    );
    wp_enqueue_style(
        'main-styles',
        get_template_directory_uri() . '/style.css',
        array('theme-style'),
        '1.0.0',
        'all'
    );
    if (is_singular('service')) {
        wp_enqueue_style(
            'single-service-styles',
            get_template_directory_uri() . '/css/single-service.css',
            array('main-styles'),
            '1.0.0',
            'all'
        );
    }
    

    wp_enqueue_script('tejelectric-scripts', get_template_directory_uri() . '/js/script.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'electrical_theme_enqueue_assets');

// Register Menus
function tej_electric_register_menus() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'tej-electric'),
    ));
}
add_action('init', 'tej_electric_register_menus');

// Redirect subscribers to the frontend
function redirect_subs_to_frontend() {
    if (current_user_can('subscriber') && !current_user_can('edit_posts')) {
        wp_redirect(home_url());
        exit;
    }
}
add_action('admin_init', 'redirect_subs_to_frontend');



// Debug to ensure enqueueing works
add_action('wp_head', function () {
    echo '<!-- Debug: electrical_theme_enqueue_assets is running -->';
});

// Disable the admin bar for subscribers.
add_action('wp_loaded', 'disable_admin_bar_for_subs');

function disable_admin_bar_for_subs() {
    $currentUser = wp_get_current_user();

    if (count($currentUser->roles) == 1 && $currentUser->roles[0] == 'subscriber') {
        show_admin_bar(false);
    }
}
/**
 * Custom Contact Form Shortcode
 */
function tej_electric_contact_form_shortcode() {
    // Handle form submission (check if form is submitted and nonce is valid)
    if ( isset($_POST['tej_contact_nonce'], $_POST['tej_contact_submit'])
         && wp_verify_nonce($_POST['tej_contact_nonce'], 'tej_contact_action') ) {
        
        // Sanitize form inputs
        $first_name   = sanitize_text_field($_POST['first_name']);
        $last_name    = sanitize_text_field($_POST['last_name']);
        $service      = sanitize_text_field($_POST['service']);
        $query_message = sanitize_textarea_field($_POST['query_message']);

        // Prepare email
        // Change this to your Gmail or any valid email address
        $to      = 'akshaysharma5432@gmail.com';
        $subject = 'New Inquiry from ' . $first_name . ' ' . $last_name;
        
        // Email body
        $body  = "First Name: $first_name\n";
        $body .= "Last Name: $last_name\n";
        $body .= "Service Interested In: $service\n";
        $body .= "Message:\n$query_message\n";
        
        $headers = array('Content-Type: text/plain; charset=UTF-8');

        // Send the email
        wp_mail($to, $subject, $body, $headers);

        // (Optional) Display success message or redirect
        echo '<div class="tej-contact-success">Thank you! Your message has been sent.</div>';
    }

    // The HTML form (always displayed)
    ob_start(); // start output buffering
    ?>
    <div class="tej-contact-container">
        <form method="post" class="tej-contact-form">
            <?php 
            // WP nonce field for security
            wp_nonce_field('tej_contact_action', 'tej_contact_nonce'); 
            ?>

            <h2>Get In Touch</h2>

            <div class="tej-contact-row">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" required />
            </div>

            <div class="tej-contact-row">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" required />
            </div>

            <div class="tej-contact-row">
                <label for="service">Service Interested In</label>
                <select name="service" required>
                    <option value="Duct Smoke Sensor Installation">Duct Smoke Sensor Installation</option>
                    <option value="EV Chargers">EV Chargers</option>
                    <option value="High Voltage Installation">High Voltage Installation</option>
                    <option value="Substation Design & Construction">Substation Design & Construction</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="tej-contact-row">
                <label for="query_message">Your Message</label>
                <textarea name="query_message" rows="5" required></textarea>
            </div>

            <button type="submit" name="tej_contact_submit">Submit</button>
        </form>
    </div>
    <?php

    return ob_get_clean(); // return the form HTML
}
add_shortcode('tej_contact_form', 'tej_electric_contact_form_shortcode');

// In functions.php, you can ensure theme support for page attributes
add_theme_support( 'page-attributes' );


//services post type
function register_services_post_type() {
    $labels = array(
        'name'               => _x('Services', 'post type general name', 'textdomain'),
        'singular_name'      => _x('Service', 'post type singular name', 'textdomain'),
        'menu_name'          => _x('Services', 'admin menu', 'textdomain'),
        'name_admin_bar'     => _x('Service', 'add new on admin bar', 'textdomain'),
        'add_new'            => _x('Add New', 'service', 'textdomain'),
        'add_new_item'       => __('Add New Service', 'textdomain'),
        'new_item'           => __('New Service', 'textdomain'),
        'edit_item'          => __('Edit Service', 'textdomain'),
        'view_item'          => __('View Service', 'textdomain'),
        'all_items'          => __('All Services', 'textdomain'),
        'search_items'       => __('Search Services', 'textdomain'),
        'not_found'          => __('No services found.', 'textdomain'),
        'not_found_in_trash' => __('No services found in Trash.', 'textdomain'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'show_in_menu'       => true,
        'supports'           => array('title', 'editor', 'thumbnail'),
        'menu_icon'          => 'dashicons-hammer', // Icon for the admin menu
    );

    register_post_type('service', $args);
}
add_action('init', 'register_services_post_type');


function redirect_logged_in_users() {
    if (is_user_logged_in() && is_page('login')) {
        wp_redirect(home_url('/contact-us/'));
        exit;
    }
}
add_action('template_redirect', 'redirect_logged_in_users');


function tej_electric_login_styles() {
    // Enqueue the login styles
    wp_enqueue_style('tej-electric-login-styles', get_template_directory_uri() . '/css/login-styles.css', array(), '1.0.0', 'all');
}
add_action('login_enqueue_scripts', 'tej_electric_login_styles');
function tej_electric_login_favicon() {
    echo '<link rel="icon" href="' . get_template_directory_uri() . '/images/tej-electric-favicon.png" type="image/png">';
}
add_action('login_head', 'tej_electric_login_favicon');
