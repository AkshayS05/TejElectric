<?php
/**
 * Template Name: Login Page
 */

get_header();

if (!is_user_logged_in()) : // Show the login form if the user is not logged in
?>
<section class="login-page">
  <div class="container">
    <h1>Login</h1>
    <p>Please log in to access this page.</p>
    <?php
    $args = array(
        'redirect'       => home_url('/contact-us/'), // Redirect to the contact page after login
        'form_id'        => 'loginform',
        'label_username' => __('Username'),
        'label_password' => __('Password'),
        'label_remember' => __('Remember Me'),
        'label_log_in'   => __('Log In'),
        'remember'       => true,
    );
    wp_login_form($args);
    ?>
  </div>
</section>
<?php
else :
    // Redirect logged-in users
    wp_redirect(home_url('/contact-us/'));
    exit;
endif;

get_footer();
