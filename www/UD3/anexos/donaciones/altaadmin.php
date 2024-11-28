<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Alta administrador</h2>
                </div>

                <div class="container justify-content-between">

                    <form action="altaadminproc.php" method="POST" class="needs-validation">
                        <div class="mb-3">
                            <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="contrasinal" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contrasinal" name="contrasinal" required>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Registrar administrador</button>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>
