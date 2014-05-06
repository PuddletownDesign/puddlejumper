<?php
/** ---------------------------------------------
Wordpress Custom Post Type Generator
 
Author: Brent Schneider
Author URL: Puddletown Design
Github: http://github.com/puddletownDesign
License: http://opensource.org/licenses/MIT

Requires: PHP 5.2 & Wordpress 3.5+ 
------------------------------------------------
Heavily insipred by Jeffery Ways Post Type Creator

see the orginal here:
http://jeffrey-way.com

This one just doesn't require PHP 5.3 and doesn't use session variables to work

His interface was perfect, still the same, just changed some of the method names...
----------------------------------------------*/


$movies = new PostType("movie");
$movies->metaBoxs('Movie Info', array(
	'name' => 'text',
	'rating' => 'text',
	'review' => 'textarea',
	'Profile Image' => 'file'
));

$books = new PostType("book");
$sk = new PostType("serial killer");

//$product->taxonomy('Actor');
//$product->taxonomy('Director');
//$product->meta_box('Movie Info', array(
//	'name' => 'text',
//	'rating' => 'text',
//	'review' => 'textarea',
//'Profile Image' => 'file'

class PostType
{
	public $post_type_name;
	public $post_type_args;

	
	
	/*-------------------------------------------------------
		Interface
	-------------------------------------------------------*/
	
	/*
	 * Contructor
	 */
	public function __construct($name, Array $post_type_args = array()) 
	{
		$this->post_type_name = strtolower($name);
        $this->post_type_args = $post_type_args;

        $this->init(array(&$this, "register_post_type"));
        $this->savePost();
	}
	
	/*
	 * Taxonomy
	 */
	public function taxonomy($title, $plural = '', Array $options = array())
	{
	    $taxonomy = array(
	    	"title" => $title,
			"plural" => $plural,
			"options" => $options
	    );
		$this->taxonomies[] = $taxonomy;
	}
	
	/*
	 * MetaBox
	 */
	public function metaBoxs($title, Array $form_fields = array())
	{
	    $n = $this->post_type_name;
	    
		//add file support onto the form if we need it
		add_action('post_edit_form_tag', function(){
			echo ' enctype="multipart/form-data"';
        });

		foreach($form_fields as $form_field) {
			add_action('init', $this->add_meta_box_callback);
		}
	}
	
	private function add_meta_box_callback()
	{
		add_meta_box("video", "Video", $this->metaDefine, "movies", "side");
	}
	
	
	public function metaDefine() 
	{ 
	    global $post;
	    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
	        return $post_id;
	    }
	    $custom = get_post_custom($post->ID);    
	    $link = $custom["video"][0];    
	    ?>    
	    <input name="video" value="<?php echo $link; ?>" />
	    <?php 
	}
	
	/*
	 * Admin Columns
	 */
	public function adminColumns(Array $columns = array())
	{
	    
	}
	
	/*-------------------------------------------------------
		Internal Functions that wordpress needs access to
	-------------------------------------------------------*/
	
	
	/** 
	 *  Register Post Type
	 */
    public function register_post_type()
    {
		$s = $this->post_type_name;
        $n = ucwords($s);
		$p = $n.'s';
		//default args
		
		$args = array( 
	        'labels' => array( 
    	        'name' => $p,
    	        'singular_name' => $n,
    	        'all_items' => 'List '.$p,
    	        'add_new' => 'Add New',
    	        'add_new_item' => 'Add New '.$n,
    	        'edit_item' => 'Edit '.$n,
    	        'new_item' => 'New '.$n,
    	        'view_item' => 'View '.$n,
    	        'search_items' => 'Search '.$p,
    	        'not_found' => 'No '.$p.' found',
    	        'not_found_in_trash' => 'No '.$p.' found in Trash',
    	        'parent_item_colon' => 'Parent '.$n.':',
    	        'menu_name' => $p
    	    ),
    	    'capability_type' => 'post',
	        'rewrite' => array( 
	            'slug' => $s, 
	            'with_front' => false 
	        ),
	        'supports' => array( 
	            'title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions' 
	        ),
	        'taxonomies' => array( 
	            'category', 
	            'post_tag', 
	            'page-category' 
	        ),
	        'hierarchical' => true,
	        'public' => true,
	        'show_ui' => true,
	        'show_in_menu' => true,
	        'menu_position' => 5,
	        'show_in_nav_menus' => true,
	        'publicly_queryable' => true,
	        'exclude_from_search' => false,
	        'has_archive' => true,
	        'query_var' => true,
	        'can_export' => true	        
			);

        // Take user provided options, and override the defaults.
        $args = array_merge($args, $this->post_type_args);

        register_post_type($this->post_type_name, $args);
    }
	
	
	/*-------------------------------------------------------
		Internal Private Methods
	-------------------------------------------------------*/
	
	
	private function init($cb)
    {
        add_action("init", $cb);
    }
	
	private function savePost()
	{
	    
	}

}


?>