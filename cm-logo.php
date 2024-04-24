<?php
/*
Plugin Name: Codemonkey Logo
Description: Wordpress Plugin wrapping React component
Version: 1.0
Author: Simon Rundell
*/

   function enqueue_react_app($atts) {
        // Default values
        $default_atts = array(
            'backgroundcolor' => 'white',
            'textcolor' => 'black',
            'maxwidth' => '90px',
            'fontsize' => 'small',
            'borderstyle'=> '1px solid #747474',
        );
    
        // error_log('Received attributes: ' . print_r($atts, true)); // Log attributes to debug

        // Merge the user-defined attributes with the default values
        $atts = shortcode_atts($default_atts, $atts, 'cm-logo');
    
        // Enqueue the script
        wp_enqueue_script('cm-logo-js', plugins_url('app/build/static/js/main.js', __FILE__), array(), '1.0', true);
    
        // Pass the attributes to the script
        wp_localize_script('cm-logo-js', 'cmLogoProps', $atts);
    }
    add_action('wp_enqueue_scripts', 'enqueue_react_app');
    

function display_react_app($atts) {
    enqueue_react_app($atts);
    return '<div id="root"></div>'; 
}
add_shortcode('cm-logo', 'display_react_app');
