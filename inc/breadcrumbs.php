<?php 

// Breadcrumbs
function custom_breadcrumbs() {
      
    // Settings
    // $separator          = '&gt;';
	$separator          = '';
    $breadcrums_id      = 'breadcrumb';
    $breadcrums_class   = 'breadcrumb';
    $home_title         = 'Home';
     
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    =  NULL;
      
    // Get the query & post information
    global $post,$wp_query;
      
    // Do not display on the homepage
    if ( !is_front_page() ) {
      
        // Build the breadcrums
        echo '<ol id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
          
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
          
        if ( is_archive() && !is_tax() && !is_category() ) {

            $custom_tax_name = get_queried_object()->name;

            if( !empty( $custom_tax_name ) ){
                echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . esc_html( ucwords( $custom_tax_name ) )  . '</strong></li>';
            }
            // echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
             
        } else if ( is_archive() && is_tax() && !is_category() ) {

            // If post is a custom post type
            $post_type = get_post_type();
             
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                 
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
             
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
             
            }
             
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
             
        } else if ( is_single() ) {
			 


            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if($post_type != 'post') {
                 


                // echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>'; 
				 
                $post_type_object = get_post_type_object( $post_type );

                $post_type_archive = get_post_type_archive_link( $post_type );
             
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
             
            }
            // Get post category info
            $category = get_the_category();

            //get custom menu name // duncan edit 
            $post_type_object   = get_post_type_object($post_type);
            $pt_menu_name       = $post_type_object->labels->menu_name;

             echo '<li class="item-cat item-post-type-' . $pt_menu_name . '"><a class="bread-cat bread-custom-post-type-' . $pt_menu_name . '" href="' . get_permalink( get_option( 'page_for_posts' ) ) . '" title="' . $pt_menu_name . '">' . $pt_menu_name . '</a></li>';

            // Get last category post is in
            $catValues = array_values( $category );
            $last_category =  end( $catValues );

			if( not_Blank($last_category) ){
  				// Get parent any categories and create array
            	$get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
           	 	$cat_parents = explode(',',$get_cat_parents);
				
				// Loop through parent categories and store in variable $cat_display
	            $cat_display = '';
	            foreach($cat_parents as $parents) {
	                $cat_display .= '<li class="item-cat">'.$parents.'</li>';
	            }
				
			} 


			
			// If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                  
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
              
            }
             
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                 
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                 
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
             
            } else {
                 
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                 
            }
             
        } else if ( is_category() ) {

			// If post is a custom post type
            $post_type = get_post_type();
			
			//If it is a custom post type display name and link
                 
            $post_type_object = get_post_type_object($post_type);
            $post_type_archive = get_post_type_archive_link($post_type);
         
            echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->menu_name . '">' . $post_type_object->labels->menu_name . '</a></li>';

            // Get post category info
            //$category = get_the_category();
			
			// Get last category post is in
            //$last_category = end(array_values($category));
			
			// Get parent any categories and create array
            //$get_cat_parents = trim(get_category_parents($last_category->term_id, true, ','),',');

            //$cat_parents = explode(',',$get_cat_parents);
			
			// $count_of_cat_parents = count( $cat_parents );
			// $counter = 0;
// 			
			// // Loop through parent categories and store in variable $cat_display
 			// foreach($cat_parents as $parents) {
 				// $counter++;
// 				
				// if( $counter != $count_of_cat_parents ){
					// echo '<li class="item-cat">'.$parents.'</li>';	
				// } else {
					// echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">'. $parents .'</strong></li>';
				// }
// 				    
            // }             


			$parent_cat = get_query_var( 'parent_cat', NULL);
			$category_name = get_query_var( 'category_name', NULL );
            
			if( $parent_cat ){
				$parent_cat = get_category_by_slug($parent_cat);	
				$parent_cat_link = get_category_link($parent_cat->term_id);
				echo '<li class="item-cat"><a class="bread-cat" href="'. $parent_cat_link .'">'. $parent_cat->name .'</a></li>'; 
			}
			
            // Category page
            $main_category = get_category_by_slug($category_name);
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . $main_category->name . '</strong></li>';  
			  
        } else if ( is_page() ) {

            // Standard page
            if( $post->post_parent ){
                  
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                  
                // Get parents in the right order
                $anc = array_reverse($anc);
                  
                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                }
                  
                // Display parent pages
                echo $parents;
                  
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                  
            } else {
                  
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                  
            }
              
        } else if ( is_tag() ) {
              
            // Tag page
              
            // Get tag information
            $term_id = get_query_var('tag_id');
            $taxonomy = 'post_tag';
            $args ='include=' . $term_id;
            $terms = get_terms( $taxonomy, $args );
              
            // Display the tag name
            echo '<li class="item-current item-tag-' . $terms[0]->term_id . ' item-tag-' . $terms[0]->slug . '"><strong class="bread-current bread-tag-' . $terms[0]->term_id . ' bread-tag-' . $terms[0]->slug . '">' . $terms[0]->name . '</strong></li>';
          
        } elseif ( is_day() ) {
              
            // Day archive
              
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
              
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
              
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
              
        } else if ( is_month() ) {
              
            // Month Archive
              
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
              
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
              
        } else if ( is_year() ) {
              
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
              
        } else if ( is_author() ) {
              
            // Auhor archive
              
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
              
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
          
        } else if ( get_query_var('paged') ) {
              
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
              
        } else if ( is_search() ) {
          
            // Search results page
            //echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
          	 echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search">Search</strong></li>';
        } elseif ( is_404() ) {
              
            // 404 page
            echo '<li>' . 'Page Not Found - 404' . '</li>';
        } elseif ( is_home() ) {
             // Home page
             echo '<li class="item-current item-' . $post->ID . '"><strong title="menu">Menu</strong></li>';
        }
      
        echo '</ol>';
          
    }
      
}