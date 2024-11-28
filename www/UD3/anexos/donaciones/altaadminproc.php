<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Alta administrador</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                    if (!empty($_POST))
                    {
                        if (isset($_POST['nombre_usuario']) && isset($_POST['contrasinal']))
                        {
                            require_once('database.php');
                            require_once('utils.php');
                            $usuario = $_POST['nombre_usuario'];
                            $contrasena = $_POST['contrasinal'];
                            
                            if (nuevoAdmin($usuario, $contrasena))
                            {
                                echo '<div class="alert alert-success" role="alert">Administrador registrado correctamente.</div>';
                            }
                            else
                            {
                                echo '<div class="alert alert-success" role="alert">Ocurrió un error registrando al administrador.</div>';
                            } 
                        }
                        else
                        {
                            echo '<div class="alert alert-danger" role="alert">Faltan campos obligatorios.</div>';
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
