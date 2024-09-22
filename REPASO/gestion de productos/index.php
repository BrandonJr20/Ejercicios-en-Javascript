<?php
// Inicializamos el array de productos
$productos = [];

// Función para agregar un nuevo producto
function agregarProducto(&$productos, $nombre, $precio, $cantidad) {
    $productos[] = [
        'nombre' => $nombre,
        'precio' => $precio,
        'cantidad' => $cantidad,
    ];
}

// Función para eliminar un producto por su nombre
function eliminarProducto(&$productos, $nombre) {
    foreach ($productos as $key => $producto) {
        if ($producto['nombre'] === $nombre) {
            unset($productos[$key]);
            return true;
        }
    }
    return false;
}

// Función para actualizar el precio o cantidad de un producto
function actualizarProducto(&$productos, $nombre, $nuevoPrecio = null, $nuevaCantidad = null) {
    foreach ($productos as &$producto) {
        if ($producto['nombre'] === $nombre) {
            if ($nuevoPrecio !== null) {
                $producto['precio'] = $nuevoPrecio;
            }
            if ($nuevaCantidad !== null) {
                $producto['cantidad'] = $nuevaCantidad;
            }
            return true;
        }
    }
    return false;
}

// Función para mostrar el listado de productos ordenado por precio
function mostrarProductos($productos, $orden = 'asc') {
    if ($orden === 'asc') {
        usort($productos, fn($a, $b) => $a['precio'] <=> $b['precio']);
    } else {
        usort($productos, fn($a, $b) => $b['precio'] <=> $a['precio']);
    }
    
    foreach ($productos as $producto) {
        echo "Nombre: {$producto['nombre']}, Precio: \${$producto['precio']}, Cantidad: {$producto['cantidad']}<br>";
    }
}

// Agregamos algunos productos de prueba
agregarProducto($productos, 'Producto A', 50, 10);
agregarProducto($productos, 'Producto B', 30, 5);
agregarProducto($productos, 'Producto C', 70, 2);

// Actualizamos el precio del Producto A
actualizarProducto($productos, 'Producto A', 45);

// Eliminamos el Producto B
eliminarProducto($productos, 'Producto B');

// Mostramos los productos ordenados por precio ascendente
echo "<h2>Listado de Productos (Ascendente)</h2>";
mostrarProductos($productos, 'asc');

// Mostramos los productos ordenados por precio descendente
echo "<h2>Listado de Productos (Descendente)</h2>";
mostrarProductos($productos, 'desc');
?>
