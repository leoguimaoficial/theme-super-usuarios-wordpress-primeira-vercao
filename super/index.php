<?php get_header(); ?>
  <div class="container mt-4">
    <div class="row">
    <div class="col-md-3  order-2 order-sm-1">
        <?php
            
        if ( is_active_sidebar( 'sidebar-1' ) ) : 
        wrap_dynamic_sidebar( 'sidebar-1' ); 
        endif;
      
      ?>
      </div>
      <div class="col-md-9">
      <div class="row">
        
        <?php if (have_posts()) :
          
          while (have_posts()) : the_post();

          get_template_part( 'content', get_post_format() );


          endwhile; 

       endif; ?>
      </div>
      </div>

    </div>
  </div>
<?php get_footer(); ?>
      