<?php get_header(); ?>
<!--SLIDE  -->
<section class="container-fluid fixar-top slider ">
	<div class="slider-desck">
		<?php echo do_shortcode('[smartslider3 slider=2]');?>
	</div>
	<div class="conatiner slider-mobile">
		<div class="posicionamento-slider">
			<h4 class="tituto titulo-slider-mobile">Selo Convênio</h4>
			<p class="text-white">Facilidade para você <br> e seus clientes!</p>
			<a href="<?php the_permalink(139); ?>"  class="saiba-mais">saiba mais</a>	
		</div>
		<img class="posicionamento-slider-mulher" src="<?php echo get_template_directory_uri()?>/assets/images/mulher-convenio.png" alt="Mulher com selo convênio parkímetro">
	</div>
</section>
<!--Fim Slide -->
<!--Serviços-->
<section class="container mt-5 mb-5">
	<div class="figura" style="margin-top:-9%;margin-bottom: 35px;"> 
		<img src="<?php echo get_template_directory_uri()?>/assets/images/banner.png" alt="" style="z-index: 1;">
	</div>
	<div class="row " style="flex-wrap:nowrap;">
		<div class="barraamarela pl-0 ml-3 col-lg-2 col-md-2 col-sm-2" ></div>
		<h2 class="col-lg-10 col-md-10 col-sm-10" style="width:auto"> Serviços <b class="titulo">Oferecidos</b></h2>
	</div>
	<p class="descricao mb-4">Facilidade e conforto para você e seu cliente. Conheça os serviços que o Parkímetro oferece para seu negócio.</p>
	<div class="container">
		<div class="row ">
			<div class="col-lg-6 col-md-6 col-sm-12 mb-3 servicos">
				<img class="card-img-top" src="<?php echo get_template_directory_uri()?>/assets/images/selo-convenio.jpg" alt="Selo de Convênio">
				<div class="card-body">
					<div class="d-flex justify-content-end">
						<h4 class=" text-white titulo-servicos mt-2">Selo Convênio</h4>
						<a href="<?php the_permalink(139); ?>" class=" ml-auto btn call_to_action text-dark">Ler Mais</a> 
					</div>
				</div>
			</div>
			<div class=" col-lg-6 col-md-6 col-sm-12 m-left servicos">
				<img class="card-img-top" src="<?php echo get_template_directory_uri()?>/assets/images/palno-mensal.jpg" alt="Plano Mensal">
				<div class="card-body">
					<div class="  d-flex justify-content-end">
						<h4 class="text-white titulo-servicos mt-2">Plano Mensal</h4>
						<a href="<?php the_permalink(139); ?>" class=" ml-auto btn call_to_action text-dark ">Ler Mais</a> 
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--Diferenciais -->
<section class="container-fluid">
	<div class="row">
		<div class="fundo-diferenciais col-lg-5 col-md-5 col-sm-12" style="padding: 0; border: none; height:auto; ">
			<div class=" mt-5 text-white ">
				<div class="  container ">
					<div class="row">
						<div class="col-lg-6 col-md-5 col-sm-12"></div>
						<div class="col-lg-6 col-md-7 col-sm-12 razoes">
							<div class="barraamarela pl-0 ml-2 ma-top "></div>
							<h2 class="mt-1">Razões para <br>
								<b class="titulo">Escolher a <br>
								Parkímetro</b>
							</h2>
							<p class="descricao my-5 txt-razoes">O Parkímetro possui <br>estacionamentos em diversas <br> cidades e traz conforto e <br>segurança onde você estiver. <br> Garantia de qualidade <br> para você e seu veículo, no <br> momento em que precisar!</p>
							<a href="<?php the_permalink(64); ?>" class="mb-3 mt-3 btn fundo-amarelo text-dark call_to_action_redondo">MAIS DETALHES</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-7 col-md-7" style="padding: 0;">
			<div class="fundo-diferenciais-amarelo text-white" style="height: 100%;">
				<div class="container m-container">
					<div class="row ml-2" style="flex-wrap: nowrap;">
						<div class="barrapreto pl-0 col-lg-2 col-sm-3 mt-5 ma-top "></div>
						<h2 class="mt-1 text-dark col-lg-9 col-md-8 col-sm-8 mt-5">Confira nossos <b class="titulo">Diferenciais</b>
						</h2>
					</div>
					<p class="descricao mb-5 text-dark m-txt">Detalhes que fazem toda a diferença, entenda por que cuidamos melhor do seu veículo.</p>
				</div>
				<div class="w-container">
					<div class="row ml-3">
						<!-- <div class="row ma-bot"> -->
						<div class="item col-xl-3 col-lg-6 col-md-6 col-sm-6 ">
							<img src="<?php echo get_template_directory_uri()?>/assets/images/casapng.png" alt="Tradição de mais de 30 anos no mercado">
							<p class="descricao-icon">Tradição de mais <br> de 30 anos</p>
						</div>
						<div class="item descricao col-xl-3 col-lg-6 col-md-6 col-sm-6 ">
							<img src="<?php echo get_template_directory_uri()?>/assets/images/perfil.png" alt="Rigoroso processo de seleção e recrutamento">
							<p class="descricao-icon">Rigoroso processo <br> de seleção</p>
						</div>
						<div class="item descricao col-xl-3 col-lg-6 col-md-6 col-sm-6 ">
							<img src="<?php echo get_template_directory_uri()?>/assets/images/colaboradores.png" alt="Colaboradores treinados e capacitados">
							<p class="descricao-icon">Colaboradores treinados <br>e capacitados</p>
						</div>
						<div class="item descricao col-xl-3 col-lg-6 col-md-6 col-sm-6 ">
							<img src="<?php echo get_template_directory_uri()?>/assets/images/atendimento.png" alt="Atendimento ao consumidor">
							<p class="descricao-icon">Atendimento <br> ao consumidor</p>
						</div>
						<!-- </div> -->
						<div class="row ml-3 mt-5 mb-5 w-container">
							<div class="item descricao col-xl-4 col-lg-6 col-md-6 col-sm-6 ">
								<img src="<?php echo get_template_directory_uri()?>/assets/images/profissionais.png" alt="Profissionais identificados e uniformizados">
								<p class="descricao-icon">Profissionais <br> identificados <br>e uniformizados</p>
							</div>
							<div class="item descricao col-xl-4 col-lg-6 col-md-6 col-sm-6 ">
								<img src="<?php echo get_template_directory_uri()?>/assets/images/segurança.png" alt="Segurança em primeiro lugar">
								<p class="descricao-icon">Segurança em <br>primeiro lugar</p>
							</div>
							<div class="item descricao col-xl-4 col-lg-6 col-md-12 col-sm-12 ">
								<img src="<?php echo get_template_directory_uri()?>/assets/images/cobertura.png" alt="Cobertura de acidentes através da Tokio Marine Seguros">
								<p class="descricao-icon">Cobertura <br> de acidentes <br>por Cia de Seguros</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section >
<!--Estacionamentos -->
<section class="container-fluid estacionamento">
	<div class="figura" style=" margin-top: -40px;"><img src="<?php echo get_template_directory_uri()?>/assets/images/figura-diferenciais.png" alt="" style="z-index: 1; "></div>
	<div class="row pt-5 margem">
		<div class="barraamarela "></div>
		<h2 class="text-white ml-3 margin-mobile p-left">Estacionamentos</h2>
	</div>
	<p class="descricao text-white margem1">Possuímos diversos estacionamentos espalhados por pontos importantes <br> de São Paulo e Santo André. Encontre um perto de você.</p>
	<div class="container p-bottom">
		<div class="row m-estacionamento">
			<? 
				$args = array(   
					'taxonomy' => 'estabelecimento',  
					'hide_empty' => 'true',
				); 
				$terms = get_terms($args); 
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){  
				foreach ( $terms as $term ) { 
				$termid = $term->term_id;
				$term_meta = get_option( "estabelecimento_".$termid );
				?> 
			<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 m-center" >
				<a href="<?php echo get_post_type_archive_link('rede').'#'. $term->slug ;?> ">
					<img src="<?php echo $term_meta['image']; ?>" >
					<div class="p-amarelo mb-2 fundo-amarelo text-center largura">
						<h3 class=" estacionamento-texto"><? echo $term->name ; ?></h3>
					</div>
				</a>
			</div>
			<?  } } ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>