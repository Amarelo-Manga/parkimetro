/* global twentyseventeenScreenReaderText */
(function( $ ) {
	$(document).ready(function() {
		//Pagina Solicitacao de Mensalista, Escolha do Estacionamento Bootstrap Select  
		$('#bootstrapSelectEst').on('change', function(e){
		  	var estacionamento = '.estacionamento-' + this.value;
		  	$('.estacionamentos').hide(100);
		  	$(estacionamento).show(100);

		  	$('#unidade_escolhida_id').val( this.value );
		  	$('#unidade_escolhida_endereco').val( $(this).children("option").filter(":selected").text() );
		  	$('#id_unidade').val( $(this).children("option").filter(":selected").attr("data-rede") );
		});

		//Passo 1 Selecionar o Estacionamento
		$('.btn-passo1').on('click', function(){
			var selected = $('#bootstrapSelectEst').val();
			if( selected ){
				$('#etapa1').hide(100);
				$('#etapa2').show(100);
				$('a.active').addClass('conclused');
				$('a.conclused').removeClass('active');
				$('.escolha-horario').addClass('active');
			}else{
				alert('Selecione o Estacionamento');
			}
		});

		//Adiciona Inputs com quantidade de vagas
		$('.qtd-vaga').on('change', function(){
			var qtd = this.value;
			var classId = $(this).parent().attr('class');
			var dataId 	= $(this).parents('ul').attr('dataid');
			var lista 	= $(this).parent();
			if( qtd ){
				var inputVaga = "";
				var inputDesc = "";
				var inputValo = "";
				var inputCodVaga = "";
				var dataIdInputs = $('div[dataIdInputs="'+dataId+'"]');

				//Valida se já existe dataInput com quantidade cadastrado
				if( !dataIdInputs.get(0) ){

					inputVaga = '<input type="hidden" value="'+qtd+'" class="qtd-vaga" name="quantidade[]">';

					$( lista ).siblings(".text-"+classId).each(function( index ) {
						var text = $( this ).text();
					  	if( index == 0){
					  		inputDesc = '<input type="hidden" value="'+text+'" class="qtd-desc" name="descricao[]">';
					  	}

					  	if( index == 1 ) {
					  		inputHora = '<input type="hidden" value="'+text+'" class="qtd-hora" name="horario[]">';
					  	}

					  	if( index == 2 ){
					  		inputValo = '<input type="hidden" value="'+text+'" class="qtd-valo" name="valor[]">';
					  	}

					  	if( index == 3 ){
					  		inputCodVaga = '<input type="hidden" value="'+text+'" class="qtd-cod" name="codigo[]">';
					  	} 
					});
					var htmlInput = "<div dataIdInputs='"+dataId+"' >";
						htmlInput = htmlInput + inputCodVaga;
						htmlInput = htmlInput + inputVaga;
						htmlInput = htmlInput + inputDesc;
						htmlInput = htmlInput + inputHora;
						htmlInput = htmlInput + inputValo;
						htmlInput = htmlInput + "</div>";
						$('#vagas-mensalista').append( htmlInput );
				//Valida se já existe dataInput com quantidade cadastrado
				}else{
					$( dataIdInputs ).find('.qtd-vaga').val( qtd );
				};	
			}else{
				//Remove Inputs Caso já tenha adicionado
				if( dataId ){
					$('div[dataIdInputs]').remove();
				}
			}
		});

		$('.btn-passo2').on('click', function(){
			//Valida se já existe dataInput com quantidade cadastrado
			if( $('div').is("[dataIdInputs]") ){
				$('#etapa2').hide(100);
				$('#etapa3').show(100);
				$('a.active').addClass('conclused');
				$('a.conclused').removeClass('active');
				$('.preencher-dados').addClass('active');
			}else{
				alert( 'Por favor escolha a quantidade de vagas');
			}
		});

		//Valida CPF
		$("#cpf").on('change', function (value, element) {
            value = $.trim( $(this).val() );

            value = value.replace('.', '');
            cpf = value.replace('-', '');
            while (cpf.length < 11) cpf = "0" + cpf;
            var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
            var a = [];
            var b = new Number;
            var c = 11;
            for (i = 0; i < 11; i++) {
                a[i] = cpf.charAt(i);
                if (i < 9) b += (a[i] * --c);
            }
            if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11 - x }
            b = 0;
            c = 11;
            for (y = 0; y < 10; y++) b += (a[y] * c--);
            if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11 - x; }
            if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)){
            	$( "#cpf" ).addClass('required');
            	alert('CPF inválido, digite novamente por favor!');
            }
        }); 

		//Busca Cep
		$('#cep').on('change', function(){
			//Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;
           //Valida o formato do CEP.
            if( validacep.test(cep) ) {
                //Preenche os campos com "..." enquanto consulta webservice.
                $("#endereco").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");
                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#endereco").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        //$("#uf").val(dados.uf);
                        console.log(dados.uf);
                        $('#estado option[value='+dados.uf+']').attr('selected','selected');
                    } //end if.
                    else {
                        alert("CEP não encontrado.");
                    }
                });
            }else{
            	$( "#cep" ).addClass('required');
            	alert('Digite um CEP válido');
            };
		});

		//Mascara Placa
		$("#placa").mask("AAA-9999", {reverse: true});

		// Repeat Fields Descrição dos Veiculos
		$(document).on('click', '.btn-add', function(e)
		{
			e.preventDefault();
			var controlForm = $('#myRepeatingFields:first'),
				currentEntry = $(this).parents('.entry:first'),
				newEntry = $(currentEntry.clone()).appendTo(controlForm);
			newEntry.find('input').val('');
			controlForm.find('.entry:not(:last) .btn-add')
				.removeClass('btn-add').addClass('btn-remove')
				.removeClass('btn-success').addClass('btn-danger')
				.html('<span class="glyphicon glyphicon-minus"></span>');
		}).on('click', '.btn-remove', function(e)
		{
			e.preventDefault();
			$(this).parents('.entry:first').remove();
			return false;
		});

		$('.btn-passo3').on('click', function(e){
			e.preventDefault();
			$('.btn-passo3').hide();
			$('.ajaxgif').show();

			var submitForm = true; 

			$('form#mensalista-form').find('input').each(function(){
			    if( $(this).prop('required') && $( this ).val() == '' ){
			    	$('input').removeClass('required');
			    	$( this ).addClass('required');
			    	alert( 'Por favor, Preencha o campo ' + $(this).attr('placeholder') );
				    $('.btn-passo3').show();
					$('.ajaxgif').hide();
					submitForm = false;
			    	return false;
			    };
			});

			if( submitForm ){
				$('#mensalista-form').submit();
			}
		});

		//Ajax 
		$('#mensalista-form').on('submit', function(e) {
	        e.preventDefault();
	        var dados = $(this).serialize();
		    $.ajax({
		        url: SmpAjax.ajaxurl + "?action=submit_solicitacao_mensalista",
		        type: "POST",
		        data: dados,
		        success: function(data){
		           console.log("success mensalista: " + data);
		           generate_xml_send_email_xml( data );
		        },
		        error: function(e){
		             alert("error mensalista " + e);
		        }
		    });
		});

		//Generate XML Send Email Ajax
		function generate_xml_send_email_xml( idPost ){
			console.log( "Generate XMl : "+idPost+"<br />" );
			$.ajax({
		        type: "POST",
		        url: SmpAjax.ajaxurl + "?action=generate_xml_send_email",
		        data: {"idPost":idPost},
		        success: function(data){
		            console.log("success xml: " + data);
			        $('#etapa3').hide(100);
					$('#etapa4').show(100);
					$('a.active').addClass('conclused');
					$('a.conclused').removeClass('active');
					$('.concluir').addClass('active');
		        },
		        error: function(e){
		        	var myObj = $.parseJSON(e);
		            console.log("error xml: " + myObj);
		        }
		    });
		};
	});
})( jQuery );
