<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <main class="col">
                
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Nuevo usuario</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                    $nombre = $_POST['nombre'];
                    $apellidos = $_POST['apellidos'];
                    $edad = $_POST['edad'];
                    $provincia = $_POST['provincia'];
                    require_once('utils.php');
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
                    //verificar edad
                    if (!esNumeroValido($edad))
                    {
                        $error = true;
                        echo '<div class="alert alert-danger" role="alert">El campo edad es obligatorio y debe contener solo números.</div>';
                    }
                    //verificar provincia
                    if (!validarCampoTexto($provincia))
                    {
                        $error = true;
                        echo '<div class="alert alert-danger" role="alert">El campo provincia es obligatorio y debe contener al menos 3 caracteres</div>';
                    }
                    if (!$error)
                    {
                        require_once('database.php');
                        $resultado = nuevoUsuario(filtraCampo($nombre), filtraCampo($apellidos), filtraCampo($edad), filtraCampo($nombre));
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

                <?php include_once('back.php'); ?>

            </main>
        </div>
    </div>
    
    <?php include_once('footer.php'); ?>
    
</body>
</html>
