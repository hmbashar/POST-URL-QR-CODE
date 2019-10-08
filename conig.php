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

	$dimension = apply_filters( 'cbpqc_qrcode_dimension',  '185x185');

	$img_url = sprintf('https://api.qrserver.com/v1/create-qr-code/?size=%s&ecc=L&qzone=1&data=%s',$dimension, $current_post_url);

	$content.= sprintf("<div class='cb-post-url-qr-code'><br><img src='%s' alt='%s'/></div>",$img_url, $current_post_title );

	return $content;

}
add_filter( 'the_content', 'cb_post_url_qr_code' );