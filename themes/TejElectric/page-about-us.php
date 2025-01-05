<?php
/**
 * Template Name: About Us Page
 */
get_header();
?>

<section class="about-us-section">
  <div class="container">

    <!-- New Image for visual appeal -->
    <div class="about-us-hero-image">
      <img 
        src="<?php echo get_template_directory_uri(); ?>/images/about-hero.jpg" 
        alt="Tej Electric - About Us" 
      />
       <!-- Electric Overlay Text -->
       <div class="electric-hero-text">
        <h2>About Us</h2>
      </div>
    </div>
    </div>

    <h1>About Us &amp; Why We Are<br>The Ideal Ones For the Job</h1>

    <p class="intro-text">
      With unwavering enthusiasm and operational efficiency, we take pride in delivering 
      exceptional experiences to our esteemed clients. Leveraging over two decades of 
      extensive knowledge and expertise, we have successfully executed numerous electrical 
      projects throughout Ontario, Canada. Our services extend to Brampton and nearby areas, 
      catering to a diverse clientele that includes both startups and established businesses.
    </p>

    <p class="intro-text">
      At our company, we specialize in providing a wide range of services tailored to meet 
      your specific electrical requirements. As an industry leader, we excel in offering 
      comprehensive solutions, including but not limited to:
    </p>

    <!-- Services List -->
    <div class="about-services">
      <article class="about-service-box">
        <h2>1. Electrical Installations</h2>
        <ul>
          <li>
            Our skilled team is well-versed in performing flawless installations 
            for residential, commercial, and industrial settings.
          </li>
          <li>
            We adhere to industry best practices and employ cutting-edge techniques 
            to ensure precise and reliable connections.
          </li>
        </ul>
      </article>

      <article class="about-service-box">
        <h2>2. EV Charger Installation</h2>
        <ul>
          <li>
            With the growing demand for electric vehicles (EVs), our technicians 
            handle various EV charger models for seamless integration.
          </li>
          <li>
            From consultation to setup, we ensure compatibility with your existing 
            electrical infrastructure.
          </li>
        </ul>
      </article>

      <article class="about-service-box">
        <h2>3. Duct Smoke Sensor Installation</h2>
        <ul>
          <li>
            Ensuring fire safety is paramount; we install duct smoke sensors to detect 
            potential hazards in HVAC systems.
          </li>
          <li>
            We comply strictly with local building codes and regulations to offer 
            you optimal protection.
          </li>
        </ul>
      </article>
    </div>
  </div>
</section>

<!-- CTA Section with Flickering Bulb -->
<section class="cta-section">
  <div class="container">
    <div class="electric-bulb-container">
      <!-- Make sure Font Awesome is enqueued so this icon appears -->
      <i class="fas fa-lightbulb"></i>
    </div>
    <h2>Need Reliable Electrical Services?</h2>
    <p>
      Trust our experienced team to handle all your electrical needs, 
      from EV chargers to high-voltage installs. 
      Let us power your next project with excellence!
    </p>
    <a class="cta-button" href="<?php echo site_url('/contact'); ?>">Get in Touch</a>
  </div>
</section>

<?php get_footer(); ?>