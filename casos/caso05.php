<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caso 5: Datos del empleado</title>
    <link rel="stylesheet" href="../plantilla/css/bootstrap.min.css">
</head>
<body>
    <div class="container py-4">
        <h1 class="h3 mb-3">Caso 5: Datos del empleado</h1>
        <?php
        // Vector asociativo con los datos personales del empleado
        $empleado = array(
            'Legajo'    => 4371,
            'Nombre'    => "Martínez Leandro",
            'D.N.I'     => "27643742",
            'Sueldo'    => 1429.54,
            'Profesión' => "Arquitecto"
        );

        echo "<strong>--Datos del empleado--</strong><br /><br />";
        foreach ($empleado as $campo => $valor) {
            echo $campo . " = " . $valor . '<br />';
        }
        ?>
    </div>
    <script src="../plantilla/js/bootstrap.bundle.min.js"></script>
</body>
</html>
