<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Donantes</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                        require_once('database.php');
                        $codPostal = null;
                        $grupo = null;
                        if (!empty($_GET) && isset($_GET['codigo_postal']))
                        {
                            $codPostal = $_GET['codigo_postal'];
                            if (isset($_GET['grupo_sanguineo'])) $grupo = $_GET['grupo_sanguineo'];
                        }
                        $donantes = listaDonantes($codPostal, $grupo);
                        if ($donantes && count($donantes) > 0)
                        {
                            echo '<div class="table-responsive">';
                            echo '<table class="table table-bordered table-striped">';
                            echo '<thead class="table-success">';
                            echo '<tr>';
                            echo '<th>Nombre</th>';
                            echo '<th>Apellidos</th>';
                            echo '<th>Edad</th>';
                            echo '<th>Grupo Sanguíneo</th>';
                            echo '<th>Código Postal</th>';
                            echo '<th>Teléfono Móvil</th>';
                            echo '<th></th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                        
                            // Recorrer y mostrar cada donante
                            foreach ($donantes as $donante) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars_decode($donante['nombre']) . '</td>';
                                echo '<td>' . htmlspecialchars_decode($donante['apellidos']) . '</td>';
                                echo '<td>' . htmlspecialchars_decode($donante['edad']) . '</td>';
                                echo '<td>' . htmlspecialchars_decode($donante['grupo_sanguineo']) . '</td>';
                                echo '<td>' . htmlspecialchars_decode($donante['codigo_postal']) . '</td>';
                                echo '<td>' . htmlspecialchars_decode($donante['telefono_movil']) . '</td>';
                                echo '<td>';
                                echo '<a class="btn btn-sm btn-outline-success me-2" href="donacionForm.php?id=' . $donante['id'] . '" role="button">Donar</a>';
                                echo '<a class="btn btn-sm btn-outline-primary me-2" href="donaciones.php?id=' . $donante['id'] . '" role="button">Donaciones</a>';
                                echo '<a class="btn btn-sm btn-outline-danger" href="donanteBorrar.php?id=' . $donante['id'] . '" role="button">Borrar</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        
                            echo '</tbody>';
                            echo '</table>';
                            echo '</div>';
                        }
                        else 
                        {
                            echo '<div class="alert alert-secondary" role="alert">No hay dondantes registrados.</div>';
                        }
                    ?>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>
