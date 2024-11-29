<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
        <?php include_once('menu.php'); ?>
            <main class="col">
                
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Actualizar Tarea</h2>
                </div>

                <div class="container justify-content-between">
                    <form action="editarTarea.php" method="POST" class="mb-2 w-50">
                        <?php
                        require_once('database.php');
                        if (!empty($_GET))
                        {
                            $id = $_GET['id'];
                            $resultado = buscarTarea($id);
                            if (!empty($id))
                            {
                                $tarea = $resultado[1];
                                $titulo = ($tarea['titulo']);
                                $descripcion = ($tarea['descripcion']);
                                $estado = ($tarea['estado']);
                                $id_usuario = ($tarea['id_usuario']);
                                $usuario = ($tarea['username']);

                        ?>
                            <input type="hidden" name="id" value="<?php echo $id ?>">

                            <div class="mb-3">
                                <label for="titulo" class="form-label">titulo</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo isset($titulo) ? htmlspecialchars($titulo) : '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">descripcion</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo isset($descripcion) ? htmlspecialchars($descripcion) : '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="estado" class="form-label">estado</label>
                                <input type="text" class="form-control" id="estado" name="estado" value="<?php echo isset($estado) ? htmlspecialchars($estado) : '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_usuario" class="form-label">Usuario</label>
                                <select class="form-select" id="id_usuario" name="id_usuario" required>
                                    <?php
                                    require_once('database.php');
                                    $usuarios = listaUsuarios();

                                    // Define el ID del usuario que deseas preseleccionar
                                    $usuarioSeleccionado = $id_usuario; // Ejemplo: ID del usuario preseleccionado

                                    foreach ($usuarios as $usuario) {
                                        // Verifica si este usuario es el seleccionado
                                        $selected = ($usuario['id'] == $usuarioSeleccionado) ? 'selected' : '';
                                    
                                        // Genera la opción con el atributo `selected` si corresponde
                                        echo '<option value="' . htmlspecialchars($usuario['id']) . '" ' . $selected . '>'
                                             . htmlspecialchars($usuario['username']) 
                                             . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success btn-sm">Actualizar</button>
                        <?php
                            }
                            else
                            {
                                echo '<div class="alert alert-danger" role="alert">No se pudo recuperar la información del usuario.</div>';
                            }
                        }
                        else
                        {
                            echo '<div class="alert alert-danger" role="alert">Debes acceder a través del listado de usuarios.</div>';
                        }
                        ?>
                        
                    </form>
                </div>

            </main>
        </div>
    </div>
    
    <?php include_once('footer.php'); ?>
    
</body>
</html>
