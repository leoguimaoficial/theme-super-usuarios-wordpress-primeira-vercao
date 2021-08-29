<?php


function check_ads_meta(){
	$posts = get_posts(['numberposts' => -1]);
	foreach($posts as $p){
			update_post_meta($p->ID , 'show_ads', 'half');
	}
}

//check_ads_meta();
