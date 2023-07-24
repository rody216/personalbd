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
    $result = $_POST['resul'];
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
        $path = "../assets/img/data" . basename($_FILES['imagen']['name']);

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $path)) {
            echo "El archivo " .  basename($_FILES['imagen']['name']) . " ha sido subido";
        } else {
            echo "El archivo no se ha subido correctamente";
            // Establecer una imagen por defecto si no se subió ninguna
            $image_path = '/assets/img/logo.png';
        }


        $query_insert = mysqli_query($conexion, "INSERT INTO personal (documento_de_identidad, tipo_de_documento, fecha_de_expedicion, nombre, segundo_nombre, apellido, fecha_de_nacimiento, grupo_sanguinio, factor_RH, eps, arl, ccf, pais_de_residencia, departamento, estado_civil, telefono, celular, email, imagen) VALUES ('$documento_de_identidad', '$tipo_de_documento', '$fecha_de_expedicion', '$nombre', '$segundo_nombre', '$apellido', '$fecha_de_nacimiento', '$grupo_sanguinio', '$factor_RH', '$eps', '$arl', '$ccf', '$pais_de_residencia', '$departamento', '$estado_civil', '$telefono', '$celular', '$email', '$imagen')");

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
<h2 class="text-center" style="color: #9C27B0;">Bienvenido</h2>
<h5 class="text-center">Datos Personales</h5>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <?php echo (isset($alert)) ? $alert : ''; ?>
                <form action="" method="post" autocomplete="on" id="formulario" enctype="multipart/form-data">
                    <div class="row">
                        <!-- BOTONES DE VALIDACION * -->
                        <div>
                            <button type="submit" class="btn btn-primary" id="btnAccion">
                                <i class="fas fa-save"></i> Registrar
                            </button>
                           <!-- <input type="submit" value="Registrar" class="btn btn-primary" id="btnAccion">
                            <input type="button" value="Actualizar" class="btn btn-success" id="btnNuevo" onclick="limpiar()">
                            -->
                            <button type="button" class="btn btn-success" id="btnNuevo" onclick="limpiar()">
                                <i class="fas fa-sync-alt"></i> Actualizar
                            </button>
                        </div>
                        <br><br>
                        <!-- DOCUMENTO DE IDENTIDAD * -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="documento_de_identidad" class="text-success font-weight-bold">Documento de Identidad</label>
                                <input type="number" placeholder="Ingresar Documento" name="documento_de_identidad" id="documento_de_identidad" class="form-control">
                            </div>
                        </div>
                        <!-- *TIPO DE DOCUMENTO* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tipo_de_documento" class="text-success font-weight-bold">Tipo de Documento</label>
                                <input type="text" class="form-control" name="tipo_de_documento" id="tipo_de_documento" placeholder="Ingresar tipo de documento">
                            </div>
                        </div>
                        <!-- *FECHA DE EXPEDICION* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fecha_de_expedicion" class="text-success font-weight-bold">Fecha de Expedición</label>
                                <div class="input-group date">
                                    <input type="date" class="form-control" name="fecha_de_expedicion" id="fecha_de_expedicion" placeholder="Ingresar la Expedición">
                                </div>
                            </div>
                        </div>
                        <!-- *NOMBRE* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre" class="text-success font-weight-bold">Nombre</label>
                                <input type="text" placeholder="Ingrese Nombre" name="nombre" id="nombre" class="form-control">
                            </div>
                        </div>
                        <!-- *SEGUNDO NOMBRE* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="segundo_nombre" class="text-success font-weight-bold">Segundo Nombre</label>
                                <input type="text" placeholder="Ingrese Segundo Nombre" name="segundo_nombre" id="segundo_nombre" class="form-control">
                            </div>
                        </div>
                        <!-- *APELLIDO* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="apellido" class="text-success font-weight-bold">Apellido</label>
                                <input type="text" placeholder="Ingrese Apellido" name="apellido" id="apellido" class="form-control">
                            </div>
                        </div>
                        <!-- *FECHA DE NACIMIENTO* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fecha_de_nacimiento" class="text-success font-weight-bold">Fecha de Nacimiento</label>
                                <div class="input-group date">
                                    <input type="date" class="form-control" name="fecha_de_nacimiento" id="fecha_de_nacimiento" placeholder="Ingrase la fecha">
                                </div>
                            </div>
                        </div>
                        <!-- *GRUPO SANGUINIO* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="grupo_sanguinio" class="text-success font-weight-bold">Grupo Sanguíneo</label>
                                <input type="text" placeholder=" Ingresar Grupo Sanguíneo" name="grupo_sanguinio" id="grupo_sanguinio" class="form-control">
                            </div>
                        </div>
                        <!-- *FACTOR RH* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="factor_RH" class="text-success font-weight-bold">Factor RH</label>
                                <input type="text" placeholder="Ingresar Factor RH" name="factor_RH" id="factor_RH" class="form-control">
                            </div>
                        </div>
                        <!-- *EPS* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="eps" class="text-success font-weight-bold">EPS</label>
                                <input type="text" placeholder="Ingresar EPS" name="eps" id="eps" class="form-control">
                            </div>
                        </div>
                        <!-- *ARL* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="arl" class="text-success font-weight-bold">ARL</label>
                                <input type="text" placeholder=" Ingresar ARL" name="arl" id="arl" class="form-control">
                            </div>
                        </div>
                        <!-- *CCF* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="ccf" class="text-success font-weight-bold">CCF</label>
                                <input type="text" placeholder="Ingrese CCF" name="ccf" id="ccf" class="form-control">
                            </div>
                        </div>
                        <!-- *PAIS DE RECIDENCIA* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pais_de_residencia" class="text-success font-weight-bold">País de Residencia</label>
                                <input type="text" placeholder=" Ingrese País de Residencia" name="pais_de_residencia" id="pais_de_residencia" class="form-control">
                            </div>
                        </div>
                        <!-- *DEPARTAMENTO* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="departamento" class="text-success font-weight-bold">Departamento</label>
                                <input type="text" placeholder="Ingrese Departamento" name="departamento" id="departamento" class="form-control">
                            </div>
                        </div>
                        <!-- *ESTADO_CIVIL* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="estado_civil" class="text-success font-weight-bold">Estado Civil</label>
                                <input type="text" placeholder="Ingrese Estado" name="estado_civil" id="estado_civil" class="form-control">
                            </div>
                        </div>
                        <!-- *TELEFONO* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="telefono" class="text-success font-weight-bold">Teléfono</label>
                                <input type="text" placeholder="Ingrese Teléfono" name="telefono" id="telefono" class="form-control">
                            </div>
                        </div>
                        <!-- *CELULAR* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="celular" class="text-success font-weight-bold">Celular</label>
                                <input type="text" placeholder="Ingrese Celular" name="celular" id="celular" class="form-control">
                            </div>
                        </div>
                        <!-- *EMAIL* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="email" class="text-success font-weight-bold">Email</label>
                                <input type="email" placeholder="Ingrese Email" name="email" id="email" class="form-control">
                            </div>
                        </div>
                        <!-- *IMAGEN* -->
                        <div class="col-md-3">
                            <label for="imagen" class="text-success font-weight-bold">Subir Imagen</label>
                            <input type="file" name="imagen" id="imagen" class="form-control" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br /><br />
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-primary">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-success">ID</th>
                            <th><span class="text-primary">Documento</span></th>
                            <th><span class="text-success">Tipo</span></th>
                            <th><span class="text-danger">Fecha</span></th>
                            <th><span class="text-warning">Nombre</span></th>
                            <th><span class="text-info">Segundo</span></th>
                            <th><span class="text-success">Apellido</span></th>
                            <th><span class="text-primary">Nacimiento</span></th>
                            <th><span class="text-secondary">Grupo</span></th>
                            <th><span class="text-success">RH</span></th>
                            <th><span class="text-danger">EPS</span></th>
                            <th><span class="text-warning">ARL</span></th>
                            <th><span class="text-info">CCF</span></th>
                            <th><span class="text-warning">País</span></th>
                            <th><span class="text-primary">Departamento</span></th>
                            <th><span class="text-secondary">Estado</span></th>
                            <th><span class="text-success">Teléfono</span></th>
                            <th><span class="text-danger">Celular</span></th>
                            <th><span class="text-warning">Email</span></th>
                            <th><span class="text-info">Imagen</span></th>
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
                                    <td><span class="text-success"><?php echo $data['id']; ?></span></td>
                                    <td><span class="text-primary"><?php echo $data['documento_de_identidad']; ?></span></td>
                                    <td><span class="text-success"><?php echo $data['tipo_de_documento']; ?></span></td>
                                    <td><span class="text-danger"><?php echo $data['fecha_de_expedicion']; ?></span></td>
                                    <td><span class="text-warning"><?php echo $data['nombre']; ?></span></td>
                                    <td><span class="text-info"><?php echo $data['segundo_nombre']; ?></span></td>
                                    <td><span class="text-success"><?php echo $data['apellido']; ?></span></td>
                                    <td><span class="text-primary"><?php echo $data['fecha_de_nacimiento']; ?></span></td>
                                    <td><span class="text-secondary"><?php echo $data['grupo_sanguinio']; ?></span></td>
                                    <td><span class="text-success"><?php echo $data['factor_RH']; ?></span></td>
                                    <td><span class="text-danger"><?php echo $data['eps']; ?></span></td>
                                    <td><span class="text-warning"><?php echo $data['arl']; ?></span></td>
                                    <td><span class="text-info"><?php echo $data['ccf']; ?></span></td>
                                    <td><span class="text-warning"><?php echo $data['pais_de_residencia']; ?></span></td>
                                    <td><span class="text-primary"><?php echo $data['departamento']; ?></span></td>
                                    <td><span class="text-secondary"><?php echo $data['estado_civil']; ?></span></td>
                                    <td><span class="text-success"><?php echo $data['telefono']; ?></span></td>
                                    <td><span class="text-danger"><?php echo $data['celular']; ?></span></td>
                                    <td><span class="text-warning"><?php echo $data['email']; ?></span></td>
                                    <td class="text-center"><img src="/assets/img/data/<?php echo $data['imagen']; ?>" alt="<?php echo $data['nombre']; ?>" class="img-thumbnail" width="80px" height="80px"></td>
                                    <td>
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