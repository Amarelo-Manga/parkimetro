<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * Template name: Solicitação Mensalista
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
get_header(); ?>
<div id="solicitacao">
	<section id="breadcrumb">
		<div class="container">
			<a href="#">Escolha uma unidade</a>
			<a href="#">Escolha valor e horário</a>
			<a href="#">Preencher dados</a>
			<a href="#">Solicitação de vaga concluída</a>
		</div>
	</section>

	<article id="post-<?php the_ID(); ?>" <?php post_class("sobrenos container"); ?>>
		<div class="row ">
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php twentyseventeen_edit_link( get_the_ID() ); ?>
			</header><!-- .entry-header -->
			<div class="col-lg-6 col-md-6 col-sm-12">
				<select>
					<option>Teste</option>
				</select>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div id="conteudo">
					<?php
						the_content();
					?>
				</div><!-- .entry-content -->
			</div>
		</div>
	</article><!-- #post-## -->
	<section id="unidade"> 
		<div class="container">
			<h3>COD - UNIDADE XPTO</h3>
			<p>Selecione abaixo a vaga desejada nesta unidade e escolha a quantidade de vagas necessárias</p>
			<div id="lista">
				<ul>
					<li>QTD</li>
					<li>Descrição</li>
					<li>Horario</li>
					<li>Valor</li>
				</ul>
			</div>
		</div>
	</section>
	<section id="form"> 
		<div class="container">
			<?php
				$box1 = get_post_meta( $post->ID, '_box1', true );
				$titulo = $box1['titulo'];
				$texto = $box1['texto'];
			?>
			<?php 
				echo apply_filters('the_content', $texto);
			?>
		</div>
	</section>
	<section id="solicitacao"> 
		<div class="container">
			<h3>Solicitação enviada com sucesso!</h3>
		</div>
	</section>
</div>
<?php get_footer();
