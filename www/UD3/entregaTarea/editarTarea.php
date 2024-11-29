<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
        <?php include_once('menu.php'); ?>
            <main class="col">
                
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Actualizar Tarea</h2>
                </div>

                <div class="container justify-content-between">
                    <form action="editarTarea.php" method="POST" class="mb-2 w-50">
                        <?php
                        require_once('database.php');
                        if (!empty($_POST))
                        {
                            $id = $_POST['id'];
                            $titulo = $_POST['titulo'];
                            $descripcion = $_POST['descripcion'];
                            $estado = $_POST['estado'];
                            $id_usuario = $_POST['id_usuario'];
                            
                            require_once('utils.php');
                            $error = false;

                            if (!validarCampoTexto($titulo))
                            {
                                $error = true;
                                echo '<div class="alert alert-danger" role="alert">El campo Titulo es obligatorio y debe contener al menos 3 caracteres.</div>';
                            }
                            
                            if (!validarCampoTexto($descripcion))
                            {
                                $error = true;
                                echo '<div class="alert alert-danger" role="alert">El campo Descripcion es obligatorio y debe contener al menos 3 caracteres.</div>';
                            }
                            
                            if (!validarCampoTexto($estado))
                            {
                                $error = true;
                                echo '<div class="alert alert-danger" role="alert">El campo Estado es obligatorio y debe contener al menos 3 caracteres</div>';
                            }
                            
                            if (!esNumeroValido($id_usuario))
                            {
                                $error = true;
                                echo '<div class="alert alert-danger" role="alert">El campo Usuario es obligatorio </div>';
                            }
                            
                            if (!$error)
                            {
                                require_once('database.php');
                                $resultado = actualizarTarea($id, filtraCampo($titulo), filtraCampo($descripcion), filtraCampo($estado), $id_usuario);

                                if ($resultado)
                                {
                                    echo '<div class="alert alert-success" role="alert">Tarea actualizada correctamente.</div>';
                                }
                                else
                                {
                                    echo '<div class="alert alert-danger" role="alert">Ocurrió un error actualizando la Tarea: </div>';
                                }
                            }
                            else
                            {
                                echo '<div class="alert alert-danger" role="alert">No se pudo recuperar la información de la Tarea.</div>';
                            }
                        }
                        else
                        {
                            echo '<div class="alert alert-danger" role="alert">Debes acceder a través del formulario de edición de Tareas.</div>';
                        }
                        ?>
                        
                    </form>
                </div>

            </main>
        </div>
    </div>
    
    <?php include_once('footer.php'); ?>
    
</body>
</html>
