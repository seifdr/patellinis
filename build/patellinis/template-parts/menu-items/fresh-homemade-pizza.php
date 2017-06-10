<?php
	
	if( ( strtolower( $category->name ) == "fresh homemade pizza" ) && ( $fhp_counter == "1" ) ){
			
			if( get_field('glutten_free') && is_tag('gluten free') ){
		?>
			<div class="row hidden-xs">
				<div class="col-xs-6"></div><div class="col-xs-6 text-center simulatedH4">10"</div>
			</div>
		<?php } else { ?>
			<div class="row hidden-xs">
				<div class="col-xs-6"></div><div class="col-xs-2 text-center simulatedH4">14"</div><div class="col-xs-2 text-center simulatedH4">16"</div><div class="col-xs-2 text-center simulatedH4">20"</div>
			</div>
		<?php } ?>
			<?php
		}
	?>
	<div class='menuItem'>
		<div class="row">
				<?php if( get_field('glutten_free') && is_tag('gluten free') ){ ?>
					<div class="col-xs-12 col-sm-6">	
						<h4 class="under"><?php the_title(); ?></h4>
						<?php echo get_field('description'); ?>
					</div>
					<div class="col-xs-12 col-sm-6 text-center simulatedH4"><small class="visible-xs">10"</small>$<?php echo get_field('14_price'); ?></div>
				<?php } else { ?>
					<div class="col-xs-12 col-sm-6">	
					<h4 class="under"><?php the_title(); ?></h4>
					<?php echo get_field('description'); ?></div>

					<div class="col-xs-4 col-sm-2 text-center simulatedH4"><small class="visible-xs">14"</small>$<?php echo get_field('14_price'); ?></div>
					<div class="col-xs-4 col-sm-2 text-center simulatedH4"><small class="visible-xs">16"</small>$<?php echo get_field('16_price'); ?></div>
					<div class="col-xs-4 col-sm-2 text-center simulatedH4"><small class="visible-xs">20"</small>$<?php echo get_field('20_price'); ?></div>
				<?php } ?>
		</div>
	</div>
