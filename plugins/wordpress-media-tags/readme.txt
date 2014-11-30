=== WordPress Media Tags ===
Contributors: destio
Donate link: http://www.typomedia.org/wordpress/plugins/wordpress-media-tags/
Tags: Attachment, Gallery, Images, Library, Media, Media Library, Media Tags, Shortcode, Tag, Tagging, Tags 
Requires at least: 3.5+
Tested up to: 3.5.2
Stable tag: 1.5

With this plugin you can tag media contents in your library. After that you'll be able to display all images from a certain tag or tags.

== Description ==

If you ever wanted to tag your media contents in WordPress, now you can. Tags can provide a comprehensive organization of different medias from different posts. Each tag is working like an own group. Medias with the same tags can be filtered by clicking on their tag names inside the media library. This helps you to organize a large amount of medias and even more: With a shortcode you can display all medias from a specific tag like a gallery.

= Features =

* Ability to tag media contents
* Separate taxonomy for media tags
* Displaying tags in library
* Extra field for media tags during upload
* Support for multiple tags in shortcode
* Localization in English and German
* No coding needed
* Custom image sizes

= Usage =

To display 5 images which have a tag named 'Flowers' and 'Screenshots' you can manually add the following shortcode in HTML view: 
`[mediatag name="flowers, screenshots" size="thumbnail" number=5]`

Display all images which are tagged with 'Flowers' and 'Screenshots' in 80 x 80 Pixel with the HTML class 'demo':
`[mediatag name="flowers, screenshots" size="80, 80" class="demo"]`

= name =

(string) The name of the tag or tags separated by comma

= size =

* thumbnail (default 150px x 150px max)
* medium (default 300px x 300px max)
* large (default 640px x 640px max)
* full (original resolution)
* 80, 80 (80 x 80 Pixel for example)

= number =

(integer) The amount of images you want do display. Type '-1' to show all images.

= class =

(string) The name of your favored class

If you want to add all medias from a specific tag in your template use this code:
`<?php if (class_exists('wp_media_tags_plugin')) print wp_media_tags_plugin::media_tags_query('flowers, screenshots', '80, 80', '-1', 'demo'); ?>`

Instead of `thumbnail` you can use the thumbnail sizes like above.

= Related Links =

* [Homepage](http://www.typomedia.org/wordpress/plugins/wordpress-media-tags/ "Homepage of WordPress Media Tags")
* [Changelog](http://wordpress.org/extend/plugins/wordpress-media-tags/changelog/ "Changelog for WordPress Media Tags")
* [Questions](http://wordpress.org/extend/plugins/wordpress-media-tags/faq/ "FAQ for WordPress Media Tags")
* [Information](http://graphicssoft.about.com/od/glossary/a/tagging.htm "What is Tagging?")
* [Demonstration](http://www.destio.de/tools/wordpress-media-tags/wordpress-media-tags-demo/ "Designstudio, Philipp Speck - WordPress Media Tags Demo Page")

**Note:**
Before installing or upgrading new plugins, please backup your database first!

= Thanks =

Thanks to all people out there using my plugin, giving ideas and help to develop it further.

== Installation ==

There are several ways to install a plugin in WordPress. For newbies this way is highly recommended:

1. Navigate to 'Add New' under 'Plugins' menu in admin area
1. Upload or choose `wordpress-media-tags.zip` from 'Install Plugins'
1. Activate the plugin through the 'Plugins' menu in WordPress

For more information please follow [WordPress Codex - Installing Plugins](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins "WordPress Codex - Installing Plugins").

== Frequently Asked Questions ==

= Will it cause trouble to my library after deactivation? =

No, it will not.

= How I can be sure that the plugin works properly? =

Upload a new picture and give it a tag. Then add a shortcode with this tag in one post.

= Will this plugin works together with other plugins? =

Yes, it's isolated in a own class.

== Screenshots ==

1. screenshot-1.gif
1. screenshot-2.gif
1. screenshot-3.gif

== Changelog ==

= 1.5 =
* Adding custom classes and user defined amount of images

= 1.4 =
* Ability to use custom image sizes

= 1.3 =
* Supports now multiple tags in shortcode

= 1.2 =
* Fix for the new Media Manager in WordPress 3.5

= 1.1 =
* Solving bug with shortcode output

= 1.0 =
* Basic functionality with shortcode support.

== Upgrade Notice ==

**Before installing or upgrading new plugins, please update you database first.**