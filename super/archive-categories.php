<?php

/*
Template Name: Archive Categories
*/
get_header(); 

$categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
) );

?> 
<main>

<div class="container-fluid">
<div class="row mt-4">
    <div class="col-md-3 order-2 order-sm-1">
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
          

<h1>Categorias do portal</h1>

<?php 
$categories_index = [];

foreach($categories as $c){
    $categories_index[$c->name[0]][$c->term_id] = $c;
}

foreach($categories_index as $index_letter => $categories){
    echo '<div class="row"><div class="col-12"><h3 class="mt-3 mb-1">'.strtoupper($index_letter).'</h2>'; 
    foreach($categories as $c){
        echo '<a class="grid-category-badge" href="'.get_category_link($c->term_id).'">'.$c->name.'</a>';
    }
    echo '</div></div>';
}
?>
    </div>

</div>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>