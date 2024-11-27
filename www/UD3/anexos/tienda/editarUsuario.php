<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <main class="col">
                
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Actualizar usuario</h2>
                </div>

                <div class="container justify-content-between">
                    <form action="editar.php" method="POST" class="mb-2 w-50">
                        <?php
                        require_once('database.php');
                        if (!empty($_GET))
                        {
                            $id = $_GET['id'];
                            $resultado = buscaUsuario($id);
                            if (!empty($id) && $resultado[0])
                            {
                                $usuario = $resultado[1];
                                $nombre = $usuario['nombre'];
                                $apellidos = $usuario['apellidos'];
                                $edad = $usuario['edad'];
                                $provincia = $usuario['provincia'];
                        ?>
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <?php include_once('form.php'); ?>
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

                <div class="container justify-content-between mb-2">
                    <a class="btn btn-info btn-sm" href="listaUsuarios.php" role="button">Volver</a>
                </div>

            </main>
        </div>
    </div>
    
    <?php include_once('footer.php'); ?>
    
</body>
</html>
