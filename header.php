<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package patelinis_base
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>

</head>
<div class="container">
	<body <?php body_class(); ?> >
			<div id="page" class="site">

				<div class="row visible-xs">
					<nav class="navbar navbar-default col-xs-12">
					  <div class="container-fluid">
					    <!-- Brand and toggle get grouped for better mobile display -->
					    <div class="navbar-header">
					      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					        <span class="sr-only">Toggle navigation</span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					      </button>
					       <a class="navbar-brand visible-xs" href="<?php echo get_site_url(); ?>" id="xsLogo" alt="Visit our homepage!"><?php $description = get_bloginfo( 'description', 'display' ); ?>
								<img id="PatelinnisLogoSm" class="img-responsive" style="height: 50px; margin-top: 0; padding-top: 0;" src='<?php echo esc_url( get_theme_mod( 'patelinni_logo', get_template_directory_uri() . '/img/Patellinis-White-Logo.png' ) ); ?>' alt="<?php echo $description; ?>" />
							</a>
					    </div>

					    <!-- Collect the nav links, forms, and other content for toggling -->
					    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						      <?php

			                        $args = array(
			                            'menu' => 'Upper Nav',
			                            'depth' => 3,
			                            'container' => false,
			                            'menu_class' => 'nav nav-justified',
			                            //'menu_class' => 'nav navbar-nav',
			                            'menu_id' =>  'upper-nav',
			                            'theme_location' => 'Upper Nav',
			                            'walker' => new wp_bootstrap_navwalker
			                        );
			                        
			                        wp_nav_menu( $args);
	                    	?>
					    </div><!-- /.navbar-collapse -->
					  </div><!-- /.container-fluid -->
					</nav>
				</div>

				<div class="row text-center upperContactInfo hidden-xs">
					<div class="col-xs-4 col-xs-offset-1">
						<p>1429 Main Street Sarasota, Florida 34236</p>
					</div>
					<div class="col-xs-2">&nbsp;</div>
					<div class="col-xs-4">
						<p>Order Now - Call 941-957-6433</p>
					</div>
				</div>
				<div class="row hidden-xs">
					<div class="col-xs-12 text-center">
						<a href="<?php echo get_site_url(); ?>">
							<header id="masthead" class="site-header" role="banner">
								<div class="site-branding">
									<div class="LogoOutter">
										<div class="LogoInner">
											<?php $description = get_bloginfo( 'description', 'display' ); ?>
											<img id="PatelinnisLogo" class="img-responsive" src='<?php echo esc_url( get_theme_mod( 'patelinni_logo', get_template_directory_uri() . '/img/Patelinnis-Header-Logo.png' ) ); ?>' alt="<?php echo $description; ?>" />
										</div>
									</div>
								</div><!-- .site-branding -->
							</header><!-- #masthead -->
						</a>
					</div> <!-- close col-xs-12 -->
				</div> <!-- close row -->
				<div class="row hidden-xs">
					<nav class="navbar navbar-default col-xs-12">
					  <div class="container-fluid">
					    <!-- Brand and toggle get grouped for better mobile display -->
					    <div class="navbar-header">
					      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					        <span class="sr-only">Toggle navigation</span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					      </button>
					    </div>

					    <!-- Collect the nav links, forms, and other content for toggling -->
					    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						      <?php

			                        $args = array(
			                            'menu' => 'Upper Nav',
			                            'depth' => 3,
			                            'container' => false,
			                            'menu_class' => 'nav nav-justified',
			                            //'menu_class' => 'nav navbar-nav',
			                            'menu_id' =>  'upper-nav',
			                            'theme_location' => 'Upper Nav',
			                            'walker' => new wp_bootstrap_navwalker
			                        );
			                        
			                        wp_nav_menu( $args);
	                    	?>
					    </div><!-- /.navbar-collapse -->
					  </div><!-- /.container-fluid -->
					</nav>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div id="content" class="site-content">
