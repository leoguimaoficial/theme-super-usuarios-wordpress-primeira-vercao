<?php get_header(); ?>

<main>
    <div class="container-fluid mt-4">
        <div class="row">
        <div class="col-md-3 order-2 order-sm-1">
        <?php get_template_part('add-to-any'); ?>
        <hr/>
        <?php
            
            if ( is_active_sidebar( 'sidebar-2' ) ) : 
            wrap_dynamic_sidebar( 'sidebar-2' ); 
            endif;
          
          ?>
        </div>
        <div class="col-md-9">
        <?php
               get_template_part('bread');
               ?>

<?php get_template_part('searchform') ?>

        <div class="alert alert-primary">
            <?php
            $allsearch = new WP_Query("s=$s&showposts=-1");
            $count = ($allsearch->post_count);
            $key = esc_html($s, 1);
            if ($count > 1) {
                echo '<h2>Foram encontrados ' . $count;
                _e(' resultados para a busca por');
                echo ' "' . $key . '"';
                _e('</h2> ');
                add_actionlog($key);
            } elseif ($count == 1) {
                echo '<h2>Foi encontrado ' . $count;
                _e(' resultado na busca por');
                echo ' "' . $key . '"';
                _e('</h2> ');
                add_actionlog($key);
            } else {
                add_404_actionlog();
                echo '<h2>Nada encontrado';
                _e(' parecido com');
                echo ' "' . $key . '"';
                _e('</h2> ');            
            }
            $c = 0;
            wp_reset_query();
            ?>
            </div>

        <div class="row">
      
        <input id="search_current" type="hidden" value="<?php echo isset($_GET['s']) ? $_GET['s'] : ''; ?>">
        <div id="w-posts" class="row"></div>
   
   <hr>
   <div id="w-load-more" class="row w-100">
   <div class="col">
   <button id="load-more-posts" class="btn btn-primary btn-lg m-auto d-block">Carregar +10 ...</button>
   </div>
   </div>

   <?php $nonce = wp_create_nonce('extra-special'); ?>

   <script>
   offset = 10;
   jQuery('#load-more-posts').click(function() {

       var ajax_url = jQuery('base').attr('url')+'/wp-admin/admin-ajax.php';

       var data = {
           'action': 'load_more_posts',
           'offset': offset,
           'security': '<?php echo $nonce; ?>',
           's' : jQuery('#search_current').val()
       };
       
       jQuery.post(ajax_url, data, function(response) {

           if (response !== ''){
               jQuery('#w-posts').append(response);

               offset += 10;
               jQuery('#w-posts').css('opacity', '1');
           } 
           else{
               jQuery('#w-load-more').hide();
           }
           
       });
   });
   jQuery('#load-more-posts').click();
   </script>
        </div>
    </div>
</main>
<?php get_footer(); ?>
