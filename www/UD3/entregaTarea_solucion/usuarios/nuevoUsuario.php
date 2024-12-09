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
                        $nombre = $_POST['nombre'];
                        $apellidos = $_POST['apellidos'];
                        $username = $_POST['username'];
                        $contrasena = $_POST['contrasena'];
                        $error = false;
                        //verificar nombre
                        if (!validarCampoTexto($nombre))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo nombre es obligatorio y debe contener al menos 3 caracteres.</div>';
                        }
                        //verificar apellidos
                        if (!validarCampoTexto($apellidos))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo apellidos es obligatorio y debe contener al menos 3 caracteres.</div>';
                        }
                        //verificar username
                        if (!validarCampoTexto($username))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo username es obligatorio y debe contener al menos 3 caracteres.</div>';
                        }
                        //verificar contrasena
                        if (!validaContrasena($contrasena))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo contraseña es obligatorio y debe ser compleja.</div>';
                        }
                        if (!$error)
                        {
                            require_once('../modelo/pdo.php');
                            $resultado = nuevoUsuario(filtraCampo($nombre), filtraCampo($apellidos), filtraCampo($username), $contrasena);
                            if ($resultado[0])
                            {
                                echo '<div class="alert alert-success" role="alert">Usuario guardado correctamente.</div>';
                            }
                            else
                            {
                                echo '<div class="alert alert-danger" role="alert">Ocurrió un error guardando el usuario: ' . $resultado[1] . '</div>';
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
