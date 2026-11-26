<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caso 2: Países de Sudamérica (foreach)</title>
    <link rel="stylesheet" href="../plantilla/css/bootstrap.min.css">
</head>
<body>
    <div class="container py-4">
        <h1 class="h3 mb-3">Caso 2: Países de Sudamérica (foreach)</h1>
        <?php
        // Vector sin colocar el número de índice (PHP lo asigna solo)
        $paises[] = "Argentina";
        $paises[] = "Bolivia";
        $paises[] = "Brasil";
        $paises[] = "Chile";
        $paises[] = "Colombia";
        $paises[] = "Ecuador";
        $paises[] = "Guyana";
        $paises[] = "Paraguay";
        $paises[] = "Perú";
        $paises[] = "Surinam";
        $paises[] = "Uruguay";
        $paises[] = "Venezuela";

        // Recorrido con foreach
        foreach ($paises as $pais) {
            echo $pais . '<br />';
        }
        ?>
    </div>
    <script src="../plantilla/js/bootstrap.bundle.min.js"></script>
</body>
</html>
