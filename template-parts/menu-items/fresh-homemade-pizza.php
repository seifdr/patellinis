<?php
	
	if( ( strtolower( $category->name ) == "fresh homemade pizza" ) && ( $fhp_counter == "1" ) ){
			?>

			<div class="row">
				<div class="col-xs-6"></div><div class="col-xs-2 text-center simulatedH4">14"</div><div class="col-xs-2 text-center simulatedH4">16"</div><div class="col-xs-2 text-center simulatedH4">20"</div>
			</div>

			<?php
		}
	?>
	<div class='menuItem'>
		<div class="row">
			<div class="col-xs-6">
				<?php if( is_single() ){ ?>		
					<h1 class="under"><?php the_title(); ?></h1>
				<?php } else { ?>
					<a class="menuLinks" href="<?php the_permalink(); ?>">
						<h4 class="under"><?php the_title(); ?></h4>
					</a>
				<?php } ?>
				<?php echo get_field('description'); ?></div><div class="col-xs-2 text-center simulatedH4">$<?php echo get_field('14_price'); ?></div><div class="col-xs-2 text-center simulatedH4">$<?php echo get_field('16_price'); ?></div><div class="col-xs-2 text-center simulatedH4">$<?php echo get_field('20_price'); ?></div>
		</div>
	</div>
