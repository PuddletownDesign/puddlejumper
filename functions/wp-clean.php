<?php

/** 
 * Deregister plugin javascript and css to handle them internally
 */

class WPclean
{
    protected static $plugins;


	/** 
	 * Start the cleaning process
	 */
	public static function init($plugins = array()) 
	{ 
	    //clean the wordpress head
	    self::head();
	    //clean out the wordpress navs
	    self::nav();
		
		//get rid of emoji garbage
		add_action( 'init', 'WPclean::disable_wp_emojicons' );
		

	    // filter to remove TinyMCE emojis
	    add_filter( 'tiny_mce_plugins', 'WPclean::disable_emojicons_tinymce' );
		
		//clean up image output
		add_filter( 'post_thumbnail_html', 'WPclean::images', 10 );
		
		//Add Rel To Post Links to be able to ta
		add_filter('next_posts_link_attributes', 'WPclean::next_posts_link_attributes');
		add_filter('previous_posts_link_attributes', 'WPclean::prev_posts_link_attributes');
		
	    //deregister plugin crap
	    self::$plugins = $plugins;
	    add_action( 'wp_print_styles', 'WPclean::deregister_plugins', 100 );
	    
		//remove new recent comments css - are these devs on drugs? wtf is wrong with them?
		add_action( 'widgets_init', 'WPclean::my_remove_recent_comments_style' );
		
		//holy shit more scripts
		add_action( 'init', 'WPclean::disable_oembed_embed', PHP_INT_MAX - 1 );
	}
	
	/**
	 * Someway of targeting the next/prev links. (Semantic too!)
	 */
	public static function disable_emojicons_tinymce( $plugins ) {
	  if ( is_array( $plugins ) ) {
	    return array_diff( $plugins, array( 'wpemoji' ) );
	  } else {
	    return array();
	  }
	}
	/**
	 * Disable OMBED Enbed
	 */
	public static function disable_oembed_embed() {

	    // Remove the REST API endpoint.
	    remove_action('rest_api_init', 'wp_oembed_register_route');

	    // Turn off oEmbed auto discovery.
	    // Don't filter oEmbed results.
	    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

	    // Remove oEmbed discovery links.
	    remove_action('wp_head', 'wp_oembed_add_discovery_links');

	    // Remove oEmbed-specific JavaScript from the front-end and back-end.
	    remove_action('wp_head', 'wp_oembed_add_host_js');
	}
	/**
	 * Get Rid of emoji crap all over pages
	 */
	public static function disable_wp_emojicons() {

	  // all actions related to emojis
	  remove_action( 'admin_print_styles', 'print_emoji_styles' );
	  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	  remove_action( 'wp_print_styles', 'print_emoji_styles' );
	  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	}
	/**
	 * Get rid of recent comments
	 */
	public static function my_remove_recent_comments_style() {
		global $wp_widget_factory;
		remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'  ) );
	}
	
	protected static function next_posts_link_attributes()
	{
		return 'rel="next"';
	}
	protected static function prev_posts_link_attributes()
	{
		return 'rel="prev"';
	}

    /** 
     Clean Up wp_head()

     This takes all unneeded garbage out of the wp_head call and leaves us with control
     over what to include
     */

    protected static function head()
    {
        //comment out any that you want to keep
        remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
        remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
        remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
        remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
        remove_action( 'wp_head', 'index_rel_link' ); // index link
        remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
        remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
        remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
        remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
        remove_action( 'wp_head', 'rel_canonical'); //Displays the canonical meta link
        remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10,0); //Displays the next/ prev post links in head
        remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); // removes the shortlink
    }
    
    /** 
     * Clean unneeded classes and attributes out of the nav
     */
    protected static function nav() 
    { 
        //comment out any you would like to keep
        add_filter('nav_menu_css_class', 'WPclean::strip_attribute', 100, 1); //strip class names from menu
        add_filter('nav_menu_item_id', 'WPclean::strip_attribute', 100, 1); //strip id names from menu list items
        add_filter('page_css_class', 'WPclean::strip_attribute', 100, 1); //strip attributes from menu
    }
    
    function images( $html ) {
	   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
	   return $html;
	}

    
    /** 
     * Strip Attributes from array
     */
    public static function strip_attribute($var) {
    	return is_array($var) ? array() : '';
    }
    
    /** 
     * Deregister Style and scripts from plugs
     */
    public static function deregister_plugins() {
  

        foreach(self::$plugins as $plugin){
            wp_deregister_style( $plugin);
            wp_dequeue_script( $plugin);
        }
    }

}
?>