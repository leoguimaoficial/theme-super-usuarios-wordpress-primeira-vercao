
  <header id="header-php">
    <!-- Menu -->

    <div class="w-logo-mobile ">
      <figure>
        <a href="<?php bloginfo('url') ?>"><img role="logo" src="<?php echo get_template_directory_uri().'/images/banner-320.png'; ?>" class="img-fluid" alt="BANNER – USUÁRIOS AVANÇADOS"></a>
      </figure>
    </div>


    <div class="menu-container">
     
      <button class="menu-button">  Menu</button>
      <div id="site-header-menu" class="site-header-menu">
        <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="Primary Menu">
          <?php display_menu('header-menu-1', false); ?>
          <div class="w-logo">
            <figure>
              <a href="<?php bloginfo('url') ?>"><img role="logo" src="<?php echo get_template_directory_uri().'/images/logo-header.png'; ?>" class="img-fluid" alt="LOGO – USUÁRIOS AVANÇADOS"></a>
            </figure>
          </div>
          <?php display_menu('header-menu-2', false); ?>
        </nav>
      </div>
    </div><!-- Menu ends -->
  </header>