<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
        <?php include_once('menu.php'); ?>
            <main class="col">
                
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Actualizar usuario</h2>
                </div>

                <div class="container justify-content-between">
                    <form action="editarUsuario.php" method="POST" class="mb-2 w-50">
                        <?php
                        require_once('database.php');
                        if (!empty($_POST))
                        {
                            $id = $_POST['id'];
                            $nombre = $_POST['nombre'];
                            $apellidos = $_POST['apellidos'];
                            $username = $_POST['username'];
                            $contraseña = $_POST['contraseña'];
                            require_once('utils.php');
                            $error = false;

                            if (!validarCampoTexto($nombre))
                            {
                                $error = true;
                                echo '<div class="alert alert-danger" role="alert">El campo nombre es obligatorio y debe contener al menos 3 caracteres.</div>';
                            }
                            
                            if (!validarCampoTexto($apellidos))
                            {
                                $error = true;
                                echo '<div class="alert alert-danger" role="alert">El campo apellidos es obligatorio y debe contener al menos 3 caracteres.</div>';
                            }
                            
                            if (!validarCampoTexto($username))
                            {
                                $error = true;
                                echo '<div class="alert alert-danger" role="alert">El campo username es obligatorio y debe contener al menos 3 caracteres</div>';
                            }
                            
                            if (!validarCampoTexto($contraseña))
                            {
                                $error = true;
                                echo '<div class="alert alert-danger" role="alert">El campo contraseña es obligatorio y debe contener al menos 3 caracteres</div>';
                            }
                            
                            if (!$error)
                            {
                                require_once('database.php');
                                $resultado = actualizarUsuario($id, filtraCampo($nombre), filtraCampo($apellidos), filtraCampo($username), filtraCampo($contraseña));

                                if ($resultado)
                                {
                                    echo '<div class="alert alert-success" role="alert">Usuario actualizado correctamente.</div>';
                                }
                                else
                                {
                                    echo '<div class="alert alert-danger" role="alert">Ocurrió un error actualizando el usuario: </div>';
                                }
                            }
                            else
                            {
                                echo '<div class="alert alert-danger" role="alert">No se pudo recuperar la información del usuario.</div>';
                            }
                        }
                        else
                        {
                            echo '<div class="alert alert-danger" role="alert">Debes acceder a través del formulario de edición de usuarios.</div>';
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
