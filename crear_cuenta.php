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
    <form method= "post" >
        <div class="logo">
            <img src="imagenes/Logo_Marina_Express-removebg.png" alt="">
        </div>
        <div class="mb-3">
            <center>
                <h2>Crear nueva cuenta</h2>
            </center>
            <div class="mb-3 mt-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" id="usuario" placeholder="usuario" name="usuario"> 
            </div>
            <div class="mb-3">
                <label for="contraseña" class="form-label">contraseña:</label>
                <input type="password" class="form-control" id="contraseña" placeholder="Contraseña" name="contraseña">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="text" class="form-control" id="email" placeholder="email" name="email">
            </div>
                <input type="submit" class="btn" name="registrarse" value="Crear cuenta">
    </form>
    <?PHP
        include ("validacion_registro.php");
    ?> 
</body>
</html>