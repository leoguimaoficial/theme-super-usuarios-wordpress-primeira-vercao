<?php

/*
Template Name: List Posts
*/
get_header(); 

?>


<main>
    <div class="container-fluid mt-4">
        <div class="row">
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
               
                <h1>Todos os posts do Portal</h1>
                        <hr/>
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
    </div>
</main>



<?php
get_footer();