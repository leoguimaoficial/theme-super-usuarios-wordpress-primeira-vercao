			
			<div class="container-fluid section-social">
                <div class="row">
                    <div class="col d-flex justify-content-end">
                        <!-- SOCIAL -->
                        <?php 
                            $social_options = get_option( 'ok_theme_settings' );
                        ?>
                        <ul class="list-inline ">                            
                            <li class="list-inline-item"><figure><a href="<?php echo $social_options['youtube_profile']; ?>" role="link"><img src="<?php echo img_url('yt.png') ?>" alt="Página no YouTube"></a></figure></li>
                            <li class="list-inline-item"><figure><a href="<?php echo $social_options['insta_profile']; ?>" role="link"><img src="<?php echo img_url('insta.png') ?>" alt="Página no Instagram"></a></figure></li>
                            <li class="list-inline-item"><figure><a href="<?php echo $social_options['linkedin_profile']; ?>" role="link"><img src="<?php echo img_url('lin.png') ?>" alt="Página no LinkedIn"></a></figure></li>
                            <li class="list-inline-item"><figure><a href="<?php echo $social_options['twitter_profile']; ?>" role="link"><img src="<?php echo img_url('twt.png') ?>" alt="Página no Twitter"></a></figure></li>
                            <li class="list-inline-item"><figure><a href="<?php echo $social_options['fb_profile']; ?>" role="link"><img src="<?php echo img_url('fb.png') ?>" alt="Página no Facebook"></a></figure></li>
                            
                        </ul>
                    </div>
                </div>
            </div>