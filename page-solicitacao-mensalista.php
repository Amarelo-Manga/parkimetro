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
	<section id="" class="row">
		<div class="container">
			<select class="selectpicker" data-show-subtext="true" data-live-search="true">
		        <option data-subtext="Rep California">Tom Foolery</option>
		        <option data-subtext="Sen California">Bill Gordon</option>
		        <option data-subtext="Sen Massacusetts">Elizabeth Warren</option>
		        <option data-subtext="Rep Alabama">Mario Flores</option>
		        <option data-subtext="Rep Alaska">Don Young</option>
		        <option data-subtext="Rep California" disabled="disabled">Marvin Martinez</option>
	      	</select>
	      	<br /><br /><br /><br /><br />
			<?php 
	            $args = array(
	                'posts_per_page' => -1,
	                'post_type' => 'rede'
	            );
	            $loop_rede = new WP_Query($args);
	            $count = 0;
	            while ($loop_rede->have_posts()) : $loop_rede->the_post();
	            	$municipios = wp_get_post_terms( get_the_ID() , 'municipio' );
	            	$estabeleci = wp_get_post_terms( get_the_ID() , 'estabelecimento' );
	            	$endereco = get_post_meta( $post->ID, 'endereco', true );
	            	$cod_unidade = get_post_meta( $post->ID, 'cod_unidade', true );
	           ?>
	           <article class="col-lg-4 col-md-4 col-sm-12 item-rede <?php echo $class_mun; echo $class_estab; ?>">
	           		<p><?php // echo $endereco ?></p>
	           		<a href="<?php //the_permalink(); ?>" >Veja no mapa</a>
	           </article>

	        <?php
				$count++;
	            endwhile;
	            wp_reset_query();
			?>
		</div>
	</section>

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
