<?php

function conecta($host, $user, $pass, $db)
{
    $conexion = new mysqli($host, $user, $pass, $db);
    return $conexion;
}

function conectaTarea()
{
    return conecta('db', 'root', 'test', 'tarea');
}

function conectaTareaPDO()
{
    $servername = 'db';
    $username = 'root';
    $password = 'test';
    $dbname = 'tarea';

    $conPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conPDO;
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
            $sqlCheck = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'tarea'";
            $resultado = $conexion->query($sqlCheck);
            if ($resultado && $resultado->num_rows > 0) {
                return [false, 'La base de datos "tarea" ya existía.'];
            }

            $sql = 'CREATE DATABASE IF NOT EXISTS tarea';
            if ($conexion->query($sql))
            {
                return [true, 'Base de datos "tarea" creada correctamente'];
            }
            else
            {
                return [false, 'No se pudo crear la base de datos "tarea".'];
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
        $conexion = conectaTarea();
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $sqlCheck = "SHOW TABLES LIKE 'usuarios'";
            $resultado = $conexion->query($sqlCheck);

            if ($resultado && $resultado->num_rows > 0)
            {
                return [false, 'La tabla "usuarios" ya existía.'];
            }

            $sql = '
                CREATE TABLE IF NOT EXISTS `tarea`.`usuarios` (
                    `id` INT NOT NULL AUTO_INCREMENT, 
                    `username` VARCHAR(50) NOT NULL, 
                    `nombre` VARCHAR(50) NOT NULL, 
                    `apellidos` VARCHAR(100) NOT NULL, 
                    `contrasena` VARCHAR(100) NOT NULL, 
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

function createTablaTareas()
{
    try {
        $conexion = conectaTarea();
        
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

            $sql = '
                CREATE TABLE IF NOT EXISTS `tarea`.`tareas` (
                    `id` INT NOT NULL AUTO_INCREMENT, 
                    `titulo` VARCHAR(50) NOT NULL, 
                    `descripcion` VARCHAR(250) NOT NULL, 
                    `estado` VARCHAR(50) NOT NULL, 
                    `id_usuario` INT NOT NULL, 
                    PRIMARY KEY (`id`),
                    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
                )';
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

function listaUsuarios()
{
    try {
        $conn = conectaTareaPDO(); 
        $sql = 'SELECT u.* FROM usuarios u';

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultados = $stmt->fetchAll();
        return $resultados;
    }
    catch (PDOException $e) {
        return null;
    }
    finally
    {
        $conn = null;
    }
}

function buscarUsuario($id)
{
    try {
        $conn = conectaTareaPDO(); 
        $sql = 'SELECT u.* FROM usuarios u WHERE id = :id';

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultados = $stmt->fetchAll();
        return $resultados;
    }
    catch (PDOException $e) {
        return null;
    }
    finally
    {
        $conn = null;
    }
}

function actualizarUsuario($id, $nombre, $apellidos, $username, $contrasena)
{
    try {
        $conn = conectaTareaPDO();

        $sql = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, username = :username, contrasena = :contrasena WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        return true;
    }
    catch (PDOException $e) {
        error_log("Error al modificar el usuario: " . $e->getMessage());
        return false;
    }
    finally
    {
        $conn = null;
    }
}  

function nuevoUsuario($username, $nombre, $apellidos, $contrasena)
{
    try {
        $conn = conectaTareaPDO();

        $sql = "INSERT INTO usuarios (username, nombre, apellidos, contrasena)
                VALUES (:username, :nombre, :apellidos, :contrasena)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
        $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);

        return $stmt->execute();
    }
    catch (PDOException $e) {
        error_log("Error al insertar el usuario: " . $e->getMessage());
        return false;
    }
    finally
    {
        $conn = null;
    }
}  

function borrarUsuario($id)
{
    try {
        $conn = conectaTareaPDO();

        $conn->beginTransaction();

        $sqlTareas = "DELETE FROM tareas WHERE id_usuario = :id";
        $stmtTareas = $conn->prepare($sqlTareas);
        $stmtTareas->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtTareas->execute();

        $sqlUsuarios = "DELETE FROM usuarios WHERE id = :id";
        $stmtUsuarios = $conn->prepare($sqlUsuarios);
        $stmtUsuarios->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtUsuarios->execute();

        $conn->commit();
        return true;
    }
    catch (PDOException $e) {
        error_log("Error al borrar el usuario: " . $e->getMessage());
        return false;
    }
    finally
    {
        $conn = null;
    }
}

function listaTareas() {
    try {
        $conexion = conectaTarea();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $sql = "SELECT tareas.id, tareas.titulo, tareas.descripcion, tareas.estado, usuarios.username FROM tareas JOIN usuarios ON tareas.id_usuario = usuarios.id;";
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

function buscarTareas($id)
{
    try {
        $conn = conectaTareaPDO(); 
        $sql = 'SELECT t.* FROM tareas t WHERE t.id_usuario = :id';
        
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    catch (PDOException $e) {
        return null;
    }
    finally
    {
        $conn = null;
    }
}

function nuevaTarea($titulo, $descripcion, $estado, $id_usuario)
{
    try {
        $conexion = conectaTarea();
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $stmt = $conexion->prepare("INSERT INTO tareas (titulo, descripcion, estado, id_usuario) VALUES (?,?,?,?)");
            $stmt->bind_param("sssi", $titulo, $descripcion, $estado, $id_usuario);

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

function borrarTarea($id)
{
    try {
        $conexion = conectaTarea();
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $stmt = $conexion->prepare("DELETE FROM tareas WHERE id = ?");
            $stmt->bind_param("i", $id);

            $stmt->execute();

            return [true, 'Tarea eliminada correctamente.'];
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

function buscarTarea($id) {
    try {
        $conexion = conectaTarea();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $stmt = $conexion->prepare("SELECT tareas.id, tareas.titulo, tareas.descripcion, tareas.estado, tareas.id_usuario, usuarios.username 
                    FROM tareas 
                    JOIN usuarios ON tareas.id_usuario = usuarios.id 
                    WHERE tareas.id = ?");
            $stmt->bind_param("i", $id);

            $stmt->execute();
            $result = $stmt->get_result();
            
            return [true,$result->fetch_assoc()];
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

function actualizarTarea($id, $titulo, $descripcion, $estado, $id_usuario)
{
    try {
        $conexion = conectaTarea();
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $stmt = $conexion->prepare("UPDATE tareas SET titulo = ?, descripcion = ?, estado = ?, id_usuario = ? WHERE id = ?");
            $stmt->bind_param("sssii",$titulo,$descripcion,$estado,$id_usuario,$id);

            $stmt->execute();
            $result = $stmt->get_result();
            return [$result];
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