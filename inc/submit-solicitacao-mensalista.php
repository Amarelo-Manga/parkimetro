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

    $post_id = wp_insert_post( array(
        'post_title'        => $nome_usuario,
        'post_status'       => 'publish',
        'post_type'			=> 'mensalista',
        'post_author'       => '1'
    ) );

	foreach ( $mensalista as $campo => $valor ) {
		update_field( $campo, $valor, $post_id );
	}

	foreach ( $empresa as $campo => $valor ) {
		update_field( $campo, $valor, $post_id );
	}

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