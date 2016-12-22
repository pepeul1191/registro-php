<!DOCTYPE html>
<html>
    <head>
        <title>Investigadores</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo BASE_URL; ?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo BASE_URL; ?>bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo BASE_URL; ?>public/css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="container">
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?php echo BASE_URL; ?>">Invitados 2016</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
              <ul class="nav navbar-nav">

              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </nav>
        <div class="cuerpo">
            <div class="row">
                <div class="col-md-12">
                    <h1>Invitado - # <span id="idInvitado"><?php echo $id; ?></span></h1>
                    <label class="texto-der oculto" id="txtMensajeRpta"></label>
                    <label id="lbAccion" style="display:none;"><?php echo $accion; ?></label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="txtNombre">Nombre</label>
                        <input type="text" class="form-control" id="txtNombre" <?php if($disabled){?>disabled<?php } ?>>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="txtInstitucion">Institución donde labora</label>
                        <input type="text" class="form-control" id="txtInstitucion" <?php if($disabled){?>disabled<?php } ?>>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Rango de Edad</label>
                        <select class="form-control" id="slcRango" <?php if($disabled){?>disabled<?php } ?>>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Grado de Instrucción</label>
                        <select class="form-control" id="slcGrado" <?php if($disabled){?>disabled<?php } ?>>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tipo Invitado</label>
                        <select class="form-control" id="slcTipo" <?php if($disabled){?>disabled<?php } ?>>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="txtTelefono">Teléfono</label>
                        <input type="text" class="form-control" id="txtTelefono" <?php if($disabled){?>disabled<?php } ?>>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="txtCorreo">Correo</label>
                        <input type="text" class="form-control" id="txtCorreo" <?php if($disabled){?>disabled<?php } ?>>
                    </div>
                </div>
                <?php if($disabled == false){?>
                <div class="col-md-4">
                    <div class="form-group form-boton">
                        <button class="btn btn-success" id="btnGuardar"><i class="fa fa-check" aria-hidden="true"></i>Guardar Cambios</button>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <script src="<?php echo BASE_URL; ?>bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo BASE_URL; ?>public/js/invitado.js" type="text/javascript"></script>
    </body>
</html>