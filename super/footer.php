

<?php 
	    if ( is_active_sidebar( 'footer-section-1' ) ) : 
		wrap_dynamic_sidebar( 'footer-section-1' ); 
		endif;
?>



<?php get_template_part('social_icons') ?>
<footer id="footer-bottom">

<!-- Footer -->
<section id="footer">
		<div class="container">




			<div class="row text-center text-xs-center text-sm-left text-md-left">

				
				  <div class="col-xs-12 col-sm-3">			
					<figure class="w-logo">
						<img src="<?php echo get_template_directory_uri().'/images/logo-header.png'; ?>" class="img-fluid" alt="LOGO – USUÁRIOS AVANÇADOS">
					<figcaption><?php echo bloginfo('title'); ?> é uma empresa gestora de conteúdo independente. <br>© <?php echo date('Y'); ?> Todos os direitos reservados</figcaption>
					<br><a class="small-link" href="<?php bloginfo('url').'/politica-de-privacidade'; ?>">Política de Privacidade</a>
					</figure>
				</div>

				<div class="col-xs-12 col-sm-3">			
					<?php display_menu('footer-menu-1', true, 's-1'); ?>
				</div>
				<div class="col-xs-12 col-sm-3">
				<?php display_menu('footer-menu-2', true, 's-1'); ?>
				</div>
				<div class="col-xs-12 col-sm-3">
					<?php display_menu('footer-menu-3', true, 's-1'); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
					<ul class="list-unstyled list-inline social text-center">
						<li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-facebook"></i></a></li>
						<li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-twitter"></i></a></li>
						<li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-instagram"></i></a></li>
						<li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-google-plus"></i></a></li>
						<li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02" target="_blank"><i class="fa fa-envelope"></i></a></li>
					</ul>
				</div>
				<hr>
			</div>	

	
		</div>
	</section>
	<!-- ./Footer -->
</footer>

<div class="sidebar-fixed bottom">
	<a class="btn-top-scroll" role="button"><img src="<?php echo get_template_directory_uri().'/images/arrow-top.png'; ?>" class="img-fluid" ></a>
	<!-- Button trigger modal -->
	
	<input type="image" role="button" alt="Pesquisar" class="btn-search"  data-toggle="modal" data-target="#modal-search" src="<?php echo img_url('search-50.png');?>" />
	
</div>

<?php get_template_part('modal-search'); ?>
<?php get_template_part('bottomtile'); ?>

<script type="text/javascript">
    var oNav = jQuery('header#header-php');
    var oMain = jQuery('main');
    var nNavTop = oNav.offset().top;
    var sNavTop= 0;
    jQuery(window).scroll(function(){
        sNavTop = jQuery(this).scrollTop();
    if(sNavTop > nNavTop){
        oNav.addClass('m-fixed');
        oMain.addClass('pt44');
    }else{
        oNav.removeClass('m-fixed');
        oMain.removeClass('pt44');
    }
    });
	</script> 
	
	<script>

jQuery(document).ready(function() {
  
  var btn = jQuery('.sidebar-fixed.bottom');

  jQuery(window).scroll(function() {
    if (jQuery(window).scrollTop() > 150) {
      btn.addClass('show');
    } else {
      btn.removeClass('show');
    }
  });

  btn.on('click', function(e) {
    e.preventDefault();
    jQuery('html, body').animate({scrollTop:0}, '300');
	
  });

});

</script>

<script>
jQuery( ".cell" ).mouseover(function() {
  jQuery( this ).find( '.wrap-img > img').addClass('hover');
}) .mouseout(function() {
	jQuery( this ).find( '.wrap-img > img').removeClass('hover');
  });

</script>

<?php wp_footer(); ?>

</body>
</html>
