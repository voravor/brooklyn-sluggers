<?php
/*
Author: Heleo.com
URL: https://heleo.com
*/

// Various clean up functions
require_once('library/cleanup.php');


// Add theme support
require_once('library/theme-support.php');


register_nav_menus(array(
    'hamburger' => 'Hamburger',
    'footer' => 'Footer'
));

// Add Header image
// require_once('library/custom-header.php');

if(!is_admin()) {

    add_action('wp_enqueue_scripts', 'enqueue_scripts');

    function enqueue_scripts() {

        switch(ENVIRONMENT) {

            case 'development':
                //use local copy
                $css_path = $path = get_template_directory_uri();

                // $css_path = str_replace(WP_HOME, CDN_CSS_URL, get_template_directory_uri());
                // $path = str_replace(WP_HOME, CDN_JS_URL, get_template_directory_uri());
                break;

            case 'staging':
                // $css_path = $path = get_template_directory_uri();
                $css_path = str_replace(WP_HOME, CDN_CSS_URL, get_template_directory_uri());
                $path = str_replace(WP_HOME, CDN_JS_URL, get_template_directory_uri());
                break;
            case 'qa':
            case 'production':

                // $css_path = $path = get_template_directory_uri();
                // use cdn version
                $css_path = str_replace(WP_HOME, CDN_CSS_URL, get_template_directory_uri());
                $path = str_replace(WP_HOME, CDN_JS_URL, get_template_directory_uri());
                break;

            default:
                $css_path = $path = get_template_directory_uri();

        }

        wp_enqueue_style('app', $css_path . '/css/foundation.css', false, filemtime(get_template_directory() . '/css/foundation.css'));

        // Register scripts

        // Deregister the jquery version bundled with wordpress
        wp_deregister_script('jquery');
        wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js', array(), '2.1.0', false);

        // jquery plugins
        wp_register_script('foundation', $path . '/js/bs.min.js', array('jquery'), filemtime(get_template_directory() . '/js/bs.min.js'), true);


        //wizard: TODO: use requirejs
        wp_register_script('viewmodel', $path . '/js/models/view.js', array('jquery'), filemtime(get_template_directory() . '/js/models/view.js'), true);



        wp_enqueue_script('jquery');

        wp_enqueue_script('foundation');
        wp_enqueue_script('viewmodel');


    }
}
