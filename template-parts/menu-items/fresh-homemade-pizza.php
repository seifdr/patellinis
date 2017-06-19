<?php

	if( is_tag() ){
		$tagTitle = single_tag_title("", false);
		$isGF = ( !empty( $tagTitle ) && $tagTitle == 'gluten free' )? TRUE : FALSE;
	} else {
		$isGF = FALSE;
	}

	if( ( strtolower( $category->name ) == "fresh homemade pizza" ) && ( $fhp_counter == "1" ) ){
			?>

			<div class="row hidden-xs">
				<?php if( !$isGF ){ ?>
					<div class="col-xs-6"></div><div class="col-xs-2 text-center simulatedH4">14"</div><div class="col-xs-2 text-center simulatedH4">16"</div><div class="col-xs-2 text-center simulatedH4">20"</div>
				<?php } else { ?>
					<div class="col-xs-6"></div><div class="col-xs-2 text-center simulatedH4">14"</div><div class="col-xs-4 text-center simulatedH4">&nbsp;</div>
				<?php } ?>
			</div>

			<?php
		}
	?>
	<div class='menuItem'>
		<div class="row">
			<div class="col-xs-12 col-sm-6">	
				<h4 class="under"><?php the_title(); ?></h4>
				<?php echo get_field('description'); ?></div>
				<?php if( !$isGF ){ ?>
					<div class="col-xs-4 col-sm-2 text-center simulatedH4"><small class="visible-xs">10"</small>$<?php echo get_field('14_price'); ?></div><div class="col-xs-4 col-sm-2 text-center simulatedH4"><small class="visible-xs">16"</small>$<?php echo get_field('16_price'); ?></div><div class="col-xs-4 col-sm-2 text-center simulatedH4"><small class="visible-xs">20"</small>$<?php echo get_field('20_price'); ?></div>
				<?php } else { ?>
					<div class="col-xs-4 col-sm-2 text-center simulatedH4">
						<small class="visible-xs">10"</small>$<?php echo get_field('14_price'); ?>
					</div>
				<?php } ?>
		</div>
	</div>
