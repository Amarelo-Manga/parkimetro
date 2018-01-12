<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * Template name: Sobre nós
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(" container"); ?>>
	<div class="row">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php twentyseventeen_edit_link( get_the_ID() ); ?>
		</header><!-- .entry-header -->
		<div class="entry-content col-6">
			<?php
				the_content();
			?>
		</div><!-- .entry-content -->
		<div class="col-6">
			<?php 
				the_post_thumbnail();
			?>
		</div>
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
		<div id="box1"  class="col-6">
			<h3><?php echo $titulo; ?></h3>
			<?php echo $texto; ?>
		</div>
	</div>
	<?php 
		}//End If Box1
		$box2 = get_post_meta( $post->ID, '_box2', true );
		$box3 = get_post_meta( $post->ID, '_box3', true );
		if( !empty( $box2 ) || !empty( $box3 ) ){
	?>
	<div class="row">
		<?php 
			$image_id = $box2['image'];
			$image_url = wp_get_attachment_url( $image_id );
			$titulo = $box2['titulo'];
			$subtitulo = $box2['subtitulo'];
			$texto = $box2['texto'];
		?>
		<div id="box2" class="col-6" style="background:url(<?php echo $image_url; ?>)">
			<h4><?php echo $titulo; ?></h4>
			<h3><?php echo $subtitulo; ?></h3>
		
			<?php echo $texto; ?>
		</div>

		<?php 
			$image_id = $box3['image'];
			$image_url = wp_get_attachment_url( $image_id );
			$titulo = $box3['titulo'];
			$texto = $box3['texto'];
		?>
		<div id="box3" class="col-6">
			<h3><?php echo $titulo; ?></h3>
			<?php echo $texto; ?>
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
			  				$active = ( $i==0 ? ' active' : '' );

			  				if( ($i % 4 ) == 0 ){
			  					echo '<div class="carousel-item row '.$active.'">';
			  				}
			  				echo '<div class="image-item col-3">';
				  			echo '<img src="'.$url_image.'" alt="First slide">';
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
			</div>
		</div>
	</div>
	<?php }//end if repeatable ?>

<?php get_footer();
