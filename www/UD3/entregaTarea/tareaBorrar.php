<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Borrar Tarea</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                        if (!empty($_GET) && isset($_GET['id']))
                        {
                            require_once('database.php');
                            if (borrarTarea($_GET['id']))
                            {
                                echo '<div class="alert alert-success" role="alert">Borrado correctamente.</div>';
                            }
                            else
                            {
                                echo '<div class="alert alert-danger" role="alert">No se pudo borrar la tarea.</div>';
                            }
                        }
                        else
                        {
                            echo '<div class="alert alert-warning" role="alert">No se puede localizar ninguna tarea.</div>';
                        }
                    ?>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>
