<?php
session_start();
include "../conexion.php";
$id_user = $_SESSION['idUser'];
$permiso = "datos_personales";
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
        $foto = $_FILES['imagen']['name'];
        $tmp_name = $_FILES['imagen']['tmp_name'];
        $folder = 'ruta/';  // Ruta donde deseas guardar las imágenes

        // Mover la imagen al directorio especificado
        move_uploaded_file($tmp_name, $folder . $foto);

        $result = 0;
        if (empty($id)) {
            $query = mysqli_query($conexion, "SELECT * FROM personal WHERE nombre = '$nombre'");
            $result = mysqli_fetch_array($query);
            if ($result > 0) {
                $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        El personal ya existe
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            } else {
                $query_insert = mysqli_query($conexion, "INSERT INTO personal (documento_de_identidad, tipo_de_documento, imagen, fecha_de_expedicion, segundo_nombre, apellido, fecha_de_nacimiento, grupo_sanguinio, factor_RH, eps, arl, ccf, pais_de_residencia, departamento, estado_civil, telefono, celular, email) VALUES ('$documento_de_identidad', '$tipo_de_documento', '$foto', '$fecha_de_expedicion', '$segundo_nombre', '$apellido', '$fecha_de_nacimiento', '$grupo_sanguinio', '$factor_RH', '$eps', '$arl', '$ccf', '$pais_de_residencia', '$departamento', '$estado_civil', '$telefono', '$celular', '$email')");
                if ($query_insert) {
                    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Personal registrado
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                } else {
                    $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error al registrar
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                }
            }
        } else {
            $sql_update = mysqli_query($conexion, "UPDATE personal SET documento_de_identidad = '$documento_de_identidad', tipo_de_documento = '$tipo_de_documento', imagen = '$foto', fecha_de_expedicion = '$fecha_de_expedicion', segundo_nombre = '$segundo_nombre', apellido = '$apellido', fecha_de_nacimiento = '$fecha_de_nacimiento', grupo_sanguinio = '$grupo_sanguinio', factor_RH = '$factor_RH', eps = '$eps', arl = '$arl', ccf = '$ccf', pais_de_residencia = '$pais_de_residencia', departamento = '$departamento', estado_civil = '$estado_civil', telefono = '$telefono', celular = '$celular', email = '$email' WHERE idpersonal = $id");
            if ($sql_update) {
                $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Personal modificado
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            } else {
                $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error al modificar
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            }
        }
    }
    mysqli_close($conexion);
}
include_once "includes/header.php";

?>
<h1 class="text-center" style="color: #9C27B0;">Bienvenido</h1>
<h3 class="text-center">Registro Personal</h3>
<div class="card">
    <div class="card-body">
        <div class="row">

            <div class="col-md-12">
                <?php echo (isset($alert)) ? $alert : ''; ?>
                <form action="" method="post" autocomplete="off" id="formulario">
                    <div class="row">
                        <div>
                            <input type="submit" value="Registrar" class="btn btn-primary" id="btnAccion">
                            <input type="button" value="Nuevo" class="btn btn-success" id="btnNuevo" onclick="limpiar()">
                        </div>
                        <br><br>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="documento_de_identidad" class="text-success font-weight-bold">Documento de Identidad</label>
                                <input type="text" placeholder="Ingrese Documento de Identidad" name="documento_de_identidad" id="documento_de_identidad" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tipo_de_documento" class="text-success font-weight-bold">Tipo de Documento</label>
                                <select name="tipo_de_documento" id="tipo_de_documento" class="form-control">
                                    <option value="">Seleccione Documento</option>
                                    <option value="cedula">Cedula</option>
                                    <option value="DNI">DNI</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                    <option value="Carnet de identidad">Carnet de identidad</option>
                                    <!-- Agrega más opciones de tipo de documento según tus necesidades -->
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fecha_de_expedicion" class="text-success font-weight-bold">Fecha de Expedición</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" name="fecha_de_expedicion" id="fecha_de_expedicion" placeholder="Seleccione una fecha" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            // Inicializar el selector de fecha
                            $(document).ready(function() {
                                $('#fecha_de_expedicion').datepicker({
                                    format: 'dd/mm/yyyy',
                                    autoclose: true,
                                    todayHighlight: true
                                });
                            });
                        </script>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre" class="text-success font-weight-bold">Nombre</label>
                                <input type="text" placeholder="Ingrese Nombre" name="nombre" id="nombre" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="segundo_nombre" class="text-success font-weight-bold">Segundo Nombre</label>
                                <input type="text" placeholder="Ingrese Segundo Nombre" name="segundo_nombre" id="segundo_nombre" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="apellido" class="text-success font-weight-bold">Apellido</label>
                                <input type="text" placeholder="Ingrese Apellido" name="apellido" id="apellido" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fecha_de_nacimiento" class="text-success font-weight-bold">Fecha de Nacimiento</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" name="fecha_de_nacimiento" id="fecha_de_nacimiento" placeholder="Seleccione una fecha" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            // Inicializar el selector de fecha
                            $(document).ready(function() {
                                $('#fecha_de_nacimiento').datepicker({
                                    format: 'dd/mm/yyyy',
                                    autoclose: true,
                                    todayHighlight: true
                                });
                            });
                        </script>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="grupo_sanguinio" class="text-success font-weight-bold">Grupo Sanguíneo</label>
                                <select name="grupo_sanguinio" id="grupo_sanguinio" class="form-control">
                                    <option value="">Seleccione una opción</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <!-- Agrega más opciones según tus necesidades -->
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="factor_RH" class="text-success font-weight-bold">Factor RH</label>
                                <input type="text" placeholder="Ingrese Factor RH" name="factor_RH" id="factor_RH" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="eps" class="text-success font-weight-bold">EPS</label>
                                <select name="eps" id="eps" class="form-control">
                                    <option value="">Seleccione una opción</option>
                                    <option value="EPS Sura">EPS Sura</option>
                                    <option value="EPS Sanitas">EPS Sanitas</option>
                                    <option value="EPS Coomeva">EPS Coomeva</option>
                                    <option value="EPS Cafesalud">EPS Cafesalud</option>
                                    <option value="EPS Salud Total">EPS Salud Total</option>
                                    <!-- Agrega más opciones según tus necesidades -->
                                </select>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="arl" class="text-success font-weight-bold">ARL</label>
                                <select name="arl" id="arl" class="form-control">
                                    <option value="">Seleccione una opción</option>
                                    <option value="Axa Colpatria">Axa Colpatria</option>
                                    <option value="Colmena">Colmena</option>
                                    <option value="Positiva">Positiva</option>
                                    <option value="Seguros Bolívar">Seguros Bolívar</option>
                                    <option value="Sura">Sura</option>
                                    <option value="Colpensiones">Colpensiones</option>
                                    <option value="Colseguros">Colseguros</option>
                                    <option value="Liberty Seguros">Liberty Seguros</option>
                                    <option value="Seguros del Estado">Seguros del Estado</option>
                                    <option value="Seguros Equidad">Seguros Equidad</option>
                                    <option value="Seguros Mapfre">Seguros Mapfre</option>
                                    <option value="Seguros Mundial">Seguros Mundial</option>
                                    <option value="Seguros de Occidente">Seguros de Occidente</option>
                                    <option value="Seguros Solidaria">Seguros Solidaria</option>
                                    <option value="Seguros Suramericana">Seguros Suramericana</option>
                                    <!-- Agrega más opciones según tus necesidades -->
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="ccf" class="text-success font-weight-bold">CCF</label>
                                <input type="text" placeholder="Ingrese CCF" name="ccf" id="ccf" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pais_de_residencia" class="text-success font-weight-bold">País de Residencia</label>
                                <select name="pais" id="pais" class="form-control">
                                    <option value="">Seleccione un Pais</option>
                                    <?php
                                    include "../conexion.php";
                                    $query = mysqli_query($conexion, "SELECT * FROM pais");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        echo '<option value="' . $row['nombre'] . '">' . $row['nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="departamento" class="text-success font-weight-bold">Departamento</label>
                                <select name="departamento" id="departamento" class="form-control">
                                    <option value="">Seleccione un departamento</option>
                                    <?php
                                    include "../conexion.php";
                                    $query = mysqli_query($conexion, "SELECT * FROM departamentos");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        echo '<option value="' . $row['nombre_departamento'] . '">' . $row['nombre_departamento'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="estado_civil" class="text-success font-weight-bold">Estado Civil</label>
                                <select name="estado_civil" id="estado_civil" class="form-control">
                                    <option value="">Seleccione una opción</option>
                                    <option value="Soltero">Soltero</option>
                                    <option value="Casado">Casado</option>
                                    <option value="Divorciado">Divorciado</option>
                                    <option value="Viudo">Viudo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="telefono" class="text-success font-weight-bold">Teléfono</label>
                                <input type="text" placeholder="Ingrese Teléfono" name="telefono" id="telefono" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="celular" class="text-success font-weight-bold">Celular</label>
                                <input type="text" placeholder="Ingrese Celular" name="celular" id="celular" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="email"  class="text-success font-weight-bold">Email</label>
                                <input type="email" placeholder="Ingrese Email" name="email" id="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="imagen" class="text-success font-weight-bold">Subir Imagen</label>
                            <input type="file" name="imagen" id="imagen" class="form-control" />
                        </div>
                    </div>
               </div>
            </form>
        </div>
        <br /><br />
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th class="text-success">ID</th>
                            <th><span class="text-primary">Documento de Identidad</span></th>
                            <th><span class="text-success">Tipo de Documento</span></th>
                            <th><span class="text-danger">Fecha de Expedición</span></th>
                            <th><span class="text-warning">Nombre</span></th>
                            <th><span class="text-info">Segundo Nombre</span></th>
                            <th><span class="text-success">Apellido</span></th>
                            <th><span class="text-primary">Fecha de Nacimiento</span></th>
                            <th><span class="text-secondary">Grupo Sanguíneo</span></th>
                            <th><span class="text-success">Factor RH</span></th>
                            <th><span class="text-danger">EPS</span></th>
                            <th><span class="text-warning">ARL</span></th>
                            <th><span class="text-info">CCF</span></th>
                            <th><span class="text-warning">Pais de Residencia</span></th>
                            <th><span class="text-primary">Departamento</span></th>
                            <th><span class="text-secondary">Estado Civil</span></th>
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
                                    <td><span class="text-info"><?php echo $data['imagen']; ?></span></td>


                                    <td>
                                        <a href="#" onclick="editarCliente(<?php echo $data['id']; ?>)" class="btn btn-primary"><i class='fas fa-edit'></i></a>
                                        <form action="eliminar_personal.php?id=<?php echo $data['id']; ?>" method="post" class="confirmar d-inline">
                                            <button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
                                        </form>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>



        <?php include_once "includes/footer.php"; ?>