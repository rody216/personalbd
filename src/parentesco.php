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
    if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['cedula']) || empty($_POST['celular']) || empty($_POST['pais']) || empty($_POST['direccion']) || empty($_POST['foto']) || empty($_POST['grupo_sangre'])) {
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
        $foto = $_POST['foto'];
        $grupo_sangre = $_POST['grupo_sangre'];

        $query_insert = mysqli_query($conexion, "INSERT INTO cliente (nombre, apellido, cedula, celular, pais, direccion, foto, grupo_sangre) VALUES ('$nombre', '$apellido', '$cedula', '$celular', '$pais', '$direccion', '$foto', '$grupo_sangre')");
        if ($query_insert) {
            $cliente_id = mysqli_insert_id($conexion); // Obtener el ID del cliente recién insertado

            // Insertar registros en la tabla de parentesco
            if (!empty($_POST['parentesco'])) {
                $parentescos = $_POST['parentesco'];
                foreach ($parentescos as $parentesco) {
                    if (!empty($parentesco['nombre']) && !empty($parentesco['relacion']) && !empty($parentesco['edad']) && !empty($parentesco['direccion'])) {
                        $nombre_parentesco = $parentesco['nombre'];
                        $relacion_parentesco = $parentesco['relacion'];
                        $edad_parentesco = $parentesco['edad'];
                        $direccion_parentesco = $parentesco['direccion'];

                        $query_insert_parentesco = mysqli_query($conexion, "INSERT INTO parentesco (cliente_id, nombre, relacion, edad, direccion) VALUES ($cliente_id, '$nombre_parentesco', '$relacion_parentesco', $edad_parentesco, '$direccion_parentesco')");
                        if (!$query_insert_parentesco) {
                            $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Error al insertar los registros de parentesco
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                            break; // Salir del bucle si hay un error en la inserción del parentesco
                        }
                    }
                }
            }

            $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Parente registrado correctamente
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        } else {
            $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error al registrar el cliente
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        }
    }
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

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="validationDefault01" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="validationDefault01" name="nombre" required>
                            </div>
                            <div class="col-md-4">
                                <label for="validationDefault02" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="validationDefault02" name="apellido" required>
                            </div>
                            <div class="col-md-4">
                                <label for="validationDefaultUsername" class="form-label">Correo</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                    <input type="text" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="pais" class="form-label">Buscar Pais</label>
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
                                <label for="departamento" class="form-label">Buscar Departamento</label>
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
                                    <label for="pais" class="form-label">Buscar Ciudad</label>
                                    <select name="pais" id="pais" class="form-control">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="validationDefault05" class="form-label">Subir Imagen</label>
                                <input type="file" class="form-control" aria-label="file example" required>
                                <div class="invalid-feedback">Ejemplo de form file feedback no válido</div>
                            </div>
                            </div>
                            </div>
                            
                        <br><br><br><br><br><br>
                        <div id="parentescos">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombre_parentesco" class="text-dark font-weight-bold">Nombre Parentesco</label>
                                        <input type="text" placeholder="Ingrese Nombre Parentesco" name="parentesco[0][nombre]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="relacion_parentesco" class="text-dark font-weight-bold">Relación Parentesco</label>
                                        <input type="text" placeholder="Ingrese Relación Parentesco" name="parentesco[0][relacion]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="edad_parentesco" class="text-dark font-weight-bold">Edad Parentesco</label>
                                        <input type="text" placeholder="Ingrese Edad Parentesco" name="parentesco[0][edad]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="direccion_parentesco" class="text-dark font-weight-bold">Dirección Parentesco</label>
                                        <input type="text" placeholder="Ingrese Dirección Parentesco" name="parentesco[0][direccion]" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary" onclick="agregarParentesco()">Agregar Parentesco</button>
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
                                <th>Nombre Parentesco</th>
                                <th>Relación Parentesco</th>
                                <th>Edad Parentesco</th>
                                <th>Dirección Parentesco</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query_parentescos = mysqli_query($conexion, "SELECT * FROM parentesco");
                            while ($data_parentesco = mysqli_fetch_assoc($query_parentescos)) {
                                $id_parentesco = $data_parentesco['id'];
                                $nombre_parentesco = $data_parentesco['nombre'];
                                $relacion_parentesco = $data_parentesco['relacion'];
                                $edad_parentesco = $data_parentesco['edad'];
                                $direccion_parentesco = $data_parentesco['direccion'];
                            ?>
                                <tr>
                                    <td><?php echo $id_parentesco; ?></td>
                                    <td><?php echo $nombre_parentesco; ?></td>
                                    <td><?php echo $relacion_parentesco; ?></td>
                                    <td><?php echo $edad_parentesco; ?></td>
                                    <td><?php echo $direccion_parentesco; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
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
                                <th>País</th>
                                <th>Dirección</th>
                                <th>Foto</th>
                                <th>Grupo Sanguíneo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($conexion, "SELECT * FROM cliente");
                            $result = mysqli_num_rows($query);
                            if ($result > 0) {
                                while ($data = mysqli_fetch_assoc($query)) {
                                    $cliente_id = $data['idcliente'];
                            ?>
                                    <tr>
                                        <td><?php echo $cliente_id; ?></td>
                                        <td><?php echo $data['nombre']; ?></td>
                                        <td><?php echo $data['apellido']; ?></td>
                                        <td><?php echo $data['cedula']; ?></td>
                                        <td><?php echo $data['celular']; ?></td>
                                        <td><?php echo $data['pais']; ?></td>
                                        <td><?php echo $data['direccion']; ?></td>
                                        <td><?php echo $data['foto']; ?></td>
                                        <td><?php echo $data['grupo_sangre']; ?></td>
                                        <td>
                                            <a href="#" onclick="editarCliente(<?php echo $cliente_id; ?>)" class="btn btn-primary"><i class='fas fa-edit'></i></a>
                                            <form action="eliminar_cliente.php?id=<?php echo $cliente_id; ?>" method="post" class="confirmar d-inline">
                                                <button type="submit" class="btn btn-danger"><i class='fas fa-trash-alt'></i></button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "includes/footer.php"; ?>
