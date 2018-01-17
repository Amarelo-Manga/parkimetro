<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<section class="container-fluid bg404">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="retangulo-amarelo">
				<h3 class="titulo-404">Página não Encontrada</h3>
				<a class="call_to_action_redondo text-dark" href="<?php echo home_url(); ?>" alt="Volte para página inicial">Volte para página inicial</a>
			</div>
		</div>
	</div>
</section>

<?php get_footer();
