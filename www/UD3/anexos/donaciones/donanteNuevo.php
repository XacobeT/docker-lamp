<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Nuevo donante</h2>
                </div>

                <div class="container justify-content-between">
                    
                    <?php
                    if (!empty($_POST))
                    {
                        require_once('utils.php');
                        $grupos = listaGrupoSanguineo();

                        $nombre = filtraCampo($_POST['nombre']);
                        $apellidos = filtraCampo($_POST['apellidos']);
                        $edad = filtraCampo($_POST['edad']);
                        $codigoPostal = filtraCampo($_POST['codigo_postal']);
                        $telefonoMovil = filtraCampo($_POST['telefono_movil']);
                        $grupoSanguineo = filtraCampo($_POST['grupo_sanguineo']);
                        
                        // Validaciones
                        $error = false;
                        if (!validarCampoTexto($nombre))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">Revisa el nombre.</div>';
                        }
                        if (!validarCampoTexto($apellidos))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">Revisa los apellidos.</div>';
                        }
                        if (!esNumeroValido($edad) || $edad < 18)
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">Revisa la edad.</div>';
                        }
                        if (!esNumeroValido($codigoPostal) || !preg_match('/^[0-9]{5}$/', $codigoPostal))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">Revisa el código postal.</div>';
                        }
                        if (!esNumeroValido($telefonoMovil) || !preg_match('/^[0-9]{9}$/', $telefonoMovil))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">Revisa el teléfono.</div>';
                        }
                        if (!in_array($grupoSanguineo, $grupos))
                        {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">Revisa el grupo sanguíneo.</div>';
                        }

                        if (!$error)
                        {
                            require_once('database.php');
                            if (nuevoDonante($nombre, $apellidos, $edad, $grupoSanguineo, $codigoPostal, $telefonoMovil))
                            {
                                echo '<div class="alert alert-success" role="alert">Donante registrado correctamente.</div>';
                            }
                            else
                            {
                                echo '<div class="alert alert-danger" role="alert">Ocurrió un error registrando el donante.</div>';
                            }
                        }
                        else
                        {
                            echo '<div class="alert alert-warning" role="alert">No se pudo procesar el contenido del formulario.</div>';
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
