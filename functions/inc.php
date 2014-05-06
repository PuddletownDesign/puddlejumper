<?php
//------------------------------------------------------
//               Formatting
//------------------------------------------------------

/** 
 * get custom navs by name and format the list output
 */
class Inc
{
    
    /** 
     * Include a Template part, takes multiple templtes at a time
     */
    public static function templates($parts, $template=null) {
        
        //accept an array input
        if (is_array($parts)) {
            foreach( $parts as $part ) {
    			include(locate_template($part.".php"));
    		};
        }
        
        //accept a comma delimited input ('includes/html-header.php, includes/header.php')
        elseif(strstr($parts, ", ")) {
            $parts = explode(', ', $parts);
            self::templates($parts);
        }
        
        //accept a single string input ('header.php')
		else {
		  include(locate_template($parts.".php"));
		}
	}
	//alias for templates
	public static function template($a) { self::templates($a); }
    
	
	/** 
	 * Get the navigation formatted how you want it (as best as possible...)
	 */
    public static function nav($name)
    {
    	$params = array(
    		//'theme_location'  => '',
    		'menu'            => $name,
    		'container'       => false,
    		'container_class' => $name,
    		'container_id'    => '',
    		'menu_class'      => $name,
    		//'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
    		'items_wrap'      => '<ul class="'.$name.'">'."\n\t\t".'%3$s'."\t".'</ul>'."\n",
    		'menu_id'         => '',
    		'echo'            => true,
    		//'fallback_cb'     => 'wp_page_menu',
    		'before'          => "",
    		'after'           => "",
    		'link_before'     => "",
    		'link_after'      => "",
    		'depth'           => 0,
    		'walker'          => ''
    	);
    	wp_nav_menu($params);
    }

    /** 
     * Get a list of Child Pages of the current page
     */
    public static function child_pages($id)
    {
    	$args = array(
    		'sort_order' => 'ASC',
    		'sort_column' => 'post_title',
    		'hierarchical' => 1,
    		'exclude' => '',
    		'include' => '',
    		'meta_key' => '',
    		'meta_value' => '',
    		'authors' => '',
    		'child_of' => $id,
    		'parent' => -1,
    		'exclude_tree' => '',
    		'number' => '',
    		'offset' => 0,
    		'post_type' => 'page',
    		'post_status' => 'publish'
    	); 
    	return get_pages($args);
    }


    /** 
     * Custom callback for outputting comments 
     */
    public static function comments( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment; ?>

<?php if ( $comment->comment_approved == '1' ): ?>	
    		<li>
    			<section <?php comment_class(); ?>>
    				<header> 
    				    
    					<h3>
							<span><?php echo get_avatar( $comment ); ?></span>
    						<cite><?php comment_author_link() ?></cite> said on: 
    						<time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php comment_date() ?> at <?php comment_time() ?></time>
    					</h3>
    				</header>

    				<article>
    					<?php comment_text() ?>
    				</article>
    			</section>
<?php endif;
    }


    /** 
     * Format the Comments Form include
     */
    public static function comments_form()
    {

    }
}


?>