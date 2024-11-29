<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Usuarios</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                        require_once('database.php');
                        $usuarios = listaUsuarios();
                        if ($usuarios && count($usuarios) > 0)
                        {
                            echo '<div class="table-responsive">';
                            echo '<table class="table table-bordered table-striped">';
                            echo '<thead class="table-success">';
                            echo '<tr>';
                            echo '<th>ID</th>';
                            echo '<th>Nombre</th>';
                            echo '<th>Apellidos</th>';
                            echo '<th>Usuario</th>';
                            echo '<th></th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                        
                            foreach ($usuarios as $usuarios) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars_decode($usuarios['id']) . '</td>';
                                echo '<td>' . htmlspecialchars_decode($usuarios['nombre']) . '</td>';
                                echo '<td>' . htmlspecialchars_decode($usuarios['apellidos']) . '</td>';
                                echo '<td>' . htmlspecialchars_decode($usuarios['username']) . '</td>';
                                echo '<td>';
                                echo '<a class="btn btn-sm btn-outline-primary me-2" href="usuarioEditarForm.php?id=' . $usuarios['id'] . '" role="button">Editar</a>';
                                echo '<a class="btn btn-sm btn-outline-danger" href="usuarioBorrar.php?id=' . $usuarios['id'] . '" role="button">Borrar</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        
                            echo '</tbody>';
                            echo '</table>';
                            echo '</div>';
                        }
                        else 
                        {
                            echo '<div class="alert alert-secondary" role="alert">No hay usuarios registrados.</div>';
                        }
                    ?>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>