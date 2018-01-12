 <?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * Template name: Servicos
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<article id="servico" <?php post_class(" container diferenciais"); ?>>
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
		<div id="box1" class="col-6 box">
			<img src="<?php echo $image_url; ?>" title="<?php echo $titulo; ?>" alt="<?php echo $titulo; ?>">
			<h3><?php echo $titulo; ?></h3>
			<div class="texto">
				<?php echo $texto; ?>
			</div>
		</div>
	<?php 
		}//End If Box1
		$box2 = get_post_meta( $post->ID, '_box2', true );
		if( !empty( $box2 ) ){
	?>
		<?php 
			$image_id = $box2['image'];
			$image_url = wp_get_attachment_url( $image_id );
			$titulo = $box2['titulo'];
			$texto = $box2['texto'];
		?>
		<div id="box2" class="col-6 box">
			<img src="<?php echo $image_url; ?>" title="<?php echo $titulo; ?>" alt="<?php echo $titulo; ?>">
			<h3><?php echo $titulo; ?></h3>
			<div class="texto">
			<?php echo $texto; ?>
			</div>
		</div>
	</div>
	<?php 
		}//end if box2 and box3
	?>

</article><!-- #post-## -->

<?php get_footer();
