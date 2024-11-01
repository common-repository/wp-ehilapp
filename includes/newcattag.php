<?php

function ehilapp_new_cat_tag( $post_id, $post  ) {
	if ( strpos($_SERVER['HTTP_REFERER'], 'edit-question') !== false ) {
        	// altro...
	} else {
		//global $wp_query;
		//$postid = $wp_query->post->ID;
		// add new cats from post
        $optcats = array(); 
		$optcats = get_option('wp_ehilapp_options_cat'); 
		//$cats = wp_get_post_categories($postid);
        $cats = get_categories();
		if(!empty($cats)){
			foreach($cats as $cat){
				$id = $cat->term_id;
				if(!array_key_exists($id ,$optcats)){
					$optcats[$id] = "";
				}

			}
		}
		update_option( 'wp_ehilapp_options_cat', $optcats);


		// add new tags from post
        $opttags = array();
		$opttags = get_option('wp_ehilapp_options_tag');     
		//$tags = wp_get_post_tags($postid);
		$tags = get_tags();
        if(!empty($tags)){
			foreach($tags as $tag){
				$id = $tag->term_id;
				if(!array_key_exists($id ,$opttags)){
					$optags[$id] = "";
				}

			}
		}
		update_option( 'wp_ehilapp_options_tag', $opttags);
	}
}

add_action( 'publish_post', 'ehilapp_new_cat_tag', 10, 2 );

?>