<?php
/**
 * Template Name: Thank You Page
 * Description: A custom thank you page after form submission.
 */

get_header();
?>

<section class="thankyou-section">
  <div class="container">
    <h1>Thank You!</h1>
    <p>Your message has been successfully sent. We will get back to you shortly.</p>
    <a class="services-cta-button" href="<?php echo home_url(); ?>">Return to Home</a>
  </div>
</section>

<?php get_footer(); ?>
