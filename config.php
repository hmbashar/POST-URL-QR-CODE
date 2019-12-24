<?php
/**
 * @package CB QR Code
 */
/*
Plugin Name: POST URL QR CODE
Plugin URI: http://www.codingbank.com/plugins/cb-post-url-qr-code
Description: This Plugin generate QR Code for post url and showing under every posts.
Version: 1.0
Author: Md Abul Bashar
Author URI: https://www.codingbank.com
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.
*/
/*
*   
*/
// Don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;

// define
define('CBPQC_DIR_PATH', plugin_dir_path(__FILE__));
define('CBPQC_DIR_URL', plugin_dir_url(__FILE__));

//Basic Setting
function cbpqc_basic_settings() {

	load_plugin_textdomain( 'cbpqc', false, CBPQC_DIR_PATH .'lang' );

}
add_action('after_setup_theme', 'cbpqc_basic_settings');


//features function
function cb_post_url_qr_code($content)  {
	$current_post_title = get_the_title();
	$current_post_id = get_the_ID();
	$current_post_url = urlencode(get_the_permalink());
	$current_post_type = get_post_type($current_post_id);

	/*
	* Post type check
	*/
	$excluded_post_type = apply_filters( 'cbpqc_excluded_post_types', array() );

	if(in_array($current_post_type, $excluded_post_type)) {
		return $content;
	}

	/*
	*	Dimension Hook
	*/
	$height = get_option('cbpqc_height');
	$width = get_option('cbpqc_width');
	$height = $height ? $height : 185;
	$width = $width ? $width : 185;

	$dimension = apply_filters( 'cbpqc_qrcode_dimension',  "{$width}x{$height}");

	$img_url = sprintf('https://api.qrserver.com/v1/create-qr-code/?size=%s&ecc=L&qzone=1&data=%s',$dimension, $current_post_url);

	$content.= sprintf("<div class='cb-post-url-qr-code'><br><img src='%s' alt='%s'/></div>",$img_url, $current_post_title );

	return $content;

}
add_filter( 'the_content', 'cb_post_url_qr_code' );

//add admin menu/options page
function cbpqc_setting_init() {
	//Add Section
	add_settings_section( 'cbpqc_sections', __('QR Code Options', 'cbpqc'), 'cbpqc_section_callback', 'general' );
	//Add Fields
	add_settings_field( 'cbpqc_height', __('QR Code Height', 'cbpqc'), 'cbpqc_qr_height', 'general' , 'cbpqc_sections');
	//Add Fields
	add_settings_field( 'cbpqc_width', __('QR Code Width', 'cbpqc'), 'cbpqc_qr_width', 'general', 'cbpqc_sections' );

	//Register Setting
	register_setting('general', 'cbpqc_height', array('sanitize_callback'=> 'esc_attr'));
	register_setting('general', 'cbpqc_width', array('sanitize_callback'=> 'esc_attr'));
}

add_action('admin_init', 'cbpqc_setting_init');

//Section Callback
function cbpqc_section_callback() {
	echo '<p>'.__("Setting for Post URL to QR Code Plugin", "cbpqc").'</p>';
}

//Height
function cbpqc_qr_height() {
	$height = get_option('cbpqc_height');
	printf("<input type='text' id='%s' name='%s' value='%s' placeholder='QR code height'>", 'cbpqc_height', 'cbpqc_height', $height);

}

//Width
function cbpqc_qr_width() {
	$width = get_option('cbpqc_width');
	printf("<input type='text' id='%s' name='%s' value='%s' placeholder='QR code width'>", 'cbpqc_width', 'cbpqc_width', $width);
}