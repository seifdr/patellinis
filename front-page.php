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


<style type="text/css">

/* 
	Small devices (tablets, 768px and up) 
	@media (min-width: @screen-sm-min) { ... }

	Medium devices (desktops, 992px and up)
	@media (min-width: @screen-md-min) { ... }

	Large devices (large desktops, 1200px and up) 
	@media (min-width: @screen-lg-min) { ... }
*/

</style>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="row">
				<!-- <div id='hpifContainer' class='img-responsive' ></div> -->
					<?php 

						if( function_exists( 'get_field' ) ){

							$imgC = get_field('image_carousel');

							if( count( $imgC > 0 ) ){
							
							?> 
								<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
								  <!-- Indicators -->
								  <ol class="carousel-indicators">
								  	<?php 
								  		if(  count( $imgC > 0 ) ){
									  		for ($i=0; $i < count( $imgC ) ; $i++) { 
									  			echo '<li data-target="#carousel-example-generic" data-slide-to="'. $i++ .'"';
									  			if ( $i == 0 ){ echo ' class="active" '; };
									  			echo ' ></li>';	
									  		}
								  		}

								  	?>
								  </ol>

								  <!-- Wrapper for slides -->
								  <div class="carousel-inner" role="listbox">
								    <?php 

								    	for ($i=0; $i < count( $imgC ); $i++) { 
								    			echo '<div class="item ';
								    				if( $i == 0 ){ echo ' active '; }
								    			echo '">';
											      echo '<img src="'. $imgC[$i]['image']['url'] .'" alt="'. $imgC[$i]['image']['alt'] .'">';
											      echo '<div class="carousel-caption';

											      if( $imgC[$i]['caption_position'] == "1" ){ echo ' left '; } elseif ( $imgC[$i]['caption_position'] == "2" ){ echo ' right '; } else { echo " center "; }
											      echo '">';
													echo "<h1>". $imgC[$i]['primary_text'] ."</h1>";
													echo "<p>". $imgC[$i]['secondary_text'] . "</p>";
													
													echo "<a href='". $imgC[$i]['page_link'] ."' type='button' class='btn btn-primary btn-lg visible-lg'>". $imgC[$i]['button_text'] ."</a>";

													echo "<a href='". $imgC[$i]['page_link'] ."' type='button' class='btn btn-primary btn-md visible-md'>". $imgC[$i]['button_text'] ."</a>";

													echo "<a href='". $imgC[$i]['page_link'] ."' type='button' class='btn btn-primary btn-sm visible-sm'>". $imgC[$i]['button_text'] ."</a>";

											      echo '</div>';
											    echo '</div>';
										}

								    ?>
								  </div>

								 <?php if(  count( $imgC > 1 ) ){ ?>
									  <!-- Controls -->
									  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
									    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
									    <span class="sr-only">Previous</span>
									  </a>
									  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
									    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
									    <span class="sr-only">Next</span>
									  </a>
								  <?php } ?>
								</div>
							<?php

							} // end if( count( $imgC ) > 0 ) 

						}

					?>
			</div>
			<?php 

				if( function_exists( 'get_field' ) ){
					//mf = middle feature
					$mf1	= get_field('middle_feature_1', $post->ID );
					$mf2	= get_field('middle_feature_2', $post->ID );
					$mf3	= get_field('middle_feature_3', $post->ID );
				}

			?>
			<div class="row">
				<div class="col-xs-12 col-sm-4 callouts">
					<div class="text-center">
						<i class=" 


						<?php if( !empty( $mf1['font_awesome_fa_values'] ) ){ echo $mf1['font_awesome_fa_values']; } else { echo 'fa fa-car'; } ?>

						 fa-4x" aria-hidden="true"></i>
					</div>
					<h3><?php if( !empty( $mf1['title'] ) ){ echo $mf1['title']; } else { echo "Delivery"; } ?></h3>
					<div class="textWrap">
					<p><?php if( !empty( $mf1['text'] ) ){ echo $mf1['text']; } else { echo "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis et odio ornare, cursus nunc nec, vulputate dolor. Proin bibendum et enim vitae commodo. Aenean ultrices urna vel dolor tincidunt, eget tempus nunc sodales."; } ?></p>
					</div>
					<div>
						<a type="button" href="<?php if( !empty( $mf1['page_link'] ) ){ echo $mf1['page_link']; } else { echo '#'; } ?>" class="btn btn-primary btn-lg btn-block"><?php if( !empty( $mf1['Button Text'] ) ){ echo $mf1['Button Text']; } else { echo "Delivery Areas"; } ?></a>
					</div>
				</div>			
				<div class="col-xs-12 col-sm-4 callouts">
					<div class="text-center">
						<i class=" 


						<?php if( !empty( $mf2['font_awesome_fa_values'] ) ){ echo $mf2['font_awesome_fa_values']; } else { echo 'fa fa-cutlery'; } ?>

						 fa-4x" aria-hidden="true"></i>
					</div>
					<h3><?php if( !empty( $mf2['title'] ) ){ echo $mf2['title']; } else { echo "Catering and Parties"; } ?></h3>
					<div class="textWrap">
					<p><?php if( !empty( $mf2['text'] ) ){ echo $mf2['text']; } else { echo "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis et odio ornare, cursus nunc nec, vulputate dolor. Proin bibendum et enim vitae commodo. Aenean ultrices urna vel dolor tincidunt, eget tempus nunc sodales."; } ?></p>
					</div>
					<div>
						<a type="button" href="<?php if( !empty( $mf2['page_link'] ) ){ echo $mf2['page_link']; } else { echo '#'; } ?>" class="btn btn-primary btn-lg btn-block"><?php if( !empty( $mf2['Button Text'] ) ){ echo $mf2['Button Text']; } else { echo "Catering & Parties Options"; } ?></a>
					</div>
				</div>		
				<div class="col-xs-12 col-sm-4 callouts">
					<div class="text-center">
						<i class=" 
						<?php if( !empty( $mf3['font_awesome_fa_values'] ) ){ echo $mf3['font_awesome_fa_values']; } else { echo 'fa fa-cutlery'; } ?>

						 fa-4x" aria-hidden="true"></i>
					</div>
					<h3><?php if( !empty( $mf3['title'] ) ){ echo $mf3['title']; } else { echo "Pizza by the Slice"; } ?></h3>
					<div class="textWrap">
					<p><?php if( !empty( $mf3['text'] ) ){ echo $mf3['text']; } else { echo "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis et odio ornare, cursus nunc nec, vulputate dolor. Proin bibendum et enim vitae commodo. Aenean ultrices urna vel dolor tincidunt, eget tempus nunc sodales."; } ?></p>
					</div>
					<div>
						<a type="button" href="<?php if( !empty( $mf3['page_link'] ) ){ echo $mf3['page_link']; } else { echo '#'; } ?>" class="btn btn-primary btn-lg btn-block"><?php if( !empty( $mf3['Button Text'] ) ){ echo $mf3['Button Text']; } else { echo "Daily Specials"; } ?></a>
					</div>
				</div>
			</div>

			<?php
				// use this instagram access token generator http://instagram.pixelunion.net/
				// $access_token	= "1503227320.1677ed0.e83ecd9ef0764818aeb744dd90e008e8";
				$access_token 	= "2103923722.1677ed0.a10dd41c280b4070b314d6fe9eace2e2";
				$photo_count	= 4;
				     
				$json_link		= "https://api.instagram.com/v1/users/self/media/recent/?";
				$json_link	   .= "access_token={$access_token}&count={$photo_count}";

				$json =	file_get_contents($json_link);
				$obj =	json_decode($json, true, 512, JSON_BIGINT_AS_STRING);
			?>

			<div id="igTitle" class="row">
				<div class="col-xs-12"><h2 class="text-center">Pizza Social</h2></div>
			</div>
			<div class="row igContainer">
			<?php 

				for ($i=0; $i < 4; $i++) { 

					// look( $obj['data'][$i] );

					echo '<div class="col-xs-6 col-sm-3">';
						echo '<a href="'. $obj['data'][$i]['link'] .'" class="thumbnail col-xs-12">';
					    	echo '<img src="'. $obj['data'][$i]['images']['low_resolution']['url'] .'" alt="...">';
					    echo '</a>';
					    echo '<div class="row"><div class="col-xs-6 "<p class="text-left"><i class="fa fa-heart red" aria-hidden="true"></i>&nbsp;'. $obj['data'][$i]['likes']['count'] .'&nbsp;Likes</p></div>';
					   	echo '<div class="col-xs-6"><p class="text-right">'. $obj['data'][$i]['comments']['count'] .'&nbsp;Comments</p></div></div>';
						echo '<div class="row"><p class="col-xs-12 text-center">'. $obj['data'][$i]['caption']['text'] .'</p></div>';
					echo '</div>';	
					
					if ( ( $i+1 ) % 2 == 0 ) {
					   ?>
					   		<div class="clearfix visible-xs"></div>
					   <?php
					}
					
				}

			?>		
<!-- 				<div class="col-xs-12 col-sm-3">
					Instagram content here
				</div>
				<div class="col-xs-12 col-sm-3">
					Instagram content here
				</div>
				<div class="col-xs-12 col-sm-3">
					Instagram content here
				</div>
				<div class="col-xs-12 col-sm-3">
					Instagram content here
				</div> -->
			</div>

			<div class="row">
				<div class="col-xs-12"><p class="text-center">Follow <a href="https://www.instagram.com/patellinis/">@Patellinis</a> on Instagram</p></div>
			</div>
			<?php 

				if( function_exists( 'get_field' ) ){

					//bf = bottom feature
					$bf_image	= get_field('bottom_feature_image', $post->ID );
			?>
			<div class="row bottomFeature">
				<div class="col-xs-12 col-sm-6">
					<h2><?php echo get_field('bottom_feature_title') ?></h2>
					<p><?php echo get_field('bottom_feature_text'); ?></p>
				</div>
				<div class="col-xs-12 col-sm-6"><?php  echo "<img class='img-responsive' src='". esc_attr( $bf_image['url'] )  ."' />" ?></div>
			</div>
			<?php 

				} // close if get_field exists

			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
