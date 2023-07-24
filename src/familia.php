
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
    .botones {
      margin-left: 45% !important;
      border-radius: 5px;
      background-color: #1296B4;
      padding: 10px;
      color: white;
    }
  </style>
</head>

<body>
  <div class="card">
    <div class="card-body">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <h3 class="text-center">Datos Familiares</h3>
          <!-- Button trigger modal -->
          <button type="button" class="botones" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Agregar Familiar
          </button>

          <!-- Primer Modal -->
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
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
                  <!-- Lista para mostrar los nombres agregados -->
                  <ul id="nombresList" class="list-group">

                  </ul>
                </div>
                <div class="modal-footer">
                 <!-- falta el botton para ver el 2 modal -->
                   <!-- Botón "Agregar" para abrir el segundo modal -->
                   <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#guardarModal">
                    Agregar
                  </button>
                  <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Segundo Modal para guardar los datos -->
          <div class="modal fade" id="guardarModal" tabindex="-1" aria-labelledby="guardarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="guardarModalLabel">Guardar Familiar</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <!-- Campo de entrada para el nombre -->
                  <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" require>
                  </div>                
                </div>
                <div class="modal-footer">
                  <!-- Botón "Agregar" para agregar el nombre a la lista -->

                  <button type="button" class="btn btn-secondary" onclick="agregarNombre()">Agregar</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

 <!-- JavaScript para la función de redirectToIngresar() y agregarNombre() -->
<script>
  function redirectToIngresar() {
    // Obtener el valor seleccionado del combobox
    var seleccion = document.getElementById("relacion_familiar").value;

    // Redirigir a la página "Ingresar" correspondiente según el valor seleccionado
    switch (seleccion) {
      case "conyugue":
      case "hijo":
      case "padre":
      case "madre":
      case "hermano":
      case "abuelo":
      case "abuela":
      case "tio":
      case "padrato":
      case "madrasta":
      case "medio_hermano":
      case "hermanastro":
        // redirigir a la página "Ingresar" correspondiente
        window.location.href = "datos_personales.php?relacion_familiar=" + seleccion;
     
        break;
      default:
        // Si no se seleccionó ninguna opción válida, no hacer ninguna redirección.

        break;
    }
  }
  var nombresArray = [];

  function agregarNombre() {
    // Obtener el nombre ingresado en el segundo modal
    var nombre = document.getElementById("nombre").value;
   

    // Agregar el nombre al array de nombres
    nombresArray.push(nombre);

    // Limpiar el campo de nombre en el segundo modal
    document.getElementById("nombre").value = "";
      
    // Luego, puedes cerrar el segundo modal
    var guardarModal = new bootstrap.Modal(document.getElementById("guardarModal"));
    guardarModal.hide();    
    if (nombre == "") {
      alert("El campo nombre no puede estar vacio");
    }
    if (nombre != "") {
      alert("El nombre " + nombre + " se agregó correctamente");
    }

    // Mostrar los nombres agregados en el primer modal
    actualizarNombresList();
   
  }

  function actualizarNombresList() {
    // Obtener el elemento de lista de nombres en el primer modal
    var nombresList = document.getElementById("nombresList");

    // Limpiar el contenido actual de la lista
    nombresList.innerHTML = "";

    // Recorrer el array de nombres y agregarlos a la lista
    nombresArray.forEach(function(nombre) {
      var listItem = document.createElement("li");
      listItem.textContent = nombre;
      listItem.classList.add("list-group-item");
      nombresList.appendChild(listItem);
      
    });
   
  }
</script>
</body>


