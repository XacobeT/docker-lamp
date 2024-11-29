<div class="mb-3">
    <label for="titulo" class="form-label">Titulo</label>
    <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo isset($titulo) ? htmlspecialchars($titulo) : '' ?>" required>
</div>
<div class="mb-3">
    <label for="descripcion" class="form-label">Descripcion</label>
    <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo isset($descripcion) ? htmlspecialchars($descripcion) : '' ?>" required>
</div>
<div class="mb-3">
    <label for="estado" class="form-label">Estado</label>
    <input type="int" class="form-control" id="estado" name="estado" value="<?php echo isset($estado) ? htmlspecialchars($estado) : '' ?>" required>
</div>
<div class="mb-3">
    <label for="id_usuario" class="form-label">Usuario</label>
    <select class="form-select" id="id_usuario" name="id_usuario" required>
        <option selected disabled value="">Selecciona un usuario</option>
            <?php
            require_once('database.php');
            $usuario = listaUsuarios();
            foreach ($usuario as $usuario)
            {
                echo '<option>' . htmlspecialchars_decode($usuario['id']) ." - ". htmlspecialchars_decode($usuario['username']) . '</option>';
            } 
            ?>
    </select>
</div>