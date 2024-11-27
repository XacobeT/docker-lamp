<?php
echo '<h1>CRUD mysqli orientación a objetos</h1>';

$conexion = null;

try {
    //Crear la conexión sin indicar BD
    $conexion = new mysqli('db', 'root', 'test', 'myDBoo');
    echo 'Conexión correcta<br>';

}
catch (mysqli_sql_exception $e) {
    //Gestionar el error si hubiera
    echo 'Error en la conexión: ' . $e->getMessage() . '<br>';
}


if (isset($conexion) && $conexion->connect_errno === 0) {
    echo '<h3>INSERT</h3>';
    try {
        $sql = "INSERT INTO clientes (nombre, apellido, email) 
            VALUES ('Marco', 'Magán', 'marco@iessanclemente.net')";
        if ($conexion->query($sql)) {
            $ultimo_id = $conexion->insert_id;
            echo "Se ha creado un nuevo registro con el id: " . $ultimo_id . '<br>';
        }
        else {
            echo 'No se pudo crear el registro: ' . $conexion->error . '<br>';
        }

        $sql = "INSERT INTO clientes (nombre, apellido, email) 
            VALUES ('Sabela', 'Sobrino', 'marco@iessanclemente.net'); ";
        $sql .=  "INSERT INTO clientes (nombre, apellido, email) 
            VALUES ('Maria', 'Garcia', 'maria@iessanclemente.net'); ";
        $sql .=  "INSERT INTO clientes (nombre, apellido, email) 
            VALUES ('Julia', 'Rode', 'julia@iessanclemente.net'); ";
          
          
        if ($conexion->multi_query($sql)) {
            do {
                $ultimo_id = $conexion->insert_id;
                echo "Se ha creado un nuevo registro con el id: " . $ultimo_id . '<br>';
            } while ($conexion->next_result()); //Es necesario recorrerlos todos para liberar la conexión para los siguientes usos  
        }
        else {
            echo 'No se pudo crear el registro: ' . $conexion->error . '<br>';
        }

    }
    catch (mysqli_sql_exception $e) {
        //Gestionar el error si hubiera
        echo 'Error en la conexión: ' . $e->getMessage() . '<br>';
    }

    echo '<h3>CONSULTAS PREPARADAS</h3>';
    try {
        //Preparar la consulta
        $conexion->store_result();
        $stmt = $conexion->prepare("INSERT INTO clientes (nombre, apellido, email) VALUES (?,?,?)");
        $stmt->bind_param("sss", $nombre, $apellido, $email);

        //Establecer parámetros y ejecutar
        $nombre = "alejandro";
        $apellido = "Garcia";
        $email = "alejandro@edu.com";
        $stmt->execute(); 
        //Repetir tantas veces como se quiera
        $nombre = "Julian";
        $apellido = "Garcia";
        $email = "julian@edu.com";
        $stmt->execute();

        //Finalizar la consulta
        $stmt->close();

        echo 'Nuevos registros creados correctamente<br>';
    }
    catch (mysqli_sql_exception $e) {
        //Gestionar el error si hubiera
        echo 'Error en la conexión: ' . $e->getMessage() . '<br>';
    }

    
    echo '<h3>SELECT</h3>';
    try {
        //Configuramos una consulta SQL que selecciona las columnas id, nombre y apellido de la tabla Cliente. 
        $sql = "SELECT id, nombre, apellido FROM clientes";
        //Se ejecuta la consulta y almacena el resultado.
        $resultados = $conexion->query($sql);
        //Con num_rows se verifica si se devuelven más de cero filas
        if($resultados->num_rows > 0){
            //fetch_assoc() coloca todos los resultados en una matriz asociativa que podemos recorrer
            //Con el bucle se recorre el conjunto de resultados y recuperan los datos de las columnas id, nombre y apellido para cada registro
            while ($row = $resultados->fetch_assoc()) {
                echo $row["id"] . " - " . $row["nombre"] . ' ' . $row["apellido"] . '<br>';
            }
        }
        else {
            echo "No hay resultados";
        }
    }
    catch (mysqli_sql_exception $e) {
        //Gestionar el error si hubiera
        echo 'Error en la conexión: ' . $e->getMessage() . '<br>';
    }
    

    echo '<h3>UPDATE</h3>';
    try {
        //sql para actualizar un cliente
        $sql = "UPDATE clientes SET apellido='Sanz' WHERE nombre='Marco'";
        if ($conexion->query($sql)) {
            echo "Actualizado correctamente<br>";
        }
        else {
            echo "Error actualizando : " . $conexion->error;
        }
    }
    catch (mysqli_sql_exception $e) {
        //Gestionar el error si hubiera
        echo 'Error en la conexión: ' . $e->getMessage() . '<br>';
    }

    echo '<h3>DELETE</h3>';
    try {
        // sql para borrar un cliente
        $sql = "DELETE FROM clientes WHERE id=3";
        if ($conexion->query($sql)) {
            echo "Eliminado correctamente<br>";
        }
        else {
            echo "Error eliminando : " . $conexion->error;
        }
    }
    catch (mysqli_sql_exception $e) {
        //Gestionar el error si hubiera
        echo 'Error en la conexión: ' . $e->getMessage() . '<br>';
    }

    $conexion->close();
    echo '<br>Conexión cerrada';
}

