<?php
include("conexion.php");

if (isset($_POST['registrarse'])) {
    if (
        strlen($_POST["usuario"]) >= 1 &&
        strlen($_POST["contraseña"]) >= 1 &&
        strlen($_POST["email"]) >= 1
    ) {
        $usuario = trim($_POST['usuario']);
        $contraseña = trim($_POST['contraseña']);
        $email = trim($_POST['email']);
        $fecha = date("d/m/y");
        $consulta = "INSERT INTO registro_datos(usuario, contraseña,email, fecha) 
        VALUES ('$usuario', '$contraseña', '$email','$fecha')";
        $resultado = mysqli_query($conex, $consulta);


        if ($resultado) {
?>
            <h3 class="success">Tu registro se ha completado</h3>
            <script>
                setTimeout(function() {
                    alert("Tu registro se ha completado");
                    window.location.href = "registro.php";
                }, 100); 
            </script>
<?php
        } else {
?>
            <h3 class="error">Ocurrió un error</h3>
<?php
        }
    } else {
?>
        <h3 class="error">Llena todos los campos</h3>
<?php
    }
}
?>