<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD3. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once('../vista/header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('../vista/menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Gestión de tarea</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                        require_once('../utils.php');
                        $titulo = $_POST['titulo'];
                        $descripcion = $_POST['descripcion'];
                        $estado = $_POST['estado'];
                        $id_usuario = $_POST['id_usuario'];
                        $error = false;
                        //verificar titulo
                        if (!validarCampoTexto($titulo))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo titulo es obligatorio y debe contener al menos 3 caracteres.</div>';
                        }
                        //verificar descripcion
                        if (!validarCampoTexto($descripcion))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo descripcion es obligatorio y debe contener al menos 3 caracteres.</div>';
                        }
                        //verificar estado
                        if (!validarCampoTexto($estado))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo estado es obligatorio.</div>';
                        }
                        //verificar id_usuario
                        if (!esNumeroValido($id_usuario))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo usuario es obligatorio.</div>';
                        }
                        if (!$error)
                        {
                            require_once('../modelo/mysqli.php');
                            $resultado = nuevaTarea(filtraCampo($titulo), filtraCampo($descripcion), filtraCampo($estado), filtraCampo($id_usuario));
                            if ($resultado[0])
                            {
                                echo '<div class="alert alert-success" role="alert">Tarea guardada correctamente.</div>';
                            }
                            else
                            {
                                echo '<div class="alert alert-danger" role="alert">Ocurrió un error guardando la tarea: ' . $resultado[1] . '</div>';
                            }
                        }
                    ?>

                </div>
            </main>
        </div>
    </div>

    <?php include_once('../vista/footer.php'); ?>
    
</body>
</html>
