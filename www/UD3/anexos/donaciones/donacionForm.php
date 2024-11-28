<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Registrar donación</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                        require_once('database.php');
                        $donantes = listaDonantes(null, null);
                        $id_donante = null;
                        if (!empty($_GET) && isset($_GET['id'])) $id_donante = $_GET['id'];
                    ?>
                    <form action="donacionNueva.php" method="POST" class="needs-validation mb-4">
                        
                        <div class="mb-3">
                            <label for="donante" class="form-label">ID del Donante</label>
                            <input type="hidden" name="donante" value="<?php echo $id_donante ?? '' ?>">
                            <select class="form-select" id="donante" name="donante" required <?php echo isset($id_donante) ? 'disabled' : '' ?>>
                                <option <?php echo !isset($id_donante) ? 'selected' : '' ?> disabled value="">Seleccione un donante</option>
                                <?php foreach ($donantes as $donante): ?>
                                    <option value="<?= $donante['id']; ?>" <?php echo isset($id_donante) && $id_donante == $donante['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($donante['nombre']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="fecha_donacion" class="form-label">Fecha de Donación</label>
                            <input type="date" class="form-control" id="fecha_donacion" name="fecha_donacion" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Registrar</button>
                        </form>

                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>
