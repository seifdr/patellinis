<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package patelinis_base
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-sm-offset-2"> 
					<?php custom_breadcrumbs(); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-sm-offset-2">
					<?php
					if ( have_posts() ) { ?>
							<p> To see our complete menu, please visit our <strong><a a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" >Menu page</a></strong>.<br />
							<h2><?php echo single_term_title(); ?></h2>
							<?php
								the_archive_description( '<p>', '</p>' );
							?>
						<?php

						// recreating the array we have from index 
						$catID 			= get_cat_ID( single_term_title( '', FALSE ) ); 
						$obj 			= get_category( $catID );
						$thisCategory  	= array( $obj );
						$category 		= $obj;

						$post_counter = 0;
						$fhp_counter  = 0;
						$s_counter	  = 0;
						$bev_counter  = 0;

						/* Start the Loop */
						while ( have_posts() ) { 
							the_post();
							$post_counter++;

							if( strtolower( $thisCategory[0]->cat_name ) == "fresh homemade pizza"){
								$fhp_counter++;
								include( 'template-parts/menu-items/fresh-homemade-pizza.php' );
							} elseif( strtolower( $thisCategory[0]->cat_name ) == "fresh salads" ){
								$s_counter++; 
								include( 'template-parts/menu-items/fresh-salads.php' );	
							} elseif( strtolower( $thisCategory[0]->cat_name ) == "beverages" ){
								$bev_counter++;
								include( 'template-parts/menu-items/beverages.php' );
							} else {
								include( 'template-parts/menu-items/standard.php' );
							}
	
						} // endwhile

						
						$after_cat_title 	= get_field( 'after_cat_title', 'category_'. $catID );
						$after_cat_content 	= get_field( 'after_cat_content', 'category_'. $catID );

						if( !empty( $after_cat_title ) || !empty( $after_cat_content ) ){

								if( !empty( $after_cat_title ) ){
									echo '<h4>'. $after_cat_title . '</h4>';
								}

								if( !empty( $after_cat_content ) ){
									echo '<p>'. $after_cat_content . '</p>';
								}
						}
					} else {
						get_template_part( 'template-parts/content', 'none' );

					} ?>
					<br />
				</div> <!-- end colalign -->
			</div> <!-- end row -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
