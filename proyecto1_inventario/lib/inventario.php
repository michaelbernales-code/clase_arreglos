<?php
// Catálogo de productos: arreglo asociativo multidimensional
function obtenerInventario(): array
{
    return [
        ['codigo' => 'LIB-001', 'nombre' => 'Lápiz HB',              'categoria' => 'Escritura', 'precio' => 1.50,  'stock' => 200],
        ['codigo' => 'LIB-002', 'nombre' => 'Lapicero azul',         'categoria' => 'Escritura', 'precio' => 2.00,  'stock' => 150],
        ['codigo' => 'LIB-003', 'nombre' => 'Goma de borrar',        'categoria' => 'Útiles',    'precio' => 1.00,  'stock' => 120],
        ['codigo' => 'LIB-004', 'nombre' => 'Cuaderno A4 100 hojas', 'categoria' => 'Papelería', 'precio' => 6.50,  'stock' => 80],
        ['codigo' => 'LIB-005', 'nombre' => 'Resma de hojas bond',   'categoria' => 'Papelería', 'precio' => 22.00, 'stock' => 35],
        ['codigo' => 'LIB-006', 'nombre' => 'Tinta para impresora',  'categoria' => 'Tintas',    'precio' => 45.00, 'stock' => 12],
        ['codigo' => 'LIB-007', 'nombre' => 'Regla de 30 cm',        'categoria' => 'Útiles',    'precio' => 2.50,  'stock' => 60],
        ['codigo' => 'LIB-008', 'nombre' => 'Plumones x12',          'categoria' => 'Escritura', 'precio' => 9.90,  'stock' => 40],
    ];
}

// Total de artículos (registros) usando count()
function totalArticulos(array $inventario): int
{
    return count($inventario);
}

// Total de unidades en stock
function totalUnidades(array $inventario): int
{
    $total = 0;
    foreach ($inventario as $p) {
        $total += $p['stock'];
    }
    return $total;
}

// Valor total del inventario = suma(precio * stock)
function valorTotalInventario(array $inventario): float
{
    $total = 0.0;
    foreach ($inventario as $p) {
        $total += $p['precio'] * $p['stock'];
    }
    return $total;
}

// Lista de categorías sin repetir
function obtenerCategorias(array $inventario): array
{
    $categorias = array_unique(array_column($inventario, 'categoria'));
    sort($categorias);
    return $categorias;
}

// Filtra por texto (nombre/código) y por categoría
function filtrarProductos(array $inventario, string $texto = '', string $categoria = ''): array
{
    $resultado = [];
    foreach ($inventario as $p) {
        $coincideTexto = $texto === ''
            || mb_stripos($p['nombre'], $texto) !== false
            || mb_stripos($p['codigo'], $texto) !== false;
        $coincideCategoria = $categoria === '' || $p['categoria'] === $categoria;

        if ($coincideTexto && $coincideCategoria) {
            $resultado[] = $p;
        }
    }
    return $resultado;
}
