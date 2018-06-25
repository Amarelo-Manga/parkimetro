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
		            	$idRede = $post->ID;
		            	$muns = wp_get_post_terms( get_the_ID() , 'municipio' );
		            	$ests = wp_get_post_terms( get_the_ID() , 'estabelecimento' );
		            	$end = get_post_meta( $idRede, 'endereco', true );
		            	$cod = get_post_meta( $idRede, 'cod_unidade', true );

		            	$mun = "";
		            	foreach ($muns as $m) {
							$mun .= " ".$m->name;
						}

						$est = "";
		            	foreach ($ests as $e) {
							$est .= " ".$e->name;
						}
		 
		        		echo '<option value="'.$cod.'" data-rede="'.$idRede.'" data-subtext=" - '.$est.'">'.$cod.' - '.$end.'</option>';

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
					<p>Garanta sua vaga com o nosso plano mensal. É fácil, rápido e seguro! Preencha o formulário, selecionando o estacionamento e número de vagas desejados. Nossa equipe entrará em contato para responder sua solicitação.
					Não esqueça de verificar o preço, vagas disponíveis e o horário de funcionamento de cada endereço.</p>
				</div>
				<br />
				<div class="infos">
					<h3>Login</h3>
					<form name="loginform" id="login_form" class="login_form" action="<?php echo esc_url( wp_login_url() ); ?>" method="post">
					<div class="form-group">
						<br />
						<div class="col-md-5">
							<label class="control-label" for="telefone">Email</label> 
							<input id="usuario" name="log" type="text" placeholder="Usuário" class="form-control input-md" required>
						</div>
						<div class="col-md-5">
							<label class="control-label" for="telefone">Senha</label> 
							<input id="senha" name="pwd" type="password" placeholder="Senha" class="form-control input-md" required>
						</div>
						<button name="wp-submit" id="wp-submit" class="btn"><?php _e("Entrar", "shorti"); ?></button>
						<br /><br /><br /><br /><br />
					</form>
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
					<div class="estacionamentos estacionamento-<?php echo $cod; ?>" >
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
						    	$cod_vaga 		= get_sub_field('codigo_preco_vaga');
						    	echo "<ul class='".$cod."' dataId='".$count."'>"; 
						    	echo "<li class='".$cod."'><input type='number' class='qtd-vaga' placeholder='QTD' /></li>";
						    	echo "<li class='text-".$cod."'>" . $descricao . "</li>";
						    	echo "<li class='text-".$cod."'>" . $horario . "</li>";
						    	echo "<li class='text-".$cod."'>" . $valor . "</li>";
						    	echo "<li class='text-".$cod." cod_vaga'>" . $cod_vaga . "</li>";
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
					<legend>Informações de Solicitação - Mensalista</legend>
					<!-- Text input-->
					<div class="form-group">
						<div class="col-md-8">
							<label class="control-label" for="nome">Nome do Mensalista</label> 
							<input id="nome" name="nome" type="text" placeholder="Nome do Mensalista" class="form-control input-md" required>
						</div>
						<div class="col-md-4">
							<label class="control-label" for="cpf">CPF<span> - Somente números</span></label>  
							<input id="cpf" name="cpf" type="text" maxlength="11" placeholder="CPF" value="" class="form-control input-md" required>
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">						
						<div class="col-md-5">
							<label class="control-label" for="telefone">Fone</label> 
							<input id="telefone" name="telefone" type="text" placeholder="Fone" class="form-control input-md" >
						</div>
						<div class="col-md-5">
							<label class="control-label" for="celuar">Celular</label> 
							<input id="celuar" name="celuar" type="text" placeholder="Celular" class="form-control input-md" required>
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<div class="col-md-12">
							<label>Dados de acesso:</label>
						</div>
						<div class="col-md-8">
							<label class="control-label" for="email">Email de acesso:</label>  
							<input id="email" name="email" type="email" placeholder="Email" class="form-control input-md" required>
						</div>
						<div class="col-md-4">
							<label class="control-label" for="email">Senha de acesso:</label>  
							<input id="senhauser" name="senha" type="password" class="form-control input-md" pattern="[0-9a-fA-F]{4,8}" title="Insira de 4-8 digitos entre números e letras" required>
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<div class="col-md-2">
							<label class="control-label" for="cep">CEP</label>  
							<input id="cep" name="cep" type="text" placeholder="CEP" class="form-control input-md" required>
						</div>
						<div class="col-md-10">
							<label class="control-label" for="endereco">Endereço</label>  
							<input id="endereco" name="endereco" type="text" placeholder="Endereço" class="form-control input-md" required>
							<span class="help-block">RUA/ AVENIDA/ TRAVESSSA - NÚMERO/BLOCO/APARTAMENTO</span>  
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<label class="control-label" for="bairro">Bairro</label> 
							<input id="bairro" name="bairro" type="text" placeholder="Bairro" class="form-control input-md">
						</div>
						<div class="col-md-4">
							<label class="control-label" for="cidade">Cidade</label> 
							<input id="cidade" name="cidade" type="text" placeholder="Cidade" class="form-control input-md" required>
						</div>
						<div class="col-md-3">
							<label class="control-label" for="estado">Estado</label> 
							<select name="estado" id="estado" class="form-control input-md">
								<option selected="" value="">Selecione o Estado (UF)</option>
								<option value="AC">Acre</option>
								<option value="AL">Alagoas</option>
								<option value="AP">Amapá</option>
								<option value="AM">Amazonas</option>
								<option value="BA">Bahia</option>
								<option value="CE">Ceará</option>
								<option value="DF">Distrito Federal</option>
								<option value="ES">Espírito Santo</option>
								<option value="GO">Goiás</option>
								<option value="MA">Maranhão</option>
								<option value="MT">Mato Grosso</option>
								<option value="MS">Mato Grosso do Sul</option>
								<option value="MG">Minas Gerais</option>
								<option value="PA">Pará</option>
								<option value="PB">Paraíba</option>
								<option value="PR">Paraná</option>
								<option value="PE">Pernambuco</option>
								<option value="PI">Piauí</option>
								<option value="RJ">Rio de Janeiro</option>
								<option value="RN">Rio Grande do Norte</option>
								<option value="RS">Rio Grande do Sul</option>
								<option value="RO">Rondônia</option>
								<option value="RR">Roraima</option>
								<option value="SC">Santa Catarina</option>
								<option value="SP">São Paulo</option>
								<option value="SE">Sergipe</option>
								<option value="TO">Tocantins</option>
							</select>
						</div>
					</div>
					<!-- Text input-->
		
					<legend>Informações de Solicitação - Empresa </legend>
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
						<div class="col-md-2">
							<label class="control-label" for="cep-empresa">CEP Empresa</label>  
							<input id="cep-empresa" name="cep-empresa" type="text" placeholder="CEP Empresa" class="form-control input-md">
						</div>
						<div class="col-md-10">
							<label class="control-label" for="endereco-empresa">Endereço Empresa</label>
							<input id="endereco-empresa" name="endereco-empresa" type="text" placeholder="Endereço Empresa" class="form-control input-md">
						</div>
					
					</div>
					<!-- Text input-->
					<div class="form-group">
						<div class="col-md-8">
							<label class="control-label" for="complemento-empresa">Complemento Empresa</label> 
							<input id="complemento-empresa" name="complemento-empresa" type="text" placeholder="Complemento Empresa" class="form-control input-md">
						</div>
						<div class="col-md-4">
							<label class="control-label" for="cidade-empresa">Cidade Empresa</label>
							<input id="cidade-empresa" name="cidade-empresa" type="text" placeholder="Cidade Empresa" class="form-control input-md">
						</div>
					</div>
				</fieldset>
				<legend>Informações de Solicitação - Veículo</legend>
				<div id="myRepeatingFields">
					<div id="veiculos" class="entry input-group col-xs-3">
						<div class="col-md-3">
							<input id="placa" name="placa[]" type="text" pattern="[a-fA-F0-9]{3,4}" placeholder="Placa" class="form-control" required>
							<span class="help-block">Ex: ABC-1234</span>  
						</div>
						<div class="col-md-3">
							<input id="marca" name="marca[]" type="text" placeholder="Marca" class="form-control" required>
							<span class="help-block">Ex: Fiat, Chevrolet, Ford...</span>  
						</div>
						<div class="col-md-3">
							<input id="modelo" name="modelo[]" type="text" placeholder="Modelo" class="form-control" required>
							<span class="help-block">Modelo (Ônix, Fiesta, Uno ...)</span>  
						</div>
						<div class="col-md-3">
							<input id="ano" name="ano[]" type="text" placeholder="Ano" class="form-control" required>
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
					<input type="hidden" value="" id="id_unidade" name="id_unidade">
					<!-- Vagas -->
				</div>	
			</form>	
			<a href="#" class="btn-passo3 btn-passo">Próximo passso</a>
			<img src="http://www.parkimetro.com.br/wp-content/themes/parkimetro/assets/images/ajax6.gif" class="ajaxgif">		
		</div>
	</section>

	<section id="etapa4" class="etapa"> 
		<div class="container">
			<h3>Solicitação enviada com sucesso!</h3>
			<p>Nossa equipe irá avaliar seu pedido e entrará em contato.</p>
			<p>
				<a href="http://www.parkimetro.com.br" alt="Home Parkimetro" title="Home Parkimetro">Voltar para Home</a>
				<a href="http://www.parkimetro.com.br/solicitacao-mensalista" alt="Solicitação Mensalista Parkimetro" title="Solicitação Mensalista Parkimetro">Nova Solicitação</a>
			</p>
		</div>
	</section>
</div>
<?php get_footer();
