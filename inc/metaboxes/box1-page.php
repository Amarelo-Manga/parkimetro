<?php
/*
 * Documentation
 * Replace "_box1" for name the metabox_box_name
 *
 * Add Metabox_example.php on the function
 * require get_template_directory() . '/metabox_example3.php';
 *
 * Add metabox-imageUpload.js on the function
 * wp_enqueue_script('metabox-imageUpload', get_template_directory_uri().'/js/metabox-imageUpload.js');
 */

add_action( 'add_meta_boxes', 'add_metabox_box1' );
function add_metabox_box1 () {
	add_meta_box( 
		'box1', // $id  
		 __( 'Box 1', 'text-domain' ),  // $title   
		'listing_box1_metabox', // $callback
		'page', // $page  
		'normal', // $context
		'high' // $priority  
	);
}

function listing_box1_metabox ( $post ) {
	global $content_width, $_wp_additional_image_sizes;
	
	$box1 = get_post_meta( $post->ID, '_box1', true );

    if( isset( $box1["texto"] ) ) {
    	$texto = $box1["texto"];
    }else{
    	$texto = "";
    }

	if ( $box1 ) {
		$image_id = $box1['image'];
    	$image_url = wp_get_attachment_url( $image_id );

		$content .= '<img src="'.$image_url.'" style="width:300px;max-height:300px;border:0;" id="upload_image1" />';
		$content .= '<p class="hide-if-no-js"><a title="Escolher Imagem" href="javascript:;" id="upload_image1_button"  data-uploader_title="Escolher Imagem" data-uploader_button_text="Escolher Imagem" class="button custom_upload_image_button">Escolher Imagem</a></p>';
		$content .= '<input type="hidden" id="upload_image1_input" name="_box1_image" value="'. $image_id .'" /><br />';

		$content .= '<p><label class="post-attributes-label">Título</label><input type="text" value="'. $box1["titulo"] .'" name="_box1_titulo" style="width:100%;padding: 10px 5px;" ></p>';


	} else {

		$content .= '<img src="" style="width:300px;max-height:300px;border:0;display:none;" id="upload_image1" />';	
		$content .= '<p class="hide-if-no-js"><a title="Escolher Imagem" href="javascript:;" id="upload_image1_button"  data-uploader_title="Escolher Imagem" data-uploader_button_text="Escolher Imagem" class="button custom_upload_image_button">Escolher Imagem</a></p>';
		$content .= '<input type="hidden" id="upload_image1_input" name="_box1_image" value="" /><br />';
		$content .= '<label class="post-attributes-label">Título</label><input type="text" value="" name="_box1_titulo" style="width:100%;padding: 10px 5px;" ><br />';
	}

	echo $content;

	//Add Text Area com Editor
	$settings = array( 'media_buttons' => false, 'tinymce' => true, 'textarea_rows'=> 6, 'media_buttons' => true, 'wpautop' => true  );
		wp_editor( $texto, "_box1_texto", $settings );
	}

add_action( 'save_post', 'box1_save', 10, 1 );
function box1_save ( $post_id ) {
	if( isset( $_POST['_box1_titulo'] ) ) {
		$new['titulo'] = $_POST['_box1_titulo'];
	}

	if( isset( $_POST['_box1_texto'] ) ) {
		$new['texto'] = $_POST['_box1_texto'];
	}

	if( isset( $_POST['_box1_image'] ) ) {
		$new['image'] = (int) $_POST['_box1_image'];
	}

	update_post_meta( $post_id, '_box1', $new );
}