<?php
/** 
 * Custom Post types
 */
include 'lib/custom_post_type_generator.php';


/**
 * Rename Default Posts Title
 */
//PostType::renameDefaultPosts("News");


/*
 * Recipe Post Type
// */
//$recipe = new PostType('recipe', array( 
//     'supports' => array( 
//         'title', 'editor', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions' 
//     )        
//));
//$recipe->add_meta_box('Recipe', array(
//	'Image' => 'file',
//	'Prep Time' => 'text',
//	'Cook Time' => 'text',
//	'Yield' => 'text',
//	'Ingredients' => 'textarea',
//	'Instructions' => 'textarea',
//	'Rating' => 'text'
//));
//$recipe->add_meta_box('Video', array(
//	'Video URL' => 'text',
//	'Thumbnail URL' => 'text',
//	'Description' => 'textarea',
//	'Duration' => 'text',
//	'Width' => 'text',
//	'Height' => 'text'
//));



//$recipe->admin_columns(array(
//	
//));
?>