<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage To_The_Nines
 * @since To The Nines 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link href="https://fonts.googleapis.com/css?family=Shrikhand|Lobster" rel="stylesheet">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site container-fluid">
	<div class="site-inner">
		<header id="masthead" class="site-header" role="banner">

			<div class="site-header-main row">

				<div id="site-header-menu col-lg-12" class="site-header-menu">
					<?php if ( has_nav_menu( 'primary' ) ) : ?>
						<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'tothenines' ); ?>">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'primary',
									'menu_class'     => 'primary-menu',
								 ) );
							?>
						</nav><!-- .main-navigation -->
					<?php endif; ?>
				</div><!-- .site-header-menu .col-lg-12 -->
			</div><!-- .site-header-main .row -->

			<?php if ( get_header_image() ) : ?>
				<div class="header-image-container row">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<div class="header-image col-lg-12" style="background:url('<?php header_image(); ?>');background-size: cover;background-repeat: no-repeat;background-position: center center;">

							<div class="site-branding col-lg-12">

								<?php if ( is_front_page() && is_home() ) : ?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php else : ?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
								<?php endif; ?>

							</div><!-- .site-branding .col-lg-12 -->

						</div><!-- .header-image -->
					</a>
				</div><!-- .header-image .row -->
			<?php endif; // End header image check. ?>
		</header><!-- .site-header -->

		<div id="content" class="site-content">
