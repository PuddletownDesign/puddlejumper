<?php
/**
 * Page Template
 */
?>
<?php Inc::templates( array( 'includes/html-header', 'includes/header' ) ); ?>

<article class="page">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<h1><?php the_title(); ?></h1>
	<?php edit_post_link(__("Edit"), ''); ?>
	<?php the_content(); ?>
	
	
<?php endwhile; ?>

</article>

<?php Inc::templates( array( 'includes/footer','includes/html-footer' ) ); ?>