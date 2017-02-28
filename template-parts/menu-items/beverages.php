<?php

$the_price 				= get_field('price');
$the_regular_price_soda = get_field( 'regular_price_soda' );
$the_large_price_soda	= get_field( 'large_price_soda' ); 
$the_bev_type			= get_field( 'beverage_type' );

	if( ( strtolower( $category->name ) == "beverages" ) && ( $bev_counter == "1" ) ){
			?>
			<div class="row">
				<div class="col-xs-6 col-sm-8"></div><div class="col-xs-3 col-sm-2 text-center simulatedH4">REG.</div><div class="col-xs-3 col-xs-2 text-center simulatedH4">LG.</div>
			</div>
			<?php
		}
?>
<div class='menuItem'>
	<div class="row">
		<div class="col-xs-6">
			<h4><?php the_title(); ?></h4>
			<?php echo get_field('description'); ?>
		</div>
		<?php if( strtolower( $the_bev_type ) == "soda" ) { ?>
			<div class="xs-hidden col-sm-2"></div><div class="col-xs-3 col-sm-2 text-center simulatedH4"><?php if( !empty( $the_regular_price_soda ) ){ echo "$" . $the_regular_price_soda; } ?></div>
			<div class="col-xs-3 col-sm-2 text-center simulatedH4"><?php if( !empty( $the_large_price_soda ) ){ echo "$" . $the_large_price_soda; } ?></div>
		<?php } else { ?>
			<div class="col-xs-3 col-sm-4" ></div><div class="col-xs-3 col-sm-2 text-center simulatedH4"><?php if( !empty( $the_price ) ){ echo "$" . $the_price; }  ?></div>
		<?php } ?>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6"></div>
	</div>
	<?php 

		if( get_field('price_variation_opt') ){
			
			while( have_rows('price_variation') ){
				the_row();

				echo "<div class='row' >";
					echo "<div class='col-xs-9 col-sm-6' >";
			       		the_sub_field('variation_description');
			        echo "</div>";
			        echo "<div class='hidden-xs col-sm-4' ></div>";
			        echo "<div class='col-xs-3 col-sm-2 text-center simulatedH4 noMargin'>";
			        	$variation_price = trim( get_sub_field('variation_price') );

			        	if( !empty( $variation_price ) ){ echo "$" . $variation_price; }

			        echo "</div>";
			    echo "</div>";

		      //  $sub_field_3 = get_sub_field('sub_field_3'); 
		        
		        // do something with $sub_field_3
		        
		    } //end while

		} 

	?>
</div>
<?php
	
	if( ( strtolower( $category->name ) == "beverages" ) && ( $bev_counter == "1" ) ){
		?>
		<div class="row">
			<div class="col-xs-12"><br /></div>
		</div>
		<?php
	}	
?>