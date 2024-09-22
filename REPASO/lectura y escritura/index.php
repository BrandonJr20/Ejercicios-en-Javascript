<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Comentarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        form {
            margin-bottom: 30px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
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
        .comment {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .comment h3 {
            margin: 0 0 5px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<h1>Sistema de Comentarios</h1>

<!-- Formulario de comentarios -->
<form method="POST" action="index.php">
    <label for="name">Nombre:</label>
    <input type="text" name="name" id="name" required>

    <label for="email">Correo Electrónico:</label>
    <input type="email" name="email" id="email" required>

    <label for="comment">Comentario:</label>
    <textarea name="comment" id="comment" rows="5" required></textarea>

    <button type="submit">Enviar Comentario</button>
</form>

<?php
// Archivo donde se almacenarán los comentarios
$file = 'comments.txt';

// Función para validar campos
function validateInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = validateInput($_POST['name']);
    $email = validateInput($_POST['email']);
    $comment = validateInput($_POST['comment']);

    // Validar que no haya campos vacíos
    if (!empty($name) && !empty($email) && !empty($comment)) {
        // Crear el comentario en el formato: nombre|email|comentario
        $entry = "$name|$email|$comment\n";
        
        // Guardar el comentario en el archivo
        file_put_contents($file, $entry, FILE_APPEND);

        echo "<p>Comentario enviado con éxito.</p>";
    } else {
        echo "<p class='error'>Todos los campos son obligatorios.</p>";
    }
}

// Leer y mostrar comentarios anteriores
if (file_exists($file)) {
    $comments = file($file);

    echo "<h2>Comentarios Anteriores</h2>";
    
    foreach ($comments as $comment) {
        list($name, $email, $userComment) = explode('|', $comment);
        echo "<div class='comment'>";
        echo "<h3>$name ($email)</h3>";
        echo "<p>$userComment</p>";
        echo "</div>";
    }
}
?>

</body>
</html>
