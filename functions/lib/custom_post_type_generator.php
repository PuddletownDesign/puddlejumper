<?php
include "jw_custom_posts.php";

class PostType extends JW_Post_Type
{
	public static $defaultPostsTitle;
	/*
	 * Set the desired Admin Columns
	 */
	function admin_colums(Array $columns = array())
	{
		
	}
	
	/*
	 * Superceeded the register_post_type() Method, set new defaults and naming logic
	 */
	public function register_post_type()
    {
		$s = $this->post_type_name;
		$sp = $s."s";
        $n = ucwords($s);
		$p = $n."s";
		//default args
		
		$defaults = array( 
	        "labels" => array( 
    	        "name" => $p,
    	        "singular_name" => $n,
    	        "all_items" => "List ".$p,
    	        "add_new" => "Add New",
    	        "add_new_item" => "Add New ".$n,
    	        "edit_item" => "Edit ".$n,
    	        "new_item" => "New ".$n,
    	        "view_item" => "View ".$n,
    	        "search_items" => "Search ".$p,
    	        "not_found" => "No ".$p." found",
    	        "not_found_in_trash" => "No ".$p." found in Trash",
    	        "parent_item_colon" => "Parent ".$n.":",
    	        "menu_name" => $p
    	    ),
    	    "capability_type" => "post",
	        "rewrite" => array( 
	            "slug" => $sp, 
	            "with_front" => false 
	        ),
	        "supports" => array( 
	            "title", "editor", "excerpt", "author", "thumbnail", "trackbacks", "custom-fields", "comments", "revisions" 
	        ),
	        "taxonomies" => array( 
	            "category", 
	            "post_tag", 
	            "page-category" 
	        ),
	        "hierarchical" => true,
	        "public" => true,
	        "show_ui" => true,
	        "show_in_menu" => true,
	        "menu_position" => 5,
	        "show_in_nav_menus" => true,
	        "publicly_queryable" => true,
	        "exclude_from_search" => false,
	        "has_archive" => true,
	        "query_var" => true,
	        "can_export" => true	        
		);

        // Take user provided options, and override the defaults.
        $args = array_merge($defaults, $this->post_type_args);

        register_post_type($this->post_type_name, $args);
    }
	
	public static function renameDefaultPosts($name)
	{
		self::$defaultPostsTitle = $name;
		if (PostType::$defaultPostsTitle != '') {
			add_action( "admin_menu", "PostType::revcon_change_post_label" );
			add_action( "init", "PostType::revcon_change_post_object" );
		}
	}
	
	/**
	 * Private Functions
	 */
	public static function revcon_change_post_label() {
	    global $menu;
	    global $submenu;
	    $menu[5][0] = PostType::$defaultPostsTitle;
	    $submenu["edit.php"][5][0] = PostType::$defaultPostsTitle;
	    $submenu["edit.php"][10][0] = "Add ".PostType::$defaultPostsTitle;
	    $submenu["edit.php"][16][0] = PostType::$defaultPostsTitle." Tags";
	    echo "";
	}
	public static function revcon_change_post_object() {
	    global $wp_post_types;
	    $labels = &$wp_post_types["post"]->labels;
	    $labels->name = PostType::$defaultPostsTitle;
	    $labels->singular_name = PostType::$defaultPostsTitle;
	    $labels->add_new = "Add ".PostType::$defaultPostsTitle;
	    $labels->add_new_item = "Add ".PostType::$defaultPostsTitle;
	    $labels->edit_item = "Edit ".PostType::$defaultPostsTitle;
	    $labels->new_item = PostType::$defaultPostsTitle;
	    $labels->view_item = "View ".PostType::$defaultPostsTitle;
	    $labels->search_items = "Search ".PostType::$defaultPostsTitle;
	    $labels->not_found = "No ".PostType::$defaultPostsTitle." found";
	    $labels->not_found_in_trash = "No ".PostType::$defaultPostsTitle." found in Trash";
	}
}

?>