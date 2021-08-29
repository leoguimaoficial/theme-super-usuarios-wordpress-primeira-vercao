<!DOCTYPE html>
<html lang="en">
  <head>
    <base url="<?php bloginfo('url') ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php bloginfo('template_directory');?>/images/favicon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Oxygen:wght@300;400&family=Prata&family=Ubuntu:wght@300;400&display=swap" rel="stylesheet"> 

<?php if(is_front_page()): ?>
  <title><?php echo get_bloginfo('name'); ?></title>
  <meta name="description" content="<?php echo get_bloginfo('description'); ?>">
  <?php else: ?>
  <?php
  if ( ! function_exists( '_wp_render_title_tag' ) ) {
    function theme_slug_render_title() {
      ?>
      <title><?php wp_title( '|', true, 'right' ); ?></title>
      <?php
    }
    add_action( 'wp_head', 'theme_slug_render_title' );
  }
  get_meta_desc_tag();
  ?>
  <?php endif; ?>

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>


   <?php
   get_template_part('toptile');
   get_template_part('accessible-nav');

   ?>
