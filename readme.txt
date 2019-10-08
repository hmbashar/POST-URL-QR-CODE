=== POST URL QR CODE ===
Contributors: hmbashar
Tags: QR code, Post url qr code, page url qr code,qr code auto generator
Requires at least: 4.6
Tested up to: 5.2.3
Stable tag: 1.0
Requires PHP: 5.6
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==

This Plugin generate QR Code for post/all post types url and showing under every posts/all post types.
You can exclude any post type using our filter hook. 

**Exclude post type**
```
//exclude post type
function cbpqrc_exclude_post_types($post_types) {

	$post_types[] = 'page';

	return $post_types;

}
add_filter( 'cbpqc_excluded_post_types', 'cbpqrc_exclude_post_types' );
```

**Change dimension**
```
function cbpqc_qrcode_dimension() {

	return '200x200';

}

add_filter( 'cbpqc_qrcode_dimension', 'cbpqc_qrcode_dimension' );
```

Using/credit 3rd Party services <a href="http://goqr.me/qr-codes/type-qr-url.html">QR ME</a>
== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Plugin Name screen to configure the plugin
1. (Make your instructions match the desired user flow for activating and installing your plugin. Include any steps that might be needed for explanatory purposes)


== Frequently Asked Questions ==

= How to use the plugin? =

Just install the plugin then check post below


== Screenshots ==


== Changelog ==

= 1.0 =
* Just release new version.


== Upgrade Notice ==

= 1.0 =