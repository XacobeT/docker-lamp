<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Tareas</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                        require_once('database.php');
                        $usuario = null;
                        if (!empty($_GET) && isset($_GET['usuario']))
                        {
                            $usuarios = $_GET['usuario'];
                            $usuario = explode(" - ", $usuarios);
                            $tareas = buscarTareas($usuario[0]);
                            if ($tareas && count($tareas) > 0)
                            {
                                echo '<div class="table-responsive">';
                                echo '<table class="table table-bordered table-striped">';
                                echo '<thead class="table-success">';
                                echo '<tr>';
                                echo '<th>ID</th>';
                                echo '<th>Titulo</th>';
                                echo '<th>Descripcion</th>';
                                echo '<th>Estado</th>';
                                echo '<th>Usuario</th>';
                                echo '<th></th>';
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                            
                                foreach ($tareas as $tarea) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars_decode($tarea['id']) . '</td>';
                                    echo '<td>' . htmlspecialchars_decode($tarea['titulo']) . '</td>';
                                    echo '<td>' . htmlspecialchars_decode($tarea['descripcion']) . '</td>';
                                    echo '<td>' . htmlspecialchars_decode($tarea['estado']) . '</td>';
                                    echo '<td>' . $usuario[1] . '</td>';
                                    echo '<td>';
                                    echo '<a class="btn btn-sm btn-outline-primary me-2" href="tareaEditarForm.php?id=' . $tarea['id'] . '" role="button">Editar</a>';
                                    echo '<a class="btn btn-sm btn-outline-danger" href="tareaBorrar.php?id=' . $tarea['id'] . '" role="button">Borrar</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            
                        
                                echo '</tbody>';
                                echo '</table>';
                                echo '</div>';
                            }
                            else 
                            {
                                echo '<div class="alert alert-secondary" role="alert">No hay tareas registradas.</div>';
                            }
                        
                        }else{
                            $tareas = listaTareas();                        
                        
                        if ($tareas && $tareas[0])
                        {
                            echo '<div class="table-responsive">';
                            echo '<table class="table table-bordered table-striped">';
                            echo '<thead class="table-success">';
                            echo '<tr>';
                            echo '<th>ID</th>';
                            echo '<th>Titulo</th>';
                            echo '<th>Descripcion</th>';
                            echo '<th>Estado</th>';
                            echo '<th>Usuario</th>';
                            echo '<th></th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            $tarea = $tareas[1];
                        if ($tarea)
                        {
                            foreach ($tarea as $tarea) {
                                echo '<tr>';
                                echo '<td>' . $tarea['id'] . '</td>';
                                echo '<td>' . $tarea['titulo'] . '</td>';
                                echo '<td>' . $tarea['descripcion'] . '</td>';
                                echo '<td>' . $tarea['estado'] . '</td>';
                                echo '<td>' . $tarea['username'] . '</td>';
                                echo '<td>';
                                echo '<a class="btn btn-sm btn-outline-primary me-2" href="tareaEditarForm.php?id=' . $tarea['id'] . '" role="button">Editar</a>';
                                echo '<a class="btn btn-sm btn-outline-danger" href="tareaBorrar.php?id=' . $tarea['id'] . '" role="button">Borrar</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                        
                            echo '</tbody>';
                            echo '</table>';
                            echo '</div>';
                        }
                        else 
                        {
                            echo '<div class="alert alert-secondary" role="alert">No hay tareas registradas.</div>';
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