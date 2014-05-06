<?php
/**
 * The template for displaying Author Archive pages
 */
?>
<?php Inc::templates( array( 'includes/html-header', 'includes/header' ), 'author' ); ?>

<?php if ( have_posts() ): the_post(); ?>

<h1>Author Archives: <?php echo get_the_author() ; ?></h1>

<?php if ( get_the_author_meta( 'description' ) ) : ?>
<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
<h2>About <?php echo get_the_author() ; ?></h2>
<?php the_author_meta( 'description' ); ?>
<?php endif; ?>

<ol>
<?php rewind_posts(); while ( have_posts() ) : the_post(); ?>
	
	<li class="xfolkentry">
		<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time> 
		<?php //comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
		<p><?php the_excerpt(); ?></p>
	</li>
<?php endwhile; ?>
</ol>

<?php else: ?>
<h1>No posts to display for <?php echo get_the_author() ; ?></h1>	
<?php endif; ?>

<?php Inc::templates( array( 'includes/footer','includes/html-footer' ) ); ?>