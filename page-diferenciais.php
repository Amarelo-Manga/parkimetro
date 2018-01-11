 <?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * Template name: Diferenciais
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(" container diferenciais"); ?>>
	<div class="row">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php twentyseventeen_edit_link( get_the_ID() ); ?>
			<div class="entry-content col-6">
				<?php
					the_content();
				?>
			</div><!-- .entry-content -->
		</header><!-- .entry-header -->
	</div>
	<?php
		$box1 = get_post_meta( $post->ID, '_box1', true );
		$image_id = $box1['image'];
		$image_url = wp_get_attachment_url( $image_id );
		$titulo = $box1['titulo'];
		$texto = $box1['texto'];
		if( !empty( $box1 ) ){
	?>
	<div class="row">
		<div class="col-6">
			<img src="<?php echo $image_url; ?>" title="<?php echo $titulo; ?>" alt="<?php echo $titulo; ?>">
		</div>
		<div id="box1" class="col-6">
			<?php echo $texto; ?>
		</div>
	</div>
	<?php 
		}//End If Box1
		$box2 = get_post_meta( $post->ID, '_box2', true );
		if( !empty( $box2 ) ){
	?>
	<div class="row">
		<?php 
			$image_id = $box2['image'];
			$image_url = wp_get_attachment_url( $image_id );
			$titulo = $box2['titulo'];
			$texto = $box2['texto'];
		?>
		<div id="box2" class="col-6">
			<h4><?php echo $titulo; ?></h4>
			<?php echo $texto; ?>
		</div>
		<div class="col-6" >
			<img src="<?php echo $image_url; ?>" title="<?php echo $titulo; ?>" alt="<?php echo $titulo; ?>">
		</div>
	</div>
	<?php 
		}//end if box2 and box3
	?>

</article><!-- #post-## -->

	<?php 
		//Galeria Clientes
		$images = get_post_meta( $post->ID, 'repeatable_images', true );
		if(! empty($images) ){
			$count = count( $images );
	?>
	<div id="clientes">
		<div class="container">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			  	<div class="carousel-inner">
			  		<?php
			  			for ($i = 0; $i < $count; $i++) {
			  					
			  				$url_image = wp_get_attachment_url( $images[$i]['images'] ); 
			  				$active = ( $i==0 ? 'active' : '' );

			  				if( ($i % 4 ) == 0 ){
			  					echo '<div class="carousel-item row '.$active.'">';
			  				}
			  				echo '<div class="image-item col-2">';
				  			echo '<img src="'.$url_image.'" alt="First slide" data-toggle="modal" data-target="#modal'.$images[$i]['images'].'">';
				  			echo '</div>';

				  			if( ($i % 4 ) == 3 ){
				  				echo '</div>';
				  			}
			  			}
			  		?>
			    </div>
			  	<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			    	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    	<span class="sr-only">Previous</span>
			  	</a>
			  	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			    	<span class="carousel-control-next-icon" aria-hidden="true"></span>
			    	<span class="sr-only">Next</span>
			  	</a>
			  	<?php 
			  		for ($i = 0; $i < $count; $i++) {
			  			$url_image = wp_get_attachment_url( $images[$i]['images'] ); 
			  			$content = '<div class="modal fade" id="modal'.$images[$i]['images'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
			  			$content .=  '<div class="modal-dialog" role="document">';
			  			$content .=  '<div class="modal-content">';
				  		$content .=  '<div class="modal-body">';
				  		$content .=  '<img class="col-4" src="'.$url_image.'" alt="First slide" >';
				  		$content .=  '</div>';	
				  		$content .=  '</div>';
			  			$content .=  '</div>';
			  			$content .=  '</div>';

			  			echo $content;
			  		}
			  	?>
			</div>
		</div>
	</div>
	<?php }//end if repeatable ?>

<?php get_footer();
