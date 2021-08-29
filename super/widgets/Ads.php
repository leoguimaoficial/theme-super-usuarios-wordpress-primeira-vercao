<?php
 
class Ads extends WP_Widget {
 
    function __construct() {
 
        parent::__construct(
            'ads',  // Base ID
            'Anúncio'   // Name
        );
 
        add_action( 'widgets_init', function() {
            register_widget( 'Ads' );
        });
 
    }
 
    public $args = array(
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="widget-wrap ads">',
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
                echo '<div class="'.$class.' wrap-cell"><div class="cell '.$thumbnail_styles.'"><a href="'.get_permalink($post).'"><figure>';
                echo '<div class="wrap-content">';
                $wrap_img = '<div class="wrap-img size-'.$siblings_count.'"><img src="'.get_the_post_thumbnail_url($post).'"></div>';
                $wrap_txt = '<div class="wrap-text size-'.$siblings_count.'"><figcaption class="text"><h6 class="title">'.$post->post_title.'</h6>'
                .'<p class="excerpt">'.$post->post_excerpt.'</p></figcaption></div>';
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


        echo $instance['content'];
 
            
        echo $this->args['after_widget'];
        echo $args['after_widget'];

 
    }

   
    public function form( $instance ) {
 
        ?>

        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">Título</label>
      
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo isset($instance['title']) ?  esc_attr( $instance['title'] ) : ''; ?>">
     
            <label for="<?php echo esc_attr( $this->get_field_id( 'Text' ) ); ?>">Conteúdo</label>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'content' ) ); ?>" cols="30" rows="10"><?php echo isset($instance['content']) ? esc_attr( $instance['content'] ) : ''; ?></textarea>
     
        <?php
 
    }
 
    public function update( $new_instance, $old_instance ) {
 
        $instance = array();
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['content'] = ( !empty( $new_instance['content'] ) ) ? $new_instance['content'] : '';
 
        return $instance;
    }
 
}
$Ads = new Ads();
?>