<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


function ns_cusplaceholder_activate_set_options()
{
	
    add_option('ns-placeholder-image-from-list', '');
}

register_activation_hook( __FILE__, 'ns_cusplaceholder_activate_set_options');


function ns_cusplaceholder_img_register_options_group()
{
	register_setting('ns_cusplaceholder_options_group', 'ns-placeholder-image-from-list'); 
	
}

add_action ('admin_init', 'ns_cusplaceholder_img_register_options_group');


?>