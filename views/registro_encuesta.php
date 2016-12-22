<!DOCTYPE html>
<html>
    <head>
        <title>Inscriptción</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="http://www.ulima.edu.pe/sites/default/files/favicon_1_1.ico" type="image/vnd.microsoft.icon">
        <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
        <link href="public/css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container container-table">
            <div class="row vertical-center-row">
                <div class="col-md-6 col-md-offset-3" style="background:#FFFFFF" id="workspace">
                    <div class="row" style="margin-bottom: 20px;">
                        <img src="public/img/logo-universidad-de-lima.png" alt="Logo ULima" height="147" width="146" id="logo-ulima">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Datos Personales</h4>
                        </div>
                    </div>
                     <div class="row row-form">
                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtApellidoPaterno">Apellido Paterno</label>
                                <input type="text" class="form-control" id="txtApellidoPaterno">
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtApellidoMaterno">Apellido Materno</label>
                                <input type="text" class="form-control" id="txtApellidoMaterno">
                            </div>
                         </div>
                      </div>
                      <div class="row row-form">
                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtNombre">Nombres</label>
                                <input type="text" class="form-control" id="txtNombre">
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtCorreo">Correo Electrónico</label>
                                <input type="email" class="form-control" id="txtCorreo">
                            </div>
                         </div>
                      </div>
                     <div class="row row-form">
                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="slcNivel">Nivel de Estudios</label>
                                <select class="form-control" id="slcNivel">
                                    <option value="E"></option>
                                    <?php foreach ($estudios as &$estudio) { ?>
                                    <option value="<?php echo $estudio['id']; ?>"><?php echo $estudio['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                          </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtUniversidadEgreso">Universidad de Egreso</label>
                                <input type="email" class="form-control" id="txtUniversidadEgreso">
                            </div>
                         </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                            <h4>Encuesta</h4>
                            <label>Selecciones los temas que le gustaría ver en un próximo taller:</label>
                        </div>
                     </div>
                      <hr>
                      <div class="row">
                        <div class="col-md-12">
                            <div class="check">
                                <input type="checkbox" id="chkAcepto">
                            </div>
                            <div class="check-texto">
                                <label>
                                 He leído y estoy informado sobre la Ley N° 29733 - Ley de Protección de Datos Personales y su reglamento aprobado mediante Decreto Supremo N° 003-2013-JUS.
                                </label>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <label id="lblMensaje"></label>
                        </div>
                         <div class="col-md-12">
                            <button type="button" class="btn btn-default" id="btnEnviar" disabled>Enviar</button>
                        </div>
                      </div>
                </div>
            </div>
        </div>
        <script src="bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>
        <script src="public/js/index.js" type="text/javascript"></script>
    </body>
</html>
