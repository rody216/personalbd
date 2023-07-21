<!DOCTYPE html>
<html>
<head>
  <title>Registrar</title>
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/src/controllers/bootstrap/css/modal.css">
</head>
<body>
  <h2>Hola</h2>

  <button id="abrirModal">Abrir Modal</button>

  <!-- Ventana modal, por defecto no visible -->
  <div id="ventanaModal" class="modal">
    <div class="contenido-modal">
        <span class="cerrar">&times;</span>
        <div class="container">
          <!-- Aquí colocamos el contenido PHP -->
          <?php
          include "Conexion.php";
          $db =  connect();
          $query = $db->query("select * from continente");
          $countries = array();
          while ($r = $query->fetch_object()) {
            $countries[] = $r;
          }
          ?>
          <div class="panel panel-default">
            <nav class="navbar navbar-default">
              <!-- Extra para moviles mostrar -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
              </div>
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <li><a href="./">INICIO <span class="sr-only">(current)</span></a></li>
                  <li><a href="./Nuevo.php">AGREGAR REGISTROS</a></li>
                  <li><a href="./modal.php">Modal</a></li>
                </ul>
              </div><!-- /.navbar-collapse -->
            </nav>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <h1>Bienvenidos</h1>
                  <?php if (isset($_COOKIE["comboadd"])) : ?>
                    <p class="alert alert-success">Agregado exitosamente!</p>
                  <?php setcookie("comboadd", 0, time() - 1);
                  endif; ?>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <form method="post" action="Agregar.php?opt=all">
                    <div class="form-group">
                      <label for="name1">Continente</label>
                      <select id="continente_id" class="form-control" name="continente_id" required>
                        <option value="">-- SELECCIONE --</option>
                        <?php foreach ($countries as $c) : ?>
                          <option value="<?php echo $c->id; ?>"><?php echo $c->name; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="name1">Pais</label>
                      <select id="pais_id" class="form-control" name="pais_id" required>
                        <option value="">-- SELECCIONE --</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="name1">Ciudad</label>
                      <select id="ciudad_id" class="form-control" name="ciudad_id" required>
                        <option value="">-- SELECCIONE --</option>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-default">Agregar Registro</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="panel-footer"></div>
          </div><!-- /.Cierra-default-panel -->
        </div><!-- /.container -->
    </div>
  </div>
  <script src="./modal.js"></script>
</body>
</html>
