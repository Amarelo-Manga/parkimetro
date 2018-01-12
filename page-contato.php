 <?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * Template name: Contato
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<article id="contato" <?php post_class(" container diferenciais"); ?>>
	<div class="row">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php twentyseventeen_edit_link( get_the_ID() ); ?>
		</header><!-- .entry-header -->
	</div>
	
	<div class="row">
		<div class="entry-content col-8">
			<?php
				the_content();
			?>
		</div><!-- .entry-content -->
		<?php
			$box1 = get_post_meta( $post->ID, '_box1', true );
			$image_id = $box1['image'];
			$image_url = wp_get_attachment_url( $image_id );
			$titulo = $box1['titulo'];
			$texto = $box1['texto'];
		?>
		<div id="box1" class="col-4">
			<h3><?php echo $titulo; ?></h3>
			<div class="texto">
				<?php echo $texto; ?>
			</div>
		</div>
	</div>
</article><!-- #post-## -->

<?php get_footer();
