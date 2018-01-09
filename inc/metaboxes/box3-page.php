<?php
/*
 * Documentation
 * Replace "__box3" for name the metabox_box_name
 *
 * Add Metabox_example.php on the function
 * require get_template_directory() . '/metabox_example3.php';
 *
 * Add metabox-imageUpload.js on the function
 * wp_enqueue_script('metabox-imageUpload', get_template_directory_uri().'/js/metabox-imageUpload.js');
 */

add_action( 'add_meta_boxes', 'add_metabox_box3' );
function add_metabox_box3() {
	add_meta_box( 
		'box3', // $id  
		 __( 'Box 3', 'text-domain' ),  // $title   
		'listing_box3_metabox', // $callback
		'page', // $page  
		'normal', // $context
		'high' // $priority  
	);
}

function listing_box3_metabox ( $post ) {
	global $content_width, $_wp_additional_image_sizes;
	
	$box3 = get_post_meta( $post->ID, '_box3', true );

    if( isset( $box3["texto"] ) ) {
    	$texto = $box3["texto"];
    }else{
    	$texto = "";
    }

	if ( $box3 ) {
		$image_id = $box3['image'];
    	$image_url = wp_get_attachment_url( $image_id );

		$content .= '<img src="'.$image_url.'" style="width:300px;max-height:300px;border:0;" id="upload_image3" />';
		$content .= '<p class="hide-if-no-js"><a title="Escolher Imagem" href="javascript:;" id="upload_image3_button"  data-uploader_title="Escolher Imagem" data-uploader_button_text="Escolher Imagem" class="button custom_upload_image_button">Escolher Imagem</a></p>';
		$content .= '<input type="hidden" id="upload_image3_input" name="_box3_image" value="'. $image_id .'" /><br />';

		$content .= '<p><label class="post-attributes-label">Título</label><input type="text" value="'. $box3["titulo"] .'" name="_box3_titulo" style="width:100%;padding: 10px 5px;" ></p>';

		$content .= '<p><label class="post-attributes-label">Subtítulo</label><input type="text" value="'. $box3["subtitulo"] .'" name="_box3_subtitulo" style="width:100%;padding: 10px 5px;" ></p>';
		$content .= '<p><label class="post-attributes-label">Texto</label>';

	} else {

		$content .= '<img src="" style="width:300px;max-height:300px;border:0;display:none;" id="upload_image3" />';	
		$content .= '<p class="hide-if-no-js"><a title="Escolher Imagem" href="javascript:;" id="upload_image3_button"  data-uploader_title="Escolher Imagem" data-uploader_button_text="Escolher Imagem" class="button custom_upload_image_button">Escolher Imagem</a></p>';
		$content .= '<input type="hidden" id="upload_image3_input" name="_box3_image" value="" /><br />';
		$content .= '<label class="post-attributes-label">Título</label><input type="text" value="" name="_box3_titulo" style="width:100%;padding: 10px 5px;" ><br />';
		$content .= '<label class="post-attributes-label">Subtítulo</label><input type="text" value="" name="_box3_subtitulo" style="width:100%;padding: 10px 5px;" ><br />';
		$content .= '<p><label class="post-attributes-label">Texto</label>';
	}

	echo $content;

	//Add Text Area com Editor
	$settings = array( 'media_buttons' => false, 'tinymce' => true, 'textarea_rows'=> 6, 'media_buttons' => true );
		wp_editor( $texto, "_box3_texto", $settings );
	}

add_action( 'save_post', '_box3_save', 10, 1 );
function _box3_save ( $post_id ) {
	if( isset( $_POST['_box3_titulo'] ) ) {
		$new['titulo'] = $_POST['_box3_titulo'];
	}

	if( isset( $_POST['_box3_subtitulo'] ) ) {
		$new['subtitulo'] = $_POST['_box3_subtitulo'];
	}

	if( isset( $_POST['_box3_texto'] ) ) {
		$new['texto'] = $_POST['_box3_texto'];
	}

	if( isset( $_POST['_box3_image'] ) ) {
		$new['image'] = (int) $_POST['_box3_image'];
	}

	update_post_meta( $post_id, '_box3', $new );
}