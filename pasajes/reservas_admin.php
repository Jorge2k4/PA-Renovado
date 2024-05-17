<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: registro.php"); 
}
include("../conexion.php");

$query = "SELECT * FROM reservas";
$where_clauses = [];
if (isset($_GET['usuario']) && !empty($_GET['usuario'])) {
    $usuario_filtro = mysqli_real_escape_string($conex, $_GET['usuario']);
    $where_clauses[] = "usuario = '$usuario_filtro'";
}
if (isset($_GET['email']) && !empty($_GET['email'])) {
    $email_filtro = mysqli_real_escape_string($conex, $_GET['email']);
    $where_clauses[] = "email = '$email_filtro'";
}
if (!empty($where_clauses)) {
    $query .= " WHERE " . implode(" OR ", $where_clauses);
}


$query .= " ORDER BY fecha_creacion DESC";

$result = mysqli_query($conex, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador - Reservas</title>
</head>
<body>
    <h1>Panel de Administrador - Reservas</h1>
    <form action="" method="GET">
        <label for="usuario">Filtrar por usuario:</label>
        <input type="text" id="usuario" name="usuario" placeholder="Nombre de usuario">
        <br>
        <label for="email">Filtrar por email:</label>
        <input type="text" id="email" name="email" placeholder="Email del usuario">
        <br>
        <button type="submit">Filtrar</button>
    </form>
    <br>
    <table>
        <thead>
            <tr>
                <th>ID Reserva</th>
                <th>Usuario</th>
                <th>Email</th>
                <th>Fecha de Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id_reserva = $row['id'];
                    $usuario = $row['usuario'];
                    $email = $row['email'];
                    $fecha_creacion = $row['fecha_creacion'];
                    echo "<tr>";
                    echo "<td>$id_reserva</td>";
                    echo "<td>$usuario</td>";
                    echo "<td>$email</td>";
                    echo "<td>$fecha_creacion</td>";
                    echo "<td><a href='codigo_qr.php?id=$id_reserva'>Ver código QR</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay reservas que mostrar.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
