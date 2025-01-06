<?php
/**
 * Template Name: Contact Us Page
 * Description: A custom contact form page.
 */

// Start by checking if the user is logged in before any output
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login/')); // Redirect to the login page
    exit;
}

// Initialize variables for form processing
$errors = [];
$success = false;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_form_submitted'])) {
    // Verify nonce (if implemented)
    // if (!isset($_POST['contact_form_nonce']) || !wp_verify_nonce($_POST['contact_form_nonce'], 'contact_form_nonce')) {
    //     $errors[] = 'Security check failed. Please try again.';
    // }

    // Honeypot Check (Optional)
    if (!empty($_POST['phone'])) {
        $errors[] = 'Spam detected.';
    } else {
        // Sanitize and validate input data
        $first_name    = sanitize_text_field($_POST['first_name']);
        $last_name     = sanitize_text_field($_POST['last_name']);
        $email         = sanitize_email($_POST['email']);
        $service_type  = sanitize_text_field($_POST['service_type']);
        $city          = sanitize_text_field($_POST['city']); // New Field
        $message       = sanitize_textarea_field($_POST['message']);

        // Validate required fields
        if (empty($first_name)) {
            $errors[] = 'First Name is required.';
        }
        if (empty($last_name)) {
            $errors[] = 'Last Name is required.';
        }
        if (empty($email) || !is_email($email)) {
            $errors[] = 'A valid Email is required.';
        }
        if (empty($service_type)) {
            $errors[] = 'Please select a Service Type.';
        }
        if (empty($city)) { // Validation for New Field
            $errors[] = 'Please select a City where services are required.';
        }
        if (empty($message)) {
            $errors[] = 'Message cannot be empty.';
        }

        // If no errors, send the email
        if (empty($errors)) {
            $to = get_option('admin_email'); // Send to site admin
            $subject = 'New Contact Form Submission from ' . $first_name . ' ' . $last_name;
            $body = "
                <p><strong>First Name:</strong> {$first_name}</p>
                <p><strong>Last Name:</strong> {$last_name}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Service Type:</strong> {$service_type}</p>
                <p><strong>City:</strong> {$city}</p> <!-- Included City -->
                <p><strong>Message:</strong><br />" . nl2br($message) . "</p>
            ";
            $headers = ['Content-Type: text/html; charset=UTF-8'];

            // Use WordPress wp_mail function
            if (wp_mail($to, $subject, $body, $headers)) {
                // Redirect to Thank You page
                wp_redirect(site_url('/thank-you'));
                exit;
            } else {
                $errors[] = 'There was an issue sending your message. Please try again later.';
            }
        }
    }
}

// After all redirects and processing, include the header
get_header();
?>

<section class="contact-us-section">
  <div class="container">
    <h1>Contact Us</h1>
    <p class="contact-intro">
      Have a question or need a quote? Fill out the form below, and our team will get back to you shortly.
    </p>

    <?php if (!empty($errors)): ?>
      <div class="contact-errors">
        <ul>
          <?php foreach ($errors as $error): ?>
            <li><?php echo esc_html($error); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form class="contact-form" action="" method="POST">
      <!-- Hidden field to identify form submission -->
      <input type="hidden" name="contact_form_submitted" value="1">
      
      <!-- Honeypot Field (Hidden from Users) -->
      <div class="form-group honeypot" style="display:none;">
        <label for="phone">Phone (Leave Blank)</label>
        <input type="text" id="phone" name="phone" value="">
      </div>

      <div class="form-group">
        <label for="first_name">First Name*</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo isset($first_name) ? esc_attr($first_name) : ''; ?>" required>
      </div>

      <div class="form-group">
        <label for="last_name">Last Name*</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo isset($last_name) ? esc_attr($last_name) : ''; ?>" required>
      </div>

      <div class="form-group">
        <label for="email">Email*</label>
        <input type="email" id="email" name="email" value="<?php echo isset($email) ? esc_attr($email) : ''; ?>" required>
      </div>

      <div class="form-group">
        <label for="service_type">Service Type*</label>
        <select id="service_type" name="service_type" required>
          <option value="">-- Please Select --</option>
          <option value="Residential" <?php selected(isset($service_type) ? $service_type : '', 'Residential'); ?>>Residential</option>
          <option value="Business" <?php selected(isset($service_type) ? $service_type : '', 'Commercial'); ?>>Commercial</option>
          <option value="Business" <?php selected(isset($service_type) ? $service_type : '', 'Industrial'); ?>>Industrial</option>
        </select>
      </div>

      <!-- New City Field -->
      <div class="form-group">
        <label for="city">City Where Services Are Required*</label>
        <select id="city" name="city" required>
          <option value="">-- Please Select --</option>
          <option value="Toronto" <?php selected(isset($city) ? $city : '', 'Toronto'); ?>>Toronto</option>
          <option value="Mississauga" <?php selected(isset($city) ? $city : '', 'Mississauga'); ?>>Mississauga</option>
          <option value="Brampton" <?php selected(isset($city) ? $city : '', 'Brampton'); ?>>Brampton</option>
          <option value="Vaughan" <?php selected(isset($city) ? $city : '', 'Vaughan'); ?>>Vaughan</option>
          <option value="Markham" <?php selected(isset($city) ? $city : '', 'Markham'); ?>>Markham</option>
          <option value="Richmond Hill" <?php selected(isset($city) ? $city : '', 'Richmond Hill'); ?>>Richmond Hill</option>
          <option value="Oakville" <?php selected(isset($city) ? $city : '', 'Oakville'); ?>>Oakville</option>
          <option value="Ajax" <?php selected(isset($city) ? $city : '', 'Ajax'); ?>>Ajax</option>
          <option value="Other GTA Areas" <?php selected(isset($city) ? $city : '', 'Other GTA Areas'); ?>>Other GTA Areas</option>
        </select>
      </div>
      <!-- End of New City Field -->

      <div class="form-group">
        <label for="message">Message*</label>
        <textarea id="message" name="message" rows="5" required><?php echo isset($message) ? esc_textarea($message) : ''; ?></textarea>
      </div>

      <button type="submit" class="contact-submit-button">Submit</button>
    </form>
  </div>
</section>

<?php get_footer(); ?>
