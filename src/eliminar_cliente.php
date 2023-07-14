<?php
require("../conexion.php");
$id_user = $_SESSION['idUser'];
$permiso = "clientes";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'");
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "DELETE FROM cliente WHERE idcliente = $id");
    mysqli_close($conexion);
    
    if ($query_delete) {
        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Cliente eliminado exitosamente
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al eliminar el cliente
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }
    
    header("Location: clientes.php?alert=" . urlencode($alert));
}