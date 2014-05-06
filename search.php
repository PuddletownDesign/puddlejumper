<?php
/**
 * Search results page
 */
?>
<?php Inc::templates( array( 'includes/html-header', 'includes/header' ), 'search' ); ?>
<section>
<?php if ( have_posts() ): ?>
<h1>Search Results for &ldquo;<?php echo esc_attr(get_search_query()); ?>&rdquo;</h1>	
<ol>
<?php while ( have_posts() ) : the_post(); ?>
	<li>
		<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time> 
		<?php //comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
		<p><?php echo get_the_excerpt(); ?></p>
	</li>
<?php endwhile; ?>
</ol>
<?php else: ?>
<h2>No results found for '<?php echo get_search_query(); ?>'</h2>
<?php endif; ?>
</section>
<?php Inc::templates( array( 'includes/footer','includes/html-footer' ) ); ?>