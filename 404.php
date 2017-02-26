<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package patelinis_base
 */

get_header(); ?>

<style>

	body.error404 div#primary {
	 	min-height: 300px;
	}

	body.error404 div#primary a {
		font-weight: bold;
	}

</style>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="row">
				<div class="col-xs-12">
					<section class="error-404 not-found">
						<header class="page-header">
							<h1 class="page-title"><?php esc_html_e( 'Page Not found', 'patelinis_base' ); ?></h1>
						</header><!-- .page-header -->

						<div class="page-content">
							<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'patelinis_base' ); ?></p>
							<br />
							<br />
							<p>Please check out our <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" >menu</a> or visit our <a href="<?php echo get_site_url(); ?>" >homepage</a>.</p>


						</div><!-- .page-content -->
					</section><!-- .error-404 -->
				</div> <!-- close div -->
			</div> <!-- close row -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
