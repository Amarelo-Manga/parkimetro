<?php

/* Add Image Upload to Series Taxonomy */

// Add Upload fields to "Add New Taxonomy" form
function estabelecimento_image_field() {
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field">
		<label for="estabelecimento_image"><?php _e( 'Estabelecimento Thumnail:', 'estabelecimento' ); ?></label>
		<input type="text" name="estabelecimento_image[image]" id="estabelecimento_image[image]" class="estabelecimento-image" value="<?php echo $estabelecimentoimage; ?>">
		<input class="upload_image_button button" name="_estabelecimento_image" id="_estabelecimento_image" type="button" value="Select/Upload Image" />
		<script>
			jQuery(document).ready(function() {
				jQuery('#_estabelecimento_image').click(function() {
					wp.media.editor.send.attachment = function(props, attachment) {
						jQuery('.estabelecimento-image').val(attachment.url);
					}
					wp.media.editor.open(this);
					return false;
				});
			});
		</script>
	</div>
<?php
}
//add_action( 'estabelecimento_add_form_fields', 'estabelecimento_image_field', 10, 2 );

// Add Upload fields to "Edit Taxonomy" form
function estabelecimento_edit_meta_field($term) {
 
	// put the term ID into a variable
	$t_id = $term->term_id;
 
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "estabelecimento_$t_id" ); ?>
	
	<tr class="form-field">
	<th scope="row" valign="top"><label for="_estabelecimento_image"><?php _e( 'Series Image', 'journey' ); ?></label></th>
		<td>
			<?php
				$estabelecimentoimage = esc_attr( $term_meta['image'] ) ? esc_attr( $term_meta['image'] ) : ''; 
				?>
			<input type="text" name="estabelecimento_image[image]" id="estabelecimento_image[image]" class="estabelecimento-image" value="<?php echo $estabelecimentoimage; ?>">
			<input class="upload_image_button button" name="_estabelecimento_image" id="_estabelecimento_image" type="button" value="Select/Upload Image" />
		</td>
	</tr>
	<tr class="form-field">
	<th scope="row" valign="top"></th>
		<td style="height: 150px;">
			<style>
				div.img-wrap {
					background-size:contain; 
					max-width: 283px; 
					max-height: 330px; 
					width: 100%; 
					height: auto; 
					overflow:hidden; 
				}
				div.img-wrap img {
					max-width: 283px;
				}
			</style>
			<div class="img-wrap">
				<img src="<?php echo $estabelecimentoimage; ?>" id="estabelecimento-img">
			</div>
			<script>
			jQuery(document).ready(function() {
				jQuery('#_estabelecimento_image').click(function() {
					wp.media.editor.send.attachment = function(props, attachment) {
						jQuery('#estabelecimento-img').attr("src",attachment.url)
						jQuery('.estabelecimento-image').val(attachment.url)
					}
					wp.media.editor.open(this);
					return false;
				});
			});
			</script>
		</td>
	</tr>
<?php
}
add_action( 'estabelecimento_edit_form_fields', 'estabelecimento_edit_meta_field', 10, 2 );

// Save Taxonomy Image fields callback function.
function save_estabelecimento_custom_meta( $term_id ) {
	if ( isset( $_POST['estabelecimento_image'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "estabelecimento_$t_id" );
		$cat_keys = array_keys( $_POST['estabelecimento_image'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['estabelecimento_image'][$key] ) ) {
				$term_meta[$key] = $_POST['estabelecimento_image'][$key];
			}
		}
		// Save the option array.
		update_option( "estabelecimento_$t_id", $term_meta );
	}
}  
add_action( 'edited_estabelecimento', 'save_estabelecimento_custom_meta', 10, 2 );  
add_action( 'create_estabelecimento', 'save_estabelecimento_custom_meta', 10, 2 );