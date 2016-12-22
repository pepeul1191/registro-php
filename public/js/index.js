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
	var valido = validarCorreo($("#txtCorreo").val());
	if (valido){
		$("#txtCorreo").removeClass("input-text-error");
		$("#txtCorreo").attr("placeholder", "Correo Electrónico");
		/*
		$.ajax({
	        type: "POST",
	        url: BASE_URL + "query",
	        data: "data=" + JSON.stringify(query),
	        async: false,
	        success:function(data){

	        }
	    });
		*/
	}else{
		$("#txtCorreo").addClass("input-text-error");
		$("#txtCorreo").val("");
		$("#txtCorreo").attr("placeholder", "Ingrese un dirección de correo válida");
	}
});

function validarCorreo(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}