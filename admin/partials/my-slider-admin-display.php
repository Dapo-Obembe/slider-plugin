<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://https://www.alphawebconsult.com
 * @since      1.0.0
 *
 * @package    My_Slider
 * @subpackage My_Slider/admin/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
/**
 * Declaring the table's meta data variables.
 *
 * @package my-slider/Dapo-Obembe
 * @since 1.0.0
 */

	$link_text = get_post_meta( $post->ID, 'my_slider_link_text', true );
	$link_url  = get_post_meta( $post->ID, 'my_slider_link_url', true );
?>

<table class="form-table my-slider-metabox">
	<input type="hidden" name="my_slider_nonce" value="<?php echo esc_attr( wp_create_nonce( 'my_slider_none' ) ); ?>"> 
	<tr>
		<th>
			<label for="my_slider_link_text">Link Text</label>
		</th>
		<td>
			<input 
				type="text" 
				name="my_slider_link_text" 
				id="my_slider_link_text" 
				class="regular-text link-text"
				value="<?php echo ( isset( $link_text ) ) ? esc_html( $link_text ) : ''; ?>"
				required
			>
		</td>
	</tr>
	<tr>
		<th>
			<label for="my_slider_link_url">Link URL</label>
		</th>
		<td>
			<input 
				type="url" 
				name="my_slider_link_url" 
				id="my_slider_link_url" 
				class="regular-text link-url"
				value="<?php echo ( isset( $link_url ) ) ? esc_html( $link_url ) : ''; ?>"
				required
			>
		</td>
	</tr>               
</table>
