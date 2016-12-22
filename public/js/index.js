var BASE_URL = "http://localhost/investigadores/";

$(document).on("click", "#chkAcepto",function(event){
	var checkado =$('#chkAcepto:checkbox:checked').length > 0;
	if (checkado){
		$("#btnEnviar").prop("disabled", false); 
	}else{
		$("#btnEnviar").prop("disabled", true);
	}
});

$(document).on("click", "#btnEnviar",function() {
	var paterno_valido = validarTextLleno($("#txtApellidoPaterno"), "Ingrese su apellido paterno");
	var materno_valido = validarTextLleno($("#txtApellidoMaterno"), "Ingrese su apellido materno");
	var nombres_valido = validarTextLleno($("#txtNombre"), "Ingrese su(s) nombre(s)");
	var correo_valido = validarCorreo($("#txtCorreo"));
	var nivel_estudios_valido = validarSelect($("#slcNivel"), "Seleccione su nivel de estudios");
	var egreso_valido = validarTextLleno($("#txtUniversidadEgreso"), "Ingrese su universidad de egreso");

	if (paterno_valido && materno_valido && nombres_valido && correo_valido && nivel_estudios_valido && egreso_valido){
		alert("AJAX VALIDAR CORREO NO REPETIDO");
		alert("INSERTAR DE LA DB");
		$("#lblMensaje").html("Chevere");
		$("#lblMensaje").removeClass("color-rojo");
		$("#lblMensaje").addClass("color-verde");
	}else{
		$("#lblMensaje").html("No se pudo enviar el formulario, llene los campos obligatorios");
		$("#lblMensaje").addClass("color-rojo");
	}
});

function validarCorreo(input) {
	var email = input.val(); 
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var rpta = false;

    if (re.test(email)){
		input.removeClass("input-text-error");
		rpta = true;
	}else{
		input.addClass("input-text-error");
		input.val("");
		input.attr("placeholder", "Ingrese un dirección de correo válida");
	}

    return rpta; 
}

function validarTextLleno(input, mensaje){
	var texto = input.val();
	var rpta = false;

	if (texto== ""){
		input.addClass("input-text-error");
		input.val("");
		input.attr("placeholder", mensaje);
	}else{
		input.removeClass("input-text-error");
		rpta = true;
	}

	return rpta;
}

function validarSelect(select, mensaje){
	var valor = select.val();
	var rpta = false;

	if (valor == "E"){
		select.addClass("input-text-error");
		select.attr("placeholder", mensaje);
	}else{
		select.removeClass("input-text-error");
		rpta = true;
	}

	return rpta;
}