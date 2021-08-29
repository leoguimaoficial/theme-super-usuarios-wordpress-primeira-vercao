

<?php
/*
Template Name: Listagem de uma categoria
*/
get_header(); 
$categories = get_categories( array(
'orderby' => 'name',
'order'   => 'ASC'
) );
?> 
<main>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-3  order-2 order-sm-1">
                <?php get_template_part('add-to-any'); ?>
                <hr/>
                <?php
                if ( is_active_sidebar( 'ads-section-1' ) ) : 
                wrap_dynamic_sidebar( 'ads-section-1' ); 
                endif;
                if ( is_active_sidebar( 'sidebar-1' ) ) : 
                wrap_dynamic_sidebar( 'sidebar-1' ); 
                endif;
                if ( is_active_sidebar( 'ads-section-2' ) ) : 
                wrap_dynamic_sidebar( 'ads-section-2' ); 
                endif;
                ?>
            </div>
            <div class="col-md-9">
                <h1><?php echo  single_cat_title( '', false ); ?></h1>
                <?php if ( category_description() ) : // Show an optional category description. ?>
                <div class="archive-meta"><?php echo category_description(); ?></div>
            <?php endif; ?>

            <?php      echo '<div class="row">'; ?>
                <?php
                // Start the Loop.
                while ( have_posts() ) :
                    the_post();
    
                    /*
                     * Include the post format-specific template for the content. If you want
                     * to use this in a child theme then include a file called content-___.php
                     * (where ___ is the post format) and that will be used instead.
                     */
               
                     get_template_part( 'content', get_post_format() );
              
                endwhile;
    
                ?>

                <?php       echo '</div>'; ?>
                </div>
            </div>
        </main>
        <?php get_footer(); ?>