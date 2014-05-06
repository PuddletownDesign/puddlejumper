<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/styles.css">
	<script src="<?php bloginfo('template_directory');?>/js/lib/modernizr.js"></script>
	<?php wp_head(); ?>
	
</head>

<body<?php if (isset($template)): ?> class="<?php echo $template; ?>"<?php endif; ?>>