<?php

$the_price = get_field('price');


?>
<div class='menuItem'>
	<div class="row">
		<div class="col-xs-9 col-sm-6 first">
			<h4 class="under"><?php the_title(); ?></h4>
			<?php echo get_field('description'); ?>
		</div>
		<div class="hidden-xs col-sm-4 simulatedH4 under">&nbsp;</div><div class="col-xs-3 col-sm-2 text-center simulatedH4 under"><?php if( !empty( $the_price ) ){ echo "$" . $the_price; }  ?></div>
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
