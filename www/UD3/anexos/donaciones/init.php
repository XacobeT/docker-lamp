<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Inicialización</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                        require_once('database.php');
                        if (creaDB())
                        {
                            echo '<div class="alert alert-success" role="alert">Base de datos gestionada correctamente.</div>';
                        }
                        else
                        {
                            echo '<div class="alert alert-warning" role="alert">Error gestionando base de datos.</div>';
                        }
                        if (creaTablaDonantes())
                        {
                            echo '<div class="alert alert-success" role="alert">Tabla donantes gestionada correctamente.</div>';
                        }
                        else
                        {
                            echo '<div class="alert alert-warning" role="alert">Error gestionando tabla donantes.</div>';
                        }
                        if (creaTablaDonaciones())
                        {
                            echo '<div class="alert alert-success" role="alert">Tabla donaciones gestionada correctamente.</div>';
                        }
                        else
                        {
                            echo '<div class="alert alert-warning" role="alert">Error gestionando tabla donaciones.</div>';
                        }
                        if (creaTablaAdmnistradores())
                        {
                            echo '<div class="alert alert-success" role="alert">Tabla administradores gestionada correctamente.</div>';
                        }
                        else
                        {
                            echo '<div class="alert alert-warning" role="alert">Error gestionando tabla administradores.</div>';
                        }
                    ?>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>
