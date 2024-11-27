<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <main class="col">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Menú</h2>
                </div>

                <div class="container justify-content-between">
                    <p><a class="btn btn-info btn-sm" href="init.php" role="button">Inicializar</a></p>    
                    <p><a class="btn btn-info btn-sm" href="nuevoUsuario.php" role="button">Nuevo usuario</a></p>
                    <p><a class="btn btn-info btn-sm" href="listaUsuarios.php" role="button">Lista de usuario</a></p>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>
