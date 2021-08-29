<?php get_header(); ?>


<main>

  <div class="mt-4">
  <?php get_template_part('bread'); ?>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <!-- Wysiwug Start -->
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
        <?php endwhile; endif;?>
        <!--- Wysiwug Editor END -->
      </div>
      <div class="col-md-3">
        <?php get_sidebar(); ?>
      </div>
    </div>
  </div>
  </main>
<?php get_footer(); ?>
      