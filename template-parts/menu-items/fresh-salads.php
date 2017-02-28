<?php
	
	if( ( strtolower( $category->name ) == "fresh salads" ) && ( $s_counter == "1" ) ){
			?>

			<div class="row">
				<div class="col-xs-8"></div><div class="col-xs-2 text-center simulatedH4">Small</div><div class="col-xs-2 text-center simulatedH4">Large</div>
			</div>

			<?php
		}

		$the_regular_size_price = get_field('regular_size_price');
		$the_large_size_price 	= get_field('large_size_price');	
?>
<div class='menuItem'>
	<div class="row">
		<div class="col-xs-6">	
			<h4 class="under"><?php the_title(); ?></h4>
			<?php echo get_field('description'); ?>
			<br />
		</div>
		<div class="col-xs-2"></div>
		<div class="col-xs-2 text-center simulatedH4"><?php if( !empty( $the_regular_size_price ) ){ echo "$" . $the_regular_size_price; }  ?></div>
		<div class="col-xs-2 text-center simulatedH4"><?php if( !empty( $the_large_size_price ) ){ echo "$" . $the_large_size_price; }  ?></div>
	</div>
</div>