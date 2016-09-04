<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');

class VCResponsiveWebsitePreview {
    function __construct() {
        // We safely integrate with VC with this hook
        add_action( 'init', array( $this, 'integrateWithVC' ) );
 
        // Use this when creating a shortcode addon
        add_shortcode( 'vc_responsive_website_preview', array( $this, 'vc_responsive_website_preview_shortcode_func' ) );

        // Register CSS and JS
        add_action( 'wp_enqueue_scripts', array( $this, 'loadCssAndJs' ) );
    }

    public function loadCssAndJs() {}
 
    public function integrateWithVC() {
        // Check if Visual Composer is installed
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            // Display notice that Visual Compser is required
            add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
            return;
        }

        vc_map( array(
            "name" => __("Responsive Website Preview", 'responsive_website_preview'),
            "description" => __("Show your website on a mobile device", 'responsive_website_preview'),
            "base" => "vc_responsive_website_preview",
            "class" => "",
            "controls" => "full",
            "category" => __('Responsive Website Preview', 'responsive_website_preview'),
            "icon" => 'vc_extend_rwp',
            "params" => array(
                array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("URL", 'responsive_website_preview'),
                  "param_name" => "url",
                  "value" => '',
                  "description" => __("Specify an URL to load on device", 'responsive_website_preview'),
              	),
                array(
                  "type" => "dropdown",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Device type", 'responsive_website_preview'),
                  "param_name" => "device",
                  "value" => array(
                  	__("Select a device", 'responsive_website_preview') => '',
                  	__("iPhone 6", 'responsive_website_preview') => 'iphone6',
                  	__("iPad Air", 'responsive_website_preview') => 'ipadair',
                  ),
                  "description" => __("Please select a device to show", 'responsive_website_preview'),
              	),
                array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Scale", 'responsive_website_preview'),
                  "param_name" => "scale",
                  "value" => '1',
                  "description" => __("Please specify a scale level. 1 is full-size device, 0.5 is half-size.", 'responsive_website_preview'),
              	),
                array(
                  "type" => "checkbox",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Disable navigation", 'responsive_website_preview'),
                  "param_name" => "disable-navigation",
                  "value" => false,
                  "description" => __("Check if you want to prevent navigation on device.", 'responsive_website_preview'),
              	),
                array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Element ID", 'responsive_website_preview'),
                  "param_name" => "id",
                  "value" => '',
                  "description" => __("Enter row ID (Note: make sure it is unique and valid according to <a href=\"http://www.w3schools.com/tags/att_global_id.asp\" target=\"_blank\">w3c specification</a>", 'responsive_website_preview'),
              	),
                array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Extra class name", 'responsive_website_preview'),
                  "param_name" => "class",
                  "value" => '',
                  "description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", 'responsive_website_preview'),
              	),
            )
        ) );
    }
    
    /*
    Shortcode logic how it should be rendered
    */
    public function vc_responsive_website_preview_shortcode_func( $atts, $content = null ) {
    	return responsive_website_preview_shortcode_func( $atts );
    }

    /*
    Show notice if your plugin is activated but Visual Composer is not
    */
    public function showVcVersionNotice() {
        $plugin_data = get_plugin_data(__FILE__);
        echo '
        <div class="updated">
          <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'vc_extend'), $plugin_data['Name']).'</p>
        </div>';
    }
}

// Finally initialize code
new VCResponsiveWebsitePreview();