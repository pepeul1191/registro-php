<?php

require 'vendor/autoload.php';
define('BASE_URL', 'http://softweb.pe/investigadores/');

Flight::route('/query', function(){
	$query = json_decode($_POST["data"]);

	$db = new PDO('sqlite:db/interfases.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare($query);
	$stmt->execute();
	$rpta = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($rpta);
});

Flight::route('/invitado/guardar/', function(){
	$invitado = json_decode($_POST['data']);

	try {
		if($invitado->{'id'} == 'E'){
			$db = new PDO('sqlite:db/interfases.db');
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $db->prepare("INSERT INTO invitados (nombre, institucion_laboral, edad_rango_id, grado_id, tipo_invitados_id, telefonos, correo) VALUES (:nombre, :institucion_laboral, :edad_rango_id, :grado_id, :tipo_invitados_id, :telefonos, :correo);");

			$stmt->bindParam(':nombre', $invitado->{'nombre'});
			$stmt->bindParam(':institucion_laboral', $invitado->{'institucion_laboral'});
			$stmt->bindParam(':edad_rango_id', $invitado->{'edad_rango_id'});
			$stmt->bindParam(':grado_id', $invitado->{'grado_id'});
			$stmt->bindParam(':tipo_invitados_id', $invitado->{'tipo_invitados_id'});
			$stmt->bindParam(':telefonos', $invitado->{'telefonos'});
			$stmt->bindParam(':correo', $invitado->{'correo'});

	       $mensaje = "Se ha añadido el nuevo invitado";
	       $rpta = array('tipo_mensaje' => 'success', 'mensaje' => array($mensaje, $this->db->lastInsertId()));

		}else{
			$db = new PDO('sqlite:db/interfases.db');
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $db->prepare("UPDATE invitados SET nombre = :nombre, institucion_laboral = :institucion_laboral, edad_rango_id = :edad_rango_id, grado_id = :grado_id, tipo_invitados_id = :tipo_invitados_id, telefonos = :telefonos, correo = :correo WHERE id = :id;");

			$stmt->bindParam(':id', $invitado->{'id'});
			$stmt->bindParam(':nombre', $invitado->{'nombre'});
			$stmt->bindParam(':institucion_laboral', $invitado->{'institucion_laboral'});
			$stmt->bindParam(':edad_rango_id', $invitado->{'edad_rango_id'});
			$stmt->bindParam(':grado_id', $invitado->{'grado_id'});
			$stmt->bindParam(':tipo_invitados_id', $invitado->{'tipo_invitados_id'});
			$stmt->bindParam(':telefonos', $invitado->{'telefonos'});
			$stmt->bindParam(':correo', $invitado->{'correo'});

			$stmt->execute();

			$mensaje = "Se ha editado el invitado";
	        $rpta = array('tipo_mensaje' => 'success', 'mensaje' => array($mensaje));
		}
	}catch (Exception $e) {
        $rpta = array('tipo_mensaje' => 'error', 'mensaje' => array("Se ha producido un error en guardar el invitado", $e->getMessage()));
   }

   echo json_encode($rpta);
});

Flight::route('/rangos', function(){
	$db = new PDO('sqlite:db/interfases.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare("SELECT * FROM edad_rangos;");
	$stmt->execute();
	$rpta = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($rpta);
});

Flight::route('/grados', function(){
	$db = new PDO('sqlite:db/interfases.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare("SELECT * FROM grados;");
	$stmt->execute();
	$rpta = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($rpta);
});

Flight::route('/tipos', function(){
	$db = new PDO('sqlite:db/interfases.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare("SELECT * FROM tipo_invitados;");
	$stmt->execute();
	$rpta = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($rpta);
});

Flight::route('/editar/@id', function($id){
	$db = new PDO('sqlite:db/interfases.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare("SELECT * FROM invitados WHERE id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	$rpta = $stmt->fetch(PDO::FETCH_ASSOC);

	if($rpta == false){
		Flight::render('404');
	}else{
		Flight::view()->set('id', $id);
		Flight::view()->set('accion', 'editar');
		Flight::view()->set('disabled', false);
		Flight::render('invitado');
	}
});

Flight::route('/ver/@id', function($id){
	$db = new PDO('sqlite:db/interfases.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare("SELECT * FROM invitados WHERE id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	$rpta = $stmt->fetch(PDO::FETCH_ASSOC);

	if($rpta == false){
		Flight::render('404');
	}else{
		Flight::view()->set('id', $id);
		Flight::view()->set('accion', 'editar');
		Flight::view()->set('disabled', true);
		Flight::render('invitado');
	}
});

Flight::route('/invitado/@id', function($id){
	$db = new PDO('sqlite:db/interfases.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare("SELECT * FROM invitados WHERE id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	$rpta = $stmt->fetch(PDO::FETCH_ASSOC);

	echo json_encode($rpta);
});

Flight::start();

?>
