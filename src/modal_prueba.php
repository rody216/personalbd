


<?php
session_start();
include "../conexion.php";
$id_user = $_SESSION['idUser'];
include_once "includes/header.php";
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modal Example</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
<style>
  .botones{
    margin-left: 45% !important;
    border-radius: 5px;
    background-color: #1296B4;
    padding: 10px;
    color: white;
  }
</style>
<body>        
  <div class="card">
    <div class="card-body">
      <div class="row justify-content-center"> <!-- Utilizamos "justify-content-center" para centrar el contenido -->
        <div class="col-md-12">
          <h3 class="text-center">Datos Familiares</h3>
          <!-- Button trigger modal -->
          <button type="button" class="botones" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Agregar Familiar
          </button>

          <!-- Modal -->
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Buscar Familiar</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <!-- Combobox para seleccionar la relación familiar -->
                  <div class="mb-3">
                    <label for="relacion_familiar" class="form-label">Selecciona una relación familiar:</label>
                    <select class="form-select" id="relacion_familiar" name="relacion_familiar" onchange="redirectToIngresar()">
                      <option value="" selected disabled>Seleccione una opción</option>
                      <option value="conyugue">Conyugue</option>
                      <option value="hijo">Hijo</option>
                      <option value="padre">Padre</option>
                      <option value="madre">Madre</option>
                      <option value="hermano">Hermano</option>
                      <option value="abuelo">Abuelo</option>
                      <option value="abuela">Abuela</option>
                      <option value="tio">Tio</option>
                      <option value="padrasto">Padrasto</option>
                      <option value="madrasta">Madrasta</option>
                      <option value="medio_hermano">Medio Hermano</option>
                      <option value="hermanastro">Hermanastro</option>
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                  <!-- creamos un boton de agragar familiar -->
                  <button type="button" class="btn btn-primary">Agregar Parentesco</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>

          <script>
            function redirectToIngresar() {
              // Obtener el valor seleccionado del combobox
              var seleccion = document.getElementById("relacion_familiar").value;

              // Redirigir a la página "Ingresar" correspondiente según el valor seleccionado
              switch (seleccion) {
                case "conyugue":
                  window.location.href = "datos_personales.php";
                  break;
                case "hijo":
                  window.location.href = "datos_personales.php";
                  break;
                case "padre":
                  window.location.href = "datos_personales.php";
                  break;
                  case "madre":
                  window.location.href = "datos_personales.php";
                  break;
                  case "hermano":
                  window.location.href = "datos_personales.php";
                  break;
                  case "abuelo":
                  window.location.href = "datos_personales.php";
                  break;
                  case "abuela":
                  window.location.href = "datos_personales.php";
                  break;
                  case "tio":
                  window.location.href = "datos_personales.php";
                  break;
                  case "padrato":
                  window.location.href = "datos_personales.php";
                  break;
                  case "madrasta":
                  window.location.href = "datos_personales.php";
                  break;
                  case "medio_hermano":
                  window.location.href = "datos_personales.php";
                  break;
                  case "hermanastro":
                  window.location.href = "datos_personales.php";
                default:
                  // Si no se seleccionó ninguna opción válida, no hacer ninguna redirección.
                  break;
              }
            }
          </script>


          <!-- Bootstrap JS -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
          </body>
        