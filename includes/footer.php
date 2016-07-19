	
<footer>
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) : ?>
        <?php #dynamic_sidebar('footer-contact') ?>
    <?php endif; ?>
	&copy; <?php echo date("Y"); ?> <a href="<?php echo site_url(); ?>"><?php bloginfo( 'name' ); ?></a>
</footer>
