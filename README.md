<h2>WordPress Responsive Website Preview Plugin</h2>

This plugin helps you to show a preview of mobile or desktop version of your website, on your desktop view.

Currently it supports:
<ul>
	<li>iPhone 6</li>
	<li>iPad Air 2</li>
</ul>

Both of them in white color.

To use the plugin, simply download it and upload to your /wp-content/plugins directory via FTP, then enable it.

Use this shortcode to implement a device:

<strong>[responsive_website_preview url="" device="" scale="" id="" class="" style="" disable-navigation=""]</strong>

Where the attributes are:
<ul>
	<li><strong>url:</strong> URL of website you want to show on device</li>
	<li><strong>device:</strong> iphone6 or ipadair</li>
	<li><strong>scale:</strong> This specifies the size of the device. 1 is full size, 0.5 is half size.</li>
	<li><strong>id:</strong> id HTML attribute, without #</li>
	<li><strong>class:</strong> space separated class names</li>
	<li><strong>style:</strong> CSS style properties on container</li>
	<li><strong>disable-navigation:</strong> if true, links won't work on device</li>
</ul>

The plugin supports Visual Composer, if you have it installed. Simply click on "Add element" then search for "Responsive Website Preview". All the attributes above can be set via Visual Composer as well.