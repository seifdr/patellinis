<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package patelinis_base
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<!-- <div id="backToTop">
			<i class="fa fa-arrow-up fa-3x" aria-hidden="true"></i>
		</div> -->
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2">
			<?php
			//if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) { ?>
					<header>
						<div class="row">
							<div class="col-xs-12">
								<?php custom_breadcrumbs(); ?>
								<br />
								<p>For a pdf copy of our menu, please <a href="#">click here</a>.</p>
								<br />
								<p><strong>Browse our menu by category</strong></p>
							</div>
						</div>
						<div class="row browseMenu">
									<ul class="col-xs-12 col-sm-6 ">
									<?php 

										$categories = get_categories( array(
										  	'hide_empty' => TRUE,
										  	'exclude'	=> 1,
										    'orderby' => 'meta_value',
										    'meta_key' => 'categoryOrder',
										    'order'   => 'ASC'
										) );

										$categoryCnt = ( count( $categories ) )/2;
										$catCount = 0;

										foreach ( $categories as $category ) {
											$catCount++;
											echo '<li><a href="#'. $category->name .'">'.  $category->name . '</a></li>';

											if( $catCount == $categoryCnt ){
												echo '</ul><ul class="col-xs-12 col-sm-6">';
											}
										}
									?>
									</ul>
						</div>
					</header>

				<?php
				} // end if is_home() and ! is_front_page	

			// look( $categories );

			foreach ( $categories as $category ) {

				?>

					<div class="row">
						<div class="col-xs-12">
						<?php 

							echo "<h2 id='". $category->name ."' >". $category->name ."</h2>";

							echo "<p>". $category->description . "</p>";
						?>
						</div>
					</div>
				
				<?php 

				// $args = array(
				// 	'posts_per_page'   => -1,
				// 	'category'         => $cat->term_id,
				// 	'orderby'          => 'meta_value',
				// 	'order'            => 'ASC',
				// 	'meta_key'         => 'menuItemOrder',
				// 	// 'meta_value'       => '',
				// 	'post_type'        => 'post',
				// 	'post_status'      => 'publish',
				// 	'suppress_filters' => true 
				// );

				// $menuItemsForCat = get_posts( $args ); 

				// $query = new WP_Query( $args2 );


				if ( have_posts() ) {

					$post_counter = 0;
					$fhp_counter  = 0;
					$s_counter	  = 0;
					$bev_counter  = 0;

					while ( have_posts() ) {

						the_post();
						$post_counter++;

						$thisCategory = get_the_category();

						if( $thisCategory[0]->cat_name == $category->name ){
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
							

						} // end if( $thisCategory[0]->cat_name == $category->name ){

					} // end while have_posts()

						$after_cat_title = get_field( 'after_cat_title', 'category_'.$category->cat_ID );
						$after_cat_content = get_field( 'after_cat_content', 'category_'.$category->cat_ID );

						if( !empty( $after_cat_title ) || !empty( $after_cat_content ) ){

							echo "<div class='row' ><div class='col-xs-12'>";

								if( !empty( $after_cat_title ) ){
									echo '<h4>'. $after_cat_title . '</h4>';
								}

								if( !empty( $after_cat_content ) ){
									echo '<p>'. $after_cat_content . '</p>';
								}

							echo "<br /></div></div>";

						}
				} // end if have posts

				// rewind
				//rewind_posts();

			} // end foreach categories

		 ?>

					
				</div> <!-- closing divs for the main row and col to pad larger screens -->
			</div>


		</main><!-- #main -->
	</div><!-- #primary -->
<script type="text/javascript">
	// jQuery(document).ready(function($) {
// 		 
		// console.log('hey');
// 
		// $(document).scroll( function () {
		    // var y = $(this).scrollTop();
		    // if (y > 800) {
		    	// console.log('hello');
		        // $('div#backToTop').fadeIn();
		    // } else {
		    	// console.log('goodbye');
		        // $('div#backToTop').fadeOut();
		    // }
// 
		// });
	// });
</script>


<?php
//get_sidebar();
get_footer();
