# Uix Page Builder
This is a WordPress Plugin. Uix Page Builder is a design system that it is simple content creation interface.

Copyright (c) 2016 UIUX Lab [@uiux_lab](https://twitter.com/uiux_lab)

[Donate Me](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PYZLU7UZNQ6CE)

[Plugin URI](https://uiux.cc/wp-plugins/uix-page-builder/)

[Plugin for Wordpress at WordPress.org Repository](https://wordpress.org/plugins/uix-page-builder/)



### Licensing

Licensed under the [GPL3.0](http://www.gnu.org/licenses/gpl-3.0.en.html).

### Description


[![Uix Page Builder Live Demo](https://github.com/xizon/Uix-Page-Builder/blob/master/screenshots/video-cover.jpg)](https://www.youtube.com/watch?v=vg3rPxcfZEg "Uix Page Builder Live Demo")


Uix Page Builder is a design system that it is simple content creation interface. The currently available default elements: `parallax`, `google maps`,  `pricing table`, `features boxes`, `testimonials carousel`, `team`, `list of clients`, `accordion`, `tabs`, `author card`, `contact form` and `portfolio`. To be continued.  

You could add any new pages using the plugin to your WordPress site, find the **Pages** menu in the WordPress Dashboard Navigation menu. Click **Add new**. The **"Uix Page Builder Attributes"** section applies page builder templates to your new page. 


Here are **5+**  templates for you to swipe and make your own. Here, you will find free, professional design for Uix Page Builder. We add new, fresh designs regularly in order to provide you with large variety of templates to chose from.



= Displaying on Front-end Pages =

Embed a shortcode `[uix_pb_sections]` into the editor of **Pages Add New Screen**.
  
  
= Features =

* You can switch between "Visual Builder" and "Default Editor" modes at any time.
* Support to choose multiple default templates you want.
* Support to save custom templates and export templates.
* Support a key to add anchor links based Uix Page Builder to your navigation. Visit the Menus page (Appearance &laquo; Menus), choose items like "Uix Page Builder Anchor Links", from the left column to add to the menu.
* Simple operation window, support loop list items.
* Customizable core style sheets.



### Advanced Customization ( For Theme Developer )


1) Plugin allow handles builder controls of backend template usage so that we can use our own templates instead of the plugin. If you want to custom your builder controls of backend for your theme, then just copy them from the directory `/wp-content/plugins/uix-page-builder/uix-page-builder-custom/` to your theme directory `/wp-content/themes/{your-theme}/`.


2) Plugin allow handles plugin scripts of front-end. If you want to custom, rename the **"_plugins.js"** to **"plugins.js"** from the directory `/wp-content/plugins/uix-page-builder/uix-page-builder-custom/js/`, and add the required script to "plugins.js". ( If you done, the default Uix Page Builder plugin scripts can't queue. You can use your own scripts instead of the plugin only. )


### Updates

##### = 1.1.6 =

* Compatible with low version PHP (5.3+)
* Fixed some minor errors in the low version of PHP.


##### = 1.1.5 =

* Upgraded core API. ( For developers, custom modules are much simpler! )
* Optimize the page builder form structure.
* Fixed some bugs of TinyMCE editor.
* Fixed some bugs of form elements.


##### = 1.1.4 =

* Resolved compatibility errors that may occur with the editor.
* Optimized pop windows UI of editor for online preview.


##### = 1.1.3 =

* Added Draft and Publish buttons in the visual builder screen.
* some minor bugs for enqueue scripts.
* Spy pop windows of editor for online preview.
* Supported select the page template on visual builder screen.


##### = 1.1.1 =

* Added function of responsive switching preview (new).

##### = 1.1.0 =

* Upgraded visual builder core UI.


##### = 1.0.7 =

* Optimized drag and drop controls.
* Upgraded visual builder panel.
* Fixed some bugs that loaded row misalignment.
* Optimized backend scripts.


##### = 1.0.6 =

* Optimized visual builder panel.
* Fixed a bug that added row misalignment.


##### = 1.0.5 =

* Added visual builder mode (new).
* You can switch between "Visual Builder" and "Default Editor" modes at any time.
* Optimization of the admin panel structure.


##### = 1.0.2 =

* Optimized core stylesheets for front-end.
* Added "Glory" template (new).
* Added "Comfortableness" template (new).
* Enhanced "Parallax" module.
* Optimized for the editor.
* Optimized for the color selector.
* Fixed error in default template image path.


##### = 1.0.1 =

* Optimized enqueue scripts for front-end.
* Enhanced theme compatibility.


##### = 1.0.0 =

* First release.




### Tested under

- WP 4.2.*
- WP 4.3.*
- WP 4.4.1
- WP 4.4.2
- WP 4.5
- WP 4.5.1
- WP 4.5.2
- WP 4.5.3
- WP 4.6.*
- WP 4.7


###Screenshot

![](https://github.com/xizon/Uix-Page-Builder/blob/master/screenshots/screenshot-1.jpg)

![](https://github.com/xizon/Uix-Page-Builder/blob/master/screenshots/screenshot-2.jpg)

![](https://github.com/xizon/Uix-Page-Builder/blob/master/screenshots/screenshot-3.jpg)

![](https://github.com/xizon/Uix-Page-Builder/blob/master/screenshots/screenshot-4.jpg)

![](https://github.com/xizon/Uix-Page-Builder/blob/master/screenshots/screenshot-5.jpg)

![](https://github.com/xizon/Uix-Page-Builder/blob/master/screenshots/screenshot-6.jpg)

![](https://github.com/xizon/Uix-Page-Builder/blob/master/screenshots/screenshot-7.jpg)

![](https://github.com/xizon/Uix-Page-Builder/blob/master/screenshots/screenshot-8.jpg)

![](https://github.com/xizon/Uix-Page-Builder/blob/master/screenshots/screenshot-9.jpg)

![](https://github.com/xizon/Uix-Page-Builder/blob/master/screenshots/screenshot-11.jpg)

![](https://github.com/xizon/Uix-Page-Builder/blob/master/screenshots/screenshot-12.jpg)




###Credits

#####I would like to give special thanks to credits. The following is a guide to the list of credits for this plugin:

- [Gridster](https://dsmorse.github.io/gridster.js/)


###How to use?

1.After activating your theme, you can see a prompt pointed out as absolutely critical. Go to **"Appearance -> Install Plugins"**.
Or, upload the plugin to wordpress, Activate it. (Access the path (/wp-content/plugins/) And upload files there.)

![](https://github.com/xizon/Uix-Page-Builder/blob/master/helper/img/plug.jpg)


2.Create a new WordPress file or edit an existing one. Just make sure to select this new created template file as the **"Template"** for this page from the **"Attributes"** section. Enter page title like **"Custom One Page"**. Save the page and hit **"Preview"** to see how it looks. ( You could specify the template name, in this case I used `Uix Page Builder Template`.)

> You could create Uix Page Builder template file (from the directory **"/wp-content/plugins/uix-page-builder/theme_templates/page-uix_page_builder.php"** ) in your templates directory.
	
	
![](https://github.com/xizon/Uix-Page-Builder/blob/master/helper/img/menu.jpg)

![](https://github.com/xizon/Uix-Page-Builder/blob/master/helper/img/add-page.jpg)


You will find **"Uix Page Builder Attributes"** settings in a meta box in your WordPress backend when you create a new page or when you are editing an existing one. This box is usually directly above the "Publish" meta box. 

Click **"Use Visual Builder"** button to enter the visual editing mode.


![](https://github.com/xizon/Uix-Page-Builder/blob/master/helper/img/active.jpg)



