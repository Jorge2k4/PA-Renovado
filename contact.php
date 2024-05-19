<?php

/*if(isset($_POST["enviar"])) {
    if(!empty($_POST['nombre']) && !empty($_POST['asunto']) && !empty($_POST['correo']) && !empty($_POST['msg'])) {
    $name = $_POST['nombre'];
    $email = $_POST['correo'];
    $m_subject = $_POST['asunto'];
    $message = $_POST['msg'];

    $header = "From: $email" . "\r\n";
    $header.= "Reply-To: $email" . "\r\n";
    $header.= "X-Mailer: PHP/". phpversion();

    $to = "jm102760@gmail.com"; // Change this email to your //
    $subject = "$m_subject:  $name";

    $body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\n\nEmail: $email\n\nSubject: $m_subject\n\nMessage: $message";

    $mail = @mail($to, $email, $m_subject, $message, $header);

    if($mail) {
        echo "<h4>Mensaje enviado exitosamente</h4>";
    }
    }
}*/



// Declarando variables 
//----------------------------------------------------
$name = $_POST['nombre'];
$email = $_POST['correo'];
$m_subject = $_POST['asunto'];
$message = $_POST['msg'];
//-----------------------------------------------------

if (isset($_POST["enviar"])) {
    $isValid = true;

    // Validar nombre
    if (empty($_POST['nombre'])) {
        $isValid = false;
        echo "Error: Ingrese su nombre.";
    }

    // Validar correo electrónico
    if (empty($_POST['correo']) || !filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {
        $isValid = false;
        echo "Error: Ingrese una dirección de correo electrónico válida.";
    }

    // Validar asunto
    if (empty($_POST['asunto'])) {
        $isValid = false;
        echo "Error: Ingrese un asunto.";
    }

    // Validar mensaje
    if (empty($_POST['msg'])) {
        $isValid = false;
        echo "Error: Ingrese un mensaje.";
    }

    // Si la validación pasa, proceda a enviar el correo electrónico
    if ($isValid) {
        $header = "From: $email" . "\r\n";
        $header.= "Reply-To: $to" . "\r\n";
        $header.= "Content-Type: text/plain; charset=UTF-8" . "\r\n"; // Establecer la codificación de caracteres para una visualización adecuada
        $header.= "X-Mailer: PHP/" . phpversion();
    
        $to = "marinaexpressoficial@gmail.com"; // Reemplace con su correo electrónico de destino
        $subject = "$m_subject: $nombre";
    
        $body = "Ha recibido un nuevo mensaje del formulario de contacto de su sitio web.\n\n" .
                "Aquí están los detalles:\n\n" .
                "Nombre: $nombre\n\n" .
                "Correo electrónico: $email\n\n" .
                "Asunto: $m_subject\n\n" .
                "Mensaje: $message";
    
        if (@mail($to, $subject, $body, $header)) {
            echo "<h4>Mensaje enviado exitosamente</h4>";
        } else {
            echo "Error: Hubo un problema al enviar el correo electrónico. Inténtalo de nuevo más tarde.";
        }
    }
}



?>