#First Steps in the Admin Panel

man, it would be cool if wordpress didn't hardcode the site url into all pages and posts. Then we could just have a default database and import it to start...

##Brents's general first steps after installing a fresh copy of Wordpress
*all of this is optional, the theme will work just fine without any of this*


1. Settings > Enable Permalinks (replace blog with whatever you want to call it ex. news, updates etc)
 	1. Set Custom Structure "/blog/%postname%/"
	2. Category Base: blog/category
	3. Tags Base: blog/tags

2. Appearance > Theme
	1. Rename theme directory
	2. Edit styles.css
	3. Make a screenshot.png
	4. Refresh
	5. Set new theme

3. Pages > New
	1. Make "Home"
		* Set Home template
	
	2. Make "Blog"
		* Set as Blog Template
		
	3. Ideally one other static page for templating (ex. About)

4. Settings > General Settings
    1. Set each preference

5. Settings > Reading
	1. Set Front Page to "Home"
	2. Set Post Page to "Blog"
	3. Show only Summary

6. Appearance > Menus
	1. Make "Primary" Menu
		* Add Blog Page and Home Page for now
		
7. Plugins
	* Trash Dolly Plugin
	* Download Plugins (The following are pretty standard)
		* Page Excerpts: <http://wordpress.org/extend/plugins/page-excerpt/>
		* W3 Total Cache: <http://wordpress.org/extend/plugins/w3-total-cache/>
		* Google XML Sitemaps: <http://wordpress.org/extend/plugins/google-sitemap-generator/>
		* Contact Form 7: <http://wordpress.org/extend/plugins/contact-form-7/>
		* Wordpress SEO: <http://wordpress.org/extend/plugins/wordpress-seo/>
		* Theme-Check: <http://wordpress.org/extend/plugins/theme-check/>
		* Google Analytics: <http://wordpress.org/extend/plugins/googleanalytics/>
		
8. **Start Theming!**