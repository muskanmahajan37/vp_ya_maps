<?php
/*
Plugin Name: VP Yandex Maps
Plugin URI: http://alkoweb.ru
Author: Petrozavodsky
Author URI: http://alkoweb.ru
*/

class VP_Yandex_Maps
{
    function __construct()
    {
        add_action('plugins_loaded', array(&$this, 'load_textdomain'), 20);
        add_action('wp_enqueue_scripts', array(&$this, 'add_js'), 20);
        add_action('plugins_loaded', array(&$this, 'load_textdomain'), 20);
     }

    function add_js()
    {

    }

    function load_textdomain()
    {
        $mo_file_path = dirname(__FILE__) . '/languages/' . get_locale() . '.mo';
        load_textdomain('vp_yandex_maps', $mo_file_path);
    }

}

$VP_Yandex_Maps = new VP_Yandex_Maps();


function VP_Yandex_Maps_init_meta_boxes()
{
    new VP_Yandex_Maps_add_metaboxes_Class();
}


if (is_admin()) {
    add_action('load-post.php', 'VP_Yandex_Maps_init_meta_boxes');
    add_action('load-post-new.php', 'VP_Yandex_Maps_init_meta_boxes');
}

add_action('init', 'VP_Yandex_Maps_init_meta_boxes');

class VP_Yandex_Maps_add_metaboxes_Class{
    public function __construct(){
	    global $current_screen;
	    $types=array('post');
	    $types = apply_filters('vp_ya_maps_types', $types);
	    if( in_array($current_screen->id,$types) ) {
		    add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ), 20 );
		    add_action( 'save_post', array( $this, 'save' ), 0 );
		    add_action( 'admin_enqueue_scripts', array(&$this,'add_scripts'), 20 );
	    }

    }

    function  add_scripts(){
        wp_register_script('api-maps-yandex', '//api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU', array('jquery'), '2.0', false );
        wp_register_script('location-tool', plugin_dir_url(__FILE__).'public/js/location-tool.js', array('jquery', 'api-maps-yandex'), '1.0', false );
        wp_register_script('cross-control', plugin_dir_url(__FILE__).'public/js/cross-control.js', array('jquery', 'api-maps-yandex','location-tool'), '1.0', false );
        wp_register_script('geolocation-button', plugin_dir_url(__FILE__).'public/js/geolocation-button.js', array('jquery', 'api-maps-yandex','location-tool','cross-control'), '1.0', false );
        wp_register_script('api-maps-init', plugin_dir_url(__FILE__).'public/js/api-maps-init.js', array('jquery', 'api-maps-yandex','location-tool','cross-control','geolocation-button'), '1.0', false );


        wp_enqueue_script('api-maps-yandex');
        wp_enqueue_script('location-tool');
        wp_enqueue_script('cross-control');
        wp_enqueue_script('geolocation-button');
        wp_enqueue_script('api-maps-init');
        wp_enqueue_style('api-maps-admin', plugin_dir_url(__FILE__) . 'public/css/api-maps-admin.css', array(), '1.0', false);

    }

    public function add_meta_box($post_type){
        $post_types = array('post', 'page');
	    $post_types = apply_filters('vp_ya_maps_types', $post_types);
        if (in_array($post_type, $post_types) and count($post_types) > 0 ) {
            add_meta_box('ya_maps_draggable', __('Yandex map draggable', 'vp_yandex_maps'), array($this, 'render_meta_box_content'), $post_type, 'advanced', 'high');
        }
    }

	function render_meta_box_content( $post ) {
		include plugin_dir_path( __FILE__ ) . 'includes/metabox-geocoder.php';
		echo '<input type="hidden" name="vpyamaps_nonce" value="'.wp_create_nonce(__FILE__).'" />';

	}

    function add_json_geo($center,$mapzoom,$placemarct){
        if($center !=='' or $mapzoom !== ''){
          $var = array('center' => $center, 'mapzoom' => $mapzoom,'placemarct'=>$placemarct);
        }else{
            $var = array('center'=>'45.04143661, 38.97730063','mapzoom' => 12 ,'placemarct'=>'45.04143661, 38.97730063');
        }
        return json_encode($var);
    }

    function save($post_id){
        if ( !wp_verify_nonce($_POST['vpyamaps_nonce'], __FILE__) ) {
            return false;
        }
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) {
            return false;
        }
        if ( !current_user_can('edit_post', $post_id) ) {
            return false;
        }
        if( !isset($_POST['vpyamaps']) ) {
            return false;
        }

        $_POST['vpyamaps'] = array_map('trim', $_POST['vpyamaps']);
        foreach( $_POST['vpyamaps'] as $key=>$value ){
            if( empty($value) ){
                delete_post_meta($post_id, $key);
                continue;
            }
            update_post_meta($post_id, $key, $value);
        }
        return $post_id;
    }
}

