<?php
session_start();
include "../conexion.php";
$id_user = $_SESSION['idUser'];
$permiso = "personal";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header('Location: permisos.php');
}

if (isset($_GET['alert'])) {
    $alert = $_GET['alert'];
    echo $alert;
}

if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['Institucion_Educativa']) || empty($_POST['Nivel_Academico']) || empty($_POST['Modalidad']) || empty($_POST['Titulo_Obtenido']) || empty($_POST['Fecha_Inicio']) || empty($_POST['Fecha_Finalizacion']) || empty($_FILES['Imagen']['name'])) {

        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Todos los campos son obligatorios
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
    } else {
        $documento_de_identidad = $_POST['Institucion_Educativa'];
        $tipo_de_documento = $_POST['Nivel_Academico '];
        $fecha_de_expedicion = $_POST['Modalidad'];
        $nombre = $_POST[' Titulo_Obtenido'];
        $segundo_nombre = $_POST['Fecha_Inicio'];
        $apellido = $_POST['Fecha_Finalizacion'];
        $imagen = $_FILES['Imagen']['name'];


        // Verificar si se subió una imagen
        $path = "/assets/img/data/" . basename($_FILES['Imagen']['name']);

        if (move_uploaded_file($_FILES['Imagen']['tmp_name'], $path)) {
            echo "El archivo " .  basename($_FILES['Imagen']['name']) . " ha sido subido";
        } else {
            echo "El archivo no se ha subido correctamente";
            // Establecer una imagen por defecto si no se subió ninguna
            $image_path = '/assets/img/logo.png';
        }


        $query_insert = mysqli_query($conexion, "INSERT INTO educacion ( Institucion_Educativa, Nivel_Academico, Modalidad, Titulo_Obtenido, Fecha_Inicio, Fecha_Finalizacion, Imagen) VALUES ('$Institucion_Educativa', '$Nivel_Academico', '$Modalidad', '$Titulo_Obtenido', '$Fecha_Inicio', '$Fecha_Finalizacion', $ruta$Imagen')");

        if ($query_insert) {
            $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Educacion registrada correctamente
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        } else {
            $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error al registrar los datos de la Educacion
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        }
    }
} else {
    if (!empty($_POST)) {
        $sql_update = mysqli_query($conexion, "UPDATE educacion SET Institucion_Educativa  = '$Institucion_Educativa', Nivel_Academico = '$Nivel_Academico',  Modalidad = '$Modalidad', Titulo_Obtenido= '$Titulo_Obtenido', Fecha_Inicio = '$Fecha_Inicio', Fecha_Finalizacion   = '$Fecha_Finalizacion  ', '$Imagen',  Imagen = '$ruta$Imagen' WHERE id = '$id_update'");
        if ($sql_update) {
            $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Personal actualizado correctamente
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>';
        } else {
            $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error al actualizar el personal
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>';
        }
    }
}

mysqli_close($conexion);

include_once "includes/header.php";

?>
<h1 class="text-center" style="color: #9C27B0;">Bienvenido</h1>
<h3 class="text-center">Registro Educativo</h3>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <?php echo (isset($alert)) ? $alert : ''; ?>
                <form action="" method="post" autocomplete="on" id="formulario" enctype="multipart/form-data">
                    <div class="row">
                        <br><br>
                        <!-- Institucion Educativa * -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Institucion_Educativa" class="text-success font-weight-bold">Institucion Educativa</label>
                                <input type="text" placeholder="Ingresar Documento" name="Institucion_Educativa" id="Institucion_Educativa" class="form-control" require>
                            </div>
                        </div>
                        <!-- *Nivel Academico* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Nivel_Academico" class="text-success font-weight-bold">Nivel Academico</label>
                                <input type="text" class="form-control" name="Nivel_Academico" id="Nivel_Academico" placeholder="Ingresar tipo de documento" require>
                            </div>
                        </div>
                        <!-- *Modalidad* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for=" Modalidad" class="text-success font-weight-bold">Modalidad</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" name=" Modalidad" id="Modalidad" placeholder="Ingresar la Expedición" require>
                                </div>
                            </div>
                        </div>
                        <!-- *Titulo Obtenido* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Titulo_Obtenido" class="text-success font-weight-bold">Titulo Obtenido</label>
                                <input type="text" placeholder=" Titulo_Obtenido" name="nombre" id="Titulo_Obtenido" class="form-control" require>
                            </div>
                        </div>
                        <!-- *Fecha de Inicio* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Fecha_Inicio" class="text-success font-weight-bold">Fecha de Inicio</label>
                                <div class="input-group date">
                                    <input type="date" class="form-control" name="Fecha_Inicio" id="Fecha_Inicio" placeholder="Ingrase la fecha" require>
                                </div>
                            </div>
                        </div>
                        <!-- *Fecha de Finalizacion* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Fecha_Finalizacion" class="text-success font-weight-bold">Fecha de Finalizacion</label>
                                <div class="input-group date">
                                    <input type="date" class="form-control" name="Fecha_Finalizacion" id=" Fecha_Finalizacion" placeholder="Ingrase la fecha" require>
                                </div>
                            </div>
                        </div>
                        <!-- *IMAGEN* -->
                        <div class="col-md-3">
                            <label for="Imagen" class="text-success font-weight-bold">Subir Imagen</label>
                            <input type="file" name="Imagen" id="imagen" class="form-control" require>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br /><br />
        <!-- BOTONES DE VALIDACION * -->
        <div>
        
        <input type="submit" value="Registrar" class="btn btn-primary" id="btnAccion">
          <input type="button" value="Nuevo" class="btn btn-success" id="btnNuevo" onclick="limpiar()">
         
        </div>
    </div>
    </form>
</div>
</div>
<br /><br />

<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-bordered table-success">
            <thead class="thead-dark">
                <tr>
                    <th class="text-success">ID</th>
                    <th><span class="text-primary">Institucion_Educativa</span></th>
                    <th><span class="text-success">Nivel_Academico</span></th>
                    <th><span class="text-danger">Modalidad </span></th>
                    <th><span class="text-info">Titulo_Obtenido</span></th>
                    <th><span class="text-info">Fecha_Inicio</span></th>
                    <th><span class="text-info">Fecha_Finalizacion </span></th>
                    <th><span class="text-info">Imagen</span></th>
                    <th><span class="text-success">Acciones</span></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../conexion.php";

                $query = mysqli_query($conexion, "SELECT * FROM educacion");
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                    while ($data = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><span class="text-success"><?php echo $data['id']; ?></span></td>
                            <td><span class="text-warning"><?php echo $data['Institucion_Educativa']; ?></span></td>
                            <td><span class="text-danger"><?php echo $data['Nivel_Academico']; ?></span></td>
                            <td><span class="text-primary"><?php echo $data['Modalidad']; ?></span></td>
                            <td><span class="text-primary"><?php echo $data['Titulo_Obtenido']; ?></span></td>
                            <td><span class="text-primary"><?php echo $data['Fecha_Inicio']; ?></span></td>
                            <td><span class="text-primary"><?php echo $data['Fecha_Finalizacion ']; ?></span></td>
                            <td class="text-center"><img src="/assets/img/data/<?php echo $data['#']; ?>" alt="<?php echo $data['nombre']; ?>" class="img-thumbnail" width="80px" height="80px"></td>
                            <a href="#" onclick="editarPersonal(<?php echo $data['id']; ?>)" class="btn btn-primary"><i class='fas fa-edit'></i> Editar</a>
                            <form action="eliminar_personal.php?id=<?php echo $data['id']; ?>" method="post" class="confirmar d-inline">
                                <button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> Eliminar</button>
                            </form>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>

<?php
include_once "includes/footer.php";
?>