<?php
include 'utils.php';

$titulo = $_POST['titulo'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$estado = $_POST['estado'] ?? '';

// Intentar guardar la tarea
$mensaje = '';
if (guardarTarea($titulo, $descripcion, $estado)) {
    $mensaje = 'La tarea se ha guardado correctamente.';
} else {
    $mensaje = 'Error al guardar la tarea. Verifique los datos e inténtelo de nuevo.';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD2 - Xacobe Tarrio</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
<body>
    <?php include 'header.php'; ?>

    <div class="container-fluid">
        <div class="row">

            <?php include 'menu.php'; ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Resultado de la Creación de Tarea</h2>
                </div>
                <div class="container">
                    <p><?php echo htmlspecialchars($mensaje); ?></p>
                </div>
            </main>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>