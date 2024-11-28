<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Donaciones</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                    require_once('database.php');
                    $id_donante = null;
                    if (!empty($_GET) && isset($_GET['id']))
                    {
                        $id_donante = $_GET['id'];
                    }
                    $donaciones = listaDonaciones($id_donante);
                    if ($donaciones && count($donaciones) > 0)
                    {
                        echo '<div class="table-responsive">';
                        echo '<table class="table table-bordered table-striped">';
                        echo '<thead class="table-success">';
                        echo '<tr>';
                        echo '<th>Donante</th>';
                        echo '<th>Fecha donación</th>';
                        echo '<th>Próxima donación</th>';
                        echo '<th>Grupo Sanguíneo</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                    
                        // Recorrer y mostrar cada donante
                        foreach ($donaciones as $donacion) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars_decode($donacion['nombre']) . ' ' . htmlspecialchars_decode($donacion['apellidos']) . '</td>';
                            echo '<td>' . ($donacion['fecha_donacion']) . '</td>';
                            echo '<td>' . ($donacion['fecha_proxima_donacion']) . '</td>';
                            echo '<td>' . ($donacion['grupo_sanguineo']) . '</td>';
                            echo '</tr>';
                        }
                    
                        echo '</tbody>';
                        echo '</table>';
                        echo '</div>';
                    }
                    else 
                    {
                        echo '<div class="alert alert-secondary" role="alert">No hay donaciones registradas.</div>';
                    }
                    ?>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>
