<?php
/**
 * The template for displaying Archive pages.
 */
?>
<?php Inc::templates( array( 'includes/html-header', 'includes/header' ) ); ?>

<?php if ( have_posts() ): ?>

<?php if ( is_day() ) : ?>
<h1>Archive: <?php echo  get_the_date( 'D M Y' ); ?></h2>							
<?php elseif ( is_month() ) : ?>
<h1>Archive: <?php echo  get_the_date( 'M Y' ); ?></h2>	
<?php elseif ( is_year() ) : ?>
<h1>Archive: <?php echo  get_the_date( 'Y' ); ?></h2>								
<?php else : ?>
<h1>Archive</h2>	
<?php endif; ?>

<ol>
<?php while ( have_posts() ) : the_post(); ?>
	<li>
		<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time> 
		<?php //comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
		<p class="description"><?php echo get_the_excerpt(); ?></p>
	</li>
<?php endwhile; ?>
</ol>
<?php else: ?>
<h1>No posts to display</h2>	
<?php endif; ?>

<?php Inc::templates( array( 'includes/footer','includes/html-footer' ) ); ?>