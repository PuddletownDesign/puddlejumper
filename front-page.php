<?php
/*
Template Name: Home
*/
?>
<?php Inc::templates( array( 'includes/html-header', 'includes/header' ) ); ?>

<article class="home">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<?php edit_post_link(__("Edit"), ''); ?>
	<?php the_content(); ?>

<?php endwhile; ?>

</article>

<?php Inc::templates('includes/footer, includes/html-footer'); ?>

