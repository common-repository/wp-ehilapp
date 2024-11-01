<?php

$wp_ehilapp = new WP_EHILAPP();

$cats = $wp_ehilapp->options_cats;  
$cats2 = $wp_ehilapp->options_cats;
$catsfinal = $wp_ehilapp->options_cats;

$tags = $wp_ehilapp->options_tags;  
$tags2 = $wp_ehilapp->options_tags;
$tagsfinal = $wp_ehilapp->options_tags; 

//echo $wp_ehilapp->numCatSel;       

    
function wp_ehilapp_action_links( $links ) {
	$settings_link = '<a href="admin.php?page=wp-ehilapp">Settings</a>';
	array_push( $links, $settings_link );
	return $links;
}
    
$plugin = plugin_basename( __FILE__ );
add_filter( 'plugin_action_links_'.$plugin, 'wp_ehilapp_action_links' );





function wp_ehilapp_create_page_json() {


	$return = array(
      'value1'  => '1',
      'value2'  => 'ok'
  	);
    
    $jdata = json_encode($return, JSON_UNESCAPED_UNICODE);
	$PageGuid = site_url() . "/ehilapp-json";
	$my_post  = array( 'post_title'     => 'Pagina Json Ehilapp',
                     'post_type'      =>  'page',
                     'post_name'      =>  $ehilapp_slag, 
                     'post_content'   =>  $jdata, 
                     'post_status'    => 'publish',
                     'comment_status' => 'closed',
                     'ping_status'    => 'closed',
                     'post_author'    => 1,
                     'menu_order'     => 0,
                     'guid'           => $PageGuid );
                     

	$PageID = wp_insert_post( $my_post, FALSE ); 
}


function wp_ehilapp_create_page_cats() {


	$return = array(
      'value1'  => '1',
      'value2'  => 'ok'
  	);
    
    $jdata = json_encode($return, JSON_UNESCAPED_UNICODE);

	$PageGuid = site_url() . "/ehilapp-json/categories";
	$my_post  = array( 'post_title'     => 'Pagina Categorie Ehilapp',
                     'post_type'      =>  'page',
                     'post_name'      =>  'ehilapp-cat-page',
                     'post_content'   =>  $jdata, 
                     'post_status'    => 'publish',
                     'comment_status' => 'closed',
                     'ping_status'    => 'closed',
                     'post_author'    => 1,
                     'menu_order'     => 0,
                     'guid'           => $PageGuid );
                     

	$PageID = wp_insert_post( $my_post, FALSE ); 
}


function wp_ehilapp_create_page_tags() {


	$return = array(
      'value1'  => '1',
      'value2'  => 'ok'
  	);
    
    $jdata = json_encode($return, JSON_UNESCAPED_UNICODE);

	$PageGuid = site_url() . "/ehilapp-json/tags";
	$my_post  = array( 'post_title'     => 'Pagina Tags Ehilapp',
                     'post_type'      =>  'page',
                     'post_name'      =>  'ehilapp-tag-page',
                     'post_content'   =>  $jdata, 
                     'post_status'    => 'publish',
                     'comment_status' => 'closed',
                     'ping_status'    => 'closed',
                     'post_author'    => 1,
                     'menu_order'     => 0,
                     'guid'           => $PageGuid );
                     

	$PageID = wp_insert_post( $my_post, FALSE ); 
}


function wp_ehilapp_update_page_json() {
	global $cats;
	$return = array();
    //$cats = array_slice($cats, 3);
	$cats = get_option('wp_ehilapp_options_cat_inv');
    if(!empty($cats)){
		sort($cats);
        $cats_separated = implode(",", $cats);
    }   
    
    $cats_separated = '['.$cats_separated.']';


     $args = array(
        'numberposts'     => -1, 
        'offset'          => 0,
        'category'        =>  $cats_separated, 
        'orderby'         => 'post_modified',
        'order'           => 'DESC', 
        'date_query' => array(
            array(
            	'column' => 'post_modified',
                'after' => '- 7 days',
                'inclusive' => true,
            ),
        ),

        'post_type'       => 'post', 

    );
    $posts_array = get_posts( $args );

	
	$i = 0;
	
    foreach( $posts_array as $post ) : setup_postdata($post);
    	//$list_post_tags = "[";
	$list_post_tags_ar = array();
    	$return[$i]['id'] = $post->ID;
        $return[$i]['category'] = $post->post_category;
        $return[$i]['title'] = $post->post_title;
        $return[$i]['slug'] = $post->post_name;
        $return[$i]['date'] = $post->post_date;
        $return[$i]['modified'] = $post->post_modified;
        $post_tags = get_the_tags( $post->ID );
        //echo count((array)$post_tags);
        //print_r($post_tags);
        if (!empty($post_tags)){
        	foreach( $post_tags as $post_tag ){
              //$list_post_tags .= $post_tag->term_id.',';
				$list_post_tags_ar[] = $post_tag->term_id;
          	}
          //$list_post_tags = substr($list_post_tags, 0, strlen($list_post_tags)-1);
        }
        
        //$list_post_tags .= "]";
	//$arrayT = explode(' ', $list_post_tags); 
        $return[$i]['tags'] = $list_post_tags_ar;
        $i++;
    endforeach;



    
    $jdata = json_encode($return, JSON_UNESCAPED_UNICODE); 
    $idp =  get_page_by_title( 'Pagina Json Ehilapp' )->ID; 
    $postarr = get_post($idp,'ARRAY_A');

    //if(array_filter($cats)){
    if(!empty($cats)){
    	$postarr['post_content'] = $jdata;
    } else {
    	$postarr['post_content'] = 'Nessuna categoria selezionata';
    }  
    

    $post_id = wp_update_post($postarr);
}



function wp_ehilapp_update_page_cats() {
	$cats2 = array();
	$return2 = array();
    //$cats2 = array_slice($cats2, 3);
    $cats2 = get_option('wp_ehilapp_options_cat_inv');
    if(!empty($cats2)){
    	sort($cats2);
    }    
    //$cats_separated2 = implode(",", $cats2);
    //$cats_separated2 = '['.$cats_separated2.']';

    $jdata2 = json_encode($cats2); 
    $idp2 =  get_page_by_title( 'Pagina Categorie Ehilapp' )->ID; 
    $postarr2 = get_post($idp2,'ARRAY_A');

    //if(is_array($cats2)){
    if(!empty($cats2)){
        foreach($cats2 as $key => $value){
			$values = explode(',',$value);
            if($values[0] != 0){
            	$numcat = $values[0];
                $namecat = get_the_category_by_ID($numcat);
                $res = $value.','.$namecat;
            } else {
            	$res = '';
            }
			$list_cats[$key] = $res; 
    	}
        
        $categories0 = get_categories( array(
            'orderby' => 'name',
            'parent'  => 0
    	) );
        
        foreach ( $categories0 as $category0 ) {
            $catarr0[$category0->term_id] = esc_html( $category0->name );
		} 
        $list_cat_json = json_encode($list_cats, JSON_UNESCAPED_UNICODE);
    	$postarr2['post_content'] = $list_cat_json;
    } else {
    	$postarr2['post_content'] = 'Nessuna categoria selezionata';
    }    

    $post_id2 = wp_update_post($postarr2);
}

function wp_ehilapp_update_page_tags() {
	global $tags2;
	$return2 = array();
	$tags2 = get_option('wp_ehilapp_options_tag_inv');
    if(!empty($tags2)){
    	sort($tags2);
    	$tags_separated2 = implode(",", $tags2);
    	$tags2_separated2 = '['.$tags2_separated2.']';
    }
    //$tags2 = array_slice($tags2, 1); 


    $jdata3 = json_encode($tags2); 
    $idp3 =  get_page_by_title( 'Pagina Tags Ehilapp' )->ID; 
    $postarr3 = get_post($idp3,'ARRAY_A');

    //if(array_filter($tags2)){
    if(!empty($tags2)){
        foreach($tags2 as $key => $value){
			$values = explode(',',$value);
            if($values[0] != 0){
            	$numtag = $values[0];
                $nametag = get_tag($numtag);
                $res = $value.','.$nametag->name;
            } else {
            	$res = '';
            }
			$list_tags[$key] = $res; 
    	}
        
        $tags0 = get_tags( array(
            'orderby' => 'name',
            'parent'  => 0
    	) );
        foreach ( $tags0 as $tag0 ) {
            $tagarr0[$tag0->term_id] = esc_html( $tag0->name );
		} 
        $list_tag_json = json_encode($list_tags, JSON_UNESCAPED_UNICODE);
    	$postarr3['post_content'] = $list_tag_json;
    } else {
    	$postarr3['post_content'] = 'Nessun tag selezionato';
    }    
    $post_id3 = wp_update_post($postarr3);
}







if( get_page_by_title( 'Pagina Json Ehilapp' ) == NULL ){ 
	add_action( 'init', 'wp_ehilapp_create_page_json' );
} else {
    add_action( 'init', 'wp_ehilapp_update_page_json' );
}


if( get_page_by_title( 'Pagina Categorie Ehilapp' ) == NULL ){ 
	add_action( 'init', 'wp_ehilapp_create_page_cats' );
} else {
    add_action( 'init', 'wp_ehilapp_update_page_cats' );
}

if( get_page_by_title( 'Pagina Tags Ehilapp' ) == NULL ){ 
	add_action( 'init', 'wp_ehilapp_create_page_tags' );
} else {
    add_action( 'init', 'wp_ehilapp_update_page_tags' );
}

$params = $wp_ehilapp->options;   
  
function wp_ehilapp_add_meta_tags() {
        global $params;
        $metakeywords = $params['parametro2'];
		$metakeywords2 = $params['parametro3'];
		$idj =  get_page_by_title( 'Pagina Json Ehilapp' )->ID; 
		$idc =  get_page_by_title( 'Pagina Categorie Ehilapp' )->ID; 
		$idt =  get_page_by_title( 'Pagina Tags Ehilapp' )->ID; 
        echo '<meta name="ehilakey" content="' . $metakeywords . '" />' . "\n";
        echo '<meta name="ehilakeydom" content="' . $metakeywords2 . '" />' . "\n";
        echo '<meta name="ehilakeyname" content="' . get_bloginfo( 'name' ) . '" />' . "\n";
        echo '<meta name="ehilakeydesc" content="' . get_bloginfo( 'description' ) . '" />' . "\n";
		echo '<meta name="ehilakeyidj" content="' . $idj . '" />' . "\n";
		echo '<meta name="ehilakeyidc" content="' . $idc . '" />' . "\n";
        echo '<meta name="ehilakeyidt" content="' . $idt . '" />' . "\n";
        echo '<meta name="ehilakeyurl" content="' . get_site_url() . '" />' . "\n";
        
}
add_action( 'wp_head', 'wp_ehilapp_add_meta_tags' , 1 );  
  


function wp_ehilapp_output_json_page(){
    if( is_page( 'Pagina Json Ehilapp' ) ){
        global $post;
        echo $post->post_content;
        die;
    }
}
add_action( 'template_redirect', 'wp_ehilapp_output_json_page' );


function wp_ehilapp_output_cats_page(){
    if( is_page( 'Pagina Categorie Ehilapp' ) ){
        global $post;
        echo $post->post_content;
        die;
    }
}
add_action( 'template_redirect', 'wp_ehilapp_output_cats_page' );

function wp_ehilapp_output_tags_page(){
    if( is_page( 'Pagina Tags Ehilapp' ) ){
        global $post;
        echo $post->post_content;
        die;
    }
}
add_action( 'template_redirect', 'wp_ehilapp_output_tags_page' );


?>