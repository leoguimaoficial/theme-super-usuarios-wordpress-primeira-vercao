<?php
function get_many_categories( $post_id = 0, $args = array() )
{
   $post_id = (int) $post_id;
   $defaults = array('fields' => 'ids');
   $args = wp_parse_args( $args, $defaults );
   
   $cats = wp_get_object_terms($post_id, 'category', $args);

        $res = [];
        foreach($cats as $k => $name){
                $res[$k]['link'] = get_category_link(get_cat_ID($name));
                $res[$k]['name'] = $name;
        }


   return $res;
}
?>

<div class="container">
                <div class="row">
                        <div class="col-12">
                                <div class="card mt-3 cats-tags">
                                        <div class="card-body">
                                                <div class="row">
                                                        <div class="col-md-2"><span class="badge badge-primary badge-title">Categorias</span></div>
                                                        <div class="col-md-10">
                                                                <?php
                                                                $categories = get_many_categories(get_the_ID(), array( 'fields' => 'names' ) );
                                                                $length = count($categories);
                                                                foreach( $categories as $key => $term ) {
                                                                        echo '<a href="' . $term['link'] . '"><span class="grid-category-badge">' . $term['name'] . '</span></a>';
                        
                                                                 
                                                                } 
                                                                ?>
                                                        </div>
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-2"><span class="badge badge-info badge-title">Tags</span></div>
                                                        <div class="col-md-10">
                                                                <?php the_tags( '<span class="grid-category-badge">', '</span><span class="grid-category-badge">', '</span>' ); ?> 
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>