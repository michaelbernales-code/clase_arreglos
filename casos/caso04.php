<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caso 4: Artículos de librería (count)</title>
    <link rel="stylesheet" href="../plantilla/css/bootstrap.min.css">
</head>
<body>
    <div class="container py-4">
        <h1 class="h3 mb-3">Caso 4: Artículos de librería (count)</h1>
        <?php
        $articulos = array("Lápiz", "Goma", "Hoja", "Tinta");

        echo "Cantidad de artículos: " . count($articulos);
        ?>
    </div>
    <script src="../plantilla/js/bootstrap.bundle.min.js"></script>
</body>
</html>
