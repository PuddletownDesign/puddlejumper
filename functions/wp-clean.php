<?php

/** 
 * Deregister plugin javascript and css to handle them internally
 */

class WPclean
{
    private static $plugins;


	/** 
	 * Start the cleaning process
	 */
	public static function init($plugins = array()) 
	{ 
	    //clean the wordpress head
	    self::head();
	    //clean out the wordpress navs
	    self::nav();
		
		//clean up image output
		add_filter( 'post_thumbnail_html', 'WPclean::images', 10 );
		
		//Add Rel To Post Links to be able to ta
		add_filter('next_posts_link_attributes', 'WPclean::next_posts_link_attributes');
		add_filter('previous_posts_link_attributes', 'WPclean::prev_posts_link_attributes');
	    
	    //deregister plugin crap
	    self::$plugins = $plugins;
	    add_action( 'wp_print_styles', 'WPclean::deregister_plugins', 100 );
	    
	}
	
	/**
	 * Someway of targeting the next/prev links. (Semantic too!)
	 */
	private static function next_posts_link_attributes()
	{
		return 'rel="next"';
	}
	private static function prev_posts_link_attributes()
	{
		return 'rel="prev"';
	}
	
	
    /** 
     Clean Up wp_head()

     This takes all unneeded garbage out of the wp_head call and leaves us with control
     over what to include
     */

    private static function head()
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
    private static function nav() 
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