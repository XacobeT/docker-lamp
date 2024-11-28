<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($nombre) ? htmlspecialchars($nombre) : '' ?>" required>
</div>
<div class="mb-3">
    <label for="apellidos" class="form-label">Apellidos</label>
    <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo isset($apellidos) ? htmlspecialchars($apellidos) : '' ?>" required>
</div>
<div class="mb-3">
    <label for="edad" class="form-label">Edad</label>
    <input type="int" class="form-control" id="edad" name="edad" value="<?php echo isset($edad) ? htmlspecialchars($edad) : '' ?>" required>
</div>
<div class="mb-3">
    <label for="provincia" class="form-label">Provincia</label>
    <input type="text" class="form-control" id="provincia" name="provincia" value="<?php echo isset($provincia) ? htmlspecialchars($provincia) : '' ?>" required>
</div>