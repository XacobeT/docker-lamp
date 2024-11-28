<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Nueva donación</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                        if (!empty($_POST))
                        {
                            if (isset($_POST['donante']))
                            {
                                require_once('database.php');
                                require_once('utils.php');
                                $id_donante = $_POST['donante'];
                                $fechaDonacion = $_POST['fecha_donacion'];
                                $donante = esNumeroValido($id_donante) ? buscaDonante($id_donante) : null;
                                if ($donante){
                                    if (nuevaDonacion($id_donante, $fechaDonacion))
                                    {
                                        echo '<div class="alert alert-success" role="alert">Donación registrada correctamente.</div>';
                                    }
                                    else
                                    {
                                        echo '<div class="alert alert-success" role="alert">Ocurrió un error registrando la donación.</div>';
                                    } 
                                }
                                else
                                {
                                    echo '<div class="alert alert-danger" role="alert">No se pudo localizar el donante.</div>';
                                }
                            }
                            else
                            {
                                echo '<div class="alert alert-danger" role="alert">No se pudo localizar el donante.</div>';
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
