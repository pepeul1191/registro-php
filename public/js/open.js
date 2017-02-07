var BASE_URL = "http://localhost/registro-php/";

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
	if (correo_valido){
		var correo_repetido = validarRepetido($("#txtCorreo"), "El correo ingresado ya se encuentra registrado", BASE_URL + "existe_correo");
	}
	var dni_valido = validarTextLleno($("#txtDni"), "Ingrese su DNI");

	if (paterno_valido && materno_valido && nombres_valido && correo_valido && dni_valido && correo_repetido){
		var encuesta = new Array(); 

		for(var i = 0; i < $("#chkPreguntas").children().length; i++){
			var col_md_6 = $($("#chkPreguntas").children()[i]);
			var class_check = $(col_md_6.children()[0]);
			var check = class_check.children(0);
			var checked =  {"pregunta_id" : check.val(), "checked": check.is(':checked')};
			encuesta.push(checked);
		}
		
		var encuestado = new Object();
		encuestado.apellido_paterno = $("#txtApellidoPaterno").val();
		encuestado.apellido_materno = $("#txtApellidoMaterno").val();
		encuestado.nombres = $("#txtNombre").val();
		encuestado.correo = $("#txtCorreo").val();
		encuestado.dni = $("#txtDni").val();
		encuestado.encuesta = encuesta;

		$.ajax({
			type: "POST",
			url: BASE_URL + "guardar",
			data: "encuestado=" + JSON.stringify(encuestado),
			async: false,
			success:function(data){
				var data = JSON.parse(data);
				console.log(data);
				if (data["tipo_mensaje"] == "error"){
					$("#lblMensaje").html("Ha ocurrido un error registar sus datos");
					$("#lblMensaje").addClass("color-rojo");
				}else{
					window.location.replace(BASE_URL + "registro-ok");
				}
			}
		});

		$("#lblMensaje").html("Chevere");
		$("#lblMensaje").removeClass("color-rojo");
		$("#lblMensaje").addClass("color-verde");
	}else{
		$("#lblMensaje").html("No se pudo enviar el formulario, llene los campos obligatorios");
		$("#lblMensaje").addClass("color-rojo");
		$("html, body").animate({ scrollTop: 0 }, "slow");
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

function validarRepetido(input, mensaje, ruta_url) {
	var rpta = true;

	$.ajax({
		type: "POST",
		url: ruta_url,
		data: "data=" + JSON.stringify(input.val()),
		async: false,
		success:function(data){
			var data = JSON.parse(data);
			if (data["tipo_mensaje"] == "error"){
				$("#lblMensaje").html("Ha ocurrido un error en validar el correo ingresado");
				$("#lblMensaje").addClass("color-rojo");
			}else{
				if (data["mensaje"]){
					input.addClass("input-text-error");
					input.val("");
					input.attr("placeholder", mensaje);
					rpta = false;
				}else{
					input.removeClass("input-text-error");
				}
			}
		}
	});

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