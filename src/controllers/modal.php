<?php
include "Conexion.php";
$db =  connect();
$query = $db->query("select * from continente");
$countries = array();
while ($r = $query->fetch_object()) {
  $countries[] = $r;
}


?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/src/controllers/bootstrap/css/modal.css">
</head>
<body>
  <h2>Ventana modal</h2>

  <button id="abrirModal">Abrir Modal</button>

  <!-- Ventana modal, por defecto no visiblel -->
  <div id="ventanaModal" class="modal">
    <div class="contenido-modal">
        <span class="cerrar">&times;</span>
        <h2>Ventana modal</h2>
        <div class="campo-modal">
        <label for="name1">Continente</label>
                <select id="continente_id" class="form-control" name="continente_id" required>
                  <option value="">-- SELECCIONE --</option>
                  <?php foreach ($countries as $c) : ?>
                    <option value="<?php echo $c->id; ?>"><?php echo $c->name; ?></option>
                  <?php endforeach; ?>
                </select>
        </div>
        <div class="campo-modal">
            <label for="pais">País:</label>
            <input type="text" id="pais" require>
        </div>
        <div class="campo-modal">
            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" require>
        </div>
        <button id="guardarBtn">Guardar</button>
    </div>
  </div>
  <script src="./modal.js"></script>
</body>
</html>