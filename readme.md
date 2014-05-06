#Puddlejumper wordpress starting theme

Puddlejumper is a very basic barebones starting theme for Wordpress. It has as much of the cruft removed. 

It has a few simple libraries included in the functions folder that you can take advantage of. Most of them are being used by default.

One of the library modules included is JW Post Types by Jeffrey Way (http://jeffrey-way.com). Which allows for creating custom post types in just a few lines of code. I've included a wrapper class for it so extend functionality and streamline it a little bit.

<hr>		

##Brents's first steps after installing

*all of this is optional, the theme will work just fine without any of this, just my personal preference*

1. **Settings > Enable Permalinks** (replace blog with whatever you want to call it ex. news, updates etc)
 	1. Set Custom Structure "/blog/%postname%/"
	2. Category Base: blog/category
	3. Tags Base: blog/tags
2. **Appearance > Theme**
	1. Rename theme directory
	2. Edit styles.css
	3. Make a screenshot.png
	4. Refresh
	5. Set new theme
3. **Pages > New**
	1. Make "Home"
		* Set Home template
	2. Make "Blog"
		* Set as Blog Template
	3. Ideally one other static page for templating (ex. About)
4. **Settings > General Settings**
    1. Set each preference

5. **Settings > Reading**
	1. Set Front Page to "Home"
	2. Set Post Page to "Blog"
	3. Show only Summary
6. **Appearance > Menus**
	1. Make "Primary" Menu
		* Add Blog Page and Home Page for now
7. **Plugins**
	* Trash Dolly Plugin
	* Download Plugins (The following are pretty standard)
		* Page Excerpts: <http://wordpress.org/extend/plugins/page-excerpt/>
		* Google XML Sitemaps: <http://wordpress.org/extend/plugins/google-sitemap-generator/>
		* Contact Form 7: <http://wordpress.org/extend/plugins/contact-form-7/>		
8. **Start Theming!**

<hr>

##Custom Class documentation

This is some shoddy documentation for the libraries included in the functions directory.

###WPclean (functions/wp-clean.php)

    $plugin_scripts_and_styles_to_remove = array(
        'jquery',
        'contact-form-7'
    );
    WPclean::init($plugin_scripts_and_styles_to_remove);

The Wordpress Clean class will take out all sorts of needless crap from the theme. Also includes a hook to remove scripts and styles from the wp-head so you can include them yourself in a civilized fashion (not 20 js/css requests)

###Inc (functions/inc.php)

    <?php Inc::templates( array( 'includes/html-header', 'includes/header' ), 'home' ); ?>

Include class. Let's you define an array of template files to include and pass a string to be the class on the page body. I believe this was taken out of the bones theme then extended to allow a string for body class.

###Custom Post Class

    $recipe = new PostType('recipe', array( 
	     'supports' => array( 
	         'title', 'editor', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions' 
	     )        
	));
	$recipe->add_meta_box('Recipe', array(
		'Image' => 'file',
		'Prep Time' => 'text',
		'Cook Time' => 'text',
		'Yield' => 'text',
		'Ingredients' => 'textarea',
		'Instructions' => 'textarea',
		'Rating' => 'text'
	));
	
Simple class to allow you to create custom post types from the above code. Only the first block is needed. The second adds custom meta boxes onto the post type. 

This has also been extended to allow you to rename the default posts type from "Posts".
    
    PostType::renameDefaultPosts("News");

##Closing

Get in touch if you have any question or are interested in contributing to this!


