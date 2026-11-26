<?php
// Empleados: arreglo multidimensional asociativo
function obtenerEmpleados(): array
{
    return [
        ['legajo' => 4371, 'nombre' => 'Martínez Leandro', 'dni' => '27643742', 'sueldo_base' => 1429.54, 'profesion' => 'Arquitecto'],
        ['legajo' => 4372, 'nombre' => 'Gómez Ana',        'dni' => '30112233', 'sueldo_base' => 1850.00, 'profesion' => 'Ingeniero'],
        ['legajo' => 4373, 'nombre' => 'Ramos Carlos',     'dni' => '41225566', 'sueldo_base' => 1200.00, 'profesion' => 'Contador'],
        ['legajo' => 4374, 'nombre' => 'Morales Luis',     'dni' => '45778899', 'sueldo_base' => 1100.00, 'profesion' => 'Diseñador'],
    ];
}

// Aporte AFP = 10 % del sueldo base
function calcularAfp(float $sueldoBase): float
{
    return $sueldoBase * AFP_PORCENTAJE;
}

// Bonificación del 5 % solo si es Arquitecto o Ingeniero
function calcularBono(float $sueldoBase, string $profesion): float
{
    return in_array($profesion, PROFESIONES_BONO, true) ? $sueldoBase * BONO_PORCENTAJE : 0.0;
}

// Sueldo neto = base + bono - AFP
function calcularNeto(float $sueldoBase, string $profesion): float
{
    return $sueldoBase + calcularBono($sueldoBase, $profesion) - calcularAfp($sueldoBase);
}

// Busca un empleado por legajo (o null si no existe)
function buscarEmpleado(array $empleados, int $legajo): ?array
{
    foreach ($empleados as $emp) {
        if ($emp['legajo'] === $legajo) {
            return $emp;
        }
    }
    return null;
}

// Totales de la planilla
function totalesPlanilla(array $empleados): array
{
    $t = ['base' => 0.0, 'bono' => 0.0, 'afp' => 0.0, 'neto' => 0.0];
    foreach ($empleados as $e) {
        $t['base'] += $e['sueldo_base'];
        $t['bono'] += calcularBono($e['sueldo_base'], $e['profesion']);
        $t['afp']  += calcularAfp($e['sueldo_base']);
        $t['neto'] += calcularNeto($e['sueldo_base'], $e['profesion']);
    }
    return $t;
}
