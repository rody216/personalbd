<?php
session_start();
include "../conexion.php";
$id_user = $_SESSION['idUser'];
$permiso = "clientes";
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
    if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['cedula']) || empty($_POST['celular']) || empty($_POST['pais']) || empty($_POST['direccion']) || empty($_POST['imagen']) || empty($_POST['grupo_sangre'])) {
        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Todos los campos son obligatorios
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
    } else {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $cedula = $_POST['cedula'];
        $celular = $_POST['celular'];
        $pais = $_POST['pais'];
        $direccion = $_POST['direccion'];
        $imagen = $_POST['imagen'];
        $grupo_sangre = $_POST['grupo_sangre'];
        $result = 0;
        // Verificar si se subió una imagen
        $path = "/assets/img/data/" . basename($_FILES['imagen']['name']);

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $path)) {
            echo "El archivo " .  basename($_FILES['imagen']['name']) . " ha sido subido";
        } else {
            echo "El archivo no se ha subido correctamente";
            // Establecer una imagen por defecto si no se subió ninguna
            $image_path = '/assets/img/logo.png';
        }


        if (empty($id)) {
            $query = mysqli_query($conexion, "SELECT * FROM cliente WHERE nombre = '$nombre'");
            $result = mysqli_fetch_array($query);
            if ($result > 0) {
                $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        El cliente ya existe
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            } else {
                $query_insert = mysqli_query($conexion, "INSERT INTO cliente (nombre, apellido, cedula, celular, pais, direccion, imagen, grupo_sangre) VALUES ('$nombre', '$apellido', '$cedula', '$celular', '$pais', '$direccion', '$imagen', '$grupo_sangre')");
                if ($query_insert) {
                    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Cliente registrado
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
            $sql_update = mysqli_query($conexion, "UPDATE cliente SET nombre = '$nombre', apellido = '$apellido', cedula = '$cedula', celular = '$celular', pais = '$pais', direccion = '$direccion', imagen = '$imagen', grupo_sangre = '$grupo_sangre' WHERE idcliente = $id");
            if ($sql_update) {
                $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Cliente modificado
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
                                <label for="nombre" class="text-dark font-weight-bold">Nombre</label>
                                <input type="text" placeholder="Ingrese Nombre" name="nombre" id="nombre" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="apellido" class="text-dark font-weight-bold">Apellido</label>
                                <input type="text" placeholder="Ingrese Apellido" name="apellido" id="apellido" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cedula" class="text-dark font-weight-bold">Cedula</label>
                                <input type="text" placeholder="Ingrese Cedula" name="cedula" id="cedula" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="celular" class="text-dark font-weight-bold">Celular</label>
                                <input type="text" placeholder="Ingrese Celular" name="celular" id="celular" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pais" class="text-dark font-weight-bold">País</label>
                                <input type="text" placeholder="Ingrese País" name="pais" id="pais" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="direccion" class="text-dark font-weight-bold">Dirección</label>
                                <input type="text" placeholder="Ingrese Dirección" name="direccion" id="direccion" class="form-control">
                            </div>
                        </div>
                        <!-- *IMAGEN* -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="imagen" class="text-dark font-weight-bold">Imagen</label>
                                <input type="file"  name="imagen" id="imagen" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="grupo_sangre" class="text-dark font-weight-bold">Grupo Sanguíneo</label>
                                <input type="text" placeholder="Ingrese Grupo Sanguíneo" name="grupo_sangre" id="grupo_sangre" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="tbl">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cedula</th>
                                <th>Celular</th>
                                <th>Pais</th>
                                <th>Dirección</th>
                                <th>Foto</th>
                                <th>R+H</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../conexion.php";

                            $query = mysqli_query($conexion, "SELECT * FROM cliente");
                            $result = mysqli_num_rows($query);
                            if ($result > 0) {
                                while ($data = mysqli_fetch_assoc($query)) { ?>
                                    <tr>
                                        <td><?php echo $data['idcliente']; ?></td>
                                        <td><?php echo $data['nombre']; ?></td>
                                        <td><?php echo $data['apellido']; ?></td>
                                        <td><?php echo $data['cedula']; ?></td>
                                        <td><?php echo $data['celular']; ?></td>
                                        <td><?php echo $data['pais']; ?></td>
                                        <td><?php echo $data['direccion']; ?></td>
                                        <td><?php echo $data['foto']; ?></td>
                                        <td><?php echo $data['grupo_sangre']; ?></td>
                                        <td>
                                            <a href="#" onclick="editarCliente(<?php echo $data['idcliente']; ?>)" class="btn btn-primary"><i class='fas fa-edit'></i></a>
                                            <form action="eliminar_cliente.php?id=<?php echo $data['idcliente']; ?>" method="post" class="confirmar d-inline">
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
        </div>
    </div>
</div>
<?php include_once "includes/footer.php"; ?>