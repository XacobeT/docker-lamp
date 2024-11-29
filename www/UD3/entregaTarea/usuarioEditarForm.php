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
                        if (!empty($_GET))
                        {
                            $id = $_GET['id'];
                            $resultado = buscarUsuario($id);
                            if (!empty($id))
                            {
                                $usuario = $resultado[0];
                                $nombre = htmlspecialchars_decode($usuario['nombre']);
                                $apellidos = htmlspecialchars_decode($usuario['apellidos']);
                                $username = htmlspecialchars_decode($usuario['username']);
                                $contraseña = htmlspecialchars_decode($usuario['contrasena']);
                        ?>
                            <input type="hidden" name="id" value="<?php echo $id ?>">

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($nombre) ? htmlspecialchars($nombre) : '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="apellidos" class="form-label">apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo isset($apellidos) ? htmlspecialchars($apellidos) : '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($username) ? htmlspecialchars($username) : '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="contraseña" class="form-label">contraseña</label>
                                <input type="text" class="form-control" id="contraseña" name="contraseña" value="<?php echo isset($contraseña) ? htmlspecialchars($contraseña) : '' ?>" required>
                            </div>

                            <button type="submit" class="btn btn-success btn-sm">Actualizar</button>
                        <?php
                            }
                            else
                            {
                                echo '<div class="alert alert-danger" role="alert">No se pudo recuperar la información del usuario.</div>';
                            }
                        }
                        else
                        {
                            echo '<div class="alert alert-danger" role="alert">Debes acceder a través del listado de usuarios.</div>';
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
