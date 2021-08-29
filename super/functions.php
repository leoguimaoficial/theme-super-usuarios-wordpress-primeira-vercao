<?php

require __DIR__.'/tools.php';
include __DIR__.'/admin/OKSettingsPage.php';
include __DIR__.'/widgets/NewsGrid.php';
include __DIR__.'/widgets/Ads.php';

add_theme_support( 'title-tag' );

add_theme_support( 'post-thumbnails' );
add_theme_support( 'pop-up-banner' );
add_image_size( 'cover-size-1', 1366, 300, ['center', 'center'] );
add_image_size( 'right-size-6', 100, 100, ['center', 'center'] );

add_post_type_support('post', 'custom-fields');

function get_meta_desc_tag(){
  if(get_the_excerpt() !== '')
  echo '<meta name="description" content="'.get_the_excerpt().'">';
}

function theme_styles() {

	wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap-reboot_css', get_template_directory_uri() . '/css/bootstrap-reboot.min.css' );
	wp_enqueue_style( 'bootstrap-grid_css', get_template_directory_uri() . '/css/bootstrap-grid.min.css' );
	wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'theme_css', get_template_directory_uri() . '/css/theme.css' );

}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

function theme_js() {

	global $wp_scripts;
	
	wp_register_script( 'html5_shiv', 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js', '', '', false );
	wp_register_script( 'respond_js', 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js', '', '', false );

	$wp_scripts->add_data( 'html5_shiv', 'conditional', 'lt IE 9' );
	$wp_scripts->add_data( 'respond_js', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'tether_js', get_template_directory_uri() . '/js/tether.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'acc_menu_js', get_template_directory_uri() . '/js/acc_menu.js', array('jquery'), '', true );
}
add_action( 'wp_enqueue_scripts', 'theme_js' );

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );


function register_theme_menus() {
	register_nav_menus(
		array(
			'header-menu'	=> __( 'Header Menu' ),
			'footer_1'	=> __( 'Footer 1' )
		)
	);
}
add_action( 'init', 'register_theme_menus' );


add_filter('widget_text','execute_php',100);
function execute_php($html){
     if(strpos($html,"<"."?php")!==false){
          ob_start();
          eval("?".">".$html);
          $html=ob_get_contents();
          ob_end_clean();
     }
     return $html;
};

// -- Custom post types --



function create_widget_area( $name, $id, $description ) {
	register_sidebar(array(
		'name' => __( $name ),	 
		'id' => $id, 
		'description' => __( $description ),
		'before_widget' => '<div class="widget-area '.$id.'">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}

// custom login screen
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
          background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png);
          height:40px;
          width:320px;
          background-size: 320px 125px;
          background-repeat: no-repeat;
          padding-bottom: 30px;
        }
        #login #wp-submit {
          background-color:#d19033 !important;
          text-shadow: none !important;
          border:none !important;
        }
        .login {
        	background-color:#191F2D;
        }
        #nav a {
        	color:#fff !important;
        }
      	#backtoblog a {
      		color:#fff !important;
      	}

    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
add_filter( 'http_request_host_is_external', '__return_true' );


function create_all_widget_areas(){
	create_widget_area( 'Destaque da Home', 'home-banner-1', 'Lugar onde fica o slide de notícias principal' );
	create_widget_area( 'Primeira seção da Home', 'home-section-1', 'Lugar onde fica primeira seção de notícias da página principal' );
	create_widget_area( 'Segunda seção da Home', 'home-section-2', 'Lugar onde fica segunda seção de notícias da página principal' );
	create_widget_area( 'Terceira seção da Home', 'home-section-3', 'Lugar onde fica terceira seção de notícias da página principal' );
	create_widget_area( 'Quarta seção da Home', 'home-section-4', 'Lugar onde fica quarta seção de notícias da página principal' );
	create_widget_area( 'Quinta seção da Home', 'home-section-5', 'Lugar onde fica quinta seção de notícias da página principal' );
	create_widget_area( 'Seção fixa do cabeçalho', 'header-section-1', 'Lugar onde fica seção fixa do cabeçalho' );
	create_widget_area( 'Seção fixa do rodapé', 'footer-section-1', 'Lugar onde fica seção fixa do rodapé' );
	create_widget_area( 'Seção fixa da barra fixa esquerda', 'sidebar-left-section-1', 'Lugar onde fica seção fixa da barra esquerda' );
	create_widget_area( 'Seção fixa da barra fixa direita', 'sidebar-right-section-1', 'Lugar onde fica seção fixa da barra direita' );
	create_widget_area( 'Seção de anúncios 1', 'ads-section-1', 'Lugar onde fica a primeira seção de anúncios' );
	create_widget_area( 'Seção de anúncios 2', 'ads-section-2', 'Lugar onde fica a segunda seção de anúncios' );
	create_widget_area( 'Seção de anúncios 3', 'ads-section-3', 'Lugar onde fica a terceira seção de anúncios' );
	create_widget_area( 'Seção de relacionados 1', 'related-posts-section-1', 'Lugar onde ficam posts relacionados no final das páginas' );
	create_widget_area( 'Barra lateral 1', 'sidebar-1', 'Lugar onde fica a barra lateral fixa usada nas páginas' );
	create_widget_area( 'Barra lateral 2', 'sidebar-2', 'Lugar onde fica a segunda barra lateral fixa usada nas páginas' );
}


add_action( 'widgets_init', 'create_all_widget_areas' );


function wrap_dynamic_sidebar($id, $classes = ''){
	dynamic_sidebar($id);
}





function wpb_custom_new_menus() {
	register_nav_menus(
	  [
		'header-menu-1' => __( 'Menu do cabeçalho #1' ),
		'header-menu-2' => __( 'Menu do cabeçalho #2' ),
		'footer-menu-1' => __( 'Menu do rodapé #1' ),
		'footer-menu-2' => __( 'Menu do rodapé #2' ),
		'footer-menu-3' => __( 'Menu do rodapé #3' ),
	  ]
	);


  }
  add_action( 'init', 'wpb_custom_new_menus' );



  
  function display_menu($menu_name, $title_visible = true, $classes = ''){

	$locations = get_nav_menu_locations();

	if (! isset( $locations[ $menu_name ] ) ) {
		return false;
	} 
	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	$items = wp_get_menu_array($menu->term_id);
	if($title_visible){
		echo '<h4>'.$menu->name.'</h4>';
	}
	echo '<ul class="primary-menu '.$classes.'">';
	echo display_menu_html($items);
	echo '</ul>';
  }

  function display_menu_html($items){
	  $html = '';
	  foreach($items as $i){
		$has_children_class = count($i['children']) >= 1 ? 'menu-item-has-children' : '' ;
		  $html .= '<li class="menu-item '. $has_children_class. '"><a href="'.$i['url'].'">'.$i['title'].'</a>';
		if(count($i['children']) >= 1){			
			$html .= '<ul class="sub-menu">';
			$html .= display_menu_html($i['children']);
		  	$html .= '</ul>';
		} 
		$html .= '</li>';
	  }
	  
	  return $html;
  }

  
  function populate_children($menu_array, $menu_item)
  {
	  $children = array();
	  if (!empty($menu_array)){
		  foreach ($menu_array as $k=>$m) {
			  if ($m->menu_item_parent == $menu_item->ID) {
				  $children[$m->ID] = array();
				  $children[$m->ID]['ID'] = $m->ID;
				  $children[$m->ID]['title'] = $m->title;
				  $children[$m->ID]['url'] = $m->url;
				  unset($menu_array[$k]);
				  $children[$m->ID]['children'] = populate_children($menu_array, $m);
			  }
		  }
	  };
	  return $children;
  }

  function wp_get_menu_array($current_menu='Main Menu') {

    $menu_array = wp_get_nav_menu_items($current_menu);

    $menu = array();


    foreach ($menu_array as $m) {
        if (empty($m->menu_item_parent)) {
            $menu[$m->ID] = array();
            $menu[$m->ID]['ID'] = $m->ID;
            $menu[$m->ID]['title'] = $m->title;
            $menu[$m->ID]['url'] = $m->url;
            $menu[$m->ID]['children'] = populate_children($menu_array, $m);
        }
    }

    return $menu;

}


			
function display_content(){
	$show_ads = get_post_meta( get_the_ID() , 'show_ads');
	if($show_ads){
		$show_ads = current($show_ads);
		$content = get_the_content(); 
		$middle = strrpos(substr($content, 0, floor(strlen($content) / 2)), ' ') + 1;
		$string1 = substr($content, 0, $middle);  // "The Quick : Brown Fox "
		$string2 = substr($content, $middle);  // "Jumped Over The Lazy / Dog"
		
		switch($show_ads){
			case 'start':
				echo '<h1>START!</h1>';
				echo $string1;            
				echo $string2;
			break;
			case 'end':
				echo $string1;            
				echo $string2;
				echo 'END';
			break;
		}
		
	} else {
		the_content();
	}
}

function has_video_thumbnail(){
	return !empty(get_post_meta( get_the_ID() , 'video_thumbnail'));
}

function img_url($name){
	return get_template_directory_uri().'/images/'.$name;
}

function termSlugToTitle(){
	$bname = basename($_SERVER['REQUEST_URI']);
	$cat = get_category_by_slug($bname);
  
	if($bname == 'contratar' || $bname == 'posts')
	return null;
  
	if(!isset($cat->name))
	return $bname;
  
	return $cat->name;
  }
  

  function add_404_actionlog(){
	$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$uri_segments = explode('/', $uri_path);

	add_actionlog('404: '. $uri_path);

  }
  
  function add_actionlog($term){
	global $wpdb;
	$table = $wpdb->prefix.'actionlog';
	$data = [
	  'ip' => $_SERVER['REMOTE_ADDR'],
	  'meta_key' => 'user_search',
	  'meta_value' => $term,
	  'log_added' => date('Y-m-d H:i:s')
	];
	$values = '(';
	foreach($data as $k=>$v){
	  $values.= "'".$v."'";
	  if($v !== end($data))
	  $values.=',';
	}
	$values.=')';
	$wpdb->query("INSERT IGNORE INTO `$table` (ip,meta_key,meta_value,log_added) VALUES $values");
  }
  
  function get_cat_count(){
	  global $wpdb;
	$SQL = "SELECT COUNT(term_id) as count_items FROM $wpdb->terms";
	return $wpdb->get_var($SQL);
  }

  function img_alt($post_id){

	$alt = get_the_post_thumbnail_alt($post_id);

	if(!empty($alt)){
		return $alt;
	}
	
	$caption = get_the_post_thumbnail_caption($post_id);

	if(!empty($caption)){
		return $caption;
	}

	$uri_path = parse_url(get_the_post_thumbnail_url($post_id), PHP_URL_PATH);
	$uri_segments = explode('/', $uri_path);
	$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', end($uri_segments));
	$withoutDashes = preg_replace('/[\_\-]/', ' ', $withoutExt);
	return $withoutDashes;
  }

  function get_the_post_thumbnail_alt($post_id) {
    return get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true);
}



//load more start

function load_more_posts() {
	$nonce_check = check_ajax_referer( 'extra-special', 'security' );
	
	if ( ! $nonce_check ) { 
		return;
	}

	$offset = $_POST['offset'];

	$args = [
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => '10',
		'orderby'	 => 'date',
		'order'	 	 => 'DESC',
		'offset'	 => $offset,
	];

	if(isset($_POST['s'])){
		$args['s'] = $_POST['s'];
	}

	$loop = new WP_Query($args);

	if ( $loop->have_posts() ){

		while( $loop->have_posts() ){
			$loop->the_post();



			get_template_part( 'content', get_post_format() );

		}
		wp_reset_postdata();
	}
	wp_die();
	
}
add_action( 'wp_ajax_load_more_posts', 'load_more_posts' );
add_action( 'wp_ajax_nopriv_load_more_posts', 'load_more_posts' );

//load more end
