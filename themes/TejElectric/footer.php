<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content
 * after. Includes wp_footer().
 */
?>

<footer class="site-footer">
    <div class="footer-container">
        <!-- Footer Navigation (Optional) -->
        <nav class="footer-nav">
            <?php
            // If using a WordPress menu named "Footer Menu":
            // 1. Register it in functions.php with register_nav_menu('footer', 'Footer Menu');
            // 2. Then create and assign the menu in WP Admin -> Appearance -> Menus
            wp_nav_menu(array(
                'theme_location' => 'footer',
                'container'      => false,
                'menu_class'     => 'footer-menu',
                'fallback_cb'    => false
            ));
            ?>
        </nav>

        <!-- Social Media Icons (Optional) -->
        <div class="footer-social">
            <a href="https://www.facebook.com/" target="_blank" rel="noopener" aria-label="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/" target="_blank" rel="noopener" aria-label="Twitter">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
            <!-- Add or remove icons/links as needed -->
        </div>
    </div>

    <div class="footer-bottom">
        <p class="copyright">
            &copy; <?php echo date('Y'); ?> TejElectric. All rights reserved.
        </p>
    </div>
</footer>

<!-- REQUIRED for WordPress to inject scripts and other markup -->
<?php wp_footer(); ?>
</body>
</html>
