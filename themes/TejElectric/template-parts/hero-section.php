<?php
/**
 * Hero Section Template
 */
?>
<div class="hero-slider">
    <div class="slides">
        <!-- Slide 1 -->
        <div class="slide" style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/images/slide1.jpg');">
            <h2>Welcome to TejElectric</h2>
            <p>Your trusted electrical services partner</p>
            <a class="slide-button" href="<?php echo esc_url(site_url('/contact')); ?>">Contact Now</a>
        </div>

        <!-- Slide 2 -->
        <div class="slide" style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/images/slide2.jpg');">
            <h2>High-Quality Services</h2>
            <p>We deliver excellence in every project</p>
            <a class="slide-button" href="<?php echo esc_url(site_url('/services')); ?>">Check Services</a>
        </div>

        <!-- Slide 3 -->
        <div class="slide" style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/images/slide3.jpg');">
            <h2>24/7 Support</h2>
            <p>Always here to assist you</p>
            <a class="slide-button" href="<?php echo esc_url(site_url('/about')); ?>">About Us</a>
        </div>
    </div>

    <!-- Slider controls -->
    <div class="slider-controls">
        <span class="prev">❮</span>
        <span class="next">❯</span>
    </div>
</div>
