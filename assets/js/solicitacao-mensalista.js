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
		});

		$('.btn-passo1').on('click', function(){
			$('#etapa1').hide(100);
			$('#etapa2').show(100);
			$('a.active').addClass('conclused');
			$('a.conclused').removeClass('active');
			$('.escolha-horario').addClass('active');
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
					});
					var htmlInput = "<div dataIdInputs='"+dataId+"' >";
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

		$('.btn-passo3').on('click', function(){
			$('.btn-passo3').hide();
			$('.ajaxgif').show();
			$('#mensalista-form').submit();
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
