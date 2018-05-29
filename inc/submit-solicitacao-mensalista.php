<?php

function submit_solicitacao_mensalista() {

    $informacoes = isset($_POST['infos']) ? $_POST['infos'] : null;
    $nome_usuario = isset($_POST['nome']) ? $_POST['nome'] : null;
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
    $fone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
    $celular = isset($_POST['celuar']) ? $_POST['celuar'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : null;
    $cep = isset($_POST['cep']) ? $_POST['cep'] : null;
    $bairro = isset($_POST['bairro']) ? $_POST['bairro'] : null;
    $cidade_uf = isset($_POST['cidade']) ? $_POST['cidade'] : null;

    $empresa = isset($_POST['empresa']) ? $_POST['empresa'] : null;
    $fone_empresa = isset($_POST['fone-empresa']) ? $_POST['fone-empresa'] : null;
    $ramal_empresa = isset($_POST['ramal-empresa']) ? $_POST['ramal-empresa'] : null;
    $endereco_empresa = isset($_POST['endereco-empresa']) ? $_POST['endereco-empresa'] : null; 
    $complemento_empresa = isset($_POST['complemento-empresa']) ? $_POST['complemento-empresa'] : null;
    $cep_empresa = isset($_POST['cep-empresa']) ? $_POST['cep-empresa'] : null;
    $cidade_empresa = isset($_POST['cidade-empresa']) ? $_POST['cidade-empresa'] : null;

	$placa = isset($_POST['placa']) ? $_POST['placa'] : null; 
	$marca = isset($_POST['marca']) ? $_POST['marca'] : null;
	$modelo = isset($_POST['modelo']) ? $_POST['modelo'] : null;
	$ano = isset($_POST['ano']) ? $_POST['ano'] : null;

	$unidade_escolhida_id = isset($_POST['unidade_escolhida_id']) ? $_POST['unidade_escolhida_id'] : null; 
	$unidade_escolhida_endereco = isset($_POST['unidade_escolhida_endereco']) ? $_POST['unidade_escolhida_endereco'] : null;
	$quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : null;
	$descricao  = isset($_POST['descricao']) ? $_POST['descricao'] : null;
	$horario    = isset($_POST['horario']) ? $_POST['horario'] : null;
	$valor      = isset($_POST['valor']) ? $_POST['valor'] : null; 

	$mensalista = array(
					'informacoes' 	=> $informacoes,
					'nome_usuario'	=> $nome_usuario,
					'cpf'			=> $cpf,
					'fone'			=> $fone,
					'celular'		=> $celular,
					'email'			=> $email,
					'endereco'		=> $endereco,
					'cep'			=> $cep,
					'bairro'		=> $bairro,
					'cidade_uf'		=> $cidade_uf
				);
	$empresa = array(
					'empresa'				=> $empresa,
					'fone_empresa'			=> $fone_empresa,
					'ramal_empresa'			=> $ramal_empresa,
					'endereco_empresa'		=> $endereco_empresa,
					'complemento_empresa'	=> $complemento_empresa,
					'cep_empresa'			=> $cep_empresa,
					'cidade_empresa'		=> $cidade_empresa
				);

	//Create User
	$user_name = strtolower(preg_replace('/\s+/', '-', $nome_usuario));
	$user_id = username_exists( $user_name );
	if ( !$user_id and email_exists($email) == false ) {
		$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
		$userdata = array(
		    'user_login'  	=> $user_name,
		    'user_pass'   	=> $random_password,
		    'user_email'	=> $email,
		    'display_name'	=> $nome_usuario,
		    'description'	=> 'Mensalista Parkimetro',
		    'role'			=> 'mensalista-user'
		);

		$user_id = wp_insert_user( $userdata );
		wp_new_user_notification( $user_name, $random_password);

	} else {
		$random_password = __('Usuário já existe.');
	}

	//Create Post By User ID
    $post_id = wp_insert_post( array(
        'post_title'        => $nome_usuario,
        'post_status'       => 'publish',
        'post_type'			=> 'mensalista',
        'post_author'       => $user_id
    ) );
    //Mensalista
	foreach ( $mensalista as $campo => $v ) {
		update_field( $campo, $v, $post_id );
	}
	//Empresa
	foreach ( $empresa as $campo => $v) {
		update_field( $campo, $v, $post_id );
	}
	//Vagas
	update_field( 'unidade_escolhida_id', $unidade_escolhida_id, $post_id );
	update_field( 'unidade_escolhida_endereco', $unidade_escolhida_endereco, $post_id );
	$value = array();
	for ($i = 0; $i < count( $quantidade ); $i++) {
		$value[] = array(
				      	'quantidade'  => $quantidade[$i],
						'descricao'	 => $descricao[$i],
						'horario' => $horario[$i],
						'valor'	 => $valor[$i]
				    );
	};
	update_field( 'vagas_mensalista', $value, $post_id );
	//Carros 
	$value = array();
	for ($i = 0; $i < count( $placa ); $i++) {
		$value[] = array(
				      	'placa'  => $placa[$i],
						'marca'	 => $marca[$i],
						'modelo' => $modelo[$i],
						'ano'	 => $ano[$i]
				    );
	};
	update_field( 'veiculo', $value, $post_id );

	echo $post_id;

    die($results);
}