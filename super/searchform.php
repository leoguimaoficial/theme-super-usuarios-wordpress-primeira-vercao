<div class="container-fluid section-search" >
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2">
            <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get"  role="search" aria-label="Pesquisar todos artigos">
               
                    <?php 
        
                        $count_categories = get_cat_count();    
                        $count_posts = wp_count_posts()->publish;  
                        $search_placeholder = 'Digite algo para pesquisar ...';
                    ?>

                    <div class="input-group">
                        <input type="search" spellcheck="false" placeholder="<?php echo $search_placeholder; ?>" name="s" id="search" value="<?php the_search_query(); ?>" class="form-control" />
                  
                    <div class="input-group-append">
                        <input type="image" alt="Pesquisar" class="btn-search" src="<?php echo img_url('search-50.png');?>" />
                    </div>
                </div>
    <?php if(!isset($_GET['s'])) : ?>
                    <small class="input-help"><?php  echo 'Total de '.$count_categories.' categorias e '.$count_posts.' artigos publicados'; ?></small>
    <?php endif; ?>
            </form>
        </div>
    </div>
</div>