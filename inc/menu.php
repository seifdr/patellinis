<?php 

/**
*  A custom class to modify the generic wordpress press post and change it in Menu "posts"/items
*/

include('views/menu-views.php');

class PatelinnisMenu
{
	
	// public $orderNumber;
	// public $items; 
	// public $count;

	function __construct(){

		add_action('admin_enqueue_scripts', array( $this, 'enqueue_menu_scripts' ) );

		add_action( 'wp_ajax_order_cats', array( $this, 'order_cats') );

		add_action( 'pre_get_posts', array( $this, 'all_menu_items_on_blog' ) );
		add_action( 'admin_menu', array( $this, 'dev_edit_admin_menus' ) );
		add_action( 'admin_menu' , array( $this, 'remove_meta_boxes' ) );
		add_action( 'init', array( $this, 'dev_change_post_object') );
		add_action('init', array( $this, 'init_remove_wp_main_editor' ),100);
		add_action('admin_init', array( $this, 'fontawesome_dashboard') );
		add_action('admin_init', array( $this, 'include_menu_css') );
		// add_action('admin_head', array( $this, 'fontawesome_icon_dashboard') );
		add_action( 'add_meta_boxes', array( $this, 'menu_meta_box_add') );
	

		add_action( 'untrash_post', array( $this, 'untrash_menuItem' ) );
		add_action( 'save_post', array( $this, 'save_post_meta'), 10, 3 );
		add_filter( 'wp_insert_post_data' , array( $this, 'filter_post_data') , '99', 2 );


		add_action( 'admin_head', array( $this, 'css_admin_head_no_cache' ) );
		add_action( 'admin_head', array( $this, 'remove_visibility_from_menu_posts' ) );

		add_action( 'admin_menu', array( $this, 'add_to_posts_menu' ) );

		//add_action( 'edit_term', array( $this, 'add_post_cat_order' ) );

		
	}
	
	public function remove_visibility_from_menu_posts(){
		//remove visibility from posts (menu items)
		global $post;
    	if( isset( $post ) && 'post' == $post->post_type ){
			?>
				<style type="text/css">
					#visibility {
						display: none;
					}
				</style>
			<?php
		} 
	}

	function enqueue_menu_scripts() {
		// if( is_single() ) {
		// 	wp_enqueue_style( 'love', plugins_url( '/love.css', __FILE__ ) );
		// }

		$cs = get_current_screen();

		if( $cs->id == 'posts_page_order' ){
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script( 'order-cats', get_stylesheet_directory_uri() . '/js/order-cats.js', array('jquery'), '1.0', true );

			wp_localize_script( 'order-cats', 'orderCats', array(
				'ajax_url' => admin_url( 'admin-ajax.php' )
			));
		}
	}

	// function add_post_cat_order( $term_id ) {

	// 	$postCats = get_terms( 'category', array( 'hide_empty' => false, 'exclude' => array('1') ) );

	// 	$pc_Ids = array();

	// 	foreach ($postCats as $pc ) {
	// 		array_push( $pc_Ids, $pc->term_id );
	// 	}
	
	// 	if( in_array( $term_id, $pc_Ids ) ){
	// 		$cnt = wp_count_terms( 'category', array( 'hide_empty' => false, 'exclude' => array( '1' )  ) );
	// 		$cnt++;
	// 		update_term_meta( $term_id, 'categoryOrder', $cnt++ );
	// 	}

	// }

	function order_cats(){
		//function hooked to ajax when cats are reordered	
		if( $_POST['type'] == "category" ){
			$counter = 0;

			foreach ( $_POST['catOrder'] as $cat ) {
				update_term_meta( $cat, 'categoryOrder', $counter );
				$counter++;
			}		
		} elseif( $_POST['type'] == "menuItem" ){
			$counter = 0;

			foreach ( $_POST['catOrder'] as $menuItem ) {
				update_post_meta( $menuItem, 'menuItemOrder', $counter );
				$counter++;
			}
		}
		//look( $_POST['catOrder'] );
	}

	function add_to_posts_menu() {
		add_posts_page( "Menu Order", "Order", "publish_posts", "order", array( $this, 'arrange_menu') );
	}

	public function get_cats(){
		return get_terms( 'category', array( 'hide_empty' => false, 'exclude' => array('1'), 'orderby' => 'meta_value', 'meta_key' => 'categoryOrder', 'order' => 'ASC') );
	}

	public function arrange_menu(){
		
		$allCatsUnsortedOrOtherwise = $postCats = get_terms( 'category', array( 'hide_empty' => false, 'exclude' => array( '1' ) ) );

		$aCuOo_Ids = array();
		foreach ($allCatsUnsortedOrOtherwise as $aCuOo ) {
			$aCuOo_Ids[] = $aCuOo->term_id;
		}

		$postCats = $this->get_cats();

		$pc_Ids = array();
		foreach ($postCats as $pc ) {
			$pc_Ids[] = $pc->term_id;
		}

		$diff = array_values( array_diff($aCuOo_Ids, $pc_Ids) );

		if( count( $diff ) >= 1 ){
			$remainderCats = get_terms( 'category', array( 'hide_empty' => false, 'include' => $diff ) );
		}


		?>
			<style>

				div.clear {
					clear: both;
				}

				ul#sortableCats, ul#unsortedCats {
					/*margin: 0 1em;*/
					max-width: 100%;
				}

				ul#sortableCats li, ul#unsortedCats li, ul.menuItemSort li {
					border: 1px solid rgb(221, 221, 221);
					padding: 1em;
					width: 100%;
					text-align: center;
					background-color: #fff;
					box-sizing: border-box;
				}

				div.col1of2, div.col2of2 {
					width: 40%;
					float: left;
				}

				div.col1of2 {
					margin-right: 10%;
				}

			</style>

			<div class="wrap nosubsub">
				<h1>Menu Categories Order</h1>
				<p>Drag and drop the menu categories below.</p>
				<div class="col1of2">	
					<h2>Current Menu List</h2>
					<ul id="sortableCats">
					<?php 
						foreach ($postCats as $cats ) {
					        echo '<li id ="'. $cats->term_id .'" class="default">'. $cats->name .'</li>';

						}
					?>
					</ul>
				</div>
			<?php if( count( $diff ) >= 1 ){ ?>
				<div class="col2of2">
					<h2>Unassigned</h2>
					<ul id="unsortedCats">
					<?php 
						foreach ($remainderCats as $cats ) {
					        echo '<li id ="'. $cats->term_id .'" class="default">'. $cats->name .'</li>';

						}
					?>
					</ul>
				</div>
			<?php } ?>
			<div class="clear"></div>
			<hr />
			<h2>Menu Items Order</h2>
			<style>
				div.menuItemSortContainer {
					float: left;
					width: 32%;
					margin-right: 1%;
					margin-bottom: 2em;
				}

				div.thirdColumn {
					margin-right: 0;
				}

				div.menuItemSortContainer h3, div.menuItemSortContainer p {
					text-align: center;
				}




			</style>
			<div class="sortContainer">
				<?php 
					$sCounter = 0;

					foreach ( $postCats as $cat ) {
						$sCounter++;
						echo "<div class='menuItemSortContainer ";
							if( $sCounter % 3 == 0 ){ 
								echo " thirdColumn "; 
							}
						echo "'>";
							echo "<h3>". $cat->name . "</h3>";

								$args = array(
									'posts_per_page'   => -1,
									'category'         => $cat->term_id,
									'orderby'          => 'meta_value',
									'order'            => 'ASC',
									'meta_key'         => 'menuItemOrder',
									// 'meta_value'       => '',
									'post_type'        => 'post',
									'post_status'      => 'publish',
									'suppress_filters' => true 
								);

								$menuItemsForCat = get_posts( $args ); 

								if( count( $menuItemsForCat ) == 0 ){
									echo "<p>There are no menu items assigned to this category.</p>";
								} else {
									echo "<ul id='mi". $sCounter ."' data-name='". $cat->name ."' class='menuItemSort'>";
										foreach ($menuItemsForCat as $menuitem ) {
												echo "<li id=". $menuitem->ID .">". $menuitem->post_title ."</li>";
										}
									echo "</ul>";
								}

						echo "</div>";

						if( $sCounter % 3 == 0 ){ 
							echo "<div class='clear'></div>"; 
						}
					}

				?>
			</div>
			<div class="clear"></div>

			<script>
				jQuery(document).ready(function($) {

					function ajaxOrderCats1( catOrder, type ){

						jQuery.ajax({
							url : orderCats.ajax_url,
							type : 'post',
							data : {
								action : 'order_cats',
								type: type,
								catOrder : catOrder
							},
							success : function( response ) {
								//alert( response );
							}
						});
					}



					$.each( $('.menuItemSort'), function() {
				    	var id 		= $(this).attr('id');
				    	var name 	= $(this).data('name');
				    	console.log( id );
				    	console.log( name );

				    	$( "ul#"+id ).sortable({

				    		update: function(event, ui) {
					         	var menuItemOrder = $(this).sortable('toArray');

					         	ajaxOrderCats1( menuItemOrder, 'menuItem' );

					        	//catOrder.toString();

					       	}
				    	});

				    });
				});

			</script>


			<?php 
	}

    function all_menu_items_on_blog( $query ){
    	// make sure all posts/menuitems show on menu
  		if( $query->is_main_query() && ( is_home() || is_archive() ) ){
  			$query->set('posts_per_page', -1);
  			$query->set('meta-key', 'menuItemOrder');
  			$query->set('orderby', 'meta_value');
  			$query->set('order', 'ASC');
  		}
    }

    function patellinis_make_permalink( $string = NULL ){
    	if( $string == NULL ){
    		return "";
    	} else {
    		$string = strtolower( str_replace(' ', '-', $string) ); // Replaces all spaces with hyphens.
    		$string = preg_replace( '/&/', '-and-', $string );
    		$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
		   	return preg_replace('/-+/', '-', $string ); // removes any double hyphens
    	}
    }

	function filter_post_data( $data , $postarr ) {

		// if not $_POST data then there is no create/edit happening.
		if( isset( $_POST ) && !empty( $_POST ) ){

				// echo "data <br />";
				// look( $data );

				// echo "postarr <br />";
				// look( $postarr );

				// echo " super global <br />";
				// look( $_POST );

			//remove acf field to set title. The title field was hidden for athestics. 				

			if( ( isset( $_POST['post_type'] ) ) && ( $_POST['post_type'] == 'post' ) ){

			    $afc_title = $_POST['acf']['field_5893dcc048082'];
			    
			    //for title
			    $data['post_title'] 	= $afc_title;

			    //for slug 
			    $data['post_name']		= $this->patellinis_make_permalink( $afc_title );

			}		
		}

		return $data;	
	}


	/**
	 * Save post metadata when a post is saved. Hook right after save. 
	 *
	 * @param int $post_id The post ID.
	 * @param post $post The post object.
	 * @param bool $update Whether this is an existing post being updated or not.
	 */	
		
	function save_post_meta( $post_id, $post, $update ) {
		global $pagenow;

		// dont run if the save is result of a revision or autosave
		if( ! ( wp_is_post_revision( $post_id) || wp_is_post_autosave( $post_id ) ) ) {
			// if post is in trash do worry about this 
			if ( 'trash' != get_post_status( $post_id ) && ( !empty( $_POST ) )  ) {

				//if there is a prexisting cat, check for it now and assign it var 
				$old_cat = get_the_category( $post_id );


				if( isset( $_POST['post_type'] ) && ( $_POST['post_type'] == 'post' ) ){
					$catArr = array();
					$catId = get_cat_ID( $_POST['catselect'] );
				    $catArr[] = $catId;

				    wp_set_post_categories( $post_id, $catArr );

	    			$args = array(
						'posts_per_page'   => -1,
						'category'         => $catId,
						'orderby'          => 'meta_value',
						'order'            => 'ASC',
						'meta_key'         => 'menuItemOrder',
						// 'meta_value'       => '',
						'post_type'        => 'post',
						'post_status'      => 'publish',
						'suppress_filters' => true 
					);

				    //how many menuitems are in selected category
					$menuItemCount = count( get_posts( $args ) ); 
					$menuItemCount++;

				    //debug z
				    //edit post
				    if( !empty( $old_cat ) && $old_cat == NULL ){
				    	//same category or change categories 
				    	if( $old_cat->term_id != $catId ){
				    		//changing categories, make sure it appears last in the list of menuitems for new cat
				    		update_post_meta( $post_id, 'menuItemOrder', $menuItemCount );
				    	} else {
				    		//just editing a post. Keeping same cat so do nothing.
				    	}
				    } else {
				    	//must be new post/menuitem because it doesnt have a previous category. So make sure it appears last in list
				    	update_post_meta( $post_id, 'menuItemOrder', $menuItemCount );
				    }

				}
			  	
			}
		}
	} 

	function untrash_menuItem( $post_id ){
		//make sure item appears last in cat list when it comes back out of trash

		//this applies to posts only
		if( get_post_type( $post_id ) == 'post' ){
			//get cat 
			$cat = get_the_category( $post_id );

			$args = array(
				'posts_per_page'   => -1,
				'category'         => $cat[0]->term_id,
				'orderby'          => 'meta_value',
				'order'            => 'ASC',
				'meta_key'         => 'menuItemOrder',
				// 'meta_value'       => '',
				'post_type'        => 'post',
				'post_status'      => 'publish',
				'suppress_filters' => true 
			);

		    //how many menuitems are in selected category
			$menuItemCount = count( get_posts( $args ) ); 
			$menuItemCount++;

			//make sure the restored items shows up last in list 
			update_post_meta( $post_id, 'menuItemOrder', $menuItemCount );

		}
	}


	/*
	* Change 'post' name to 'Menu'
	*/
	function dev_edit_admin_menus() {
		global $menu;
		global $submenu;
		$menu[5][0] = 'Menu'; // Change Posts to Houses
		$submenu['edit.php'][5][0] = 'Menu Items';
		$submenu['edit.php'][10][0] = 'Add Menu Item';
		// $submenu['edit.php'][16][0] = 'House Tags';
	}


	function dev_change_post_object() {
		global $wp_post_types;
		$labels = &$wp_post_types['post']->labels;
		$labels->name = 'Menu Items';
		$labels->singular_name = 'Menu Item';
		$labels->add_new = 'Add Menu Item';
		$labels->add_new_item = 'Add Menu Item';
		$labels->edit_item = 'Edit Menu Item';
		$labels->new_item = 'Menu Item';
		$labels->view_item = 'View Menu Item';
		$labels->search_items = 'Search Menu Items';
		$labels->not_found = 'No Menu Items found';
		$labels->not_found_in_trash = 'No Menu Items found in Trash';
		$labels->all_items = 'All Menu Items';
		$labels->menu_name = 'Menu';
		$labels->name_admin_bar = 'Menu';
		// print_r($labels);
	}

	/*
	 * Remove standard WYSIWYG editor from post page - remember post is menu item
	 * https://codex.wordpress.org/Function_Reference/remove_post_type_support
	 */
	 
	function init_remove_wp_main_editor(){
	    $post_type = 'post'; 
	    remove_post_type_support( $post_type, 'title');
	    remove_post_type_support( $post_type, 'editor');
	    remove_post_type_support( $post_type, 'comments');
	    remove_post_type_support( $post_type, 'thumbnail');
	    remove_post_type_support( $post_type, 'excerpt');
	    remove_post_type_support( $post_type, 'revisions');
	}
	 

	function remove_meta_boxes(){
		//replacing cat metabox with a dropdown
		
		remove_meta_box( 'commentsdiv', 'post', 'normal');
		remove_meta_box( 'categorydiv', 'post', 'side'); 
		//repacing tax metabox with a dropdown
		//gluten free, new item, popular 
		remove_meta_box( 'tagsdiv-post_tag', 'post', 'side'); 
	}

	 /*
	 * Add font awesome CSS / icons to the admin area.
	 */
	function fontawesome_dashboard() {
		wp_enqueue_style ( 'font_awescome_css', get_stylesheet_directory_uri() . "/font-awesome-4.7.0/css/font-awesome.min.css", '', '4.7.0', 'all');
	}

	function include_menu_css(){
		wp_enqueue_style ( 'menu_admin_css', get_stylesheet_directory_uri() . "/css/menu-admin.css");
	}


	function menu_meta_box_add(){
	    add_meta_box( 'category-select', 'Menu Category', array( $this, 'menu_meta_box_cb' ), 'post', 'normal', 'high', 'null' );
	
	}

	function menu_meta_box_cb(){

		$theID = get_the_ID();

		$selectedCat = get_the_category( $theID );

		$selectedCat = ( !empty( $selectedCat ) )? $selectedCat[0]->cat_name : NULL;


		//Get a list of all menu categories 
		$args = array(
			'hide_empty' 	=> 0
		);

		$cats = get_categories( $args );

		//start the MenuBView class
		$views = new MenuViews;

		echo $views->output_cat_menu_box( $cats, $selectedCat );

	}

	function css_admin_head_no_cache() {
		global $pagenow;


		if( in_array( $pagenow, array('post.php', 'post-new.php' ) ) ){

		$cs = get_current_screen();

		if(  $cs->post_type == 'post' ){
			// if( $cs->id == 'posts_page_order' ){

				//yes edit post or new post 
				echo '<style>
					div.colThirds {
						float: left !important;
						position: relative !important;
						clear: none !important;
						width: 32%;
						margin-right: 1%;
					} 

					body.post-type-post div#postbox-container-2 {
						background-color: #fff;  
						border: 1px solid #e5e5e5;
						-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.04);
						box-shadow: 0 1px 1px rgba(0,0,0,.04);
					}

					body.post-type-post div#post-body-content {
						margin-bottom: 0;
					}

					body.post-type-post div#category-select {
						border: none !important;
						-webkit-box-shadow: none !important;
						box-shadow: none !important;
					}

					body.post-type-post div#category-select > button, div#category-select > h2 {
						display: none;
					}

					body.post-type-post div#postbox-container-2 .inside {
						 margin: 6px 0 0 !important;
					}

					body.post-type-post .fhp, .soda, .salad, .reg {
						display: none;
					}

				</style>';

				echo '<script>
					jQuery(document).ready(function($) {


						function arrayContains(needle, arrhaystack) {
						    return (arrhaystack.indexOf(needle) > -1);
						}

						function hideAndShow( value ){

							$("select#catselect option[value=default]").remove();

							// .reg
							// .soda 
							// .salad

							var text = value.toLowerCase();

							console.log( text );

							if( text == "fresh homemade pizza" ){
								$(".fhp, #theTitle, #theDescription").css("display", "block");
								
								$(".thePrice, .soda, .salad").css("display", "none");

							} else if( text == "fresh salads" ) {
								$(".salad, #theTitle, #theDescription").css("display", "block");

								$(".fhp, .soda, #thePrice").css("display", "none");

							} else if ( text == "beverages" ){

								$(".soda").css("display", "block");

								$(".fhp, .salad, .reg").css("display", "none");

								var bevType = $("div#bevType select").val().toLowerCase();

								if( bevType == "soda" ){
									$(" .soda, .reg ").css("display", "block");
									$(".fhp, .salad, #thePrice, #thePriceVar").css("display", "none");
								} else {
									$(".fhp, .salad, .soda").css("display", "none");
									$(".reg, #bevType ").css("display", "block");
								}


							} else if ( text == "firstTime" ) {
								// Do nothing, let css hide all 

							} else {
								$(".fhp, .soda, .salad").css("display", "none");
								$(".reg").css("display", "block");
							}
						}

						var initCatSelectVal = $("select#catselect").val();

						if( initCatSelectVal != "default" ){
							hideAndShow( initCatSelectVal );
						}		

						$("select#catselect").change( function(){ 
							hideAndShow( $(this).val() );
						});

						$("div#bevType select").change( function(){

							$("div#bevType select option[value=default]").remove();

							var text = $(this).val().toLowerCase();

							if( text == "soda" ){
								$(" .soda, .reg ").css("display", "block");
								$(".fhp, .salad, #thePrice, #thePriceVar").css("display", "none");
							} else {
								$(".fhp, .salad, .soda").css("display", "none");
								$(".reg, #bevType ").css("display", "block");
							}

						});



					});
				</script>';
			}

		} 

	}
}

$patMenu = new PatelinnisMenu();


?>