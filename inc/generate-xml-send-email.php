<?php
function generate_xml_send_email() {

	$idPost = isset($_POST['idPost']) ? $_POST['idPost'] : null;

	$mensalista = array(
					'nome_usuario'	=> get_post_meta( $idPost, 'nome_usuario', true ),
					'cpf'			=> get_post_meta( $idPost, 'cpf', true ),
					'fone'			=> get_post_meta( $idPost, 'fone', true ),
					'celular'		=> get_post_meta( $idPost, 'celular', true ),
					'email'			=> get_post_meta( $idPost, 'email', true ),
					'endereco'		=> get_post_meta( $idPost, 'endereco', true ),
					'cep'			=> get_post_meta( $idPost, 'cep', true ),
					'bairro'		=> get_post_meta( $idPost, 'bairro', true ),
					'cidade'		=> get_post_meta( $idPost, 'cidade', true ),
					'estado'		=> get_post_meta( $idPost, 'estado', true )
				);

	$empresa = array(
					'empresa'				=> get_post_meta( $idPost, 'empresa', true ),
					'fone_empresa'			=> get_post_meta( $idPost, 'fone_empresa', true ),
					'ramal_empresa'			=> get_post_meta( $idPost, 'ramal_empresa', true ),
					'endereco_empresa'		=> get_post_meta( $idPost, 'endereco_empresa', true ),
					'complemento_empresa'	=> get_post_meta( $idPost, 'complemento_empresa', true ),
					'cep_empresa'			=> get_post_meta( $idPost, 'cep_empresa', true ),
					'cidade_empresa'		=> get_post_meta( $idPost, 'cidade_empresa', true )
				);

	$unidade_escolhida = get_post_meta( $idPost, 'unidade_escolhida_id', true );
	$cont = 1;
   	while ( have_rows('vagas_mensalista', $idPost ) ) : the_row();
   		$vagas[$cont]['quantidade'] = get_sub_field('quantidade');
		$vagas[$cont]['descricao']  = get_sub_field('descricao');
    	$vagas[$cont]['horario'] 	= get_sub_field('horario');
    	$vagas[$cont]['valor'] 	 	= get_sub_field('valor');
    	$vagas[$cont]['codigo'] 	= get_sub_field('codigo');
    	$cont++;
    endwhile;
   
    //Veiculos
	$cont = 1;
  	while ( have_rows('veiculo', $idPost ) ) : the_row();
	   	$veiculos[$cont]['placa'] 	= get_sub_field('placa');
	   	$veiculos[$cont]['marca']  	= get_sub_field('marca');
	    $veiculos[$cont]['modelo']  = get_sub_field('modelo');
	   	$veiculos[$cont]['ano']  	= get_sub_field('ano');
	   	$cont++;
    endwhile;


    //Get Emails Vagas
    $idUnidade = get_post_meta( $idPost, 'id_unidade', true );
    $emails = get_post_meta( $idUnidade, 'email_de_envio', true );

	// Document
	$xmlDoc = new DOMDocument('1.0', 'UTF-8');

	// Root element
	$root = $xmlDoc->appendChild( $xmlDoc->createElement("Mensalista") );

	// Mensalista
	$user = $root->appendChild( $xmlDoc->createElement("Usuario") );
	foreach( $mensalista as $path => $data )
	{
	    $user->appendChild( $xmlDoc->createElement( $path, $data  ) );
	}

	// Empresa
	$empre = $root->appendChild( $xmlDoc->createElement("Empresa") );
	foreach( $empresa as $path => $data )
	{
	    $empre->appendChild( $xmlDoc->createElement( $path, $data  ) );
	}

	//Vagas
	$vag = $root->appendChild( $xmlDoc->createElement("Vagas") );
	$vag->appendChild( $xmlDoc->createElement( 'unidade_escolhida', $unidade_escolhida  ) );
	foreach ( $vagas as $data ) {
		$va  = $vag->appendChild( $xmlDoc->createElement("vaga") );
		$va->appendChild( $xmlDoc->createElement( 'codigo_vaga', $data['codigo'] ) );
		$va->appendChild( $xmlDoc->createElement( 'quantidade', $data['quantidade'] ) );
		$va->appendChild( $xmlDoc->createElement( 'descricao', $data['descricao'] ) );
		$va->appendChild( $xmlDoc->createElement( 'horario', $data['horario'] ) );
		$va->appendChild( $xmlDoc->createElement( 'valor', $data['valor'] ) );
	}

	//Veiculos
	$veiculo = $root->appendChild( $xmlDoc->createElement("Veiculos") );
	foreach ($veiculos as $data ) {
		$ve  = $veiculo->appendChild( $xmlDoc->createElement("veiculo") );
		$ve->appendChild( $xmlDoc->createElement( 'placa', $data['placa'] ) );
		$ve->appendChild( $xmlDoc->createElement( 'marca', $data['marca'] ) );
		$ve->appendChild( $xmlDoc->createElement( 'modelo', $data['modelo'] ) );
		$ve->appendChild( $xmlDoc->createElement( 'ano', $data['ano'] ) );
	}

	// make the output pretty (later)
	$xmlDoc->formatOutput = true;

	//Save XML
	$upload = wp_upload_dir();
	$pathSave = $upload['basedir'] . '/mensalista-xml/mensalista-'.$idPost.'.xml';
	$pathDownload = $upload['baseurl'] . '/mensalista-xml/mensalista-'.$idPost.'.xml';
	$saveXml = $xmlDoc->saveXML();
	$saveDoc = $xmlDoc->save( $pathSave );

	//Salvar XMl do User
	update_field( 'url_xml', $pathDownload, $idPost );

	//enviar email
	$to = $emails;
	$subject = 'Solicitação Mensalista';
	$body = 'Solicitação de Mensalista Parkimetro';
	$headers[] = 'Content-Type: text/html;';
	// $headers[] = 'charset=UTF-8;';
	// $headers[] = 'From: Parkimetro <contato@parkimetro.com.br>;';
	// $headers[] = 'MIME-Version: 1.0;';
	$attachments = array( $pathSave );
	$mailSend = wp_mail( $to, $subject, $body , $headers, $attachments );

	if( $mailSend  ) 
		{ echo 'The test message was sent. Check your email inbox.'; } else { echo 'The message was not sent! ' . $mailSend; };

	die;
}