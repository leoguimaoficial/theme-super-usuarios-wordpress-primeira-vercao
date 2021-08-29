<?php
class OKSettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'Configurações do tema', 
            'manage_options', 
            'ok-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'ok_theme_settings' );
        ?>
        <div class="wrap">
            <h1>Configurações básicas do tema</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'my_option_group' );
                do_settings_sections( 'ok-setting-admin' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'my_option_group', // Option group
            'ok_theme_settings', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'My Custom Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'ok-setting-admin' // Page
        );  

        add_settings_field(
            'youtube_profile', // ID
            'Canal do YouTube', // Title 
            array( $this, 'youtube_profile_callback' ), // Callback
            'ok-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'insta_profile', // ID
            'Perfil do Insta', // Title 
            array( $this, 'insta_profile_callback' ), // Callback
            'ok-setting-admin', // Page
            'setting_section_id' // Section           
        );     

        add_settings_field(
            'linkedin_profile', // ID
            'Perfil do LinkedIn', // Title 
            array( $this, 'linkedin_profile_callback' ), // Callback
            'ok-setting-admin', // Page
            'setting_section_id' // Section           
        );    
        
        add_settings_field(
            'twitter_profile', // ID
            'Perfil do Twitter', // Title 
            array( $this, 'twitter_profile_callback' ), // Callback
            'ok-setting-admin', // Page
            'setting_section_id' // Section           
        );   
        
        add_settings_field(
            'fb_profile', // ID
            'Perfil do Facebook', // Title 
            array( $this, 'fb_profile_callback' ), // Callback
            'ok-setting-admin', // Page
            'setting_section_id' // Section           
        );     

     
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();

        if( isset( $input['youtube_profile'] ) )
            $new_input['youtube_profile'] =  $input['youtube_profile'] ;

            if( isset( $input['insta_profile'] ) )
            $new_input['insta_profile'] =  $input['insta_profile'] ;

            if( isset( $input['linkedin_profile'] ) )
            $new_input['linkedin_profile'] =  $input['linkedin_profile'] ;

            if( isset( $input['twitter_profile'] ) )
            $new_input['twitter_profile'] =  $input['twitter_profile'] ;

            if( isset( $input['fb_profile'] ) )
            $new_input['fb_profile'] =  $input['fb_profile'] ;

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Forneça as seguintes informações do tema';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function youtube_profile_callback()
    {
        printf(
            '<input type="text" id="youtube_profile" name="ok_theme_settings[youtube_profile]" value="%s" />',
            isset( $this->options['youtube_profile'] ) ? esc_attr( $this->options['youtube_profile']) : ''
        );
    }

    
    /** 
     * Get the settings option array and print one of its values
     */
    public function insta_profile_callback()
    {
        printf(
            '<input type="text" id="insta_profile" name="ok_theme_settings[insta_profile]" value="%s" />',
            isset( $this->options['insta_profile'] ) ? esc_attr( $this->options['insta_profile']) : ''
        );
    }


        /** 
     * Get the settings option array and print one of its values
     */
    public function linkedin_profile_callback()
    {
        printf(
            '<input type="text" id="linkedin_profile" name="ok_theme_settings[linkedin_profile]" value="%s" />',
            isset( $this->options['linkedin_profile'] ) ? esc_attr( $this->options['linkedin_profile']) : ''
        );
    }

            /** 
     * Get the settings option array and print one of its values
     */
    public function twitter_profile_callback()
    {
        printf(
            '<input type="text" id="twitter_profile" name="ok_theme_settings[twitter_profile]" value="%s" />',
            isset( $this->options['twitter_profile'] ) ? esc_attr( $this->options['twitter_profile']) : ''
        );
    }

                /** 
     * Get the settings option array and print one of its values
     */
    public function fb_profile_callback()
    {
        printf(
            '<input type="text" id="fb_profile" name="ok_theme_settings[fb_profile]" value="%s" />',
            isset( $this->options['fb_profile'] ) ? esc_attr( $this->options['fb_profile']) : ''
        );
    }

}

if( is_admin() )
    $my_settings_page = new OKSettingsPage();