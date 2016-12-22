var BASE_URL = "http://localhost/investigadores/";


$(document).on("click", "#btnEjecutar",function() {
	var incluir_acciones = $("#chkAcciones").is(':checked');

    var query = $("#txtQuery").val();
    $.ajax({
        type: "POST",
        url: BASE_URL + "query",
        data: "data=" + JSON.stringify(query),
        async: false,
        success:function(data){
           var rset = JSON.parse(data);
			var keys = [];
			var rptaString = "<table class='table table-striped'><thead>";
			var acciones = [];

			for(var k in rset[0]){ 
			 	keys.push(k);
			 	var temp = "<th>" + k + "</th>";
			 	rptaString = rptaString + temp;
			}

			if(incluir_acciones == true){	
				var temp = "<th>Acciones</th>";
				rptaString = rptaString + temp;
			}

			rptaString = rptaString + "</thead>";

			for(var i = 0; i < rset.length ; i++){
				var row = rset[i];
				rptaString = rptaString + "<tr>";

				for(var j = 0; j < keys.length; j++){
					var temp = "<td>" + row[keys[j]] + "</td>";
					rptaString = rptaString + temp;
				}
				
				if(incluir_acciones == true){	
					if(typeof row["id"] !== 'undefined'){
						var id = row["id"];
						var temp = "<td>" + "<a class='accion' href='" + BASE_URL + "ver/" + id + "'><i class='fa fa-search' aria-hidden='true'></i></a>" + "<a class='accion' href='" + BASE_URL + "editar/" + id + "'><i class='fa fa-pencil' aria-hidden='true'></i></a>" + "</td>";
						rptaString = rptaString + temp;
					}
				}

				rptaString = rptaString + "</tr>";
			}

			$("#tablaResultSet").empty();
			$("#tablaResultSet").append(rptaString);
        }
    });
});
