<?php
session_start(); // Iniciar la sesión

// Inicializar variables
$nombre = $edad = $correo = '';
$errores = [];

// Procesar el formulario al enviarlo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $edad = trim($_POST['edad']);
    $correo = trim($_POST['correo']);

    // Validación
    if (empty($nombre)) {
        $errores[] = "El nombre no puede estar vacío.";
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no es válido.";
    }

    if (empty($errores)) {
        // Almacenar los datos en la sesión
        $_SESSION['nombre'] = $nombre;
        $_SESSION['edad'] = $edad;
        $_SESSION['correo'] = $correo;

        // Mensaje de éxito
        $mensaje = "Datos almacenados correctamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Usuario</title>
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

<h1>Formulario de Usuario</h1>

<?php
// Mostrar mensajes de error
if (!empty($errores)) {
    echo '<div style="color: red;">' . implode('<br>', $errores) . '</div>';
}

// Mostrar mensaje de éxito
if (isset($mensaje)) {
    echo '<div style="color: green;">' . $mensaje . '</div>';
}
?>

<form method="post" action="">
    <input type="text" name="nombre" placeholder="Nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
    <input type="number" name="edad" placeholder="Edad" value="<?php echo htmlspecialchars($edad); ?>" required>
    <input type="email" name="correo" placeholder="Correo Electrónico" value="<?php echo htmlspecialchars($correo); ?>" required>
    <button type="submit">Enviar</button>
</form>

</body>
</html>
