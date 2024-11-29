<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
        <?php include_once('menu.php'); ?>
            <main class="col">
                
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Nueva Tarea</h2>
                </div>

                <div class="container justify-content-between">
                    <form action="nuevo.php" method="POST" class="mb-2 w-50">
                        <?php include_once('form.php'); ?>
                        <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                    </form>
                </div>

            </main>
        </div>
    </div>
    
    <?php include_once('footer.php'); ?>
    
</body>
</html>
