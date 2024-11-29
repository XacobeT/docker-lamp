<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Buscador de tareas</h2>
                </div>

                <div class="container justify-content-between">
                <form action="listaTareas.php" method="GET" class="needs-validation mb-4">

                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <select class="form-select" id="usuario" name="usuario">
                            <option selected disabled value="">Selecciona un usuario</option>
                            <?php
                                require_once('database.php');
                                $usuarios = listaUsuarios();
                                foreach ($usuarios as $usuarios)
                                {
                                    echo '<option>' . htmlspecialchars_decode($usuarios['id']) ." - ". htmlspecialchars_decode($usuarios['username']) . '</option>';
                                } 
                            ?>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>