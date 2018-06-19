<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * Template name: Editar Mensalista
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
get_header(); ?>
<?php 
	//Valida User Logado e se o user é um mensalista
	// Redirect para Solicitação Mensalista
	$role = $current_user->roles[0];
	if( $role != 'mensalista-user'){
		wp_redirect( get_permalink(213) ); exit; 
	}
?>
<div id="editar_mensalista">
	<section id="breadcrumb">
		<div class="container">
			<a href="#" class="active">Meus Dados <i class="fa fa-caret-right" aria-hidden="true"></i><i class="fa fa-angle-right" aria-hidden="true"></i></a>
			<a href="<?php echo wp_logout_url(); ?>" class="active sair">Sair</a>
		</div>
	</section>
	<section id="etapa3"> 
		<?php
		    $args = array(
			  	'author'         => $current_user->ID,
			  	'post_type'      => 'mensalista', 
			  	'orderby'        => 'post_date',
			  	'order'          => 'ASC',
			  	'posts_per_page' => 1 // no limit
			);
			$current_user_post = get_posts( $args );
			$postId = $current_user_post[0]->ID;

		    $nome_usuario = get_post_meta( $postId, 'nome_usuario', true );
		    $cpf = get_post_meta( $postId, 'cpf', true );
		    $fone = get_post_meta( $postId, 'fone', true );
		    $celular = get_post_meta( $postId, 'celular', true );
		    $email = get_post_meta( $postId, 'email', true );
		    $endereco = get_post_meta( $postId, 'endereco', true );
		    $cep = get_post_meta( $postId, 'cep', true );
		    $bairro = get_post_meta( $postId, 'bairro', true );
		    $cidade_uf = get_post_meta( $postId, 'cidade_uf', true );

		    $empresa = get_post_meta( $postId, 'empresa', true );
		    $fone_empresa = get_post_meta( $postId, 'fone_empresa', true );
		    $ramal_empresa = get_post_meta( $postId, 'ramal_empresa', true );
		    $endereco_empresa = get_post_meta( $postId, 'endereco_empresa', true );
		    $complemento_empresa = get_post_meta( $postId, 'complemento_empresa', true );
		    $cep_empresa = get_post_meta( $postId, 'cep_empresa', true );
		    $cidade_empresa =get_post_meta( $postId, 'cidade_empresa', true );

			$unidade_escolhida_id = get_post_meta( $postId, 'unidade_escolhida_id', true );
			$unidade_escolhida_endereco = get_post_meta( $postId, 'unidade_escolhida_endereco', true );
			$quantidade = get_post_meta( $postId, 'quantidade', true );
			$descricao  = get_post_meta( $postId, 'descricao', true );
			$horario    = get_post_meta( $postId, 'horario', true );
			$valor      = get_post_meta( $postId, 'valor', true );
		?>

		<div class="container">
			<form class="form-horizontal" id="mensalista-form">
				<fieldset>
					<!-- Text input-->
					<div class="form-group">
						<div class="col-md-8">
							<label class="control-label" for="nome">Nome Usuário</label> 
							<input id="nome" name="nome" type="text" placeholder="Nome Usuário" class="form-control input-md" required value="<?php echo $nome_usuario; ?>">
						</div>
						<div class="col-md-4">
							<label class="control-label" for="cpf">CPF</label>  
							<input id="cpf" name="cpf" type="text" placeholder="CPF" class="form-control input-md"  value="<?php echo $cpf; ?>" required>
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">						
						<div class="col-md-5">
							<label class="control-label" for="telefone">Fone</label> 
							<input id="telefone" name="telefone" type="text" placeholder="Fone"  value="<?php echo $fone; ?>" class="form-control input-md" required>
						</div>
						<div class="col-md-5">
							<label class="control-label" for="celuar">Celular</label> 
							<input id="celuar" name="celuar" type="text" placeholder="Celular"  value="<?php echo $celular; ?>" class="form-control input-md" required>
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label" for="email">Email</label>  
							<input id="email" name="email" type="email" placeholder="Email" value="<?php echo $email; ?>" class="form-control input-md" required>
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label" for="endereco">Endereço</label>  
							<input id="endereco" name="endereco" type="text" placeholder="Endereço"  value="<?php echo $endereco; ?>" class="form-control input-md" required>
							<span class="help-block">RUA/ AVENIDA/ TRAVESSSA - NÚMERO/BLOCO/APARTAMENTO</span>  
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<label class="control-label" for="cep">CEP</label>  
							<input id="cep" name="cep" type="text" placeholder="CEP"  value="<?php echo $cep; ?>" class="form-control input-md" required>
						</div>
						<div class="col-md-4">
							<label class="control-label" for="bairro">Bairro</label> 
							<input id="bairro" name="bairro" type="text" placeholder="Bairro" value="<?php echo $bairro; ?>" class="form-control input-md">
						</div>
						<div class="col-md-4">
							<label class="control-label" for="cidade">Cidade - UF</label> 
							<input id="cidade" name="cidade" type="text" placeholder="Cidade - UF"  value="<?php echo $cidade_uf; ?>" class="form-control input-md" required>
						</div>
					</div>
					<!-- Text input-->
		
					<legend>Informações de Solicitação - Empresa</legend>
					<!-- Text input-->
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label" for="empresa">Empresa</label> 
							<input id="empresa" name="empresa" type="text"  value="<?php echo $empresa; ?>" placeholder="Empresa" class="form-control input-md">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<div class="col-md-5">
							<label class="control-label" for="fone-empresa">Fone Empresa</label>  
							<input id="fone-empresa" name="fone-empresa" type="text"  value="<?php echo $fone_empresa; ?>" placeholder="Fone Empresa" class="form-control input-md">
						</div>
						<div class="col-md-4">
							<label class="control-label" for="ramal-empresa">Ramal Empresa</label> 
							<input id="ramal-empresa" name="ramal-empresa" type="text" placeholder="Ramal Empresa"  value="<?php echo $ramal_empresa; ?>" class="form-control input-md">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label" for="endereco-empresa">Endereço Empresa</label>
							<input id="endereco-empresa" name="endereco-empresa" type="text"  value="<?php echo $endereco_empresa; ?>" placeholder="Endereço Empresa" class="form-control input-md">
						</div>
						<div class="col-md-12">
							<label class="control-label" for="complemento-empresa">Complemento Empresa</label> 
							<input id="complemento-empresa" name="complemento-empresa" type="text"  value="<?php echo $complemento_empresa; ?>" placeholder="Complemento Empresa" class="form-control input-md">
						</div>
					</div>
					<!-- Text input-->
					<div class="form-group">
						<div class="col-md-4">
							<label class="control-label" for="cep-empresa">CEP Empresa</label>  
							<input id="cep-empresa" name="cep-empresa" type="text"  value="<?php echo $cep_empresa; ?>" placeholder="CEP Empresa" class="form-control input-md">
						</div>
						<div class="col-md-4">
							<label class="control-label" for="cidade-empresa">Cidade Empresa</label>
							<input id="cidade-empresa" name="cidade-empresa" type="text" placeholder="Cidade Empresa"  value="<?php echo $cidade_empresa; ?>" class="form-control input-md">
						</div>
					</div>
				</fieldset>
				<legend>Informações de Solicitação - Veiculo</legend>
				<div id="myRepeatingFields">
					<?php
						if( have_rows('veiculo', $postId ) ):
						    while ( have_rows('veiculo', $postId ) ) : the_row();
						    	$placa = get_sub_field('placa');
								$marca = get_sub_field('marca');
								$modelo = get_sub_field('modelo');
								$ano = get_sub_field('ano');
					?>
					<div id="veiculos" class="entry input-group col-xs-3">
						<div class="col-md-3">
							<input id="placa" name="placa[]" type="text" placeholder="Placa" value="<?php echo $placa; ?>" class="form-control" required>
						</div>
						<div class="col-md-3">
							<input id="marca" name="marca[]" type="text" placeholder="Marca" value="<?php echo $marca; ?>" class="form-control" required>
							<span class="help-block">Ex: Fiat, Chevrolet, Ford...</span>  
						</div>
						<div class="col-md-3">
							<input id="modelo" name="modelo[]" type="text" placeholder="Modelo" value="<?php echo $modelo; ?>" class="form-control" required>
							<span class="help-block">Modelo (Ônix, Fiesta, Uno ...)</span>  
						</div>
						<div class="col-md-3">
							<input id="ano" name="ano[]" type="text" placeholder="Ano" value="<?php echo $ano; ?>" class="form-control" required>
						</div>
						<span class="input-group-btn">
							<button type="button" class="btn btn-success btn-lg btn-add">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</button>
						</span>
					</div>
					<?php 
						    endwhile;
						endif; //endif veiculo
					?>
				</div>
				<br /><br />
				<label>Para alterar as informações de vaga envie um email para contato@parkimetro.com.br, com assunto: Alteração de vaga.</label>
				<legend>Informações de Solicitação - VAGA/s</legend>
				<div id="vagas-mensalista">
					<input type="hidden" value="<?php echo $unidade_escolhida_id; ?>" id="unidade_escolhida_id" name="unidade_escolhida_id" disabled>
					<input type="text" value="<?php echo $unidade_escolhida_endereco; ?>" id="unidade_escolhida_endereco" name="unidade_escolhida_endereco" disabled>
					<ul class="lista">
						<li>Quantidade</li><li>Descrição</li><li>Horário</li><li>Valor</li>
					</ul>
					<!-- Vagas -->
					<?php
						if( have_rows('vagas_mensalista', $postId ) ):
						    while ( have_rows('vagas_mensalista', $postId ) ) : the_row();
						    	$quantidade = get_sub_field('quantidade');
								$descricao = get_sub_field('descricao');
								$horario = get_sub_field('horario');
								$valor = get_sub_field('valor');
					?>
					<ul>
						<li><input type="text" value="<?php echo $quantidade;?>" id="quantidade" name="quantidade[]" disabled></li>
						<li><input type="text" value="<?php echo $descricao;?>" id="descricao" name="descricao[]" disabled></li>
						<li><input type="text" value="<?php echo $horario;?>" id="horario" name="horario[]" disabled></li>
						<li><input type="text" value="<?php echo $valor;?>" id="valor" name="valor[]" disabled></li>
					</ul>
					<?php 
						    endwhile;
						endif; //endif veiculo
					?>
				</div>	
			</form>	
			<a href="#" class="btn-passo3 btn-passo">Salvar</a>		
		</div>
	</section>
</div>
<?php get_footer();