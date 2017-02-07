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
                                <label for="txtDni">DNI</label>
                                <input type="text" class="form-control" id="txtDni">
                            </div>
                         </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                            <h4>Encuesta</h4>
                            <label style="margin-bottom:20px;">Selecciones los temas que le gustaría ver en un próximo taller:</label>
                        </div>
                     </div>
                     <div class="row" id="chkPreguntas">
                        <?php foreach ($preguntas as &$pregunta) { ?>
                        <div class="col-md-6">
                            <div class="check">
                                <input type="checkbox" class="preguntas" value="<?php echo $pregunta['id']; ?>">
                            </div>
                            <div class="check-texto">
                                <label><?php echo $pregunta['pregunta']; ?></label>
                            </div>
                        </div>
                        <?php } ?>
                     </div>
                      <hr>
                      <div class="row">
                        <div class="col-md-12">
                            <div class="check">
                                <input type="checkbox" id="chkAcepto">
                            </div>
                            <div class="check-texto">
                                <label>
                                 La información suministrada será usada para mantenerlo informado de nuestro próximos eventos  Su información será tratada en forma confidencial y no será divulgada a terceros, en cumplimiento de la Ley 29733 de Protección de Datos Personales.
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
        <script src="public/js/open.js" type="text/javascript"></script>
    </body>
</html>
