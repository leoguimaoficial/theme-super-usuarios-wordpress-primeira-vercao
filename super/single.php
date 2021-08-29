<?php get_header(); ?>


<main>

  <div class="mt-4">
  <?php get_template_part('bread'); ?>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <article>
        <!-- Wysiwug Start -->
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php 
            the_title('<h1>', '</h1>');
            echo '<div class="w-post-featured-image"><img src="'.get_the_post_thumbnail_url($post, 'large').'" alt="'.img_alt($post).'" class="thumbnail"></div>';

            the_content();
        ?>
        <?php endwhile; endif;?>
        <!--- Wysiwug Editor END -->
</article>
      </div>
      <div class="col-md-3">
        <?php get_template_part('add-to-any'); ?>
        <hr/>
        <?php
            
        if ( is_active_sidebar( 'sidebar-1' ) ) : 
        wrap_dynamic_sidebar( 'sidebar-1' ); 
        endif;

        if ( is_active_sidebar( 'ads-section-1' ) ) : 
        wrap_dynamic_sidebar( 'ads-section-1' ); 
        endif;
      
      ?>

      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-12">
          <?php
            
            if ( is_active_sidebar( 'related-posts-section-section-1' ) ) : 
            wrap_dynamic_sidebar( 'related-posts-section-section-1' ); 
            endif;
          
          ?>
      
      </div>
    </div>
  </div>


  <?php get_template_part('cats-tags'); ?>

</main>
<?php get_footer(); ?>
      