<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Alta de donante</h2>
                </div>

                <div class="container justify-content-between">
                    <form action="donanteNuevo.php" method="POST" class="needs-validation mb-4">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="edad" class="form-label">Edad</label>
                            <input type="number" class="form-control" id="edad" name="edad" min="18" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="grupo_sanguineo" class="form-label">Grupo Sanguíneo</label>
                            <select class="form-select" id="grupo_sanguineo" name="grupo_sanguineo" required>
                            <option selected disabled value="">Selecciona un grupo sanguíneo</option>
                            <?php
                                require_once('utils.php');
                                $grupos = listaGrupoSanguineo();
                                foreach ($grupos as $grupo)
                                {
                                    echo "<option>$grupo</option>";
                                } 
                            ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="codigo_postal" class="form-label">Código Postal</label>
                            <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" pattern="^\d{5}$" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="telefono_movil" class="form-label">Teléfono Móvil</label>
                            <input type="text" class="form-control" id="telefono_movil" name="telefono_movil" pattern="^\d{9}$" required>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Registrar Donante</button>
                    </form>

                    <?php
                    
                    ?>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>
