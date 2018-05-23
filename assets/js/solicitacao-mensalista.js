/* global twentyseventeenScreenReaderText */
(function( $ ) {
	$(document).ready(function() {
		//Pagina Solicitacao de Mensalista, Escolha do Estacionamento Bootstrap Select  
		$('#bootstrapSelectEst').on('change', function(e){
		  	console.log(this.value);
		  	var estacionamento = '.estacionamento-' + this.value;
		  	$('.estacionamentos').hide(100);
		  	$(estacionamento).show(100);
		});

		$('.btn-passo1').on('click', function(){
			$('#etapa1').hide(100);
			$('#etapa2').show(100);
			$('a.active').addClass('conclused');
			$('a.conclused').removeClass('active');
			$('.escolha-horario').addClass('active');
		});
		$('.btn-passo2').on('click', function(){
			$('#etapa2').hide(100);
			$('#etapa3').show(100);
			$('a.active').addClass('conclused');
			$('a.conclused').removeClass('active');
			$('.preencher-dados').addClass('active');
		});
		$('.btn-passo3').on('click', function(){
			// $('#etapa3').hide(100);
			// $('#etapa4').show(100);
			// $('a.active').addClass('conclused');
			// $('a.conclused').removeClass('active');
			// $('.concluir').addClass('active');
			$('#mensalista-form').submit();
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

		//Ajax 
		$('#mensalista-form').on('submit', function(e) {
	        e.preventDefault();
	        var dados = $(this).serialize();
		    $.ajax({
		        url: SmpAjax.ajaxurl + "?action=submit_solicitacao_mensalista",
		        type: "POST",
		        data: dados,
		        success: function(data){
		           alert("success " + data);
		        },
		        error: function(e){
		             alert("error " + e);
		        }
		    });
		});

	});
})( jQuery );
