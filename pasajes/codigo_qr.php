<?php
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

include("../conexion.php");

$id_reserva = $_GET['id'];
$query = "SELECT * FROM reservas WHERE id = $id_reserva";
$result = mysqli_query($conex, $query);
if (mysqli_num_rows($result) == 0) {
    header("Location: index.php");
    exit();
}
$row = mysqli_fetch_assoc($result);
$token = $row['codigo_qr'];
$fecha_creacion = $row['fecha_creacion'];
$usuario = $row['usuario']; // Nuevo: Obtener el usuario asociado a la reserva
$email= $row['email'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Código QR</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>
<body>
    <h1>Detalles del Código QR</h1>
    <p>ID de Reserva: <?php echo $id_reserva; ?></p>
    <p>Usuario: <?php echo $usuario; ?></p> <!-- Nuevo: Mostrar el usuario -->
    <p>Email: <?php echo $email; ?></p> <!-- Nuevo: Mostrar el usuario -->
    <p>Fecha de Creación: <?php echo $fecha_creacion; ?></p>
    <p>Código QR:</p>
    <div id="qrcode"></div>
    <a href="reservas_usuario.php">Volver a Mis Reservas</a>

    <script>
        var qrCode = new QRCode(document.getElementById("qrcode"), {
            text: "<?php echo $token; ?>",
            width: 200,
            height: 200
        });
    </script>
</body>
</html>
