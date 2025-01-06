<?php
/**
 * Template Name: Front Page
 */

// 1. Get the header (which usually includes <head>, site header, nav, etc.)
get_header();

// 2. Output the hero section (either by including a separate template file
//    or by directly writing the hero HTML/PHP here).
//    If your hero section is in "hero-section.php", for example:
get_template_part('template-parts/hero', 'section'); 

// 3. Add the new content (your "Providing a Range of..." section)
?>
<section class="services-section">
  <div class="container">
     <!-- Hanging Bulbs -->
     <div class="hanging-bulb bulb-left" aria-hidden="true">
      <i class="fas fa-lightbulb"></i>
    </div>
    <div class="hanging-bulb bulb-right" aria-hidden="true">
      <i class="fas fa-lightbulb"></i>
    </div>
    <h2>Providing a Range of<br>Commercial &amp; Residential Services</h2>

    <!-- Intro Paragraph -->
    <p class="intro-text">
      We work efficiently with full enthusiasm to provide the best experiences
      to our clients. With more than twenty years of knowledge and expertise,
      we have completed many projects in Ontario, Canada. We have provided all
      the electrical connections to startups as well as reputed businesses
      in the area.
    </p>

    <!-- Services Grid -->
    <div class="service-grid">
      
      <!-- Card 1: Duct Smoke Sensor Installation -->
      <div class="service-card">
        <div class="icon">
          <!-- Font Awesome icon -->
          <i class="fas fa-wind"></i>
        </div>
        <h3>Duct Smoke Sensor Installation</h3>
        <ul>
          <li>Install and maintain duct smoke sensors for enhanced fire safety.</li>
          <li>Inspect, troubleshoot, and repair existing systems.</li>
          <li>Offer appliance repair for quick and reliable fixes.</li>
          <li>Set up outlets and lighting features to meet modern needs.</li>
          <li>Provide electric panel installations and repairs.</li>
          <li>Install EV charging stations for convenient home charging.</li>
          <li>Implement solar panels for eco-friendly energy solutions.</li>
          <li>Cover everything in between to keep your home powered safely.</li>
        </ul>
      </div>

      <!-- Card 2: EV Chargers -->
      <div class="service-card">
        <div class="icon">
          <i class="fas fa-charging-station"></i>
        </div>
        <h3>EV Chargers</h3>
        <ul>
          <li>Professional EV charger installation for residential and commercial properties.</li>
          <li>Expert advice on the best charger models and placement.</li>
          <li>Ongoing maintenance and technical support for maximum uptime.</li>
          <li>Competitive pricing tailored for Brampton and nearby areas.</li>
          <li>Eco-friendly solutions that help reduce your carbon footprint.</li>
        </ul>
      </div>

      <!-- Card 3: High Voltage Installation -->
      <div class="service-card">
        <div class="icon">
          <i class="fas fa-bolt"></i>
        </div>
        <h3>High Voltage Installation</h3>
        <ul>
          <li>Transformer installs for commercial and industrial applications.</li>
          <li>Upgrades and repairs for high-capacity outlets and light fixtures.</li>
          <li>Restaurant appliance wiring to meet heavy-duty electrical demands.</li>
          <li>Dental equipment installation with precise voltage requirements.</li>
          <li>Electrical panel setups and repairs for safe, reliable performance.</li>
          <li>AC and heater installation/repair to keep your environment comfortable.</li>
        </ul>
      </div>

      <!-- Card 4: Substation Design & Construction -->
      <div class="service-card">
        <div class="icon">
          <i class="fas fa-tools"></i>
        </div>
        <h3>Substation Design &amp; Construction</h3>
        <ul>
          <li>End-to-end substation planning for commercial and industrial facilities.</li>
          <li>Skilled engineering teams ensure compliance with local and national codes.</li>
          <li>Construction and installation for seamless power distribution.</li>
          <li>Ongoing maintenance and upgrades to keep your substation running efficiently.</li>
          <li>Expert consulting to optimize energy usage and minimize downtime.</li>
        </ul>
      </div>
    </div>
  </div>
</section>
<?php echo do_shortcode('[tej_contact_form]'); ?>


<?php

// 4. Finally, get the footer
get_footer();
