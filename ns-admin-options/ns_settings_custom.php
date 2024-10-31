<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	<div id="ns-placeholder-group">
		<?php if (get_option('ns-placeholder-image-from-list')) { echo '<img src="'.get_option('ns-placeholder-image-from-list').'" style="max-width: 200px;">'; } ?>
		<table>
			<tr>
				<td><p><?php _e('Choose an image from your gallery', $ns_text_domain); ?></p></td>
				<td><button id="ns-gallery-btn" type="button"><?php _e('Open Gallery', $ns_text_domain); ?></button></td>
				<td><button id="ns-set-to-default" class="ns-remove-img-btn ns-tab1-remove-img" type="button" ><?php _e('Set to default', $ns_text_domain); ?></button></td>
			</tr>		
		</table>
		<input id="ns-placeholder-image-from-list" name="ns-placeholder-image-from-list" placeholder="..." readonly value="<?php if (get_option('ns-placeholder-image-from-list')) { echo get_option('ns-placeholder-image-from-list'); } ?>" />
		<input type="hidden" id="ns-replace-default-place-val" name="ns-replace-default-place-val" value="<?php echo plugin_dir_url( __FILE__ ).'img/placeholder.png';?>">
	</div>
	

<?php settings_fields('ns_cusplaceholder_options_group'); ?>
