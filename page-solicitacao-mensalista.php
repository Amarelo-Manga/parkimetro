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
			<a href="#" class="active">Escolha uma unidade <i class="fa fa-caret-right" aria-hidden="true"></i><i class="fa fa-angle-right" aria-hidden="true"></i></a>
			<a href="#" class="escolha-horario">Escolha valor e horário <i class="fa fa-caret-right" aria-hidden="true"></i><i class="fa fa-angle-right" aria-hidden="true"></i></a>
			<a href="#" class="preencher-dados">Preencher dados <i class="fa fa-caret-right" aria-hidden="true"></i><i class="fa fa-angle-right" aria-hidden="true"></i></a>
			<a href="#" class="concluir">Solicitação de vaga concluída <i class="fa fa-caret-right" aria-hidden="true"></i><i class="fa fa-angle-right" aria-hidden="true"></i></a>
		</div>
	</section>
	<section id="etapa1" class="container etapa">
		<div id="filtros"  class="row">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<h3>
					Escolha a unidade desejada e verifique<br />a disponibilidade de vagas e horários.
				</h3>
				<select id="bootstrapSelectEst" class="selectpicker" data-show-subtext="true" data-live-search="true">
				<option value="">Escolha o Estacionamento</option>
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
		 
		        		echo '<option value="'.$post->ID.'" data-subtext=" - '.$est.'">'.$cod.' - '.$end.'</option>';

						$count++;
		            endwhile;
		            wp_reset_query();
				?>
				</select>
				<a href="#" class="btn-passo1 btn-passo">Próximo passso</a>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="infos">
					<h3>Vagas para mensalistas</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
				</div>
				<br />
				<div class="infos">
					<h3>Login</h3>
					<div class="form-group">
						<br />
						<div class="col-md-5">
							<label class="control-label" for="telefone">Usuário</label> 
							<input id="usuario" name="usuario" type="text" placeholder="Fone" class="form-control input-md" required="">
						</div>
						<div class="col-md-5">
							<label class="control-label" for="telefone">Senha</label> 
							<input id="senha" name="senha" type="password" placeholder="senha" class="form-control input-md" required="">
						</div>
						<br /><br /><br /><br /><br />
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="etapa2" class="etapa"> 
		<div class="container">
			<div id="vagas">
				<?php
					//Use Count for dataId inputs qtd vagas
					$count = 1; 
					// check if the repeater field has rows of data
					while ($loop_rede->have_posts()) : $loop_rede->the_post();
						$qtd = get_post_meta( $post->ID, 'quantidade-vagas', true );
						$end = get_post_meta( $post->ID, 'endereco', true );
		            	$cod = get_post_meta( $post->ID, 'cod_unidade', true );
				?>
					<div class="estacionamentos estacionamento-<?php echo $post->ID; ?>" >
						<h3><?php echo $cod .' - ' . $end; ?></h3>
						<p>Selecione abaixo a vaga desejada nesta unidade e escolha a quantidade de vagas necessárias</p>
					<?php 
						if( !empty( $qtd ) ){
							echo "<h4> Quantidade de vagas do Estacionamento: " . $qtd ."</h4>";	
					?>
						<ul class="lista">
							<li>Quantidade</li><li>Descrição</li><li>Horário</li><li>Valor</li>
						</ul>
					<?php
						}//EndIf Empty QTD
						if( have_rows('tabelas-precos', $post->ID ) ):
						    while ( have_rows('tabelas-precos', $post->ID ) ) : the_row();
						    	$descricao 		= get_sub_field('descricao');
						    	$horario 		= get_sub_field('horario');
						    	$valor 			= get_sub_field('valor');
						    	$postId 		= $post->ID;
						    	echo "<ul class='".$postId."' dataId='".$count."'>"; 
						    	echo "<li class='".$postId."'><input type='number' class='qtd-vaga' placeholder='QTD' /></li>";
						    	echo "<li class='text-".$postId."'>" . $descricao . "</li>";
						    	echo "<li class='text-".$postId."'>" . $horario . "</li>";
						    	echo "<li class='text-".$postId."'>" . $valor . "</li>";
						    	echo "</ul>";
						    	$count++;
						     endwhile;
						endif; //endif vagas
					?>
					</div>
				<?php 
					 endwhile;//endWhile $loop_rede
				?>
				<a href="#" class="btn-passo2 btn-passo">Próximo passso</a>
			</div>
		</div>
	</section>

	<section id="etapa3" class="etapa"> 
		<div class="container">
			<form class="form-horizontal" id="mensalista-form">
				<fieldset>
					<!-- Form Name -->
					<legend>Informações de Solicitação</legend>
					<!-- Multiple Checkboxes -->
					<div class="form-group">
						<label class="col-md-12 control-label" for="infos">Informações</label>
						<div class="col-md-12">
							<div class="checkbox">
								<label for="infos-0">
								<input type="checkbox" name="infos[]" id="infos-0" value="diurno">
								DIURNO
								</label>
							</div>
							<div class="checkbox">
								<label for="infos-1">
								<input type="checkbox" name="infos[]" id="infos-1" value="noturno">
								NOTURNO
								</label>
							</div>
							<div class="checkbox">
								<label for="infos-2">
								<input type="checkbox" name="infos[]" id="infos-2" value="24-horas">
								24 HORAS
								</label>
							</div>
							<div class="checkbox">
								<label for="infos-3">
								<input type="checkbox" name="infos[]" id="infos-3" value="estudante">
								ESTUDANTE
								</label>
							</div>
							<div class="checkbox">
								<label for="infos-4">
								<input type="checkbox" name="infos[]" id="infos-4" value="outros">
								OUTROS
								</label>
							</div>
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<div class="col-md-8">
							<label class="control-label" for="nome">Nome Usuário</label> 
							<input id="nome" name="nome" type="text" placeholder="Nome Usuário" class="form-control input-md" required="">
						</div>
						<div class="col-md-4">
							<label class="control-label" for="cpf">CPF</label>  
							<input id="cpf" name="cpf" type="text" placeholder="CPF" class="form-control input-md" required="">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">						
						<div class="col-md-5">
							<label class="control-label" for="telefone">Fone</label> 
							<input id="telefone" name="telefone" type="text" placeholder="Fone" class="form-control input-md" required="">
						</div>
						<div class="col-md-5">
							<label class="control-label" for="celuar">Celular</label> 
							<input id="celuar" name="celuar" type="text" placeholder="Celular" class="form-control input-md" required="">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label" for="email">Email</label>  
							<input id="email" name="email" type="email" placeholder="Email" class="form-control input-md" required="">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label" for="endereco">Endereço</label>  
							<input id="endereco" name="endereco" type="text" placeholder="Endereço" class="form-control input-md" required="">
							<span class="help-block">RUA/ AVENIDA/ TRAVESSSA - NÚMERO/BLOCO/APARTAMENTO</span>  
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<label class="control-label" for="cep">CEP</label>  
							<input id="cep" name="cep" type="text" placeholder="CEP" class="form-control input-md" required="">
						</div>
						<div class="col-md-4">
							<label class="control-label" for="bairro">Bairro</label> 
							<input id="bairro" name="bairro" type="text" placeholder="Bairro" class="form-control input-md">
						</div>
						<div class="col-md-4">
							<label class="control-label" for="cidade">Cidade - UF</label> 
							<input id="cidade" name="cidade" type="text" placeholder="Cidade - UF" class="form-control input-md" required="">
						</div>
					</div>
					<!-- Text input-->
		
					<legend>Informações de Solicitação - Empresa</legend>
					<!-- Text input-->
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label" for="empresa">Empresa</label> 
							<input id="empresa" name="empresa" type="text" placeholder="Empresa" class="form-control input-md">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<div class="col-md-5">
							<label class="control-label" for="fone-empresa">Fone Empresa</label>  
							<input id="fone-empresa" name="fone-empresa" type="text" placeholder="Fone Empresa" class="form-control input-md">
						</div>
						<div class="col-md-4">
							<label class="control-label" for="ramal-empresa">Ramal Empresa</label> 
							<input id="ramal-empresa" name="ramal-empresa" type="text" placeholder="Ramal Empresa" class="form-control input-md">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label" for="endereco-empresa">Endereço Empresa</label>
							<input id="endereco-empresa" name="endereco-empresa" type="text" placeholder="Endereço Empresa" class="form-control input-md">
						</div>
						<div class="col-md-12">
							<label class="control-label" for="complemento-empresa">Complemento Empresa</label> 
							<input id="complemento-empresa" name="complemento-empresa" type="text" placeholder="Complemento Empresa" class="form-control input-md">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<div class="col-md-4">
							<label class="control-label" for="cep-empresa">CEP Empresa</label>  
							<input id="cep-empresa" name="cep-empresa" type="text" placeholder="CEP Empresa" class="form-control input-md">
						</div>
						<div class="col-md-4">
							<label class="control-label" for="cidade-empresa">Cidade Empresa</label>
							<input id="cidade-empresa" name="cidade-empresa" type="text" placeholder="Cidade Empresa" class="form-control input-md">
						</div>
					</div>
				</fieldset>
				<legend>Informações de Solicitação - Veiculo</legend>
				<div id="myRepeatingFields">
					<div id="veiculos" class="entry input-group col-xs-3">
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
				<div id="vagas-mensalista">
					<input type="hidden" value="" id="unidade_escolhida_id" name="unidade_escolhida_id">
					<input type="hidden" value="" id="unidade_escolhida_endereco" name="unidade_escolhida_endereco">
					<!-- Vagas -->
				</div>	
			</form>	
			<a href="#" class="btn-passo3 btn-passo">Próximo passso</a>		
		</div>
	</section>

	<section id="etapa4" class="etapa"> 
		<div class="container">
			<h3>Solicitação enviada com sucesso!</h3>
			<p>Nossa equipe irá avaliar seu pedido e entrará em contato.</p>
		</div>
	</section>
</div>
<?php get_footer();
