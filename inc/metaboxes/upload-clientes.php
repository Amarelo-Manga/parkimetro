<?
/**
 * Repeatable Custom Fields in a Metabox
 * Author: Helen Hou-Sandi
 *
 * From a bespoke system, so currently not modular - will fix soon
 * Note that this particular metadata is saved as one multidimensional array (serialized)
 */
 
add_action('admin_init', 'add_meta_boxes', 1);
function add_meta_boxes() {
	add_meta_box( 'repeatable_images', 'Galeria Clientes', 'repeatable_meta_box_display', 'page', 'side', 'default');
}

function repeatable_meta_box_display() {
	global $post;

	$repeatable_images = get_post_meta( $post->ID, 'repeatable_images', true );

	wp_nonce_field( 'repeatable_meta_box_nonce', 'repeatable_meta_box_nonce' );
?>
	<script type="text/javascript">

	</script>
  
	<table id="repeatable-fieldset-one" width="100%">
	<thead>
		<tr>
			<th width="50%">Imagens</th>
		</tr>
	</thead>
	<tbody>
	<?php
	
	if ( $repeatable_images ) :
	
	foreach ( $repeatable_images as $field ) {
	?>
	<tr>
		<td>
			<?php 
				$image_id =  $field['images'];
				$url_image = wp_get_attachment_url( $image_id ); 
			?>
			<img src="<?php echo $url_image; ?>" style="max-width:250px;max-height: 300px;" class="upload_image" id="upload_image<?php echo $image_id; ?>" />
			<input type="hidden" id="upload_image<?php echo $image_id; ?>_input" class="upload_image_input" name="_images_gallery[]" value="<?php echo $image_id; ?>" />

			<p class="hide-if-no-js">
				<a title="Set listing image" href="javascript:;" id="upload_image<?php echo $image_id; ?>_button" data-uploader_title="Choose an image" class="button custom_upload_image_button" data-uploader_button_text="Set listing image">Escolher Imagem</a>
				<a class="button remove-row" href="#">Remover</a>
			</p>
			
		</td>
	</tr>
	<?php
	}
	else :
	// show a blank one
	?>
	<tr>
		<td>
			<img src="" style="max-width:250px;max-height: 300px;" class="upload_image" id="upload_image" />
			<input type="hidden" id="upload_image_input" class="upload_image_input" name="_images_gallery[]" value="" />
			<p class="hide-if-no-js">
				<a title="Set listing image" href="javascript:;" id="upload_image_button" data-uploader_title="Choose an image" class="button custom_upload_image_button" data-uploader_button_text="Set listing image">Escolher Imagem</a>
				<a class="button remove-row" href="#">Remover</a>
			</p>
		</td>
	</tr>
	<?php endif; ?>
	
	<!-- empty hidden one for jQuery -->
	<tr class="empty-row screen-reader-text">
		<td>
			<img src="" style="max-width:250px;max-height: 300px;" class="upload_image" id="upload_image_hidden" />
			<input type="hidden" id="upload_image_input_hidden" class="upload_image_input" name="_images_gallery[]" value="" />
			<p class="hide-if-no-js">
				<a title="Set listing image" href="javascript:;" id="upload_image_button" data-uploader_title="Choose an image" class="button custom_upload_image_button" data-uploader_button_text="Set listing image">Escolher Imagem</a>
				<a class="button remove-row" href="#">Remover</a>
			</p>
		</td>
	</tr>
	</tbody>
	</table>
	
	<p><a id="add-row" class="button" href="#">Adicionar imagem</a></p>
	<?php
}

add_action('save_post', 'repeatable_meta_box_save');
function repeatable_meta_box_save($post_id) {
	if ( ! isset( $_POST['repeatable_meta_box_nonce'] ) ||
	! wp_verify_nonce( $_POST['repeatable_meta_box_nonce'], 'repeatable_meta_box_nonce' ) )
		return;
	
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;
	
	if (!current_user_can('edit_post', $post_id))
		return;
	
	$old = get_post_meta($post_id, 'repeatable_images', true);
	$new = array();
	
	$images = $_POST['_images_gallery'];

	$count = count( $images );
	
	for ( $i = 0; $i < $count; $i++ ) {
		if ( $images[$i] != '' ) :
			$new[$i]['images'] = stripslashes( strip_tags( $images[$i] ) );
		endif;
	}

	if ( !empty( $new ) && $new != $old )
		update_post_meta( $post_id, 'repeatable_images', $new );
	elseif ( empty($new) && $old )
		delete_post_meta( $post_id, 'repeatable_images', $old );
}
?>