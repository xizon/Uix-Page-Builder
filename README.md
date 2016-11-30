# Uix Page Builder
This is a WordPress Plugin. Uix Page Builder is a design system that it is simple content creation interface.

Copyright (c) 2016 UIUX Lab [@uiux_lab](https://twitter.com/uiux_lab)

[Donate Me](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PYZLU7UZNQ6CE)

[Plugin URI](https://uiux.cc/wp-plugins/uix-pagebuilder/)

### Licensing

Licensed under the [GPL3.0](http://www.gnu.org/licenses/gpl-3.0.en.html).

### Description


Uix Page Builder is a design system that it is simple content creation interface.



### Updates 


##### Version 1.0.0

Initial Release.


### Tested under

- WP 4.2.*
- WP 4.3.*
- WP 4.4.1
- WP 4.4.2
- WP 4.5.*
- WP 4.6.*


###Screenshot

![](https://github.com/xizon/Uix-Page-Builder/blob/master/assets/screenshot-1.jpg)

![](https://github.com/xizon/Uix-Page-Builder/blob/master/assets/screenshot-2.jpg)




###Credits

#####I would like to give special thanks to credits. The following is a guide to the list of credits for this plugin:

- [Gridster](http://gridster.net/)


###How to use?

1.After activating your theme, you can see a prompt pointed out as absolutely critical. Go to **"Appearance -> Install Plugins"**.
Or, upload the plugin to wordpress, Activate it. (Access the path (/wp-content/plugins/) And upload files there.)

![](https://github.com/xizon/Uix-Page-Builder/blob/master/helper/img/plug.jpg)

2.You need to create Uix Page Builder template files in your templates directory. You can create the files on the WordPress admin panel. As a workaround you can use FTP, access the Uix Page Builder template files path (`/wp-content/plugins/uix-pagebuilder/theme_templates/`) and upload files to your theme templates directory (`/wp-content/themes/{your-theme}/`).  


Please check if you have the **1** template files `page-uix_pagebuilder.php` in your templates directory. If you can't find these files, then just copy them from the directory **"/wp-content/plugins/uix-pagebuilder/theme_templates/"** to your templates directory.

![](https://github.com/xizon/Uix-Page-Builder/blob/master/helper/img/temp.jpg)



3.Create a new WordPress file or edit an existing one. Just make sure to select this new created template file as the **"Template"** for this page from the **"Attributes"** section. Enter page title like **"Custom One Page"**. Save the page and hit **"Preview"** to see how it looks. ( You should specify the template name, in this case I used `Uix Page Builder Template`. The "Template Name: Uix Page Builder Template" tells WordPress that this will be a custom page template. )

![](https://github.com/xizon/Uix-Page-Builder/blob/master/helper/img/menu.jpg)

![](https://github.com/xizon/Uix-Page-Builder/blob/master/helper/img/add-page.jpg)


    Note: You will find **"Uix Page Builder Attributes"** settings in a meta box in your WordPress backend when you create a new page or when you are editing an existing one. This box is usually directly above the "Publish" meta box.

![](https://github.com/xizon/Uix-Page-Builder/blob/master/helper/img/active.jpg)


4.You can pretty much custom every aspect of the look and feel of this page by modifying the `*.php` template files **(Access the path to the themes directory)**. **Best Practices for Editing WordPress Template Files:**

　(1) WordPress comes with a theme and plugin editor as part of the core functionality. You can find it in your install by going to **"Appearance > Editor"** from your sidebar.
  
  ![](https://github.com/xizon/Uix-Page-Builder/blob/master/helper/img/editor.jpg)

　(2) You can connect to your site via an **FTP** client, download a copy of the file you want to change, make the changes and then upload the file back to the server, overwriting the file that’s on the server.


5.Handles builder controls of backend template usage so that we can use our own templates instead of the plugin.

Backend templates are in the `'uix-pagebuilder-sections'` folder. Includes custom "css, js, php" files. If you want to custom your builder controls of backend for your theme, then just copy them from the directory **"/wp-content/plugins/uix-pagebuilder/uix-pagebuilder-sections/"** to your theme directory **"/wp-content/themes/{your-theme}/"**.
  
![](https://github.com/xizon/Uix-Page-Builder/blob/master/helper/img/temp2.jpg)