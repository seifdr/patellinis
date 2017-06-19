<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package patelinis_base
 */

?>

						</div><!-- #content -->
					</div> <!-- close col-xs-12 from header -->
				</div> <!-- close row -->


				<div class="row footer-widgets">
					<?php if ( is_active_sidebar( 'patellinis-footer-widgets' ) ) { ?>
						<div id="primary-sidebar"  role="complementary">
							<?php dynamic_sidebar( 'patellinis-footer-widgets' ); ?>
						</div>
					<?php } ?>
				</div>


				<div class="row">
					<footer id="colophon" class="site-footer col-xs-12" role="contentinfo">
						<div class="site-info text-center">
							    <p>&copy; 
							    <?php 
							    	bloginfo('name');
									echo " " . date('Y');
								 ?></p>    
						</div><!-- .site-info -->
					</footer><!-- #colophon -->
				</div> <!-- close row -->	



			</div><!-- #page -->

			<?php wp_footer(); ?>

			<?php include('inc/views/contact-us.php'); ?>

			<script type="text/javascript">

				jQuery(document).ready(function($) {

					$('.contactUsLink').on('click', function(){
						alert('Message Sent');
						$('div#exampleModal').modal('hide');
					});
				});

			</script>
		</body>
	</div> <!-- close container -->
</html>
