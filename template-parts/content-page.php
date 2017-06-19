<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package patelinis_base
 */

?>
<style>
	.page-img-feature {
		float: right;
		max-width: 500px;
		margin: 0 0 1em 1em;
	}

	/* Medium devices (desktops, 992px and up) */
	@media (max-width: 992px) {
		.page-img-feature {
			max-width: 100%;
		}
	}

</style>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	<article <?php echo ( has_post_thumbnail() )? " class='' " : " class='' "; ?> >
	<!-- col-xs-7 -->
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php

				displayImg( get_post_thumbnail_id(), "large", 'img-responsive page-img-feature hidden-xs hidden-sm', TRUE );

				the_content();

			?>
			<div class="row">
				<?php displayImg( get_post_thumbnail_id(), "large", 'img-responsive page-img-feature visible-xs visible-sm col-xs-12', TRUE ); ?>
			</div>
		</div><!-- .entry-content -->

		<?php if ( get_edit_post_link() ){ ?>
			<footer class="entry-footer">
				<?php
					edit_post_link(
						sprintf(
							/* translators: %s: Name of current post */
							esc_html__( 'Edit %s', 'patelinis_base' ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						),
						'<span class="edit-link">',
						'</span>'
					);
				?>
			</footer><!-- .entry-footer -->
		<?php } ?>
	</article><!-- #post-## -->
<?php if( has_post_thumbnail() ){ ?>
	<aside class=" page-img-feature" >
	<!-- col-xs-5 -->
		
	</aside>
<?php } ?>
</div>
