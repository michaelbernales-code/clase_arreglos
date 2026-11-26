<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caso 1: Días de la semana (for + count)</title>
    <link rel="stylesheet" href="../plantilla/css/bootstrap.min.css">
</head>
<body>
    <div class="container py-4">
        <h1 class="h3 mb-3">Caso 1: Días de la semana (for + count)</h1>
        <?php
        // Vector con índice inicializado en 0
        $dias[0] = "Lunes";
        $dias[1] = "Martes";
        $dias[2] = "Miércoles";
        $dias[3] = "Jueves";
        $dias[4] = "Viernes";
        $dias[5] = "Sábado";
        $dias[6] = "Domingo";

        // Recorrido con for y la función count
        for ($i = 0; $i < count($dias); $i++) {
            echo $dias[$i] . '<br />';
        }
        ?>
    </div>
    <script src="../plantilla/js/bootstrap.bundle.min.js"></script>
</body>
</html>
