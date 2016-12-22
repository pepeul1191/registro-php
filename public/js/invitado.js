var BASE_URL = "http://softweb.pe/investigadores/";

var rangos = function(id_rango){
	$.ajax({
        type: "POST",
        url: BASE_URL + "rangos",
        data: "",
        async: false,
        success:function(data){
           data = JSON.parse(data);
           var str_rpta = "";

           for(var k = 0; k < data.length ; k++){ 
           	var rango = data[k];
           	if(rango["id"] == id_rango){
           		str_rpta = str_rpta + "<option selected value='" + rango["id"] + "'>" + rango["rango"] + "</option>";
           	}else{
           		str_rpta = str_rpta + "<option value='" + rango["id"] + "'>" + rango["rango"] + "</option>";
           	}
           }
           $("#slcRango").append(str_rpta);
        }
    });
};

var grados = function(grado_id){
	$.ajax({
        type: "POST",
        url: BASE_URL + "grados",
        data: "",
        async: false,
        success:function(data){
           data = JSON.parse(data);
           var str_rpta = "";

           for(var k = 0; k < data.length ; k++){ 
           	var grado = data[k];
           	if(grado["id"] == grado_id){
           		str_rpta = str_rpta + "<option selected value='" + grado["id"] + "'>" + grado["nombre"] + "</option>";
           	}else{
           		str_rpta = str_rpta + "<option value='" + grado["id"] + "'>" + grado["nombre"] + "</option>";
           	}
           }
           $("#slcGrado").append(str_rpta);
        }
    });
};

var tipos = function(tipo_invitados_id){
	$.ajax({
        type: "POST",
        url: BASE_URL + "tipos",
        data: "",
        async: false,
        success:function(data){
           data = JSON.parse(data);
           var str_rpta = "";

           for(var k = 0; k < data.length ; k++){ 
           	var tipo = data[k];
           	if(tipo["id"] == tipo_invitados_id){
           		str_rpta = str_rpta + "<option selected value='" + tipo["id"] + "'>" + tipo["nombre"] + "</option>";
           	}else{
           		str_rpta = str_rpta + "<option value='" + tipo["id"] + "'>" + tipo["nombre"] + "</option>";
           	}
           }
           $("#slcTipo").append(str_rpta);
        }
    });
};

$(document).on("click", "#btnGuardar",function() {
    var usuario = { 
      id : $("#idInvitado").html(), 
      nombre : $("#txtNombre").val(), 
      institucion_laboral : $("#txtInstitucion").val(), 
      edad_rango_id : $("#slcRango").val(), 
      grado_id : $("#slcGrado").val(), 
      tipo_invitados_id : $("#slcTipo").val(), 
      telefonos : $("#txtTelefono").val(), 
      correo : $("#txtCorreo").val()
    }; 

    $.ajax({
        type: "POST",
        url: BASE_URL + "invitado/guardar/",
        data: "data=" + JSON.stringify(usuario),
        async: false,
        success:function(data){
           var rpta = JSON.parse(data);

           if(rpta["tipo_mensaje"] == "error"){
               $("#txtMensajeRpta").html(rpta["mensaje"][0]);
               $("#txtMensajeRpta").removeClass("color-success");
               $("#txtMensajeRpta").addClass("color-error");
               $("#txtMensajeRpta").removeClass("oculto");
           }else{
               $("#txtMensajeRpta").html(rpta["mensaje"][0]);
               $("#txtMensajeRpta").removeClass("oculto");
               
               if ($("#idInvitado").html() == "E"){
                 $("#idInvitado").html(rpta["mensaje"][1]); 
               }

               $("#txtMensajeRpta").removeClass("color-error");
               $("#txtMensajeRpta").addClass("color-success");
           }
       }
    });
});

$( document ).ready(function() {
	var idInvitado = $("#idInvitado").html();

	$.ajax({
        type: "POST",
        url: BASE_URL + "invitado/" + idInvitado,
        data: "",
        async: false,
        success:function(data){
           data = JSON.parse(data);

           $("#txtNombre").val(data["nombre"]);
			$("#txtInstitucion").val(data["institucion_laboral"]);
			$("#txtTelefono").val(data["telefonos"]);
			$("#txtCorreo").val(data["correo"]);

			rangos(data["edad_rango_id"]);
			grados(data["grado_id"]);
			tipos(data["tipo_invitados_id"]);
        }
    });
});
