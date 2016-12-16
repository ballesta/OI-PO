=== Flexible Modals ===
Contributors: bagerathan
Donate link: http://www.wpsnippet.com/flexible-modals
Tags: modal, block, popup
Requires at least: 3.5
Tested up to: 3.9.1
Stable tag: 0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Flexible Modal is a very simple plugin to add modal windows to your WordPress content using shortcodes. 

== Description ==

Modal windows are interesting way to include extran information on a page. [adaptive-modal.js](http://www.onextrapixel.com/2014/06/25/create-modal-windows-that-can-be-morphed-from-anything-with-jquery-adaptive-modal-js/) makes it beautiful. You can use this little plugin which uses the same jQuery plugin to creae modal windows easily in any page or post or even on a widget uisng shortcode.

I have also added another functionality into this plugin, which will let you to embed your modal content into your post a page directly.

##Usage

Upon activation, the plugin will create a custom post type called 'Modals'. Where you can add your content, which later you can use it on a modal or embed directly into your page or post. 

1. [modal]
2. [block] 

###modal
the 'modal' shortcode is to create modal windows. 

For now the [modal] shortcode comes with four attributes.

**id**
Your modal id. eg: *[modal id=2]Click here[/modal]*

**data**
If your modal only going to have just text, you can directly add the content in the shortcode. eg: *[modal data="This is my modal content"]Click here[/modal]*. This shortcode is much useful when you want to add a modal window to a word in a paragrap without braking the paragrap.

`note: you cannot use both id and data in the same shortcode`

**background**
This is to style the link and the modal window background. Have to specify a valid color. eg: *[modal id=2 background="#DDDDDD"]Click here[/modal]*

**color**
This attribute is to change the color of the link. eg: *[modal id=2 background="#DDDDDD" color="#000000"]Click here[/modal]*

###block

The 'block' shortcode is to embed your modal content into any page or post. It only has one attribute.

**id**
id of the modal post type post. 

`note: both block and modal shortcodes uses the same Modals custom post type.` 

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `flexible-modal` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress


== Screenshots ==

-screenshots coming soon.-

== Changelog ==

= 0.1 =
* Initial release.

= 0.2 =
* Updated shortcode. - I have removed the label attribute from the [modal] shortcode and instead made it to wrap a text. eg: in **[modal id=2]Click here[/modal]** the "Click here" will become the anchor tag to activate the modal. So basically if you have a shortcode like **[modal id="2" label="Click here"]**, you will have to change it to **[modal id="2"]Click here[/modal]**

