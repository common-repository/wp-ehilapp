<?php
/*
Plugin Name: WP Ehilapp
Plugin URI: http://www.ehilapp.com/
Description: Plugin ufficiale per l'applicazione per smartphone Ehilapp
Version: 2.3
Author: Alessandro Littera
Author URI: http://www.ehilapp.com/chi-sono/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wp-ehilapp
Domain Path: lang/
*/


if(!defined('ABSPATH')) exit;

$ehilapp_slag = 'ehilapp-json-page';

define( 'EHILAPP_PLUGIN', __FILE__ );

define( 'EHILAPP_PLUGIN_BASENAME', plugin_basename( EHILAPP_PLUGIN ) );

define( 'EHILAPP_PLUGIN_NAME', trim( dirname( EHILAPP_PLUGIN_BASENAME ), '/' ) );

define( 'EHILAPP_PLUGIN_DIR', untrailingslashit( dirname( EHILAPP_PLUGIN ) ) );

define( 'EHILAPP_PLUGIN_INC_DIR', EHILAPP_PLUGIN_DIR . '/includes' );



class WP_EHILAPP {

	public $oparr = array();
	public $catarr = array();
	private $categories = array();
	public $tagarr = array();
	private $tags = array();
    public $options = array();
	public $options_tags = array();
    public $options_cats = array();

    
    function __construct(){
        
       $categories = get_categories( array(
            'orderby' => 'name',
            'parent'  => 0
    	) );

       foreach ( $categories as $category ) {
            $catarr[esc_html( $category->name )] = $category->term_id;
		}
        
	if(get_option('wp_ehilapp_options_cat')){
        	$c_inv = get_option('wp_ehilapp_options_cat');
	} else {
        	$c_inv = array();
        }	

        foreach($c_inv as $key=>$value){
        	if($value == ''){
                	$c_invarr[$key] = $key.','.get_category($key)->name;
        	}
        }
        update_option( 'wp_ehilapp_options_cat_inv', $c_invarr);
        
        
        
        
	$tags = get_tags( array(
            'orderby' => 'name',
            'parent'  => 0
    	) );

        foreach ( $tags as $tag ) {
            $tagarr[esc_html( $tag->name )] = $tag->term_id;
	} 
		
	if(get_option('wp_ehilapp_options_tag')){
        	$t_inv = get_option('wp_ehilapp_options_tag');
	} else {
        	$t_inv = array();
        }	 

        foreach($t_inv as $key=>$value){
        	if($value == ''){
                	$t_invarr[$key] = $key.','.get_tag($key)->name;
        	}
        }
        update_option( 'wp_ehilapp_options_tag_inv', $t_invarr);
        
        
        
    	add_action('admin_menu', array($this, 'add_ehilapp_menu'));
        add_action('admin_init', array($this, 'add_fields'));
        $this->options = get_option('wp_ehilapp_options', $oparr);
        $this->options_cats = get_option('wp_ehilapp_options_cat', $catarr);    
        $this->options_tags = get_option('wp_ehilapp_options_tag', $tagarr);
        $this->ehilapp_slag = 'pagina-json-ehilapp';

		
        
    }
    
    public function add_ehilapp_menu(){
        add_menu_page(__('Titolo Pagina Ehilapp', 'wp-ehilapp'), __('Wp Ehilapp', 'wp-ehilapp'), 'manage_options', 'wp-ehilapp', array($this, 'wp_ehilapp_options'), plugins_url('/images/ehilapp_icon_16.png', __FILE__));

    }
    

    
    public function wp_ehilapp_options(){
    	echo '<div class="wrap">';
    	echo '<h2>Configurazione WP EHILAPP</h2>';
        echo $this->plugin;
        echo '<form action="options.php" method="post">';
        submit_button('', 'primary', 'wp_ehilapp_save', true);
        settings_fields('wp_ehilapp_options_group');
        do_settings_sections('wp-ehilapp');
        echo '</form>';
        echo '</div>';
    }
    
    function add_fields() {
		register_setting( 'wp_ehilapp_options_group', 'wp_ehilapp_options', array($this, 'sanitize'));
		register_setting( 'wp_ehilapp_options_group', 'wp_ehilapp_options_cat', array($this, 'sanitizec'));
		register_setting( 'wp_ehilapp_options_group', 'wp_ehilapp_options_tag', array($this, 'sanitizet')); 
		register_setting( 'wp_ehilapp_options_group', 'wp_ehilapp_options_cat_inv', array($this, 'sanitizec'));
		register_setting( 'wp_ehilapp_options_group', 'wp_ehilapp_options_tag_inv', array($this, 'sanitizet')); 
		add_settings_section('main_section', 'Opzioni del plugin', array($this, 'dispay_main_section'), 'wp-ehilapp');
		add_settings_section('cattag_section', 'Filtro per le CATEGORIE ed i TAG', array($this, 'dispay_cattag_section'), 'wp-ehilapp');        
        add_settings_field('parametro1', 'Attiva popup (ti aiuterà a far iscrivere gli utenti al tuo sito tramite Ehilapp)', array($this, 'display_field_1'), 'wp-ehilapp', 'main_section');
        add_settings_field('parametro2', 'Il tuo codice personale (necessario per far funzionare il plugin)', array($this, 'display_field_2'), 'wp-ehilapp', 'main_section');
        add_settings_field('parametro3', 'Inserisci codice trasferimento dominio (nel caso si debba cambiare)', array($this, 'display_field_3'), 'wp-ehilapp', 'main_section');
        add_settings_field('json post', 'Link per esportare post', array($this, 'display_json_link'), 'wp-ehilapp', 'main_section');
		add_settings_field('json categorie', 'Link per esportare categorie', array($this, 'display_cat_link'), 'wp-ehilapp', 'main_section');
		add_settings_field('json tags', 'Link per esportare tags', array($this, 'display_tag_link'), 'wp-ehilapp', 'main_section');
        //add_settings_field('cat', __('Seleziona categorie','select-category'), array($this, 'display_categories'), 'wp-ehilapp', 'main_section');
		//add_settings_field('tag', __('Seleziona tags','select-tag'), array($this, 'display_tags'), 'wp-ehilapp', 'main_section');
	    add_settings_field('filtri', 'Filtri', array($this, 'display_tabs'), 'wp-ehilapp', 'cattag_section');
	    add_settings_field('save', '', array($this, 'saveonbottom'), 'wp-ehilapp', 'cattag_section');
    }
  
  

    
    public function display_tabs(){
    	echo'
         <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-1">Categorie</a></li>
            <li><a href="#tab-2">Tags</a></li>
        </ul>
        <div class="tab-content">
			<div id="tab-1" class="tab-pane active">
            <p>Spunta le categorie che vuoi estromettere dalla visualizzazione. 
            Se vuoi farli visualizzare tutti non selezionare nulla</p>
            <ul>';
            $categories = get_categories( array(
                'orderby' => 'name',
                'parent'  => 0
            ) );
            foreach ( $categories as $category ) {
                $cat = $this->options_cats[$category->term_id];
                $checked = '';
                if($cat != ''){ 
                    $checked = 'checked'; 
                }
                printf( '<li style="float:left;width: 250px;"><input type="checkbox" name="wp_ehilapp_options_cat[%3$s]" value="%3$s,%2$s" %4$s ><a style="margin-left:5px" target="_blank" href="%1$s">%2$s</a></li>',
                    esc_url( get_category_link( $category->term_id ) ),
                    esc_html( $category->name ),
                    esc_html( $category->term_id ),
                    $checked
                );
            }
			echo'
            </ul></div>

            <div id="tab-2" class="tab-pane">
            <p> Hai un totale di <b>';
            echo sizeof(get_tags());
            $numop = get_option('wp_ehilapp_options_tag_inv');
		$tagvisibili = sizeof($numop);
		if(empty($numop)){$tagvisibili = 0;}
		if(sizeof(get_tags()) == 0){ $tagvisibili = 0; }
            echo '</b> TAG di cui <b style="color:green">'.$tagvisibili.'</b> sono visibili 
            </p><p>Spunta i tag che NON vuoi visualizzare, per visualizzarli tutti non selezionare nulla</p><ul>';
            $tags = get_tags( array(
              'orderby' => 'name',
              'parent'  => 0
        	) );

        	foreach ( $tags as $tag ) {
              $tg = $this->options_tags[$tag->term_id];
              $checked = '';
              if($tg != ''){ $checked = 'checked';}
              printf( '<li style="float:left;width: 250px;"><input type="checkbox" name="wp_ehilapp_options_tag[%3$s]" value="%3$s,%2$s" %4$s ><a style="margin-left:5px" target="_blank" href="%1$s">%2$s</a></li>',
                  esc_url( get_tag_link( $tag->term_id ) ),
                  esc_html( $tag->name ),
                  esc_html( $tag->term_id ),
                  $checked
              );
        	}
            echo'
            </ul</div>

		</div>';

    }    
    
    public function dispay_main_section(){
    	echo 'Ricordati di inserire il <b>codice personale del sito</b> che trovi nell\'app';
    }
    
    public function dispay_cattag_section(){
    	echo 'Seleziona le categorie ed i tag che <b>NON</b> vuoi visualizzare in Ehilapp. Se vuoi esportare tutti i post allora non selezionare nulla <br>
        	<span style="color:red">Ricorda che Ehilapp visualizza un massimo di <b>500 tag</b>, è possibile inserire tag illimitati abbonandoti annualmente</span>';
    }
    






    

    
    public function display_field_1(){
    	echo '<select name="wp_ehilapp_options[parametro1]">';
        ?>
        <option value="2" <?php selected($this->options['parametro1'], 2); ?>>ON</option>
        <option value="1" <?php selected($this->options['parametro1'], 1); ?>>OFF</option>
        <?php
        echo '</select>';
    }
    
    public function display_field_2(){
    	echo '<input type="text" name="wp_ehilapp_options[parametro2]" value="'.esc_attr($this->options['parametro2']).'" />';
    }
     public function display_field_3(){
    	echo '<input type="text" name="wp_ehilapp_options[parametro3]" value="'.esc_attr($this->options['parametro3']).'" />';
    }   
    

    public function display_json_link(){
		$idj =  get_page_by_title( 'Pagina Json Ehilapp' )->ID; 
		echo '<a href="'.site_url().'/?p='.$idj.'" target="_blank">'.site_url().'/?p='.$idj.'</a>';
    }
	
    public function display_cat_link(){
		$idc =  get_page_by_title( 'Pagina Categorie Ehilapp' )->ID; 
		echo '<a href="'.site_url().'/?p='.$idc.'" target="_blank">'.site_url().'/?p='.$idc.'</a>';
    }

    public function display_tag_link(){
		$idt =  get_page_by_title( 'Pagina Tags Ehilapp' )->ID; 
		echo '<a href="'.site_url().'/?p='.$idt.'" target="_blank">'.site_url().'/?p='.$idt.'</a>';
    }
    

    public function sanitize($input){
        return $input;
    }
    
    public function sanitizec($input){
        $categories = get_categories( array(
            'orderby' => 'name',
            'parent'  => 0
        ) );
        foreach ( $categories as $category ) {
            $this->catarr[$category->name] = "$category->term_id";
            $input[$category->term_id] = sanitize_text_field($input[$category->term_id]);
        }
    
        return $input;
    }


    public function sanitizet($input){
        $tags = get_tags( array(
            'orderby' => 'name',
            'parent'  => 0
        ) );
        foreach ( $tags as $tag ) {
            $this->tagarr[$tag->name] = "$tag->term_id";
            $input[$tag->term_id] = sanitize_text_field($input[$tag->term_id]);
        }

		return $input;
    }

    
    public function frontend(){
    	add_action('wp_footer', array($this, 'load_div'));
        wp_enqueue_style('wp-ehilapp', plugins_url('/css/style.css', __FILE__));
    }
    
    public function load_div(){
    	echo '<div class="wp-ehilapp-overlay">';
        echo '<div class="wp-ehilapp-container">'.$this->options['parametro2'].'</div>';
        echo '</div>';
    }    

	public function saveonbottom(){
        submit_button('', 'primary', 'wp_ehilapp_save', true);
    }


	
}


 


require_once EHILAPP_PLUGIN_DIR . '/includes/page.php';

require_once EHILAPP_PLUGIN_DIR . '/includes/popup.php';

require_once EHILAPP_PLUGIN_DIR . '/includes/mail.php';

require_once EHILAPP_PLUGIN_DIR . '/includes/css-js.php';

require_once EHILAPP_PLUGIN_DIR . '/includes/newcattag.php';








?>
