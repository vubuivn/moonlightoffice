<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?> itemscope itemtype="http://schema.org/Blog">
<head>	
	<!-- wp_head __-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="loadbar"></div>
	
<div id="wrapperbox">
	
<!-- ====================
	       HEADER 
	==================== -->
	<header id="header">

		<!-- Logo __-->
		<h1 id="logo">
			<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url('/') ); ?>" rel="home">
					<?php echo esc_attr( get_bloginfo( 'name' )); ?>
				</a>
			<?php endif; ?>
			<span id="tagline"><?php echo esc_attr( get_bloginfo( 'description' )); ?></span>
		</h1>
	
		<!-- Main menu __-->
		<input type="checkbox" id="menutoggle" />
		<label for="menutoggle" id="menutogglebutton">☰</label>
		<nav id="menu">
			<?php get_template_part( 'menu', 'primary' ); // menu-primary.php ?>
		</nav>
		
		<!-- Search __-->
		<div id="extras">
			<?php get_search_form(); ?>
		</div>
	</header>
	<!-- END #header -->

<!-- ====================
	       CONTENT 
	==================== -->
	<main id="content">
		<div class="wrapper">