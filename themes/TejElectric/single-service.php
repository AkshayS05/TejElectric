<?php
get_header();

if (have_posts()) : 
    while (have_posts()) : the_post(); 
        echo '<!-- Debug: Post Found -->'; // Debugging

        $service_image = get_field('service_image'); // Fetch the service image
        echo '<!-- Debug: ' . ($service_image ? 'Image Found' : 'No Image Found') . ' -->';
?>
<section class="single-service-container">
  <div class="container">
    <!-- Service Image -->
    <div class="single-service-featured-image">
        <?php
        if ($service_image) {
            echo '<img src="' . esc_url($service_image['url']) . '" alt="' . esc_attr($service_image['alt']) . '" />';
        } else {
            echo '<img src="' . esc_url(get_template_directory_uri() . '/images/placeholder.jpg') . '" alt="Placeholder Image" />';
        }
        ?>
    </div>

    <!-- Service Content -->
    <div class="single-service-content">
      <h1 class="service-title"><?php the_title(); ?></h1>
      <div class="service-description">
        <?php the_content(); ?>
      </div>
    </div>

    <!-- CTA Section -->
    <div class="single-service-cta">
      <a href="<?php echo site_url('/contact'); ?>" class="cta-button">Contact Us for This Service</a>
    </div>
  </div>
</section>
<?php
    endwhile; 
else : 
    echo '<!-- Debug: No Posts Found -->'; // Debugging
endif;

get_footer();
