<html>
    <head>
        <title>UD2 - Xacobe Tarrio</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container-fluid">
        <div class="row">
            <?php include 'menu.php'; ?>

            <main>
                <div>
                    <h2>Crear Nueva Tarea</h2>
                </div>

                <div class="container">
                    <form action="nueva.php" method="POST" class="mb-5">
                        <div class="mb-3">
                            <p> Titulo </p>
                            <input type="text" name="titulo" >
                        </div>
                        <div class="mb-3">
                            <p>Descripción</p>
                            <textarea name="descripcion" rows="4" cols="40"></textarea>
                        </div>
                        <div class="mb-3">
                            <p>Estado</p>
                            <select class="form-select" name="estado" required>
                                <option value="">Seleccionar</option>
                                <option value="completada">Completado</option>
                                <option value="en proceso">En Proceso</option>
                                <option value="pendiente">Pendiente</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>

            </main>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    </body>
</html>