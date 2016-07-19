
<header>
<?php /*
this will display the site name logo as an h1 for the homepage only. 

For all other pages it will display a div. Have the title of each page be the h1! 
There's obviously no need for an explict 'Home' Title on the home page, that's what the logo is for.
Also, no reason to display a link to the homepage on the homepage
*/ ?>
<?php if (is_front_page()): ?>
	<h1><img src="<?php bloginfo('template_directory');?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' ); ?>"></h1>
<?php else: ?>
	<a href="<?php echo site_url(); ?>"><img src="<?php bloginfo('template_directory');?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' ); ?>"></a>
<?php endif; ?>

	<nav>
<?php Inc::nav('primary'); ?>
	</nav>
</header>