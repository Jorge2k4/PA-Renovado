<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="utf-8">
    <title>Marina Express</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <main>
        <form method="post">
            <div class="logo">
                <img src="imagenes/Logo_Marina_Express-removebg.png" alt="">
            </div>
            <div class="mb-3">
                <center>
                    <h2>Iniciar Sesión</h2>
                </center>
                <div class="mb-3 mt-3">
                    <label for="usuario" class="form-label">Usuario:</label>
                    <input type="text" class="form-control" id="usuario" placeholder="Usuario" name="usuario">
                </div>
                <div class="mb-3">
                    <label for="contraseña" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" id="contraseña" placeholder="Contraseña" name="contraseña">
                </div>
                <button type="submit" class="btn btn-primary">Ingresar</button>
                <a href="crear_cuenta.php" class="btn btn-primary">Crear nueva cuenta</a>
                <a href="invitado.html" class="btn btn-primary">Ingresar como invitado</a>
            </div>
        </form>

        <?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("conexion.php");

    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    $consulta = "SELECT * FROM registro_datos WHERE usuario='$usuario'";
    $resultado = mysqli_query($conex, $consulta);

    if (mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_assoc($resultado);
        $contraseña_hash = $fila['contraseña'];

        if (password_verify($contraseña, $contraseña_hash)) {
            // Establecer variables de sesión
            $_SESSION['usuario'] = $usuario;
            $_SESSION['email'] = $fila['email'];
            
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Usuario o contraseña incorrectos. Por favor, inténtalo de nuevo.');</script>";
        }
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos. Por favor, inténtalo de nuevo.');</script>";
    }
}
?>
