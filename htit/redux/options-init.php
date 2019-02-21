<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "blank_op";

    $icons_url  = ReduxFramework::$_url . '/assets/img/icons/';
    $patterns_path  = ReduxFramework::$_url . '/assets/img/patterns/';

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
    * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.
    
    $args = array(
        'opt_name' => 'iz_theme',
        'use_cdn' => TRUE,
        'display_name' => 'blank',
        'display_version' => '1.5.0',
        'page_slug' => 'iz_theme_options',
        'page_title' => 'Page Info',
        'update_notice' => false,//kiem tra version moi
        'admin_bar' => true,
        'admin_bar_icon' => 'dashicons-admin-settings',
        'menu_icon' => 'dashicons-admin-settings',
        'footer_credit' => '<span id="footer-thankyou"></span>',
        'menu_title' => 'Page Info',
        'page_parent_post_type' => 'your_post_type',
        'page_priority' => '60',
        'customizer' => TRUE,
        'default_show' => TRUE,
        'default_mark' => '*',
        'allow_sub_menu' => false,
        'hide_reset' => true,
        'class' => 'dn',
        'hints' => array(
            'icon' => 'el el-warning-sign',
            'icon_position' => 'left',
            'icon_color' => '#dd3333',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'cream',
                'rounded' => '1',
                'style' => 'tipped',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'effect' => 'fade',
                    'duration' => '500',
                    'event' => 'mouseover click',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'dev_mode' => false,
        'ciz_check_time' => '1440',
        'compiler' => TRUE,
        'global_variable' => 'iz_options',
        'page_permissions' => 'manage_options',
        'save_defaults' => false,
        'show_import_export' => false,
        'transient_time' => '3600',
        'network_sites' => TRUE,
        'async_typography' => TRUE,
    );

    Redux::setArgs( $opt_name, $args );
    /*
     *
     * ---> START SECTIONS
     *
     */

    Redux::setSection( $opt_name, array(
        'title' => __( 'Page Info', 'blank' ),
        'id'    => 'basic',
        'icon'  => $icons_url.'icon_option.png',
        'fields'=> array(
                      array(
                         "title"   => __("Company name", "blank"),
                         "id"      => "contact_name",
                         "url"     => true,
                         "output"     => array('.contact-info'),
                         "type"    => "text",
                      ),
                      array(
                         "title"   => __("Description", "blank"),
                         "id"      => "company_description",
                         "url"     => true,
                         "output"     => array('.contact-info'),
                         "type"    => "textarea",
                      ),
                      array(
                         "title"   => __("Logo", "blank"),
                         "id"      => "logo",
                         "url"     => true,
                         "type"    => "media"
                      ),
                      array(
                         "title"   => __("Favicon", "blank"),
                         "id"      => "favicon",
                         "url"     => true,
                         "type"    => "media"
                      ),
                      array(
                          "title"   => __("Image Default", "blank"),
                          "id"      => "image_default",
                          "url"     => true,
                          "output"     => array('.contact-info'),
                          "type"    => "media"
                      ),
                      array(
                          "title"   => __("Image 404", "blank"),
                          "id"      => "image_404",
                          "url"     => true,
                          "output"     => array('.contact-info'),
                          "type"    => "media"
                      ),
           )
    ) );


    //Contact
    Redux::setSection( $opt_name, array(
       'title'            => __( 'Settings', 'blank' ),
       'id'               => 'setting',
       'heading'          => 'Settings',       
       'icon'             => $icons_url.'icon-contact.png',
       'fields'           => array(
                                array(
                                   "title"   => __("Sidebar", "blank"),
                                   "id"      => "sidebar",
                                   "type"    => "select",
                                   'data'    => 'post',
                                   'args' => array(
                                        'post_type' => array( 'structure' ),
                                        'posts_per_page' => -1,
                                    ),
                                ),
                                array(
                                   "title"   => __("Footer", "blank"),
                                   "id"      => "footer",
                                   "type"    => "select",
                                   'data'    => 'post',
                                   'args' => array(
                                        'post_type' => array( 'structure' ),
                                        'posts_per_page' => -1,
                                    ),
                                ),
                             )
    ));
    
    // ADVANCED
    Redux::setSection( $opt_name, array(
       'title'            => __( 'Advanced', 'blank' ),
       'id'               => 'advanced',
       'icon'  => $icons_url.'icon-blog.png',
       'fields'           => array(
                                array( "title"        => __("Script Header", "blank"),
                                       "id"           => "script-header",
                                       "type"         => "textarea",
                                ),
                                array( "title"        => __("Script Body", "blank"),
                                       "id"           => "script-body",
                                       "type"         => "textarea",
                                ), 
                                array( "title"        => __("Script Footer", "blank"),
                                       "id"           => "script-footer",
                                       "type"         => "textarea",
                                ),
                             )
    ));

