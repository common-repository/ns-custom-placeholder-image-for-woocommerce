<?php
/*
Plugin Name: NS Custom Placeholder Image For Woocommerce
Plugin URI: https://www.nsthemes.com/
Description: This plugin allow to choose the placeholder to show in woocommerce product page
Version: 1.3.6
Author: NsThemes
Author URI: http://www.nsthemes.com
Text Domain: ns-custom-placeholder-image-for-woocommerce
Domain Path: /languages
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** 
 * @author        PluginEye
 * @copyright     Copyright (c) 2019, PluginEye.
 * @version         1.0.0
 * @license       https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 * PLUGINEYE SDK
*/

require_once('plugineye/plugineye-class.php');
$plugineye = array(
    'main_directory_name'       => 'ns-custom-placeholder-image-for-woocommerce',
    'main_file_name'            => 'ns-custom-placeholder-image-page.php',
    'redirect_after_confirm'    => 'admin.php?page=ns-custom-placeholder-image-for-woocommerce%2Fns-admin-options%2Fns_admin_option_dashboard.php',
    'plugin_id'                 => '244',
    'plugin_token'              => 'NWNmZmFmMDljYTBkNzZjMTZjYzA1MjE4ZDcyMDgwNDRlMDgwMjVmMDRkOGZjYzUwZThjYzdmYjA1YmIxYmI4M2ZlYzEyZjU3NTkzMmI=',
    'plugin_dir_url'            => plugin_dir_url(__FILE__),
    'plugin_dir_path'           => plugin_dir_path(__FILE__)
);

$plugineyeobj244 = new pluginEye($plugineye);
$plugineyeobj244->pluginEyeStart();      

if ( ! defined( 'CUSPLACEHOLDER_NS_PLUGIN_DIR' ) )
    define( 'CUSPLACEHOLDER_NS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if ( ! defined( 'CUSPLACEHOLDER_NS_PLUGIN_DIR_URL' ) )
    define( 'CUSPLACEHOLDER_NS_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );



/* *** plugin options *** */
require_once( CUSPLACEHOLDER_NS_PLUGIN_DIR.'/ns-custom-placeholder-image-options.php');


require_once( plugin_dir_path( __FILE__ ).'ns-admin-options/ns-admin-options-setup.php');


/*Set the choosen placeholder image*/
// add_action( 'init', 'cpiw_custom_fix_thumbnail', 1);
// function cpiw_custom_fix_thumbnail() {
//   add_filter('wc_placeholder_img_src', 'cpiw_custom_woocommerce_placeholder_img_src', 10, 1);
//   //return cpiw_custom_woocommerce_placeholder_img_src();
// }

add_action( 'init', 'custom_fix_thumbnail');
function custom_fix_thumbnail() {
	
	add_filter('woocommerce_placeholder_img_src', 'cpiw_custom_woocommerce_placeholder_img_src', 10 , 1);	
}

function cpiw_custom_woocommerce_placeholder_img_src($src) {
	$src_2 = get_option('ns-placeholder-image-from-list'); 
	if($src_2 != false){
		return $src_2;
	}
	else{
		//echo 'Error';
	}	
}

add_filter('woocommerce_placeholder_img', 'ns_woocommerce_placeholder_img', 10, 3);
function ns_woocommerce_placeholder_img($image_html, $size, $dimensions){
	$image = get_option('ns-placeholder-image-from-list'); 
	$extension_pos = strrpos($image, '.'); // find position of the last dot, so where the extension starts
	$image = substr($image, 0, $extension_pos) . '-'.$dimensions['width'].'x'.$dimensions['height'] . substr($image, $extension_pos);
	$image_html = '<img src="' . esc_attr( $image ) .'" alt="' . esc_attr__( 'Placeholder', 'woocommerce' ) . '" width="' . esc_attr( $dimensions['width'] ) . '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" height="' . esc_attr( $dimensions['height'] ) . '" />';
	return $image_html;
}



function cpiw_enqueue_media_uploader()
{
    wp_enqueue_media();
}

add_action("admin_enqueue_scripts", "cpiw_enqueue_media_uploader");

add_action( 'plugins_loaded', 'ns_custom_placeholder_load_textdomain' );

function ns_custom_placeholder_load_textdomain() {
  load_plugin_textdomain( 'ns-custom-placeholder-image-for-woocommerce', false, basename( dirname( __FILE__ ) ) . '/languages/' ); 
}


/* *** add link premium *** */
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'nscplaceholderimage_add_action_links' );

function nscplaceholderimage_add_action_links ( $links ) {	
 $mylinks = array('<a id="nsplaceholderlinkpremium" href="https://www.nsthemes.com/product/custom-placeholder-image-for-woocommerce/?ref-ns=2&campaign=CIP-linkpremium" target="_blank">'.__( 'Premium Version', 'ns-custom-placeholder-image-for-woocommerce' ).'</a>');
return array_merge( $links, $mylinks );
}
?>