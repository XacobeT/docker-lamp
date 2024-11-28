<?php
echo '<h1>CRUD PDO orientación a objetos</h1>';

$servername = 'db';
$username = 'root';
$password = 'test';
$dbname = 'myDBPDO';

$conPDO = null;

try {
    //Crear la conexión
    $conPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Conexión correcta<br>';
}
catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage() . '<br>';
}

if ($conPDO) {
    echo '<h3>INSERT</h3>';
    try {
        $sql = "INSERT INTO clientes (nombre, apellido, email) 
            VALUES ('Marco', 'Magán', 'marco@iessanclemente.net')";
        $conPDO->exec($sql);

        $last_id = $conPDO->lastInsertId();
        echo "Nuevo registro creado. Último ID insertado:  " . $last_id . '<br>';
    }
    catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage() . '<br>';
    }

    try {
        //Insertar múltiples datos
        $conPDO->beginTransaction();

        $sql = "INSERT INTO clientes (nombre, apellido, email)
        VALUES ('Sabela', 'Sobrino', 'sabela@iessanclemente.net')";
        $conPDO->exec($sql);

        $sql = "INSERT INTO clientes (nombre, apellido, email)
        VALUES ('Maria', 'Sobrino', 'maria@iessanclemente.net')";
        $conPDO->exec($sql);

        $sql = "INSERT INTO clientes (nombre, apellido, email)
        VALUES ('Julia', 'Sobrino', 'julia@iessanclemente.net')";
        $conPDO->exec($sql);

        $conPDO->commit();

        echo "Se insertaron datos correctametne. <br>";

    }
    catch(PDOExcetion $e) {
        if ($conPDO != null) $conPDO->rollback();
        echo $sql . "<br>" . $e->getMessage() . '<br>';
    }


    echo '<h3>CONSULTAS PREPARADAS</h3>'; 
    try{
        $stmt = $conPDO->prepare("INSERT INTO clientes (nombre, apellido, email) VALUES (:nombre, :apellido, :email)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':email', $email);

        $nombre ="Juan";
        $apellido ="López";    
        $email = "juan@edu.com";
        $stmt->execute();

        $nombre ="Ayla";
        $apellido ="Pérez";    
        $email = "ayla@edu.com";
        $stmt->execute();

        // Cerrar el cursor
        $stmt->closeCursor();

        echo 'Los datos fueron insertados <br>';
    }
    catch(PDOExcetion $e){
        echo 'Fallo en INSERT: ' . $e->getMessage();
    }


    echo '<h3>SELECT</h3>';
    try {
        //Preparar el select 
        $stmt = $conPDO->prepare('SELECT id, nombre, apellido FROM clientes');
        $stmt->execute();

        //Recuperamos el resultado y guardamos como array asociativo
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultados = $stmt->fetchAll();
        //var_dump($resultados);
        //Se recorre el array para recuperar cada fila
        foreach($resultados as $row) {
            echo $row["id"] . " - " . $row["nombre"] . ' ' . $row["apellido"] . '<br>';
        }
    }
    catch (PDOException $e) {
        echo 'Fallo en SELECT: ' . $e->getMessage() . '<br>';
    }

    echo '<h5>FETCH_ASSOC</h5>';
    try {
        //Si no hay parámetros en la consulta, se puede usar query() 
        $stmt = $conPDO->query('SELECT id, nombre, apellido FROM clientes');
        //Se indica que se quiere en formato de array asociativo.
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // Se leen los datos por orden con fetch() 
        while ($row = $stmt->fetch()) {
            echo $row["id"] . " - " . $row["nombre"] . ' ' . $row["apellido"] . '<br>';
        }
        // Liberar los recursos utilizados para la consulta
        $stmt = null;
    }
    catch(PDOException $e) {
        echo 'Fallo en SELECT: ' . $e->getMessage() . '<br>';
    }

    echo '<h5>FETCH_BOTH</h5>';
    try {
        //En este caso hay parámetros y se usa una consulta preparada
        $stmt = $conPDO->prepare('SELECT id, nombre, apellido FROM clientes WHERE apellido =:apellido');
        //Es opcional y además, el modo por defecto
        $stmt->setFetchMode(PDO::FETCH_BOTH);
        //Se ejecuta pasando los parámetros necesarios
        $stmt->execute(array('apellido'=>'Magán') );
        
        // Se leen los datos por orden con fetch() 
        while ($row = $stmt->fetch()) {
            echo $row["id"] . " - " . $row["nombre"] . ' ' . $row["apellido"] . '<br>';
        }
        // Para liberar los recursos utilizados en la consulta SELECT
        $stmt=null;
    }
    catch(PDOException $e) {
        echo 'Fallo en SELECT: ' . $e->getMessage() . '<br>';
    }


    echo '<h3>UPDATE</h3>';
    try {
        //sql para actualizar un cliente
        $sql = "UPDATE clientes SET apellido='Sanz' WHERE nombre='Marco'";
        // Prepare statement
        $stmt = $conPDO->prepare($sql);
        // Ejecutar la consulta
        $stmt->execute();
        echo $stmt->rowCount() . " registros actualizados correctamente<br>";
    }
    catch(PDOException $e) {
        echo 'Fallo en UPDATE: ' . $e->getMessage() . '<br>';
    }


    echo '<h3>DELETE</h3>';
    try {
        // sql parar borrar un cliente
        $sql = "DELETE FROM clientes WHERE id=3";
        $conPDO->exec($sql);
        echo "Registro borrado correctamente<br>";
    }
    catch(PDOException $e) {
        echo 'Fallo en DELETE: ' . $e->getMessage() . '<br>';
    }


    //Cerrar la conexión
    $conn = null;
    echo '<br>Conexión cerrada';
}