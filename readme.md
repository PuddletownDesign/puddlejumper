#Puddlejumper wordpress starting theme

Puddlejumper is a very basic barebones starting theme for Wordpress. It has as much of the cruft removed. 

It has a few simple libraries included in the functions folder that you can take advantage of. Most of them are being used by default.

One of the library modules included is JW Post Types by Jeffrey Way (http://jeffrey-way.com). Which allows for creating custom post types in just a few lines of code. I've included a wrapper class for it to extend functionality and streamline it a little bit.

<hr>		

##Features

* Setup to use SASS. Sheets broken down into logical structures.
* Modularly loaded javascript with modernizr
* Simple semantic templates (each type individually stylable)
* Tons of useless code, classes, bizzaro semantics removed 
* A few useful classes thrown in to make some common things easy. Feel free not to use them either!
* Did I mention that piles of useless garbage is removed?

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

##Using SCSS

A quickover view on working with the included SCSS features. The best part is you don't have to use them. Just feel free to start writing in the css/styles.css file.

All of the included tags are already targeted in the SCSS files and ready to be themed.

This structure promotes a mobile first design pattern.

###SCSS Directory Structure

    scss/ (hold all of the scss data, ignored by wordpress)
    |
   	|	_colors.scss (holds the master color codes for the theme)
    |
    |	_fonts.scss (holds any @fontface or font data)
    |
    |	_layout.scss (the basic layout of the site globally)
    |
    |	_mixins.scss (common recurring items, like buttons can go here)
    |
    |	_pages.scss (page specific styles, each body tag can be given it's own class)
    |
    |	_plugins.scss (where all wordpress or other plugin css goes)
    |
    |	_reset.scss (css reset)
    |
    |	_responsive.scss (controls how the responsive settings for the site work)
    |
    |	_typography.scss (holds the master typography data for the site)
    |
    |	responsive/ (holds resposive variations)
    |   |
    |	|	_480.scss (ex. layouts > 480px)
    |   |
    |	|	_760.scss (ex. layouts > 760px)
    |   |
    |	|	_980.scss  (ex. layouts > 980px)
    |   |
    |	|	_1200.scss (ex. layouts > 1200px)
    |   |
    |	|	_1201.scss (ex. everything else)
    |   |
    |	styles.scss (loads each of the above SCSS files in the correct order)
    |
    styles.css (the final compiled style sheet)

Everything in the scss directory compiles down to styles.css. styles.css is the file that will be read by wordpress. 

<hr>

##Modularly loading javscripts with modernizr

    js/lib/modernizr.js

The head calls the modernizr file which loads in any listed files. You will have to change sitename.com to whatever the domain is.

Shown below is the lazy approach. You can easily use if/else statements and only include scripts on the pages that need them! Take that wordpress!

Coupled with the WPClean Class you can inlcude scripts yourself and compile plugin css with scss.

Once again if you don't want to use this just don't call modernizr in the includes/html-header.php file. Then include javascript in whatever fashion you like.

    Modernizr.load([
    	/* Libraries */
    	'//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', 
    	'//sitename.com/wp-content/themes/100lettersforpeace/js/lib/jquery.slicknav.js',
    	'//sitename.com/wp-content/themes/100lettersforpeace/js/lib/jquery.magnific-popup.js',
    	'//sitename.com/wp-content/themes/100lettersforpeace/js/lib/jquery.ga.js',
    	'//sitename.com/wp-content/themes/100lettersforpeace/js/lib/jquery.form.js',
    	'//sitename.com/wp-content/themes/100lettersforpeace/js/lib/contactform7.js',
    	
    	/* Modules */
    	'//sitename.com/wp-content/themes/100lettersforpeace/js/scripts.js'
    ]);

<hr>

##Custom Class documentation

This is some shoddy documentation for the libraries included in the functions directory. It'll get better.

###WPclean (functions/wp-clean.php)

    $plugin_scripts_and_styles_to_remove = array(
        'jquery',
        'contact-form-7'
    );
    WPclean::init($plugin_scripts_and_styles_to_remove);

The Wordpress Clean class will take out all sorts of needless crap from the theme. Also includes a hook to remove scripts and styles from the wp-head so you can include them yourself in a civilized fashion (not 20 js/css requests). I've included Modernizr. It's require method works nicely and this is set up by default to use it. Again if you don't want to use it. Just delete it from the head and include scripts however you want to.

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


