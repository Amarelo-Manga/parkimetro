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
	<section id="etapa1" class="container">
		<div id="filtros"  class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 mb-3">
				<select id="bootstrapSelectEst" class="selectpicker" data-show-subtext="true" data-live-search="true">	
				<?php 
		            $args = array(
		                'posts_per_page' => -1,
		                'post_type' => 'rede'
		            );
		            $loop_rede = new WP_Query($args);
		            $count = 0;
		            while ($loop_rede->have_posts()) : $loop_rede->the_post();
		            	$muns = wp_get_post_terms( get_the_ID() , 'municipio' );
		            	$ests = wp_get_post_terms( get_the_ID() , 'estabelecimento' );
		            	$end = get_post_meta( $post->ID, 'endereco', true );
		            	$cod = get_post_meta( $post->ID, 'cod_unidade', true );

		            	$mun = "";
		            	foreach ($muns as $m) {
							$mun .= " ".$m->name;
						}

						$est = "";
		            	foreach ($ests as $e) {
							$est .= " ".$e->name;
						}
		 
		        		echo '<option value="'.$cod.'" data-subtext="'.$est.' - '.$mun .'">'.$cod.' - '.$end.'</option>';

						$count++;
		            endwhile;
		            wp_reset_query();
				?>
				</select>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 mb-3">
				<div class="">
					<h3>vagas para mensalistas</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
				</div>
			</div>
		</div>
	</section>
	<hr />
	<section id="etapa2"> 
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
			<div id="vagas">
				<?php
					// check if the repeater field has rows of data
					while ($loop_rede->have_posts()) : $loop_rede->the_post();
						$qtd = get_post_meta( $post->ID, 'quantidade-vagas', true );
						if( !empty( $qtd ) ){
							echo "Quantida de vagas do Estacionamento: " . $qtd;	
						}
						if( have_rows('tabelas-precos', $post->ID ) ):
						    while ( have_rows('tabelas-precos', $post->ID ) ) : the_row();
						    	$descricao 		= get_sub_field('descricao');
						    	$horario 		= get_sub_field('horario');
						    	$valor 			= get_sub_field('valor');
						    	echo "<ul class='".$post->ID."'>"; 
						    	echo "<li><input type='text' placeholder='QTD' /></li>";
						    	echo "<li>" . $descricao . "</li>";
						    	echo "<li>" . $horario . "</li>";
						    	echo "<li>" . $valor . "</li>";
						    	echo "</ul>";
						     endwhile;
						endif; //endif vagas
					 endwhile;//endWhile $loop_rede
				?>
			</div>
		</div>
	</section>
	<hr />
	<section id="etapa3"> 
		<div class="container">
			<form class="form-horizontal">
				<fieldset>
					<!-- Form Name -->
					<legend>Informações de Solicitação</legend>
					<!-- Multiple Checkboxes -->
					<div class="form-group">
						<label class="col-md-4 control-label" for="infos">Informações</label>
						<div class="col-md-4">
							<div class="checkbox">
								<label for="infos-0">
								<input type="checkbox" name="infos" id="infos-0" value="diurno">
								DIURNO
								</label>
							</div>
							<div class="checkbox">
								<label for="infos-1">
								<input type="checkbox" name="infos" id="infos-1" value="noturno">
								NOTURNO
								</label>
							</div>
							<div class="checkbox">
								<label for="infos-2">
								<input type="checkbox" name="infos" id="infos-2" value="24-horas">
								24 HORAS
								</label>
							</div>
							<div class="checkbox">
								<label for="infos-3">
								<input type="checkbox" name="infos" id="infos-3" value="estudante">
								ESTUDANTE
								</label>
							</div>
							<div class="checkbox">
								<label for="infos-4">
								<input type="checkbox" name="infos" id="infos-4" value="outros">
								OUTROS
								</label>
							</div>
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="nome">Nome Usuário</label>  
						<div class="col-md-4">
							<input id="nome" name="nome" type="text" placeholder="Nome Usuário" class="form-control input-md" required="">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="cpf">CPF</label>  
						<div class="col-md-4">
							<input id="cpf" name="cpf" type="text" placeholder="CPF" class="form-control input-md" required="">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="telefone">Fone</label>  
						<div class="col-md-4">
							<input id="telefone" name="telefone" type="text" placeholder="Fone" class="form-control input-md" required="">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="celuar">Celular</label>  
						<div class="col-md-4">
							<input id="celuar" name="celuar" type="text" placeholder="Celular" class="form-control input-md" required="">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="email">Email</label>  
						<div class="col-md-4">
							<input id="email" name="email" type="text" placeholder="Email" class="form-control input-md" required="">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="endereco">Endereço</label>  
						<div class="col-md-4">
							<input id="endereco" name="endereco" type="text" placeholder="Endereço" class="form-control input-md" required="">
							<span class="help-block">RUA/ AVENIDA/ TRAVESSSA - NÚMERO/BLOCO/APARTAMENTO</span>  
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="bairro">Bairro</label>  
						<div class="col-md-4">
							<input id="bairro" name="bairro" type="text" placeholder="Bairro" class="form-control input-md">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="cep">CEP</label>  
						<div class="col-md-4">
							<input id="cep" name="cep" type="text" placeholder="CEP" class="form-control input-md" required="">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="cidade">Cidade - UF</label>  
						<div class="col-md-4">
							<input id="cidade" name="cidade" type="text" placeholder="Cidade - UF" class="form-control input-md" required="">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="empresa">Empresa</label>  
						<div class="col-md-4">
							<input id="empresa" name="empresa" type="text" placeholder="Empresa" class="form-control input-md">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="fone-empresa">Fone Empresa</label>  
						<div class="col-md-4">
							<input id="fone-empresa" name="fone-empresa" type="text" placeholder="Fone Empresa" class="form-control input-md">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="ramal-empresa">Ramal Empresa</label>  
						<div class="col-md-4">
							<input id="ramal-empresa" name="ramal-empresa" type="text" placeholder="Ramal Empresa" class="form-control input-md">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="endereco-empresa">Endereço Empresa</label>  
						<div class="col-md-4">
							<input id="endereco-empresa" name="endereco-empresa" type="text" placeholder="Endereço Empresa" class="form-control input-md">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="cep-empresa">CEP Empresa</label>  
						<div class="col-md-4">
							<input id="cep-empresa" name="cep-empresa" type="text" placeholder="CEP Empresa" class="form-control input-md">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="cidade-empresa">Cidade Empresa</label>  
						<div class="col-md-4">
							<input id="cidade-empresa" name="cidade-empresa" type="text" placeholder="Cidade Empresa" class="form-control input-md">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="complemento-empresa">Complemento Empresa</label>  
						<div class="col-md-4">
							<input id="complemento-empresa" name="complemento-empresa" type="text" placeholder="Complemento Empresa" class="form-control input-md">
						</div>
					</div>
				</fieldset>
			</form>
			<form class="form-horizontal" id="veiculos">
				<div id="myRepeatingFields">
					<div class="entry input-group col-xs-3">
						<div class="col-md-3">
							<input id="placa" name="placa[]" type="text" placeholder="Placa" class="form-control" required="">
						</div>
						<div class="col-md-3">
							<input id="marca" name="marca[]" type="text" placeholder="Marca" class="form-control" required="">
							<span class="help-block">Ex: Fiat, Chevrolet, Ford...</span>  
						</div>
						<div class="col-md-3">
							<input id="modelo" name="modelo[]" type="text" placeholder="Modelo" class="form-control" required="">
							<span class="help-block">Modelo (Ônix, Fiesta, Uno ...)</span>  
						</div>
						<div class="col-md-3">
							<input id="ano" name="ano[]" type="text" placeholder="Ano" class="form-control" required="">
						</div>
						<span class="input-group-btn">
							<button type="button" class="btn btn-success btn-lg btn-add">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</button>
						</span>
					</div>
				</div>	
			</form>			
		</div>
	</section>
	<hr />
	<section id="solicitacao"> 
		<div class="container">
			<h3>Solicitação enviada com sucesso!</h3>
		</div>
	</section>
</div>
<?php get_footer();
