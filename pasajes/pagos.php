<!DOCTYPE html>
<html lang="es">
<?php
    session_start();

    if (!isset($_SESSION['usuario']) || !isset($_SESSION['email'])) {
        header("Location: registro.php");
        exit();
    }

    $usuario = $_SESSION['usuario'];
    $email = $_SESSION['email'];
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Tarjeta</title>
    <link rel="stylesheet" href="estilos.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/uuid/8.3.2/uuid.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>
<body>

<form id="paymentForm" action="#" method="post" autocomplete="off">
    Número de tarjeta<br>
    <input type="text" id="tarjeta" name="tarjeta" placeholder="XXXX XXXX XXXX XXXX" pattern="\d{4} \d{4} \d{4} \d{4}" maxlength="19" required>
    <br><br>

    Vencimiento<br>
    <input type="text" id="vencimiento" name="vencimiento" placeholder="MM/AA" maxlength="5" pattern="\d{2}/\d{2}" required>
    <br><br>

    Cvv<br>
    <input type="text" id="cvv" name="cvv" placeholder="XXX" pattern="[0-9]{3}" maxlength="3" required>
    <br><br>

    Nombre del titular<br>
    <input type="text" name="nombre" required>
    <br><br>
    <input id="QRcode" type="submit" value="Pagar">
</form>

<script>
document.getElementById('tarjeta').addEventListener('input', function (e) {
    var target = e.target;
    var position = target.selectionStart;
    var value = target.value.replace(/\D/g, '').substring(0,16);
    var newValue = '';

    for (var i = 0; i < value.length; i++) {
        if (i > 0 && i % 4 === 0) {
            newValue += ' ';
            if (i <= position) position++;
        }
        newValue += value[i];
    }
    
    target.value = newValue;
    target.setSelectionRange(position, position);
});

document.getElementById('vencimiento').addEventListener('input', function (e) {
    var target = e.target;
    var value = target.value.replace(/\D/g, '').substring(0,4);
    var newValue = '';
    
    for (var i = 0; i < value.length; i++) {
        if (i == 2) {
            newValue += '/';
        }
        newValue += value[i];
    }
    
    target.value = newValue;
});

document.getElementById('cvv').addEventListener('input', function (e) {
    var target = e.target;
    target.value = target.value.replace(/\D/g, '');
});

document.getElementById('paymentForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada
    
    // Generar un token único
    const token = uuid.v4();
    console.log('Token generado:', token);

    // Enviar el token al servidor para guardarlo en la base de datos
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'guardar_qr.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log('Código QR guardado en la base de datos.');
                alert('Código QR guardado en la base de datos.');

                // Redirige a la página de confirmación
                window.location.href = 'confirmacion_pagos.html';
            } else {
                console.error('Error al guardar el código QR en la base de datos.');
            }
        }
    };
    xhr.send('token=' + encodeURIComponent(token) + '&usuario=' + encodeURIComponent('<?php echo $usuario; ?>'));

    // Generar el código QR
    const qrContainer = document.createElement('div');
    qrContainer.id = 'qrcode';

    new QRCode(qrContainer, {
        text: token,
        width: 128,
        height: 128,
    });

    // Crear el PDF del QR
    const qrCanvas = qrContainer.querySelector('canvas');
    const imgData = qrCanvas.toDataURL('image/png');
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.setFontSize(18);
    doc.text('Código QR', 10, 10);
    doc.addImage(imgData, 'PNG', 10, 20, 50, 50);
    doc.setFontSize(12);
    doc.text('Token:', 10, 80);
    doc.text(token, 10, 90);
    doc.text('Fecha de Generación:', 10, 100);
    doc.text(new Date().toLocaleString(), 10, 110);
    doc.save('Codigo_QR.pdf');
});
</script>

</body>
</html>
