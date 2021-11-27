$(document).ready(function(){
// ====================================================== //

var jVal = {

	/* FUNCION PARA VALIDAR NIT O CEDULA CLIENTE */
	'IdCliente' : function() {
	
		$('body').append('<div id="nameInfo" class="info"></div>');
		
		var nameInfo = $('#nameInfo');
		var ele = $('#Id_Cliente');
		var pos = ele.offset();
		
		nameInfo.css({
			top: pos.top-3,
			left: pos.left+ele.width()+17
		});

		var patt = /^[0-9]{7,11}$/i;
		
		if(!patt.test(ele.val())) {
			jVal.errors = true;
				nameInfo.removeClass('correct').addClass('error').html('&larr; Digite solo numeros y NIT sin verificacion').show();
				ele.removeClass('normal').addClass('wrong');
		} else {
				nameInfo.removeClass('error').addClass('correct').html('&radic;').show();
				ele.removeClass('wrong').addClass('normal');
		}
	},
	
	/* FUNCION PARA VALIDAR NOMBRE CLIENTE */
	'NomCliente' : function (){
		
		$('body').append('<div id="NomInfo" class="info"></div>');

		var birthInfo = $('#NomInfo');
		var ele = $('#Nom_Cliente');
		var pos = ele.offset();
		
		birthInfo.css({
			top: pos.top-3,
			left: pos.left+ele.width()+15
		});
		
		var patt2 = /^[A-Z ]{3,25}$/i;
		
		if(!patt2.test(ele.val())) {
			jVal.errors = true;
				birthInfo.removeClass('correct').addClass('error').html('&larr; No se permiten numeros en este campo').show();
				ele.removeClass('normal').addClass('wrong');
		} else {
				birthInfo.removeClass('error').addClass('correct').html('&radic;').show();
				ele.removeClass('wrong').addClass('normal');
		}	
	},
	
/* FUNCION PARA VALIDAR CORREO ELECTRONICO*/

'Celectronico' : function() {
	
		$('body').append('<div id="emailInfo" class="info"></div>');
	
		var emailInfo = $('#emailInfo');
		var ele = $('#C_electronico');
		var pos = ele.offset();
		
		emailInfo.css({
			top: pos.top-3,
			left: pos.left+ele.width()+15
		});
		
		var patt = /^.+@.+[.].{2,}$/i;
		
		if(!patt.test(ele.val())) {
			jVal.errors = true;
				emailInfo.removeClass('correct').addClass('error').html('&larr; Escriba una direccion de correo valida').show();
				ele.removeClass('normal').addClass('wrong');
		} else {
				emailInfo.removeClass('error').addClass('correct').html('&radic;').show();
				ele.removeClass('wrong').addClass('normal');
		}
	},

	/* FUNCION PARA VALIDAR PLACA DE SERVICIO */

	'PLServicio' : function() {
	
		$('body').append('<div id="SvcInfo" class="info"></div>');
		
		var nameInfo = $('#SvcInfo');
		var ele = $('#PL_Servicio');
		var pos = ele.offset();
		
		nameInfo.css({
			top: pos.top-3,
			left: pos.left+ele.width()+17
		});

		var patt = /^[0-9]{0,7}$/i;
		
		if(!patt.test(ele.val())) {
			jVal.errors = true;
				nameInfo.removeClass('correct').addClass('error').html('&larr; Verifique la placa de servicio de su activo').show();
				ele.removeClass('normal').addClass('wrong');
		} else {
				nameInfo.removeClass('error').addClass('correct').html('&radic;').show();
				ele.removeClass('wrong').addClass('normal');
		}
	},

	/* CAMPO DESCRIPCION */

	'PDescripcion' : function() {
	
		$('body').append('<div id="ProblemaInfo" class="info"></div>');
	
		var aboutInfo = $('#ProblemaInfo');
		var ele = $('#P_Descripcion');
		var pos = ele.offset();
		
		aboutInfo.css({
			top: pos.top-3,
			left: pos.left+ele.width()+15
		});
		
		if(ele.val().length < 100) {
			jVal.errors = true;
				aboutInfo.removeClass('correct').addClass('error').html('&larr; come on, tell me a little bit more!').show();
				ele.removeClass('normal').addClass('wrong').css({'font-weight': 'normal'});
		} else {
				aboutInfo.removeClass('error').addClass('correct').html('&radic;').show();
				ele.removeClass('wrong').addClass('normal');
		}
	},

	/* VALIDACION BUSCAR */

	'BTicket' : function() {
	
		$('body').append('<div id="BuscarTicket" class="info"></div>');
		
		var nameInfo = $('#BuscarTicket');
		var ele = $('#B_Ticket');
		var pos = ele.offsetfset();
		
		nameInfo.css({
			top: pos.top-3,
			left: pos.left+ele.width()+17
		});

		var patt = /^[0-9]{0,7}$/i;
		
		if(!patt.test(ele.val())) {
			jVal.errors = true;
				nameInfo.removeClass('correct').addClass('error').html('&larr; Verifique la placa de servicio de su activo').show();
				ele.removeClass('normal').addClass('wrong');
		} else {
				nameInfo.removeClass('error').addClass('correct').html('&radic;').show();
				ele.removeClass('wrong').addClass('normal');
		}
	},
	
	'Enviar' : function (){
		if(!jVal.errors) {
			$('#jform').submit();
		}
	}
};


// ====================================================== //

$('#BTNenviar').click(function (){
	var obj = $.browser.webkit ? $('body') : $('html');
	obj.animate({ scrollTop: $('#jform').offset().top }, 750, function (){
		jVal.errors = false;
		jVal.IdCliente();
		jVal.NomInfo();
		jVal.emailInfo();
		jVal.SvcInfo();
		jVal.ProblemaInfo();
		jVal.BuscarTicket();
		jVal.Enviar();
	});
	return false;
});

$('#Id_Cliente').change(jVal.IdCliente);
$('#Nom_Cliente').change(jVal.NomCliente);
$('#C_electronico').change(jVal.Celectronico);
$('#PL_Servicio').change(jVal.PLServicio);
$('#P_Descripcion').change(jVal.PDescripcion);
$('#B_Ticket').change(jVal.BTicket);

// ====================================================== //
});