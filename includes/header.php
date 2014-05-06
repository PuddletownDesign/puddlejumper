
<header>
<?php /*
this will display the site name logo as an h1 for the homepage only. 

For all other pages it will display a div. Have the title of each page be the h1! 
There's obviously no need for an explict 'Home' Title on the home page, that's what the logo is for.
Also, no reason to display a link to the homepage on the homepage
*/ ?>
<?php if (is_front_page()): ?>
	<h1>
		<img src="<?php bloginfo('template_directory');?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' ); ?>">
	</h1>

<?php else: ?>
	<div>
		<a href="<?php echo site_url(); ?>">
			<img src="<?php bloginfo('template_directory');?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' ); ?>">
		</a>
	</div>

<?php endif; ?>

    <?php /* Here we have the search form */ ?>
	<form action="<?php echo site_url(); ?>" method="get" id="search">
		<input type="search" name="s" placeholder="search" role="search">		
		<input type="submit" id="submit" value="Search">
	</form>
	
    <?php /* Primary Navigation - Check the functions/formatting.php to control classes and attributes */ ?>
	
	<nav class="primary" role="navigation">
    	<?php Inc::nav('primary'); ?>
    	
    </nav>
</header>


