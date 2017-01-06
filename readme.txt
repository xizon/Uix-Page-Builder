=== Uix Page Builder ===
Contributors: uiuxlab
Donate link: https://uiux.cc
Author URI: https://uiux.cc
Plugin URL: https://uiux.cc/wp-plugins/uix-pagebuilder/
Tags: pagebuilder, page builder, builder, website builder
Requires at least: 4.2
Tested up to: 4.7
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


Uix Page Builder is a design system that it is simple content creation interface.

== Description ==

Uix Page Builder is a design system that it is simple content creation interface. The currently available default elements: `parallax`, `google maps`,  `pricing table`, `features boxes`, `testimonials carousel`, `team`, `list of clients`, `accordion`, `tabs`, `author card`, `contact form` and `portfolio`. To be continued.


= Features =

* Plugin allow handles builder controls of backend template usage so that we can use our own templates instead of the plugin.
* Support to save custom templates and export templates.
* Support a key to add anchor links based Uix Page Builder to your navigation. Visit the Menus page (Appearance &laquo; Menus), choose items like "Uix Page Builder Anchor Links", from the left column to add to the menu.
* It is s easy to bind specific WordPress themes you want.
* Simple operation window, support loop list items.
* Allows you to customize front-end templates and publish multiple pages based Uix Page Builder.
* Allows completely customize your '.css', '.php', '.js', 'image' files for your builder structure, please refer to the usage.

> Note: Currently there is no detailed custom development documentation, can only refer to the default provided by the custom files in folders ( <strong>"uix-pagebuilder/uix-pagebuilder-sections/"</strong> and <strong>"uix-pagebuilder/theme_templates/"</strong> ).



== Installation ==

1. After activating your theme, you can see a prompt pointed out as absolutely critical. Go to "Appearance -> Install Plugins".
Or, upload the plugin to wordpress, Activate it. (Access the path (/wp-content/plugins/) And upload files there.)

2. You need to create Uix Page Builder template files in your templates directory. You can create the files on the WordPress admin panel. As a workaround you can use FTP, access the Uix Page Builder template files path (/wp-content/plugins/uix-pagebuilder/theme_templates/) and upload files to your theme templates directory (/wp-content/themes/{your-theme}/).  

	Please check if you have the 1 template files **'page-uix_pagebuilder.php'** in your templates directory. If you can't find these files, then just copy them from the directory '/wp-content/plugins/uix-pagebuilder/theme_templates/' to your templates directory.

3. Create a new WordPress file or edit an existing one. Just make sure to select this new created template file as the "Template" for this page from the "Attributes" section. Enter page title like "Custom One Page". Save the page and hit "Preview" to see how it looks. ( You should specify the template name, in this case I used **"Uix Page Builder Template"**. The "Template Name: Uix Page Builder Template" tells WordPress that this will be a custom page template. )

    Note: You will find **"Uix Page Builder Attributes"** settings in a meta box in your WordPress backend when you create a new page or when you are editing an existing one. This box is usually directly above the "Publish" meta box.
	

4. You can pretty much custom every aspect of the look and feel of this page by modifying the "*.php" template files (Access the path to the themes directory) . Best Practices for Editing WordPress Template Files:

  (1) WordPress comes with a theme and plugin editor as part of the core functionality. You can find it in your install by going to "Appearance > Editor" from your sidebar.

  (2) You can connect to your site via an FTP client, download a copy of the file you want to change, make the changes and then upload the file back to the server, overwriting the file that’s on the server.

5. Handles builder controls of backend template usage so that we can use our own templates instead of the plugin.

  Backend templates are in the <strong>"uix-pagebuilder-sections"</strong> folder. Includes custom "css, js, php" files. If you want to custom your builder controls of backend for your theme, then just copy them from the directory  <strong>"/wp-content/plugins/uix-pagebuilder/uix-pagebuilder-sections/"</strong> to your theme directory  <strong>"/wp-content/themes/{your-theme}/"</strong>.


== Frequently Asked Questions ==

= What's with the version numbers? =

The version number is the date of the revision of the [guidelines](https://make.wordpress.org/themes/handbook/review/) used to create it.


== Screenshots ==
1. screenshot-1.jpg
2. screenshot-2.jpg
3. screenshot-3.jpg
4. screenshot-4.jpg
5. screenshot-5.jpg


== Upgrade Notice ==


* Bug fixes and improvements.


== Changelog ==


= 1.0.0 =

* First release.

