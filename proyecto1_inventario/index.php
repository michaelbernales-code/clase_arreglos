<?php
header('Content-Type: text/html; charset=UTF-8');
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/lib/inventario.php';

$inventario = obtenerInventario();
$categorias = obtenerCategorias($inventario);

// Datos del formulario de filtro
$texto     = trim($_GET['texto'] ?? '');
$categoria = $_GET['categoria'] ?? '';

$filtrados = filtrarProductos($inventario, $texto, $categoria);

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

        <!-- Métricas -->
        <div class="row row-cols-1 row-cols-md-3 g-3 my-3 text-center">
            <div class="col">
                <div class="card h-100"><div class="card-body">
                    <h2 class="h6">Total de artículos</h2>
                    <span class="badge bg-primary rounded-pill fs-6"><?= totalArticulos($inventario) ?></span>
                </div></div>
            </div>
            <div class="col">
                <div class="card h-100"><div class="card-body">
                    <h2 class="h6">Unidades en stock</h2>
                    <span class="badge bg-success rounded-pill fs-6"><?= totalUnidades($inventario) ?></span>
                </div></div>
            </div>
            <div class="col">
                <div class="card h-100"><div class="card-body">
                    <h2 class="h6">Valor total del inventario</h2>
                    <span class="badge bg-warning text-dark rounded-pill fs-6"><?= dinero(valorTotalInventario($inventario)) ?></span>
                </div></div>
            </div>
        </div>

        <!-- Filtro -->
        <form method="get" class="row g-2 align-items-end mb-4">
            <div class="col-12 col-md-5">
                <label for="texto" class="form-label">Buscar producto</label>
                <input type="text" class="form-control" id="texto" name="texto" value="<?= e($texto) ?>" placeholder="Nombre o código">
            </div>
            <div class="col-12 col-md-4">
                <label for="categoria" class="form-label">Categoría</label>
                <select class="form-select" id="categoria" name="categoria">
                    <option value="">Todas</option>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?= e($cat) ?>" <?= $cat === $categoria ? 'selected' : '' ?>><?= e($cat) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12 col-md-3 d-grid">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </form>

        <!-- Resultados -->
        <p class="text-muted">Mostrando <?= count($filtrados) ?> de <?= totalArticulos($inventario) ?> artículos.</p>

        <?php if (count($filtrados) === 0): ?>
            <div class="alert alert-warning">No se encontraron productos con ese filtro.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Código</th>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th class="text-end">Precio</th>
                            <th class="text-end">Stock</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($filtrados as $p): ?>
                            <tr>
                                <td><?= e($p['codigo']) ?></td>
                                <td><?= e($p['nombre']) ?></td>
                                <td><?= e($p['categoria']) ?></td>
                                <td class="text-end"><?= dinero($p['precio']) ?></td>
                                <td class="text-end"><?= $p['stock'] ?></td>
                                <td class="text-end"><?= dinero($p['precio'] * $p['stock']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    <script src="../plantilla/js/bootstrap.bundle.min.js"></script>
</body>
</html>
