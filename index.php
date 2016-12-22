<?php

require 'vendor/autoload.php';
define('BASE_URL', 'http://softweb.pe/investigadores/');

Flight::route('/', function(){
	$db = new PDO('sqlite:db/db_encuesta.db');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare("SELECT * FROM estudios");
	$stmt->execute();
	$estudios = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if($estudios == false){
		Flight::render('404');
	}else{
		Flight::view()->set('estudios', $estudios);
		Flight::render('registro_encuesta');
	}
});

Flight::start();

?>
