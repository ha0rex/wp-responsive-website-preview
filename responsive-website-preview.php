<?php
/**
 * Plugin Name: Responsive Website Preview
 * Plugin URI: http://upd8.hu
 * Description: Responsive Website Preview WordPres Plugin
 * Version: 1.0.0
 * Author: Levi Racz
 * Author URI: http://levi.racz.nl
 * License: GPL2
 * Text Domain: responsive_website_preview
 */
 
// don't load directly
if (!defined('ABSPATH')) die('-1');

/**
 * Enqueue Styles
 */
 
function rwp_styles_func() {
	wp_enqueue_style( 'rwp_style', plugin_dir_url(__FILE__).'/css/styles.css', array(), false, 'all' );
}
add_action( 'wp_enqueue_scripts', 'rwp_styles_func', 120 );

/**
 * Enqueue Scripts
 */
 
function rwp_scripts_func() { 
	wp_enqueue_script( 'rwp_functions', plugin_dir_url(__FILE__).'/js/functions.js', array('jquery'), false, true );
}
add_action( 'wp_enqueue_scripts', 'rwp_scripts_func' );

/**
 * Enqueue Admin Styles
 */
 
if( is_admin() ) {
	wp_enqueue_style( 'rwp_admin_style', plugin_dir_url(__FILE__).'/css/admin.css', array(), false, 'all' );
}

/**
 * Shortcode logic: [responsive_website_preview url="" device="" scale="" id="" class="" style=""]
 */

function responsive_website_preview_shortcode_func( $atts ) {
	$atts = shortcode_atts( array(
		'url' => false,
		'device' => false,
		'scale' => 1,
		'id' => false,
		'class' => false,
		'style' => false,
		'disable-navigation' => false
	), $atts, 'responsive_website_preview' );

	if(!$_GET['vc_mdp']) {
		return '
		<div '.($atts['id'] ? 'id="'.$atts['id'].'" ' : '').'class="vc_mdp_outer_wrapper device_wrapper_'.$atts['device'].' '.$atts['class'].'" style="'.$atts['style'].'">
			<div class="vc_mdp_wrapper device_'.$atts['device'].'" data-scale="'.$atts['scale'].'" '.($atts['disable-navigation'] ? 'data-disable-navigation="true"' : '').'>
				<div class="toolbar_top">
					<div class="network"></div>
					<div class="time"></div>
					<div class="battery"></div>
					<div class="url">'.str_replace(array('http://', 'https://'), '', $atts['url']).'</div>
				</div>
				<div class="iframe_wrapper">
					<iframe src="'.$atts['url'].'/?vc_mdp=true"></iframe>
				</div>
			</div>
		</div>';
	}
}
add_shortcode( 'responsive_website_preview', 'responsive_website_preview_shortcode_func' );

/**
 * Check if Visual Composer is installed and activated, and map the shortcode if it is
 */
 
include_once ABSPATH . 'wp-admin/includes/plugin.php';
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
    include_once 'includes/vc_map.php';
}
