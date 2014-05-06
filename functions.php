<?php
/** 
 * Site Config
 */

/**
 * Register the Primary Nav
 */
register_nav_menus(array('primary' => 'Primary Navigation'));

/**
 * Register a sidebar, just delete if you don't want it
 */
register_sidebar(array(
	'name'          => 'Contact Details',
	'id'            => 'footer-contact',
	'description'   => '',
    'class'         => '',
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '<h2>',
	'after_title'   => '</h2>' 
	)
);

/** 
  Includes Class
  this is a small library to include files and elements into wordpress
  you can add more elements here like a dynamic side bar
  methods included are: templates(), nav(), child_pages(), comments(), comments_form()
 */
include 'functions/inc.php';


/** 
 *   Load the Clean up class
    
    go inside functions.wp-clean and edit to your preference
    
    #using  $plugin_scripts_and_styles_to_remove
    
    You can load plugin ids into the init function and it will remove included styles and scripts
    the best thing to do is to :
    
    1. first load the plug, find all the css and scripts
    2. copy the scripts and styles to the js/scripts.js and css/sass/plugins.scss files
    3. Find the plugin id
    4. add it to the plugin_scripts_and_styles_to_remove array
*/
require_once "functions/wp-clean.php";

$plugin_scripts_and_styles_to_remove = array(
    'jquery',
    'contact-form-7'
);
WPclean::init($plugin_scripts_and_styles_to_remove);


/** 
 Custom post types
 
 Add your custom post types and keep them separate in a separate file
 */
require_once( 'functions/custom-post-types.php' );

