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
    if (empty($_POST['documento_de_identidad']) || empty($_POST['tipo_de_documento']) || empty($_POST['fecha_de_expedicion']) || empty($_POST['nombre']) || empty($_POST['segundo_nombre']) || empty($_POST['apellido']) || empty($_POST['fecha_de_nacimiento']) || empty($_POST['grupo_sanguinio']) || empty($_POST['factor_RH']) || empty($_POST['eps']) || empty($_POST['arl']) || empty($_POST['ccf']) || empty($_POST['pais_de_residencia']) || empty($_POST['departamento']) || empty($_POST['estado_civil']) || empty($_POST['telefono']) || empty($_POST['celular']) || empty($_POST['email']) || empty($_FILES['imagen']['name'])) {

        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Todos los campos son obligatorios
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
    } else {
        $documento_de_identidad = $_POST['documento_de_identidad'];
        $tipo_de_documento = $_POST['tipo_de_documento'];
        $fecha_de_expedicion = $_POST['fecha_de_expedicion'];
        $nombre = $_POST['nombre'];
        $segundo_nombre = $_POST['segundo_nombre'];
        $apellido = $_POST['apellido'];
        $fecha_de_nacimiento = $_POST['fecha_de_nacimiento'];
        $grupo_sanguinio = $_POST['grupo_sanguinio'];
        $factor_RH = $_POST['factor_RH'];
        $eps = $_POST['eps'];
        $arl = $_POST['arl'];
        $ccf = $_POST['ccf'];
        $pais_de_residencia = $_POST['pais_de_residencia'];
        $departamento = $_POST['departamento'];
        $estado_civil = $_POST['estado_civil'];
        $telefono = $_POST['telefono'];
        $celular = $_POST['celular'];
        $email = $_POST['email'];
        $imagen = $_FILES['imagen']['name'];


        // Verificar si se subió una imagen
        $path = "/assets/img/data/" . basename($_FILES['imagen']['name']);

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $path)) {
            echo "El archivo " .  basename($_FILES['imagen']['name']) . " ha sido subido";
        } else {
            echo "El archivo no se ha subido correctamente";
            // Establecer una imagen por defecto si no se subió ninguna
            $image_path = '/assets/img/logo.png';
        }


        $query_insert = mysqli_query($conexion, "INSERT INTO personal (documento_de_identidad, tipo_de_documento, fecha_de_expedicion, nombre, segundo_nombre, apellido, fecha_de_nacimiento, grupo_sanguinio, factor_RH, eps, arl, ccf, pais_de_residencia, departamento, estado_civil, telefono, celular, email, imagen) VALUES ('$documento_de_identidad', '$tipo_de_documento', '$fecha_de_expedicion', '$nombre', '$segundo_nombre', '$apellido', '$fecha_de_nacimiento', '$grupo_sanguinio', '$factor_RH', '$eps', '$arl', '$ccf', '$pais_de_residencia', '$departamento', '$estado_civil', '$telefono', '$celular', '$email', '$ruta$imagen')");

        if ($query_insert) {
            $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Personal registrado correctamente
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        } else {
            $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error al registrar el personal
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        }
    }
} else {
    if (!empty($_POST)) {
        $sql_update = mysqli_query($conexion, "UPDATE personal SET documento_de_identidad = '$documento_de_identidad', tipo_de_documento = '$tipo_de_documento', fecha_de_expedicion = '$fecha_de_expedicion', nombre = '$nombre', segundo_nombre = '$segundo_nombre', apellido = '$apellido', fecha_de_nacimiento = '$fecha_de_nacimiento', grupo_sanguinio = '$grupo_sanguinio', factor_RH = '$factor_RH', eps = '$eps', arl = '$arl', ccf = '$ccf', pais_de_residencia = '$pais_de_residencia', departamento = '$departamento', estado_civil = '$estado_civil', telefono = '$telefono', celular = '$celular', email = '$email', imagen = '$ruta$imagen' WHERE id = '$id_update'");
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
<h3 class="text-center">Registro Familiar</h3>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <?php echo (isset($alert)) ? $alert : ''; ?>
                <form action="" method="post" autocomplete="on" id="formulario" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Tipo de Examen* -->
                        <div>
                            <input type="search" id="mySearch" name="q" placeholder="Documento de Identidad" size="30" />
                            <button>Buscar</button>
                        </div>
                        <!-- *IMAGEN* -->
                        <div class="col-md-3">
                            <input type="file" name="imagen" id="imagen" class="form-control" />
                            <label for="imagen" class="text-success font-weight-bold">Subir Imagen</label>
                        </div>
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
                    <thead>
                        <tr>
                            <th class="text-success">ID</th>
                            <th><span class="text-primary">#</span></th>
                            <th><span class="text-success">#</span></th>
                            <th><span class="text-danger">#</span></th>
                            <th><span class="text-info">#</span></th>
                            <th><span class="text-success">Acciones</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "../conexion.php";

                        $query = mysqli_query($conexion, "SELECT * FROM personal");
                        $result = mysqli_num_rows($query);
                        if ($result > 0) {
                            while ($data = mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <!--
                                    <td><span class="text-success"><?php echo $data['id']; ?></span></td>
                                    <td><span class="text-warning"><?php echo $data['#']; ?></span></td>
                                    <td><span class="text-danger"><?php echo $data['#']; ?></span></td>
                                    <td><span class="text-primary"><?php echo $data['#']; ?></span></td>
                                    <td class="text-center"><img src="/assets/img/data/<?php echo $data['#']; ?>" alt="<?php echo $data['nombre']; ?>" class="img-thumbnail" width="80px" height="80px"></td>
                                    <td>
                                    -->
                                        <a href="#" onclick="editarPersonal(<?php echo $data['id']; ?>)" class="btn btn-primary"><i class='fas fa-edit'></i> Editar</a>
                                         <a href="ventas.php" class="btn btn-success"><i class='fas fa-edit'></i> Imprimir</a>
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