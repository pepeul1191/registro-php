<?php

require 'vendor/autoload.php';
define('BASE_URL', 'http://localhost/registro-php/');

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

Flight::route('/existe_correo/@correo', function($correo){

});

Flight::route('/access/error/404', function(){
	Flight::render('404');
});

Flight::map('notFound', function(){
    Flight::redirect('/access/error/404');
});

Flight::start();

?>
