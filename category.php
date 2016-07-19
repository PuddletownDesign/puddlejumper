<?php
/** 
 * Category Template
 */
?>
<?php Inc::templates( array( 'includes/html-header', 'includes/header' ), 'category' ); ?>

<?php if ( have_posts() ): ?>

<section id="category">
	<h1><?php echo single_cat_title( '', false ); ?></h1>
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
	<h1>No posts to display in <?php echo single_cat_title( '', false ); ?></h1>
</section>

<?php endif; ?>

<?php Inc::templates( array( 'includes/footer','includes/html-footer' ) ); ?>