<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package patelinis_base
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="row">
				<div class="col-xs-12">
					<?php custom_breadcrumbs(); ?>
				</div>
			</div>
			<div class="row">
			 	<div class="col-xs-12">
				<?php
					while ( have_posts() ) { 
						the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						// if ( comments_open() || get_comments_number() ) :
						// 	comments_template();
						// endif;

					} // End of the loop.
				?>
				</div>
			</div>
            <div class="row text-center">
                <div class="col-xs-12 col-sm-6">
                    <h2>Location</h2>
                    <adress>
                        <p>1429 Main Street<br />Sarasota, FL 34236 <br />(<a href="https://www.google.com/maps/place/Patellini's+Pizza/@27.336706,-82.544225,17z/data=!3m1!4b1!4m5!3m4!1s0x88c34012ef0f7031:0x96174450e37f3e1e!8m2!3d27.336706!4d-82.542031"> Map It! </a>)</p>
                        <br >
                        <p><a href="tel:941-947-6433"><phone>941-947-6433</phone></a></p>
                    <adress>
                    <p><a data-toggle="modal" data-target="#exampleModal" href="#">Send us a message!</a></p>
                </div>
                <div class="col-xs-12 col-sm-6">
                        <h2>Hours</h2>
                        <div id="locationAndHours">
                            <table>
                                <tr>
                                    <td>Monday - Thursday</td><td>11:00 AM – 9:00 PM</td>
                                </tr><tr>
                                    <td>Friday - Saturday</td><td>11:00 AM – 2:30 AM</td>
                                </tr><tr>
                                    <td>Sunday</td><td>12:00 PM – 9:00 PM</td>
                                </tr>
                            </table>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <br />
                    <div class='embed-container maps'>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3544.248261348006!2d-82.54422504893023!3d27.336705982863094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88c34012ef0f7031%3A0x96174450e37f3e1e!2sPatellini&#39;s+Pizza!5e0!3m2!1sen!2sus!4v1492717898661" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
