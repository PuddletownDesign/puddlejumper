<?php
/**
 * The Template for displaying all single posts
 */
?>
<?php Inc::templates( array( 'includes/html-header', 'includes/header' ), 'post' ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<section id="post">
	<header>
	    <h1><?php the_title(); ?></h1> <?php edit_post_link(__("Edit"), ''); ?>	    
	    <em>posted at: <time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_date(); ?> <?php the_time(); ?></time></em>
<?php //comments_popup_link(' / Leave a Comment', ' / 1 Comment', ' / % Comments'); ?>
	</header>
	
	<article>
	   <?php the_content(); ?>
	</article>

	<footer>
		<strong><?php if (has_category()): ?>posted in: <?php the_category(", "); ?><?php endif; ?>
<?php if (the_tags()): ?> | tagged with: <?php the_tags('',', ',''); ?><?php endif; ?></strong>	
<?php if ( get_the_author_meta( 'description' ) ) : ?>
	    <?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
	    <h2>About <?php echo get_the_author() ; ?></h2>
	    <?php the_author_meta( 'description' ); ?>
<?php endif; ?>
<?php if (previous_post_link() OR next_post_link()): ?>
		<div class="paging">
		<?php previous_post_link('%link', '&laquo; Previous Post'); ?>
		<?php next_post_link('%link', 'Next Post &raquo;'); ?>
		</div>
<?php endif; ?>		
	</footer>
<?php //comments_template( '', true ); ?>
</section>
<?php endwhile; ?>

<?php Inc::templates( array( 'includes/footer','includes/html-footer' ) ); ?>