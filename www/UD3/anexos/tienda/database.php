<?php

function conecta($host, $user, $pass, $db)
{
    $conexion = new mysqli($host, $user, $pass, $db);
    return $conexion;
}

function conectaTienda()
{
    return conecta('db', 'root', 'test', 'tienda');
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
            $sqlCheck = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'tienda'";
            $resultado = $conexion->query($sqlCheck);
            if ($resultado && $resultado->num_rows > 0) {
                return [false, 'La base de datos "tienda" ya existía.'];
            }

            $sql = 'CREATE DATABASE IF NOT EXISTS tienda';
            if ($conexion->query($sql))
            {
                return [true, 'Base de datos "tienda" creada correctamente'];
            }
            else
            {
                return [false, 'No se pudo crear la base de datos "tienda".'];
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
        $conexion = conectaTienda();
        
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

            $sql = '
                CREATE TABLE IF NOT EXISTS `tienda`.`usuarios` (
                    `id` INT NOT NULL AUTO_INCREMENT, 
                    `nombre` VARCHAR(50) NOT NULL, 
                    `apellidos` VARCHAR(100) NOT NULL, 
                    `edad` INT NOT NULL, 
                    `provincia` VARCHAR(50) NOT NULL, 
                    PRIMARY KEY (`id`) 
                )';
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

function listaUsuarios() {
    try {
        $conexion = conectaTienda();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $sql = "SELECT * FROM usuarios";
            $resultados = $conexion->query($sql);
            return [true, $resultados->fetch_all(MYSQLI_ASSOC)];
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

function nuevoUsuario($nombre, $apellidos, $edad, $provincia)
{
    try {
        $conexion = conectaTienda();
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellidos, edad, provincia) VALUES (?,?,?,?)");
            $stmt->bind_param("ssis", $nombre, $apellidos, $edad, $provincia);

            $stmt->execute();

            return [true, 'Usuario creado correctamente.'];
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

function buscaUsuario($id)
{
    try {
        $conexion = conectaTienda();

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
                return [true, $resultados->fetch_assoc()];
            }
            else
            {
                return [false, 'No se pudo recuperar el alumno.'];
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

function borraUsuario($id)
{
    try {
        $conexion = conectaTienda();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $sql = "DELETE FROM usuarios WHERE id = " . $id;
            if ($conexion->query($sql))
            {
                return [true, 'Usuario borrado correctamente.'];
            }
            else
            {
                return [false, 'No se pudo borrar el usuario.'];
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

function actualizaUsuario($id, $nombre, $apellidos, $edad, $provincia)
{
    try {
        $conexion = conectaTienda();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $sql = "UPDATE usuarios SET nombre = ?, apellidos = ?, edad = ?, provincia = ? WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            
            $stmt->bind_param("ssisi", $nombre, $apellidos, $edad, $provincia, $id);

            $stmt->execute();

            return [true, 'Usuario actualizado correctamente.'];
            
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