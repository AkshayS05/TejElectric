<?php
/**
 * Template Name: Services Page
 * Description: A custom layout for TejElectric services.
 */
get_header();
?>

<section class="services-hero-section">
  <div class="container">
    <h1>Our Services</h1>
    <p class="hero-intro">
      Explore the range of services we offer to cater to all your industrial, residential, and commercial electrical needs.
    </p>
  </div>
</section>

<section class="services-page-content">
  <div class="container">

    <?php
    // Fetch all published services from the "Services" post type
    $services = new WP_Query(array(
        'post_type' => 'service',
        'posts_per_page' => -1, // Get all services
        'orderby' => 'title',
        'order' => 'ASC',
    ));

    if ($services->have_posts()) :
      while ($services->have_posts()) :
        $services->the_post();
    ?>

    <!-- Dynamic Service Block -->
    <div class="service-block">
      <h2><?php the_title(); ?></h2>
      <?php if (has_post_thumbnail()) : ?>
        <div class="service-image">
          <?php the_post_thumbnail('medium', array('class' => 'service-thumbnail')); ?>
        </div>
      <?php endif; ?>
      <p><?php the_excerpt(); ?></p>
      <a class="services-cta-button" href="<?php the_permalink(); ?>">Learn More</a>
    </div>

    <?php
      endwhile;
      wp_reset_postdata();
    else :
    ?>
      <p>No services found. Please check back later.</p>
    <?php endif; ?>

  </div>
</section>

<!-- Partner with TejElectric Section -->
<section class="services-brand-callout">
  <div class="container">
    <div class="flickering-light">
      <i class="fas fa-lightbulb"></i>
    </div>
    <h2>Partner with TejElectric</h2>
    <p>
      Ready to power up your next project? Count on our decades of experience 
      to deliver top-grade solutions, every time.
    </p>
    <a class="services-cta-button" href="<?php echo site_url('/contact'); ?>">Contact Us Today</a>
  </div>
</section>

<?php get_footer(); ?>
