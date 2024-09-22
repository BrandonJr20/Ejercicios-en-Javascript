<?php
session_start(); // Iniciar la sesión

// Inicializar saldo
if (!isset($_SESSION['saldo'])) {
    $_SESSION['saldo'] = 0; // Saldo inicial
}

// Inicializar variables
$monto = 0;
$mensaje = '';

// Procesar el formulario al enviarlo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cantidad_inicial'])) {
        $monto = floatval(trim($_POST['cantidad_inicial']));
        $_SESSION['saldo'] += $monto; // Sumar monto al saldo
        $mensaje = "Se ha ingresado: $" . number_format($monto, 2);
    } elseif (isset($_POST['retiro'])) {
        $monto = floatval(trim($_POST['retiro']));
        if ($monto > $_SESSION['saldo']) {
            $mensaje = "No se puede retirar esa cantidad. Saldo actual: $" . number_format($_SESSION['saldo'], 2);
        } else {
            $_SESSION['saldo'] -= $monto; // Restar monto del saldo
            $mensaje = "Se ha retirado: $" . number_format($monto, 2);
        }
    }
}

$saldoActual = $_SESSION['saldo'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de Ingreso Bancario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }
        input {
            margin: 10px 0;
            padding: 10px;
            width: 90%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h1>Simulador de Ingreso Bancario</h1>

<div style="margin: 20px 0;">
    <strong>Saldo Actual: $<?php echo number_format($saldoActual, 2); ?></strong>
</div>

<?php
// Mostrar mensaje
if ($mensaje) {
    echo '<div>' . $mensaje . '</div>';
}
?>

<form method="post" action="">
    <h2>Ingresar Cantidad Inicial</h2>
    <input type="number" name="cantidad_inicial" placeholder="Monto a ingresar" step="0.01" required>
    <button type="submit">Ingresar</button>
</form>

<form method="post" action="" style="margin-top: 20px;">
    <h2>Retirar Cantidad</h2>
    <input type="number" name="retiro" placeholder="Monto a retirar" step="0.01" required>
    <button type="submit">Retirar</button>
</form>

</body>
</html>
