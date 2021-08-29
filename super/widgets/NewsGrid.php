<?php
 
class NewsGrid extends WP_Widget {
 
    function __construct() {
 
        parent::__construct(
            'news-grid',  // Base ID
            'Grade de Notícias'   // Name
        );
 
        add_action( 'widgets_init', function() {
            register_widget( 'NewsGrid' );
        });
 
    }
 
    public $args = array(
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="widget-wrap news-grid">',
        'after_widget'  => '</div>'
    );

    public static function displayGrid($grid_classmap, $posts_list, $categories_list, $thumbnail_styles = 'cover', $siblings_count = 0){
        foreach($grid_classmap as $wrap_class => $class){

            if(is_array($class)){

                if(!is_int($wrap_class)){
                    echo '<div class="'.$wrap_class.'">';
                }   
                
                if(count($class) > 1){
                    echo '<div class="row no-gutters">';
                }   
                    self::displayGrid($class, $posts_list, $categories_list, $thumbnail_styles, count($class));

                    if(count($class) > 1){
                        echo '</div>';
                    } 

                if(!is_int($wrap_class)){
                    echo '</div>';
                }

              
                  
            } else {
                $post = array_shift($posts_list);
                $class_size = [

                ];
                echo '<div class="'.$class.' wrap-cell"><div class="cell '.$thumbnail_styles.'"><a href="'.get_permalink($post).'"><figure>';
                echo '<div class="wrap-content">';
                $composed_img_size = $thumbnail_styles.'-size-'.$siblings_count;
                $fixed_tile_items = [];

                if(has_video_thumbnail($post)){
                    $video_icon = '<img src="'.img_url('video-60.png').'" alt="contém vídeo" class="video-icon">';
                    $fixed_tile_items[] = $video_icon;
                }


                if(count($fixed_tile_items) > 0){
                    $fixed_tile_top = '<div class="fixed-tile top"><ul class="list-inline">';
                    foreach($fixed_tile_items as $item){
                        $fixed_tile_top .= '<li class="list-inline-item">'.$item.'</li>';
                    }
                    $fixed_tile_top .= '</ul></div>';
                }
                

                $wrap_img = '<div class="wrap-img size-'.$siblings_count.'"><img src="'.get_the_post_thumbnail_url($post, $composed_img_size).'" alt="'.img_alt($post).'" class="thumbnail">';
                $wrap_img .= isset($fixed_tile_top) ? $fixed_tile_top : '';
                $wrap_img .= '</div>';
          
        
                $wrap_txt = '<div class="wrap-text size-'.$siblings_count.'"><figcaption class="text"><h6 class="title">'.mb_strimwidth($post->post_title, 0, 50, ' »').'</h6>'
                .'<p class="excerpt">'.mb_strimwidth($post->post_excerpt, 0,80, ' »').'</p></figcaption></div>';
                if($thumbnail_styles == 'bottom'){
                    echo $wrap_txt.$wrap_img;
                } else {
                    echo $wrap_img.$wrap_txt;
                }

                echo '</div></figure></a></div></div>';
            }
        }
    }
 
    public function widget( $args, $instance ) {
 
        echo $args['before_widget'];
        echo $this->args['before_widget'];

        $grid_classmap = $this->getClassMapFromGridOptions($instance['grid_options']); 
 

        $categories_list = is_array($instance['categories']) ? implode(',', $instance['categories']) : $instance['categories'];

        $posts_list = get_posts( [
            'numberposts'      => count($grid_classmap, 1),
            'category'         => $categories_list,
            'orderby'          => $instance['sorting_options'],
            'order'            => $instance['sorting_options_extra'],
            'post_type'        => 'post',
            'suppress_filters' => true
        ]);


        if(isset($instance['display_category_names']) && $instance['display_category_names'] == 1){
            $categories_list_array = explode(',', $categories_list);
            foreach($categories_list_array as $cat_id){
                $cat_info = [];
                $cat_info['link'] = get_category_link($cat_id);
                $cat_info['name'] = get_cat_name($cat_id);
                $cats_names[$cat_id] = $cat_info;
            }
            echo '<div class="row"><div class="col-12 grid-categories">';
            foreach( $cats_names as $cat_info){
                echo '<a href="'.$cat_info['link'].'" role="link" class="grid-category-badge">'.$cat_info['name'].'</a>';
            }
            echo '</div></div>';
        }

        echo '<div class="row">';
        self::displayGrid($grid_classmap, $posts_list, $categories_list, $instance['thumbnail_styles'], count($grid_classmap));
        echo '</div>';
 
            
        echo $this->args['after_widget'];
        echo $args['after_widget'];

 
    }

    function getExtraSortingOptions($default = null){
        $sorting = [
            'ASC' => 'Descendente',
            'DESC' => 'Ascendente'
        ];

    $html = '<div><label for="sorting_options_extra">Modo de ordenação</label><br><select class="widefat" id="sorting_options_extra" name="'.esc_attr( $this->get_field_name( 'sorting_options_extra' ) ).'"  value="'.$default.'">';
         
        foreach( $sorting as $opt_key => $opt ) {
  /*          $category_link = sprintf( 
                '<a href="%1$s" alt="%2$s">%3$s</a>',
                esc_url( get_category_link( $category->term_id ) ),
                esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
                esc_html( $category->name )
            );
             
            echo '<p>' . sprintf( esc_html__( 'Category: %s', 'textdomain' ), $category_link ) . '</p> ';
            echo '<p>' . sprintf( esc_html__( 'Description: %s', 'textdomain' ), $category->description ) . '</p>';
            echo '<p>' . sprintf( esc_html__( 'Post Count: %s', 'textdomain' ), $category->count ) . '</p>';
*/
            $html .= '<option value="'.$opt_key.'">'.$opt.'</option>'; 
        } 

        $html .= '</select></div>';
        return $html;
    }

    function getSortingOptions($default = null){
        $sorting = [
            'none' => 'Sem ordenação',
            'ID' => 'ID',
            'author' => 'Autor',
            'title' => 'Nome',
            'date' => 'Data de criação',
            'modified' => 'Data de modificação',
            'rand' => 'Aleatório',
            'comment_count' => 'Núm de comentários'
        ];

        $html = '<div><label for="sorting_options">Ordenação<br><select class="widefat" id="sorting_options" name="'.esc_attr( $this->get_field_name( 'sorting_options' ) ).'"  value="'.$default.'">';
         
        foreach( $sorting as $opt_key => $opt ) {
  /*          $category_link = sprintf( 
                '<a href="%1$s" alt="%2$s">%3$s</a>',
                esc_url( get_category_link( $category->term_id ) ),
                esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
                esc_html( $category->name )
            );
             
            echo '<p>' . sprintf( esc_html__( 'Category: %s', 'textdomain' ), $category_link ) . '</p> ';
            echo '<p>' . sprintf( esc_html__( 'Description: %s', 'textdomain' ), $category->description ) . '</p>';
            echo '<p>' . sprintf( esc_html__( 'Post Count: %s', 'textdomain' ), $category->count ) . '</p>';
*/
$selected = $opt_key == $default ? 'selected' : '';
            $html .= '<option '.$selected.' value="'.$opt_key.'">'.$opt.'</option>'; 
        } 

        $html .= '</select></div>';
        return $html;
    }


    function getCategoriesListing($default_list = []){
        $categories = get_categories( array(
            'orderby' => 'name',
            'order'   => 'ASC'
        ) );

$html = '<div><label for="categories">Categorias</label><br><select id="categories" multiple="multiple" name="'. esc_attr( $this->get_field_name( 'categories' ) ).'[]" class="widefat">';
         
        foreach( $categories as $category ) {
  /*          $category_link = sprintf( 
                '<a href="%1$s" alt="%2$s">%3$s</a>',
                esc_url( get_category_link( $category->term_id ) ),
                esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
                esc_html( $category->name )
            );
             
            echo '<p>' . sprintf( esc_html__( 'Category: %s', 'textdomain' ), $category_link ) . '</p> ';
            echo '<p>' . sprintf( esc_html__( 'Description: %s', 'textdomain' ), $category->description ) . '</p>';
            echo '<p>' . sprintf( esc_html__( 'Post Count: %s', 'textdomain' ), $category->count ) . '</p>';
*/          
            $selected = array_search((string) $category->term_id, $default_list) !== false ? "selected" : "";
            $html .= '<option '. $selected. ' value="'.$category->term_id.'">'.$category->name .' ('.$category->count.' notícias)</option>'; 
        } 

        $html .= '</select></div>';
        return $html;
    }

    function getClassMapFromGridOptions($option){
        switch($option){
            case 'opt-3-2':
                $map = [
                    0 => 'col-6',
                    1 => 'col-6',
                    2 => 'col-6',
                    3 => 'col-6',
                    4 => 'col-6',
                    5 => 'col-6'
                ];
            break;
            case 'opt-2-2':
                $map = [
                    0 => 'col-6',
                    1 => 'col-6',
                    2 => 'col-6',
                    3 => 'col-6'
                ];            
            break;
            case 'opt-1-4':
            $map = [
                0 => 'col-6 col-md-3',
                1 => 'col-6 col-md-3',
                2 => 'col-6 col-md-3',
                3 => 'col-6 col-md-3',
            ];  
            break;
            case 'opt-1-2':
            $map = [
                0 => 'col-md-6',
                1 => 'col-md-6'
            ];  
            break;
            case 'opt-6-1':
                $map = [
                    0 => 'col-md-12',
                    1 => 'col-md-12',
                    2 => 'col-md-12',
                    3 => 'col-md-12',
                    4 => 'col-md-12',
                    5 => 'col-md-12'
                ];  
                break;
            case 'o-1':
                $map = [
                    0 => [
                        'col-md-6' => [
                            'col-12',
                        ],
                    ],
                    1 => [
                        'col-md-6' => [
                            0 => 'col-6',
                            1 =>'col-6',
                            2 => 'col-6',
                            3 => 'col-6'
                        ]
                    ] 
               ];             
            break;
            case 'o-2':
                $map = [
                    0 => [
                        'col-md-6' => [
                            0 => 'col-6',
                            1 => 'col-6',
                            2 => 'col-6',
                            3 => 'col-6'
                        ]
                    ],
                    1 => [
                        'col-md-6' => [
                            'col-12'
                        ]
                    ]
               ];       
            break;
            default:
            $map = [
                'col-md-12'
            ];
        break;
        }

        return $map;
    }

    function getGridOptions($default = 'opt-destaque-apenas'){
        $options = [
            'opt-destaque-apenas' => 'Destaque Apenas',
            'opt-3-2' => '3 Linhas e 2 Colunas',
            'opt-2-2' => '2 Linhas e 2 Colunas',
            'opt-1-4' => '1 Linha e 4 Colunas',
            'opt-1-2' => '1 Linha e 2 Colunas',
            'opt-6-1' => '6 Linhas e 1 Coluna',
            'o-1' => 'Destaque + 4 menores',
            'o-2' => '4 menores + Destaque'
        ];

$html = '<div><label for="grid_options">Opções de grade</label><br><select id="grid_options" name="'. esc_attr( $this->get_field_name( 'grid_options' ) ).'" class="widefat">';
         
        foreach( $options as $key => $opt ) {
  /*          $category_link = sprintf( 
                '<a href="%1$s" alt="%2$s">%3$s</a>',
                esc_url( get_category_link( $category->term_id ) ),
                esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
                esc_html( $category->name )
            );
             
            echo '<p>' . sprintf( esc_html__( 'Category: %s', 'textdomain' ), $category_link ) . '</p> ';
            echo '<p>' . sprintf( esc_html__( 'Description: %s', 'textdomain' ), $category->description ) . '</p>';
            echo '<p>' . sprintf( esc_html__( 'Post Count: %s', 'textdomain' ), $category->count ) . '</p>';
*/          
$selected =  $default == $key ? "selected" : "";
            $html .= '<option '. $selected. ' value="'.$key.'">'.$opt .'</option>'; 
        } 

        $html .= '</select></div>';
        return $html;
    }

    function getThumbnailStyles($default = 'cover'){
        $options = [
            'cover' => 'Imagem no fundo',
            'top' => 'Imagem em cima',
            'left' => 'Imagem à esquerda',
            'right' => 'Imagem à direita',
            'bottom' => 'Imagem em baixo'
        ];

$html = '<div><label for="thumbnail_styles">Estilo de miniatura</label><br><select id="thumbnail_styles" name="'. esc_attr( $this->get_field_name( 'thumbnail_styles' ) ).'" class="widefat">';
         
        foreach( $options as $key => $opt ) {
  /*          $category_link = sprintf( 
                '<a href="%1$s" alt="%2$s">%3$s</a>',
                esc_url( get_category_link( $category->term_id ) ),
                esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
                esc_html( $category->name )
            );
             
            echo '<p>' . sprintf( esc_html__( 'Category: %s', 'textdomain' ), $category_link ) . '</p> ';
            echo '<p>' . sprintf( esc_html__( 'Description: %s', 'textdomain' ), $category->description ) . '</p>';
            echo '<p>' . sprintf( esc_html__( 'Post Count: %s', 'textdomain' ), $category->count ) . '</p>';
*/          
$selected =  $default == $key ? "selected" : "";
            $html .= '<option '. $selected. ' value="'.$key.'">'.$opt .'</option>'; 
        } 

        $html .= '</select></div>';
        return $html;
    }
 
    public function form( $instance ) {
 
        ?>
        <?php echo $this->getCategoriesListing(!empty($instance['categories']) ? $instance['categories'] : []); ?>
        <?php echo $this->getSortingOptions(isset($instance['sorting_options']) ? $instance['sorting_options'] : null); ?>
        <?php echo $this->getExtraSortingOptions(isset($instance['sorting_options_extra']) ? $instance['sorting_options_extra'] : null); ?>
        <?php echo $this->getGridOptions(isset($instance['grid_options']) ? $instance['grid_options'] : null); ?>
        <?php echo $this->getThumbnailStyles(isset($instance['thumbnail_styles']) ? $instance['thumbnail_styles'] : null); ?>

        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">Título</label>
      
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo isset($instance['title']) ?  esc_attr( $instance['title'] ) : ''; ?>">
        <div style="margin: 6px 0">
        <input class="widefat" type="checkbox" value="1" id="<?php echo esc_attr( $this->get_field_id( 'display_category_names' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_category_names' ) ); ?>" <?php echo isset($instance['display_category_names']) && $instance['display_category_names'] == 1 ? 'checked' : ''; ?>><label for="<?php echo esc_attr( $this->get_field_id( 'display_category_names' ) ); ?>">Exibir nomes das categorias </label>
    </div>
     
        <label for="<?php echo esc_attr( $this->get_field_id( 'Text' ) ); ?>">Descrição</label>
        <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" cols="30" rows="10"><?php echo isset($instance['text']) ? esc_attr( $instance['text'] ) : ''; ?></textarea>
       

    
        <?php
 
    }
 
    public function update( $new_instance, $old_instance ) {
 
        $instance = array();
        $instance['categories'] = $new_instance['categories'];
        $instance['sorting_options'] = $new_instance['sorting_options'];
        $instance['grid_options'] = $new_instance['grid_options'];
        $instance['thumbnail_styles'] = $new_instance['thumbnail_styles'];
        $instance['sorting_options_extra'] = $new_instance['sorting_options_extra'];
        $instance['display_category_names'] = $new_instance['display_category_names'];
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['text'] = ( !empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';
 
        return $instance;
    }
 
}
$NewsGrid = new NewsGrid();
?>