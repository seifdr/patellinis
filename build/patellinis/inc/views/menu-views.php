<?php 


/**
* 
*/
class MenuViews 
{
	
	// function __construct(argument)
	// {
	// 	# code...
	// }


	//ADMIN VIEWS

	public function output_cat_menu_box( $cats = NULL, $cat_name = NULL ){


		$result = "<p>First select category the menu item should appear under. Depending on your selection, additional fields will be displayed to collect the necessary information.</p>";

		if( $cats != NULL ){
			$result .= "<select id='catselect' name='catselect'>";

			$result .= "<option value='default' > -- SELECT ONE -- </option>";

			foreach ($cats as $cat ) {
				$result .= "<option value=\"". $cat->name ."\" ";

					if( ( $cat_name != NULL ) && ( $cat->name == $cat_name ) ){
						$result .= " selected ";
					}

				$result .= " >". $cat->name ."</option>";
			}

			$result .= "</select>";		

			
		}


		return $result;	


		//return "<p>Hello from the inside!</p>";

	}


}


?>