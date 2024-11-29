<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once('menu.php'); ?>

            <main class="col">
                
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Nueva Tarea</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                    require_once('database.php');
                    $usuarios=listaUsuarios();

                    $titulo = $_POST['titulo'];
                    $descripcion = $_POST['descripcion'];
                    $estado = $_POST['estado'];
                    $id_usuario = $_POST['id_usuario'];
                    require_once('utils.php');
                    $error = false;

                    if (!validarCampoTexto($titulo))
                    {
                        $error = true;
                        echo '<div class="alert alert-danger" role="alert">El campo titulo es obligatorio y debe contener al menos 3 caracteres.</div>';
                    }
                    
                    if (!validarCampoTexto($descripcion))
                    {
                        $error = true;
                        echo '<div class="alert alert-danger" role="alert">El campo descripcione es obligatorio y debe contener al menos 3 caracteres.</div>';
                    }
                
                    if (!validarCampoTexto($estado))
                    {
                        $error = true;
                        echo '<div class="alert alert-danger" role="alert">El campo estado es obligatorio y debe contener solo números.</div>';
                    }
                    if (!esNumeroValido($id_usuario[0]))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">Revisa el usuario. </div>';
                        }
                    
                    if (!$error)
                    {
                        require_once('database.php');
                        $resultado = nuevaTarea(filtraCampo($titulo), filtraCampo($descripcion), filtraCampo($estado), filtraCampo($id_usuario[0]));
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
    
    <?php include_once('footer.php'); ?>
    
</body>
</html>
