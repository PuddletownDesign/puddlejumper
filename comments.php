<?php
/** 
 * Comments Template
 */
?>
<section class="comments">
	<?php if ( post_password_required() ) : ?>
	<p>This post is password protected. Enter the password to view any comments</p>
</section>
<?php return; endif;?>

<?php if ( have_comments() ) : ?>

	<h2 itemprop="interactionCount"><?php comments_number(); ?></h2>

	<ol>
	    <?php //edit the comments template in the functions/inc.php file - comments method ?>
		<?php wp_list_comments( array( 'callback' => 'Inc::comments') ); ?>	
	</ol>

<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	
	<p>Comments are closed</p>
	
<?php endif; ?>

	<?php comment_form(); ?>

</section><!-- #comments -->
