<?php get_header(); ?>
<?php    get_template_part('searchform'); ?>
<main>

<div class="container-fluid">
    <?php
    
    if ( is_active_sidebar( 'home-banner-1' ) ) : 
    wrap_dynamic_sidebar( 'home-banner-1' ); 
    endif;
    
    ?>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <?php
            
            
            if ( is_active_sidebar( 'home-section-1' ) ) : 
            wrap_dynamic_sidebar( 'home-section-1' ); 
            endif;
            
            ?>
        </div>
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    
                    if ( is_active_sidebar( 'home-section-2' ) ) : 
                    wrap_dynamic_sidebar( 'home-section-2' ); 
                    endif;
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <?php
            
            if ( is_active_sidebar( 'home-section-3' ) ) : 
            wrap_dynamic_sidebar( 'home-section-3' ); 
            endif;
            
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            
            if ( is_active_sidebar( 'home-section-4' ) ) : 
            wrap_dynamic_sidebar( 'home-section-4' ); 
            endif;
            
            ?>
        </div>
    </div>
    <?php
    if ( is_active_sidebar( 'home-section-5' ) ) : 
    wrap_dynamic_sidebar( 'home-section-5' ); 
    endif;
    ?>
</div>
</main>


<?php get_footer(); ?>
