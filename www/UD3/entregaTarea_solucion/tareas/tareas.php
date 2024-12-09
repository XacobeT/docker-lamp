<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD3. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once('../vista/header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('../vista/menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Tareas</h2>
                </div>

                <div class="container justify-content-between">
                <?php

                    $resultado = null;
                    if (!empty($_GET))
                    {
                        $estado = isset($_GET['estado']) ? $_GET['estado'] : null;
                        $id_usuario = $_GET['id_usuario'];
                        require_once('../modelo/pdo.php');
                        $resultado = listaTareasPDO($id_usuario, $estado);
                    }
                    else
                    {
                        require_once('../modelo/mysqli.php');
                        $resultado = listaTareas();
                    }
                    
                    if ($resultado && $resultado[0])
                    {
                ?>
                    <div class="table">
                        <table class="table table-sm table-striped table-hover">
                            <thead class="thead">
                                <tr>                            
                                    <th>ID</th>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Usuario</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $lista = $resultado[1];
                                    if (count($lista) > 0)
                                    {
                                        foreach ($lista as $tarea)
                                        {
                                            echo '<tr>';
                                            echo '<td>' . $tarea['id'] . '</td>';
                                            echo '<td>' . $tarea['titulo'] . '</td>';
                                            echo '<td>' . $tarea['descripcion'] . '</td>';
                                            echo '<td>' . $tarea['estado'] . '</td>';
                                            echo '<td>' . $tarea['id_usuario'] . '</td>';
                                            echo '<td>';
                                            echo '<a class="btn btn-sm btn-outline-success" href="editaTareaForm.php?id=' . $tarea['id'] . '" role="button">Editar</a>';
                                            echo '<a class="btn btn-sm btn-outline-danger ms-2" href="borraTarea.php?id=' . $tarea['id'] . '" role="button">Borrar</a>';
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    else
                                    {
                                        echo '<tr><td colspan="100">No hay tareas</td></tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                    }
                    else
                    {
                        echo '<div class="alert alert-warning" role="alert">' . $resultado[1] . '</div>';
                    }
                ?>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('../vista/footer.php'); ?>
    
</body>
</html>
