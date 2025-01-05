<?php
/**
 * The header template for the theme
 *
 * Displays all of the <head> section and the beginning of the site content.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header id="site-header" class="site-header" role="banner">
    <div class="top-bar">
        <div class="container">
            <span class="contact-info">Call us: +1 234 567 890</span>
            <span class="opening-hours">Opening Hours: Mon-Fri 9:00 AM - 5:00 PM</span>
        </div>
    </div>
    
    <div class="top-menu">
        <nav class="top-navigation" role="navigation" aria-label="Top Menu">
            <?php
            if ( has_nav_menu( 'top' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'top',
                    'menu_id'        => 'top-menu',
                    'menu_class'     => 'menu top-menu',
                ) );
            }
            ?>
        </nav>
    </div>

    <div class="primary-menu">
        <div class="site-branding">
            <?php
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else {
                echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="site-title">' . get_bloginfo( 'name' ) . '</a>';
            }
            ?>
        </div>

        <nav class="main-navigation" role="navigation" aria-label="Primary Menu">
        <ul class="menu primary-menu">
            <li><a href="<?php echo esc_url(home_url('/services/')); ?>">Services</a></li>
            <li><a href="<?php echo esc_url(home_url('/contact-us/')); ?>">Contact Us</a></li>
            <li><a href="<?php echo esc_url(home_url('/about-us/')); ?>">About Us</a></li>
            <?php if (is_user_logged_in()) : ?>
                <li><a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a></li>
            <?php else : ?>
                <li><a href="<?php echo wp_login_url(); ?>">Login</a></li>
                <li><a href="<?php echo wp_registration_url(); ?>">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    </div>
    <div class="electric-switch">
  <!-- The checkbox to toggle dark mode -->
  <input type="checkbox" id="electric-toggle" />

  <!-- The label that visually becomes the switch -->
  <label for="electric-toggle" class="switch-body">
    <!-- The switch lever that flips -->
    <div class="switch-lever"></div>
    <!-- Optional spark elements for fun electricity effect -->
    <div class="switch-spark spark-1"></div>
    <div class="switch-spark spark-2"></div>
  </label>
</div>


</header>

<div id="content" class="site-content">
