
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
