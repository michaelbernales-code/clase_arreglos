<?php
header('Content-Type: text/html; charset=UTF-8');
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/lib/planilla.php';

$empleados = obtenerEmpleados();
$totales   = totalesPlanilla($empleados);

// Boleta seleccionada (si se hizo clic en "Ver boleta")
$boleta = null;
if (isset($_GET['legajo'])) {
    $boleta = buscarEmpleado($empleados, (int) $_GET['legajo']);
}

function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
function dinero(float $n): string { return MONEDA . ' ' . number_format($n, 2); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e(APP_NAME) ?></title>
    <link rel="stylesheet" href="../plantilla/css/bootstrap.min.css">
</head>
<body>
    <div class="container py-4">
        <h1 class="display-6"><?= e(APP_NAME) ?></h1>
        <p class="text-muted">
            AFP: <?= AFP_PORCENTAJE * 100 ?> % &nbsp;|&nbsp;
            Bonificación (<?= e(implode(' / ', PROFESIONES_BONO)) ?>): <?= BONO_PORCENTAJE * 100 ?> %
        </p>

        <?php if (isset($_GET['legajo']) && $boleta === null): ?>
            <div class="alert alert-danger">No se encontró el empleado solicitado.</div>
        <?php endif; ?>

        <?php if ($boleta !== null):
            $afp  = calcularAfp($boleta['sueldo_base']);
            $bono = calcularBono($boleta['sueldo_base'], $boleta['profesion']);
            $neto = calcularNeto($boleta['sueldo_base'], $boleta['profesion']);
        ?>
            <div class="card border-primary mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between">
                    <span>Boleta de pago - Legajo <?= $boleta['legajo'] ?></span>
                    <a href="index.php" class="btn-close btn-close-white" aria-label="Cerrar"></a>
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Nombre:</strong> <?= e($boleta['nombre']) ?></p>
                    <p class="mb-1"><strong>D.N.I.:</strong> <?= e($boleta['dni']) ?></p>
                    <p><strong>Profesión:</strong> <?= e($boleta['profesion']) ?></p>
                    <table class="table table-sm w-auto">
                        <tr><td>Sueldo base</td><td class="text-end"><?= dinero($boleta['sueldo_base']) ?></td></tr>
                        <tr class="table-success"><td>(+) Bonificación</td><td class="text-end"><?= dinero($bono) ?></td></tr>
                        <tr class="table-danger"><td>(-) Aporte AFP</td><td class="text-end"><?= dinero($afp) ?></td></tr>
                        <tr class="table-dark"><td><strong>Sueldo neto</strong></td><td class="text-end"><strong><?= dinero($neto) ?></strong></td></tr>
                    </table>
                </div>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Legajo</th>
                        <th>Nombre</th>
                        <th>D.N.I.</th>
                        <th>Profesión</th>
                        <th class="text-end">Sueldo base</th>
                        <th class="text-end">Bono</th>
                        <th class="text-end">AFP</th>
                        <th class="text-end">Neto</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($empleados as $emp): ?>
                        <tr>
                            <td><?= $emp['legajo'] ?></td>
                            <td><?= e($emp['nombre']) ?></td>
                            <td><?= e($emp['dni']) ?></td>
                            <td><?= e($emp['profesion']) ?></td>
                            <td class="text-end"><?= dinero($emp['sueldo_base']) ?></td>
                            <td class="text-end"><?= dinero(calcularBono($emp['sueldo_base'], $emp['profesion'])) ?></td>
                            <td class="text-end"><?= dinero(calcularAfp($emp['sueldo_base'])) ?></td>
                            <td class="text-end"><strong><?= dinero(calcularNeto($emp['sueldo_base'], $emp['profesion'])) ?></strong></td>
                            <td><a class="btn btn-sm btn-outline-primary" href="?legajo=<?= $emp['legajo'] ?>">Ver boleta</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="table-secondary">
                    <tr>
                        <th colspan="4">Totales (<?= count($empleados) ?> empleados)</th>
                        <th class="text-end"><?= dinero($totales['base']) ?></th>
                        <th class="text-end"><?= dinero($totales['bono']) ?></th>
                        <th class="text-end"><?= dinero($totales['afp']) ?></th>
                        <th class="text-end"><?= dinero($totales['neto']) ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <script src="../plantilla/js/bootstrap.bundle.min.js"></script>
</body>
</html>
