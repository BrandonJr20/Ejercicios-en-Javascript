<?php
// Verificamos si se ha solicitado la descarga del CSV
if (isset($_POST['download'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="tabla_multiplicar.csv"');

    // Abrimos la salida para escritura
    $output = fopen('php://output', 'w');

    // Generamos las filas del CSV
    for ($i = 1; $i <= 12; $i++) {
        $row = [];
        for ($j = 1; $j <= 12; $j++) {
            $row[] = $i * $j;
        }
        fputcsv($output, $row);
    }

    fclose($output);
    exit; // Terminamos el script después de la descarga
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas de Multiplicar</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
    </style>
</head>
<body>

<h1>Tablas de Multiplicar del 1 al 12</h1>

<table>
    <thead>
        <tr>
            <th>Multiplicador</th>
            <?php for ($j = 1; $j <= 12; $j++): ?>
                <th><?php echo $j; ?></th>
            <?php endfor; ?>
        </tr>
    </thead>
    <tbody>
        <?php for ($i = 1; $i <= 12; $i++): ?>
            <tr>
                <td><?php echo $i; ?></td>
                <?php for ($j = 1; $j <= 12; $j++): ?>
                    <td><?php echo $i * $j; ?></td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </tbody>
</table>

<form method="post" action="">
    <button type="submit" name="download">Descargar como CSV</button>
</form>

</body>
</html>
