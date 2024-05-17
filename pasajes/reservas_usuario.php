<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: registro.php");
    exit();
}
include("../conexion.php");

$usuario = $_SESSION['usuario'];

$query = "SELECT * FROM reservas WHERE usuario = '$usuario' ORDER BY fecha_creacion DESC"; 
$result = mysqli_query($conex, $query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas</title>
</head>
<body>
    <h1>Mis Reservas</h1>
    <table>
        <thead>
            <tr>
                <th>ID Reserva</th>
                <th>Fecha de Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id_reserva = $row['id'];
                    $fecha_creacion = $row['fecha_creacion'];
                    echo "<tr>";
                    echo "<td>$id_reserva</td>";
                    echo "<td>$fecha_creacion</td>";
                    echo "<td><a href='codigo_qr.php?id=$id_reserva'>Ver código QR</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No tienes reservas.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
