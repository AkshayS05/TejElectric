<?php get_header(); ?>

<?php get_template_part('hero-section'); ?>

<div id="content" class="site-content">
    <?php while (have_posts()) : the_post(); ?>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php the_content(); ?>
        <hr>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
