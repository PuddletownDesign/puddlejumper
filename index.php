<?php
/*
Template Name: Blog
*/
?>
<?php Inc::templates( array( 'includes/html-header', 'includes/header' ), 'blog' ); ?>
<article>
<?php if ( have_posts() ): ?>
	
	<h1>Latest Posts</h1>	
	<ol>
<?php while ( have_posts() ) : the_post(); ?>
		<li>
			<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></h2>			
			<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time> <?php //comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
			
			<p><?php echo get_the_excerpt(); ?></p>
		</li>
<?php endwhile; ?>
	</ol>
	
<?php if (previous_posts_link() OR next_posts_link()): ?>
	<nav class="paging">
		<?php previous_posts_link( '&laquo; Newer Posts' ); ?>
		<?php next_posts_link( 'Older Posts &raquo; ' ); ?>
	</nav>
<?php endif; ?>

	
<?php else: ?>
	<h1>No posts to display</h1>
<?php endif; ?>
</article>
	
<?php Inc::templates( array( 'includes/footer', 'includes/html-footer' ) ); ?>
