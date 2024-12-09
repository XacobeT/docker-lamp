<?php

function conecta($host, $user, $pass, $db)
{
    $conexion = new mysqli($host, $user, $pass, $db);
    return $conexion;
}

function conectaTareas()
{
    return conecta('db', 'root', 'test', 'tareas');
}

function cerrarConexion($conexion)
{
    if (isset($conexion) && $conexion->connect_errno === 0) {
        $conexion->close();
    }
}

function creaDB()
{
    try {
        $conexion = conecta('db', 'root', 'test', null);
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            // Verificar si la base de datos ya existe
            $sqlCheck = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'tareas'";
            $resultado = $conexion->query($sqlCheck);
            if ($resultado && $resultado->num_rows > 0) {
                return [false, 'La base de datos "tareas" ya existía.'];
            }

            $sql = 'CREATE DATABASE IF NOT EXISTS tareas';
            if ($conexion->query($sql))
            {
                return [true, 'Base de datos "tareas" creada correctamente'];
            }
            else
            {
                return [false, 'No se pudo crear la base de datos "tareas".'];
            }
        }
    }
    catch (mysqli_sql_exception $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function createTablaUsuarios()
{
    try {
        $conexion = conectaTareas();
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            // Verificar si la tabla ya existe
            $sqlCheck = "SHOW TABLES LIKE 'usuarios'";
            $resultado = $conexion->query($sqlCheck);

            if ($resultado && $resultado->num_rows > 0)
            {
                return [false, 'La tabla "usuarios" ya existía.'];
            }

            $sql = 'CREATE TABLE `usuarios` (`id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(50) NOT NULL , `nombre` VARCHAR(50) NOT NULL , `apellidos` VARCHAR(100) NOT NULL , `contrasena` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ';
            if ($conexion->query($sql))
            {
                return [true, 'Tabla "usuarios" creada correctamente'];
            }
            else
            {
                return [false, 'No se pudo crear la tabla "usuarios".'];
            }
        }
    }
    catch (mysqli_sql_exception $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function createTablaTareas()
{
    try {
        $conexion = conectaTareas();
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            // Verificar si la tabla ya existe
            $sqlCheck = "SHOW TABLES LIKE 'tareas'";
            $resultado = $conexion->query($sqlCheck);

            if ($resultado && $resultado->num_rows > 0)
            {
                return [false, 'La tabla "tareas" ya existía.'];
            }

            $sql = 'CREATE TABLE `tareas` (`id` INT NOT NULL AUTO_INCREMENT, `titulo` VARCHAR(50) NOT NULL, `descripcion` VARCHAR(250) NOT NULL, `estado` VARCHAR(50) NOT NULL, `id_usuario` INT NOT NULL, PRIMARY KEY (`id`), FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id`))';
            if ($conexion->query($sql))
            {
                return [true, 'Tabla "tareas" creada correctamente'];
            }
            else
            {
                return [false, 'No se pudo crear la tabla "tareas".'];
            }
        }
    }
    catch (mysqli_sql_exception $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function listaTareas()
{
    try {
        $conexion = conectaTareas();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $sql = "SELECT * FROM tareas";
            $resultados = $conexion->query($sql);
            $tareas = array();
            while ($row = $resultados->fetch_assoc())
            {
                $usuario = buscaUsuarioMysqli($row['id_usuario']);
                $row['id_usuario'] = $usuario['username'];
                array_push($tareas, $row);
            }
            return [true, $tareas];
        }
        
    }
    catch (mysqli_sql_exception $e) {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function nuevaTarea($titulo, $descripcion, $estado, $usuario)
{
    try {
        $conexion = conectaTareas();
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $stmt = $conexion->prepare("INSERT INTO tareas (titulo, descripcion, estado, id_usuario) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $titulo, $descripcion, $estado, $usuario);

            $stmt->execute();

            return [true, 'Tarea creada correctamente.'];
        }
    }
    catch (mysqli_sql_exception $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function actualizaTarea($id, $titulo, $descripcion, $estado, $usuario)
{
    try {
        $conexion = conectaTareas();
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $sql = "UPDATE tareas SET titulo = ?, descripcion = ?, estado = ?, id_usuario = ? WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("sssii", $titulo, $descripcion, $estado, $usuario, $id);

            $stmt->execute();

            return [true, 'Tarea actualizada correctamente.'];
        }
    }
    catch (mysqli_sql_exception $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function borraTarea($id)
{
    try {
        $conexion = conectaTareas();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $sql = "DELETE FROM tareas WHERE id = " . $id;
            if ($conexion->query($sql))
            {
                return [true, 'Tarea borrada correctamente.'];
            }
            else
            {
                return [false, 'No se pudo borrar la tarea.'];
            }
            
        }
        
    }
    catch (mysqli_sql_exception $e) {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function buscaTarea($id)
{
    $conexion = conectaTareas();

    if ($conexion->connect_error)
    {
        return [false, $conexion->error];
    }
    else
    {
        $sql = "SELECT * FROM tareas WHERE id = " . $id;
        $resultados = $conexion->query($sql);
        if ($resultados->num_rows == 1)
        {
            return $resultados->fetch_assoc();
        }
        else
        {
            return null;
        }
    }
}

function buscaUsuarioMysqli($id)
{
    $conexion = conectaTareas();

    if ($conexion->connect_error)
    {
        return [false, $conexion->error];
    }
    else
    {
        $sql = "SELECT * FROM usuarios WHERE id = " . $id;
        $resultados = $conexion->query($sql);
        if ($resultados->num_rows == 1)
        {
            return $resultados->fetch_assoc();
        }
        else
        {
            return null;
        }
    }
}