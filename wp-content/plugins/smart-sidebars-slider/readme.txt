=== Smart Sidebars Slider ===
Version: 2.6.1
Requires at least: 3.5
Tested up to: 4.2

Add extra sidebars that will be hidden behind tab on left or right side of the screen.

== Installation ==
= Requirements =
* PHP: 5.2.4 or newer
* WordPress: 3.5 or newer

= Basic Installation =
* Plugin folder in the WordPress plugins folder must be `smart-sidebars-slider`.
* Upload folder `smart-sidebars-slider` to the `/wp-content/plugins/` directory
* Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==
= Does plugin works with WordPress MultiSite installations? =
Yes. Each website in network can activate and use plugin on it's on.

= Can I translate plugin to my language? =
Yes. POT file is provided as a base for translation. Translation files should go into Languages directory.

== Changelog ==
= 2.6.1 / 2015.05.31 =
* Fix: Sidebars list reordering not working with drag to last row
* Fix: JavaScript code not properly minified causing few issues

= 2.6 / 2015.04.03 =
* Added: Close sidebar when user clicks anywhere outside the sidebar
* Update: Smart Tab Drawer v3.0
* Update: nanoScroller.js library updated to 0.8.5
* Update: Now loading new FontAwesome 4.3
* Fix: HTML widget custom content field was stripping HTML

= 2.5.5 / 2015.01.08 =
* Added: Sidebar content can be HTML and Shortcodes
* Update: Cleanup of the sidebars and order arrays
* Update: Minor changes to the sidebar setup panel
* Fix: Adding UL even if the sidebar is not set for widgets
* Fix: Import of exported data was not working

= 2.5.2 / 2014.09.16 =
* Fix: Few small issues with sidebars ordering

= 2.5.1 / 2014.09.14 =
* Fix: Major problem with deleting sidebars

= 2.5 / 2014.09.06 =
* Added: Change sidebars order using Drag and Drop
* Added: Auto tab positioning uses new method and settings
* Added: Panel to display sidebar jQuery control code
* Update: Expanded information about some plugin settings
* Update: Now loading new FontAwesome 4.2
* Update: nanoScroller.js library updated to 0.8.4
* Update: Smart Tab Drawer v2.7.1_internal
* Fix: Small issue with open on load settings
* Fix: Some issues with UI admin side styling

= 2.3.2 / 2014.08.06 =
* Fix: Problems saving settings on the Defaults panel
* Fix: Problem with saving sidebar minimal window size

= 2.3.1 / 2014.08.05 =
* Fix: Detection of single pages for sidebar rules
* Fix: Missing few strings from translation POT file

= 2.3 / 2014.07.21 =
* Added: Option for the tab edge spacing value
* Added: Option to set title attribute for tab element
* Update: Smart Tab Drawer v2.7
* Fix: Border radius from styles not used for sidebars
* Fix: Problems with sidebars resizing minimal size

= 2.2 / 2014.07.12 =
* Added: Plugin enforces open on load in case of conflict
* Update: Few improvements in sidebars code building
* Fix: Issues with some themes hiding the sidebars wrappers
* Fix: Some extra data included in building JavaScript calls
* Fix: Problem with open on load sidebar settings selection

= 2.1 / 2014.07.05 =
* Update: Smart Tab Drawer v2.6
* Fix: Issues with some themes and sidebars order on the page

= 2.0 / 2014.07.03 =
* Added: Sidebar content can be any custom HTML/PHP
* Added: Sidebar content can be custom action
* Added: Settings for sidebar opacity
* Added: Settings for sidebar anchor
* Added: Settings for sidebar edge and spacing
* Added: Settings for sidebar tab Closed state label
* Added: Settings to open sidebar on load
* Added: Settings to set minimum allowed window size
* Added: Global settings for all sidebars zIndex
* Added: Global settings for embed method for all sidebars
* Added: Actions before and after sidebar display
* Update: Reorganization of some general plugin settings
* Update: Smart Tab Drawer v2.5
* Fix: Few minor issues with plugin settings
* Fix: Few issues with rendering the sidebars

= 1.0 / 2014.05.29 =
* First release
