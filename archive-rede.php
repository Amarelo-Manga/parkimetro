<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="container">
	<header class="row">
		<div class="col-lg-6 col-md-6 col-sm-12">
			<h3>Principais pontos em operação</h3>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12">
			<p>Clique no endereço de nossos estacionamentos e encontre uma <br> unidade perto de você.</p>
		</div>
	</header><!-- .page-header -->
	<section id="filtros" class="row">
		<?php 
			$municipios =  get_terms( array( 'post_types' => 'rede', 'taxonomy' => 'municipio' ) );
			$estabelecimentos =  get_terms( array( 'post_types' => 'rede', 'taxonomy' => 'estabelecimento' ) );
		?>
		<div class="col-lg-4 col-md-4 col-sm-12 mb-municipio">
			<p>Selecione o município</p>
			<select id="select_municipio">
				<option value="all">Selecione</option>
				<?php
					foreach ($municipios as $mun) {
						echo "<option value='".$mun->slug."'>". $mun->name."</option>";
					}
				?>
			</select>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-12 mb-estabelecimento">
			<p>Selecione o estabelecimento</p>
			<select  id="select_estabelecimento">
				<option value="all">Selecione</option>
				<?php
					foreach ($estabelecimentos as $est) {
						echo "<option value='". $est->slug."'>". $est->name."</option>";
					}
				?>
			</select>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-12 mb-busca">
			<p>Buscar</p>
			<input type="search" value="" id="filterSearch" placeholder="Digite aqui" >	
 		</div>
	</section>
	<section id="artigos" class="row">
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

            	$class_mun = "";
            	foreach ($municipios as $mun) {
					$class_mun .= " ".$mun->slug;
				}

				$class_estab = "";
            	foreach ($estabeleci as $est) {
					$class_estab .= " ".$est->slug;
				}
           ?>
           <article class="col-lg-4 col-md-4 col-sm-12 item-rede <?php echo $class_mun; echo $class_estab; ?>">
           		<p><?php echo $endereco ?></p>
           		<a href="<?php the_permalink(); ?>" >Veja no mapa</a>
           </article>

        <?php
			$count++;
            endwhile;
            wp_reset_query();
		?>
		
	</section>
</div><!-- .contanier -->

<?php get_footer();
