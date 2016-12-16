=== 3D WP Tag Cloud-S ===
Contributors: hityr5yr, bisko
Tags: tag cloud, 3D, widget, HTML5, canvas, cloud, tags, links, recent posts, menu, images, multiple shapes
Requires at least: 3.9
Tested up to: 4.3.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl.html


3D WP Tag Cloud-S draws and animates a HTML5 canvas based tag cloud. 


== Description ==

Description: This is the Single Cloud variation of 3D WP Tag Cloud. It Creates multiple instances widget that draws and animates a HTML5 canvas based tag cloud. Plugin may rotate 
Pages, Recent Posts, External Links (blogroll), Menus, Blog Archives, List of Authors, Current Page/Post Links, Links from a custom HTML container, Post Tags, Post Categories, 
Portfolio Categories, Portfolio Items, Portfolio Filters, Slider Categories and Slider Items. Supports following shapes: parabolic ANTENNA, AXES, lighthouse BEAM, BALLS, BLOSSOM, BULB, 
CANDY, CAPSULE, concentric CIRCLES, CROWN, CUBE, CYLINDER that starts off horizontal, CYLINDER that starts off vertical, DNA, DOMES, EGG, Christmas FIR, GLASS, GLOBE of rings, HEART, 
HEXAGON (bee cell), KNOT, LEMON, LOVE, PEG TOP that starts off horizontal, PEG TOP that starts off vertical, PYRAMID (tetrahedron), RING that starts off horizontal, RING that starts 
off vertical, RINGS knotwork, ROLLER of rings, SANDGLASS, SATURN, SPHERE, SPIRAL, SPRING, SQUARE, STAIRECASE, STOOL, TIRE, TOWER of rings and TRIANGLE. Supports also multiple shape 
selection for automatic shape transitions during rotation and usage of a customer defined shape. Able to rotate clouds around all three axes. Option values are preset and don't have 
to be typed but selected. Multiple fonts, multiple colors and multiple backgrounds can be applied to the cloud content. Full variety of fonts from Google Font Library is available. 
The plugin allows creating clouds of images. In case of Recent posts, Pages, Menu, List of Authors, External Links (blogroll), Current Page/Post Links and Custom HTML container tags 
may consist of both image and text. It gives an option to put images and/or text in the center of the cloud. It accepts background images as well. The Number of tags in the cloud is 
adjustable. The plugin automatically includes WP Links panel for users who started using WP since v 3.5, when Links Manager and blogroll were made hidden by default. 3D WP Tag Cloud 
uses Graham Breach's Javascript class TagCanvas v. 2.8 and includes all its 80+ options in the Control Panel settings.


== Installation ==

= Manual = 
1. Make sure you are running WordPress version 3.9 or higher. 
2. Download the zip file and extract the content. 
3. Upload the '3D WP Tag Cloud' folder to your plugins directory (wp-content/plugins/). 
4. Login to your WordPress Admin menu, go to 'Appearance > Widgets' and if required enable accessibility mode in 'Screen Options' (right top corner). 
5. Add a widget instance.
6. If tag clouds created by previous plugin versions do not appear on your site after installation of a new version, just open and save their widget instances again without any changes.

= Automatic =
1. Make sure you are running WordPress version 3.9 or higher.
2. Use WordPress' built-in installer and activate the plugin.
3. Go to 'Appearance > Widgets' and if required enable accessibility mode in 'Screen Options' (right top corner). 
4. Add a widget instance.
5. If tag clouds created by previous plugin versions do not appear after installation, just open and save their widget instances again without any changes.


== Changelog ==

= 4.7.2 =
1. Added automatic reminder to the site administrator after installation of new version to open and save the old Widget Instances for making them compatible if necessary.
2. Added instructions in 'GUIDE & TIPS > Cloud Content Tips' section on how to put Portfolio Categories, Portfolio Items, Portfolio Filters, Slider Categories and/or Slider Items into the 
cloud via Menus content type.

= 4.7.1 =
1. Extended Range of Border Radius and Outline Radius to 61 (the range of Image Radius).

= 4.7 =
1. Added Image Radius option for rounding off image corners.
2. Added Scroll Pause option for pausing animation during page scroll.
3. Updated to Graham Breach's Javascript class TagCanvas v. 2.8.

= 4.6.3 =
1. Added a Target option for opening tag links in a new tab/window, parent or top frame to the rest content types, namely: Archives, Categories, Menu, Page/Post Links and Post Tags.

= 4.6.2 =
1. Added a Target option for opening tag links in a new tab/window, parent or top frame. Available to Authors, Blogroll, Pages and Recent Posts.

= 4.6.1 =
1. Prevented Firefox from showing an error when image_cf() is selected without supplying an image URL for it.

= 4.6 =
1. Added new shape: Crown.
2. Extended range of some Number of tags options.

= 4.5 =
1. Added new shape: Saturn.

= 4.4 =
1. Added multiple shape selection and fadein-fadeout shape transitions during rotation.
2. Added an option for usage of a customer defined shape.
3. Added new shape: Domes.
4. Improved shapes Glass and Sandglass.

= 4.3 =
1. Added a new shape: DNA.
2. Added an option for usage of custom shapes.
3. Added an option for Minimal Number of Tags in the Cloud.
4. Added an option for Repeating of Tag List.
5. Added Pinch Zoom of the cloud for touch screens.
6. Improved Balls Shape function.
7. Updated to Graham Breach's Javascript class TagCanvas v. 2.7.

= 4.2 =
1. Added new types of content: Current Page/Post Links and Custom HTML container (div, table, ul etc.).
2. Added new shapes: Rings Knotwork and Love.
3. Extended range of Radius X, Radius Y and Radius Z.
4. Fixed small bugs in Control Panel.

= 4.1 =
1. Added new shape: 3D spiral.
2. Fixed bug in Blossom Shape.

= 4.0.1 =
1. Fixed bug in Center Function for text.

= 4.0 =
1. Added new shapes: 3D axes, Balls, Blossom, Bulb, Christmas fir, Candy, Capsule, Concentric circles, Cube, Egg, Glass, Globe of rings, Heart, Knot, Lemon, 
Lighthouse beam, Parabolic antenna, Peg top that starts off horizontal, Peg top that starts off vertical, Roller of rings, Sandglass, Square, Stool, Starecase, 
Tire, Tower of rings, Triangle and Triangle pyramid.
2. Added new tips.
3. Extended range of some size options.
4. Fixed bug in Center Function for images.
5. Fixed small bugs. 

= 3.4 =
1. Added rotation around z-axis and an option for setting its speed.
2. Improved algorithm of hexagon 2D shape.

= 3.3 =
1. Added two new 2D shapes: spiral and hexagon.

= 3.2.2 =
1. Fixed bug in switching off Wheel Zoom.

= 3.2.1 =
1. The minimal values of Radius X, Radius Y & Radius Z are shifted to zero so clouds could be one or two dimensional.
2. Expanded scope of Canvas Height (90px - 960px): now Tag Cloud could be used as Header/Footer menu or Leaderboard Banner (728x90).
3. Reduced step between Depth values for precise setting of perspective. 
4. Reduced step between Initial values for precise control of speed.
5. Fixed bug in HEX check of entered colors.

= 3.2 =
1. Entirely redesigned Fonts section. Selection of Web Safe Fonts and Google fonts is simplified by two combo-boxes. Single or multiple fonts now can be selected rather than entered via keyboard.
2. Automatic update of Google Fonts List from Google Font Library.
3. Small code improvements.

= 3.1 =
1. Added a new feature for Recent posts, Pages, Menu Items, List of Authors and External Links (blogroll): Support for mixed image/text tags and choice of image, text or both. 
2. Added text and image alignment options. 
3. Added an option to enable/disable a "No tags" message when there are no tags to display.
4. Added an option for limiting number of Pages that can be rotated in the cloud.
5. Updated to Graham Breach's Javascript class TagCanvas v. 2.6.1.
6. Added new tips in Help section.
7. Fixed bug in freezing animation till next page loads.
8. Made some code improvements.

= 3.0 =
1. New option for adding background image behind cloud's content.
2. New function: At a click over a tag animation freezes and starts loading of requested URL .
3. New option for excluding tags from a cloud when its content consists of Authors
4. Automatic including of WP Links panel for users who started using WP after v 3.5 when Links Manager and blogroll were made hidden by default. 
5. Added User Guide in Help Section.
6. Added new tips in Help Section.
7. Added two ready made Central Functions for putting image or text in the center of the cloud.
8. Redesigned Control Panel: All settings are preset and thus option values don't have to be typed, but selected. Entered colors are shown next to their value for user's convenience. 
9. Fixed bug in Multiple Fonts
10. Code Improvements


= 2.3 =
1. Resolved problem with conflict between different js libraries used by customers: Due to such conflict some customers were not able to create 3D Tag Clouds.
2. Changed the way Central Function section was functioning: Till now the new versions used to delete already created functions, because they were kept in a plugin's file. Now customers put their functions away from the plugin. 


= 2.2.3 =
1. Installation clarifications
2. Code improvements.
3. New tips added.


= 2.2.2 =
1. Fixed bug with Control Panel interface.
2. Fixed a bug in Google Font check.

= 2.2.1 =
1. Fixed bug with Control Panel interface.

= 2.2 =
1. Changed the way Web Safe Fonts are inserted: Now user can choose Web Safe Font without typing its name. For Google Font there is a separate field.
2. Fixed a bug in Google Font check.
3. Improved Gradient Interface.


= 2.1.1 =
1. Fixed bug in multiple coloring.
2. Improved help for Gradient Colors.
3. Added tips in Help Section.

= 2.1 =
1. New types of Cloud Content added: 
	Archives (monthly, limit option), 
	Authors (incl/excl Admins, limit option) and 
	Pages;
2. New Option added: Multiple Colors. Now tags in the cloud may be motley;
3. New Option added: Multiple Backgrounds. Now tag's backgrounds may be pied;
4. New Option added: Multiple Fonts. Now Cloud Tags may be with different fonts;
5. Redesigned Gradient Colors option: Previous automatic one was not able to give clearly distinguishable colors. Now gradient depends on user's wish;
6. Redesigned Help Section for better convenience in use;
7. Fixed a bug in tags coloring.

= 2.0.1 =
During upload of v. 2.0 some files were missed.
Small amendments in Description are made.

= 2.0 =
1. Multiple widget instances
2. Extended cloud content with Recent Posts, External Links and Menu Items
3. Full variety of fonts from Google Font Library
4. All 70+ setting options of Graham Breach's Javascript class TagCanvas v. 2.5
5. Adjustable number of external links in the cloud
6. Usage of images instead of text in the cloud
7. Possibility to put images and/or text in the center of the cloud.
8. New convenient Control Panel for plugin settings
9. Tooltips for all settings and help section 
10. New plugin's name

= 1.1 =
Two more options added: 
1. Taxonomy. Now My WP-TagCanvas works with:
- Post Tags [default],
- Categories, or 
- Both mixed.
2. Number of Tags. By default it is 45, but it can be any number.

= 1.0 =
The First Version.