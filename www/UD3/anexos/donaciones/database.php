<?php

function conecta()
{
    $servername = 'db';
    $username = 'root';
    $password = 'test';

    $conPDO = new PDO("mysql:host=$servername", $username, $password);
    $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conPDO;
}

function conectaDonaciones()
{
    $servername = 'db';
    $username = 'root';
    $password = 'test';
    $dbname = 'donaciones';

    $conPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conPDO;
}

function creaDB()
{
    try {
        $conn = conecta();
        $sql = 'CREATE DATABASE IF NOT EXISTS donaciones';
        return ($conn->exec($sql));
    }
    catch (PDOException $e)
    {
       return false;
    }
    finally {
        $conn = null;
    }
}

function creaTabla($sql)
{
    try {
        $conn = conectaDonaciones();
        $result = $conn->exec($sql);
        return $result === false ? false : true; //si se ejecuta correctamente, devuelve un núemero
    }
    catch (PDOException $e)
    {
       return false;
    }
    finally {
        $conn = null;
    }
}

function creaTablaDonantes()
{
    $sql = "CREATE TABLE IF NOT EXISTS donantes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        apellidos VARCHAR(50) NOT NULL,
        edad INT NOT NULL CHECK (Edad >= 18),
        grupo_sanguineo ENUM('O-', 'O+', 'A-', 'A+', 'B-', 'B+', 'AB-', 'AB+') NOT NULL,
        codigo_postal CHAR(5) NOT NULL CHECK (codigo_postal REGEXP '^[0-9]{5}$'),
        telefono_movil CHAR(9) NOT NULL CHECK (telefono_movil REGEXP '^[0-9]{9}$')
    )";
    return creaTabla($sql);
}

function creaTablaDonaciones()
{
    $sql = "CREATE TABLE IF NOT EXISTS historico (
        id INT AUTO_INCREMENT PRIMARY KEY,
        donante INT NOT NULL,
        fecha_donacion DATE NOT NULL,
        fecha_proxima_donacion DATE GENERATED ALWAYS AS (DATE_ADD(fecha_donacion, INTERVAL 4 MONTH)) STORED,
        FOREIGN KEY (donante) REFERENCES donantes(id)
    )";
    return creaTabla($sql);
}

function creaTablaAdmnistradores()
{
    $sql = "CREATE TABLE IF NOT EXISTS administradores (
        nombre_usuario VARCHAR(50) PRIMARY KEY,
        contrasena VARCHAR(200) NOT NULL
    )";
    return creaTabla($sql);
}

function listaDonantes($codPostal, $grupo)
{
    try {
        $conn = conectaDonaciones(); 
        $sql = 'SELECT d.* FROM donantes d';
        if (isset($codPostal))
        {
            $sql = $sql . " LEFT JOIN historico h ON d.id = h.donante WHERE d.codigo_postal = '$codPostal'";
            if (isset($grupo)) $sql = $sql . " AND d.grupo_sanguineo = '$grupo'";
            $sql = $sql . " AND (h.fecha_proxima_donacion IS NULL OR h.fecha_proxima_donacion > CURDATE())";
        }

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

function buscaDonante($id)
{
    try {
        $conn = conectaDonaciones(); 
        $sql = 'SELECT * FROM donantes WHERE id = ' . $id;
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado = $stmt->fetch();
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

function nuevoDonante($nombre, $apellidos, $edad, $grupoSanguineo, $codigoPostal, $telefonoMovil)
{
    try {
        $conn = conectaDonaciones();

        $sql = "INSERT INTO donantes (nombre, apellidos, edad, grupo_sanguineo, codigo_postal, telefono_movil)
                VALUES (:nombre, :apellidos, :edad, :grupo_sanguineo, :codigo_postal, :telefono_movil)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
        $stmt->bindParam(':edad', $edad, PDO::PARAM_INT);
        $stmt->bindParam(':grupo_sanguineo', $grupoSanguineo, PDO::PARAM_STR);
        $stmt->bindParam(':codigo_postal', $codigoPostal, PDO::PARAM_STR);
        $stmt->bindParam(':telefono_movil', $telefonoMovil, PDO::PARAM_STR);

        return $stmt->execute();
    }
    catch (PDOException $e) {
        error_log("Error al insertar el donante: " . $e->getMessage());
        return false;
    }
    finally
    {
        $conn = null;
    }
}  

function borraDonante($id)
{
    try {
        $conn = conectaDonaciones();

        $conn->beginTransaction();

        $sqlDonaciones = "DELETE FROM historico WHERE donante = :donanteId";
        $stmtDonaciones = $conn->prepare($sqlDonaciones);
        $stmtDonaciones->bindParam(':donanteId', $id, PDO::PARAM_INT);
        $stmtDonaciones->execute();

        $sqlDonante = "DELETE FROM donantes WHERE id = :donanteId";
        $stmtDonante = $conn->prepare($sqlDonante);
        $stmtDonante->bindParam(':donanteId', $id, PDO::PARAM_INT);
        $stmtDonante->execute();

        $conn->commit();
        return true;
    }
    catch (PDOException $e) {
        error_log("Error al insertar el donante: " . $e->getMessage());
        return false;
    }
    finally
    {
        $conn = null;
    }
}

function nuevaDonacion($donante, $fechaDonacion)
{
    try {
        $conn = conectaDonaciones();

        $sql = "INSERT INTO historico (donante, fecha_donacion)
                VALUES (:donante, :fechaDonacion)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':donante', $donante, PDO::PARAM_STR);
        $stmt->bindParam(':fechaDonacion', $fechaDonacion, PDO::PARAM_STR);

        return $stmt->execute();
    }
    catch (PDOException $e) {
        error_log("Error al insertar donacion: " . $e->getMessage());
        return false;
    }
    finally
    {
        $conn = null;
    }
} 

function listaDonaciones($idDonante)
{
    try {
        $conn = conectaDonaciones(); 
        $sql = 'SELECT h.id, h.donante, h.fecha_donacion, h.fecha_proxima_donacion, d.grupo_sanguineo, d.nombre, d.apellidos FROM historico h JOIN donantes d ON h.donante = d.id';
        if (isset($idDonante))
        {
            $sql = $sql . " WHERE donante = '$idDonante'";
        }
        $sql = $sql . " ORDER BY fecha_donacion DESC";
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

function nuevoAdmin($usuario, $contrasena)
{
    try {
        $conn = conectaDonaciones();

        $sql = "INSERT INTO administradores (nombre_usuario, contrasena)
                VALUES (:usuario, :contrasena)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);

        return $stmt->execute();
    }
    catch (PDOException $e) {
        error_log("Error al insertar el donante: " . $e->getMessage());
        return false;
    }
    finally
    {
        $conn = null;
    }
} 