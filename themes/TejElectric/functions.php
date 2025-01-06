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

// Custom Contact Form Shortcode
function tej_electric_contact_form_shortcode() {
    // Initialize variables for form processing
    $errors = [];
    $success = false;

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tej_contact_submit'])) {
        error_log('Form submission detected.');

        // Verify nonce for security
        if (!isset($_POST['tej_contact_nonce']) || !wp_verify_nonce($_POST['tej_contact_nonce'], 'tej_contact_action')) {
            $errors[] = 'Security check failed. Please try again.';
            error_log('Nonce verification failed.');
        }

        // Honeypot Check (Optional)
        /*
        if (!empty($_POST['hp_field'])) {
            $errors[] = 'Spam detected.';
            error_log('Honeypot field filled.');
        }
        */

        // Sanitize and validate form inputs only if no previous errors
        if (empty($errors)) {
            // Sanitize form inputs
            $first_name    = sanitize_text_field($_POST['first_name']);
            $last_name     = sanitize_text_field($_POST['last_name']);
            $service       = sanitize_text_field($_POST['service']);
            $query_message = sanitize_textarea_field($_POST['query_message']);

            // Validate required fields
            if (empty($first_name)) {
                $errors[] = 'First Name is required.';
                error_log('First Name is missing.');
            }
            if (empty($last_name)) {
                $errors[] = 'Last Name is required.';
                error_log('Last Name is missing.');
            }
            if (empty($service)) {
                $errors[] = 'Please select a Service.';
                error_log('Service selection is missing.');
            }
            if (empty($query_message)) {
                $errors[] = 'Message cannot be empty.';
                error_log('Message is missing.');
            }

            // If no validation errors, proceed to send the email
            if (empty($errors)) {
                $to      = 'akshaysharma5432@gmail.com'; // Change this to your desired email address
                $subject = 'New Inquiry from ' . $first_name . ' ' . $last_name;

                // Email body
                $body  = "First Name: $first_name\n";
                $body .= "Last Name: $last_name\n";
                $body .= "Service Interested In: $service\n";
                $body .= "Message:\n$query_message\n";

                $headers = array(
                    'Content-Type: text/plain; charset=UTF-8',
                    'From: Tej Electric <noreply@yourdomain.com>' // Ensure this is a valid email from your domain
                );

                // Send the email and store the result
                $mail_sent = wp_mail($to, $subject, $body, $headers);
                error_log('wp_mail() function called. Result: ' . ($mail_sent ? 'Success' : 'Failure'));

                if ($mail_sent) {
                    // Redirect to Thank You page
                    error_log('Redirecting to Thank You page.');
                    wp_redirect(home_url('/thank-you/'));
                    exit;
                } else {
                    $errors[] = 'There was an issue sending your message. Please try again later.';
                    error_log('wp_mail() failed to send the email.');
                }
            }
        }
    }

    // Start output buffering
    ob_start();
    ?>
    <div class="tej-contact-container">
        <?php if (!empty($errors)): ?>
            <div class="tej-contact-errors">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo esc_html($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" class="tej-contact-form" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">
            <?php 
            // WP nonce field for security
            wp_nonce_field('tej_contact_action', 'tej_contact_nonce'); 
            ?>

            <!-- Optional Honeypot Field -->
            <!-- 
            <div class="form-group honeypot" style="display:none;">
                <label for="hp_field">Leave this field empty</label>
                <input type="text" id="hp_field" name="hp_field" value="">
            </div>
            -->

            <h2>Get In Touch</h2>

            <div class="tej-contact-row">
                <label for="first_name">First Name<span style="color:red;">*</span></label>
                <input type="text" name="first_name" id="first_name" required value="<?php echo isset($first_name) ? esc_attr($first_name) : ''; ?>" />
            </div>

            <div class="tej-contact-row">
                <label for="last_name">Last Name<span style="color:red;">*</span></label>
                <input type="text" name="last_name" id="last_name" required value="<?php echo isset($last_name) ? esc_attr($last_name) : ''; ?>" />
            </div>

            <div class="tej-contact-row">
                <label for="service">Service Interested In<span style="color:red;">*</span></label>
                <select name="service" id="service" required>
                    <option value="">-- Please Select --</option>
                    <option value="Duct Smoke Sensor Installation" <?php selected(isset($service) ? $service : '', 'Duct Smoke Sensor Installation'); ?>>Duct Smoke Sensor Installation</option>
                    <option value="EV Chargers" <?php selected(isset($service) ? $service : '', 'EV Chargers'); ?>>EV Chargers</option>
                    <option value="High Voltage Installation" <?php selected(isset($service) ? $service : '', 'High Voltage Installation'); ?>>High Voltage Installation</option>
                    <option value="Substation Design & Construction" <?php selected(isset($service) ? $service : '', 'Substation Design & Construction'); ?>>Substation Design & Construction</option>
                    <option value="Other" <?php selected(isset($service) ? $service : '', 'Other'); ?>>Other</option>
                </select>
            </div>

            <div class="tej-contact-row">
                <label for="query_message">Your Message<span style="color:red;">*</span></label>
                <textarea name="query_message" id="query_message" rows="5" required><?php echo isset($query_message) ? esc_textarea($query_message) : ''; ?></textarea>
            </div>

            <button type="submit" name="tej_contact_submit">Submit</button>
        </form>
    </div>
    <?php

    return ob_get_clean(); // Return the form HTML
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


function enqueue_font_awesome() {
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );
?>