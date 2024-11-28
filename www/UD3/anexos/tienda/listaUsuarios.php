<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <main class="col">
                
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Usuarios registrados</h2>
                </div>

                <div class="container justify-content-between">
                    <div class="table">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>                            
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Edad</th>
                                    <th>Provincia</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    require_once('database.php');
                                    $resultado = listaUsuarios();
                                    if ($resultado && $resultado[0])
                                    {
                                        $usuarios = $resultado[1];
                                        if ($usuarios)
                                        {
                                            foreach ($usuarios as $usuario)
                                            {
                                                echo '<tr>';
                                                echo '<td>' . $usuario['id'] . '</td>';
                                                echo '<td>' . $usuario['nombre'] . '</td>';
                                                echo '<td>' . $usuario['apellidos'] . '</td>';
                                                echo '<td>' . $usuario['edad'] . '</td>';
                                                echo '<td>' . $usuario['provincia'] . '</td>';
                                                echo '<td>';
                                                echo '<a class="btn btn-outline-success btn-sm me-1" href="editarUsuario.php?id=' . $usuario['id'] . '" role="button">Editar</a></span>';
                                                echo '<a class="btn btn-outline-danger btn-sm" href="borrar.php?id=' . $usuario['id'] . '" role="button">Borrar</a>';
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                        }
                                        else{
                                            echo '<tr><td colspan="100">No hay usuarios registrados</td></tr>';
                                        }
                                    }
                                    else
                                    {
                                        echo '<tr><td colspan="100">Error recuperando usuarios: ' . $resultado['1'] . '</td></tr>';
                                    }
                                    
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php include_once('back.php'); ?>

            </main>
        </div>
    </div>
    
    <?php include_once('footer.php'); ?>
    
</body>
</html>
