<?php

require 'vendor/autoload.php';
define('BASE_URL', 'http://localhost/registro-php/');

Flight::route('/', function(){
	$db = new PDO('sqlite:db/db_open.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare("SELECT * FROM preguntas");
	$stmt->execute();
	$preguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);

	Flight::view()->set('preguntas', $preguntas);
	Flight::render('registro_open');
});

Flight::route('/existe_correo', function(){
	$correo = json_decode($_POST['data']);
	try {
		$db = new PDO('sqlite:db/db_open.db');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $db->prepare("SELECT (CASE WHEN (COUNT(*) > 0) THEN 'true' ELSE 'false' END) AS existe FROM personas WHERE correo = :correo;");
		$stmt->bindParam(':correo', $correo);
		$stmt->execute();
		$existe = $stmt->fetch(PDO::FETCH_ASSOC);
		$temp = false;

		if ($existe["existe"] == "true"){
			$temp = true;
		}

		$mensaje = $temp;
	    $rpta = array('tipo_mensaje' => 'success', 'mensaje' => $mensaje);
	}catch (Exception $e) {
        $rpta = array('tipo_mensaje' => 'error', 'mensaje' => array("Se ha producido un error en verificar el correo ingresado", $e->getMessage()));
   	}

	echo json_encode($rpta);
});

Flight::route('/guardar', function(){
	$encuestado = json_decode($_POST['encuestado']);
	try {
		$db = new PDO('sqlite:db/db_open.db');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $db->prepare("INSERT INTO personas (nombres, apellido_paterno, apellido_materno, correo, dni) VALUES (?,?,?,?,?);");
		$stmt->bindParam(1, $encuestado->{'nombres'});
		$stmt->bindParam(2, $encuestado->{'apellido_paterno'});
		$stmt->bindParam(3, $encuestado->{'apellido_materno'});
		$stmt->bindParam(4, $encuestado->{'correo'});
		$stmt->bindParam(5, $encuestado->{'open'});
		$stmt->execute();
		
		$persona_id = $db->lastInsertId();

		$encuestas = $encuestado->{'encuesta'};

		foreach ($encuestas as &$encuesta) {
			if($encuesta->{'checked'}){
				$stmt = $db->prepare("INSERT INTO personas_preguntas (persona_id, pregunta_id) VALUES (?,?);");
				$stmt->bindParam(1, $persona_id);
				$stmt->bindParam(2, $encuesta->{'pregunta_id'});
				$stmt->execute();
			}
		}

	    $rpta = array('tipo_mensaje' => 'success', 'mensaje' => "Registro OK");
	}catch (Exception $e) {
        $rpta = array('tipo_mensaje' => 'error', 'mensaje' => array("Se ha producido un error en registrar el formulario", $e->getMessage()));
   	}

	echo json_encode($rpta);
});

Flight::route('/access/error/404', function(){
	Flight::render('404');
});

Flight::route('/registro-ok', function(){
	Flight::render('registro-ok');
});

Flight::map('notFound', function(){
    Flight::redirect('/access/error/404');
});

Flight::start();

?>
