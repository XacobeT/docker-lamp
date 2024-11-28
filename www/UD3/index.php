<?php

echo '<h1>Conexiones</h1>';

echo '<a href="crud_mysqli.php">CRUD MySQLi objeto</a><br>';
echo '<a href="crud_mysqli_proc.php">CRUD MySQLi procedimental</a><br>';
echo '<a href="crud_pdo.php">CRUD PDO</a><br>';


echo '<h3>Conexión mysqli orientación a objetos</h3>';
//1. Crear la conexión 
$conexion = new mysqli('db', 'root', 'test', 'colegio');
//2. Comprobar la conexión
$error = $conexion->connect_errno;
if($error !=null){
    die('Fallo en la conexión: ' . $conexion->connect_error . ', con numero ' . $error);
}
echo 'Conexión correcta';
//3. Cerrar la conexión
$conexion->close();


echo '<h3>Conexión mysqli procedimental</h3>';
//1. Crear la conexión
$con = mysqli_connect('db', 'root', 'test', 'colegio');
//2. Comprobar la conexión
if(!$con){
 die('Fallo en la conexión: ' . mysqli_connect_error());
}
echo 'Conexión procedimental correcta';
//3. Cerrar la conexión
mysqli_close($con);


echo '<h3>Conexión PDO</h3>';
$servername = 'db';
$username = 'root';
$password = 'test';
$dbname = 'colegio';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //  Forzar excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Conexión correcta';
} catch(PDOException $e) {
    echo 'Fallo en conexión: ' . $e->getMessage();
}
//3. Cierre de conexión
$conPDO = null;


echo '<h3>Verificar conexión mysqli</h3>';
try {
    //1. Crear la conexión 
    $conexion = new mysqli('db', 'root', 'test', 'myDB');
    echo 'Conexión correcta';
}
catch (mysqli_sql_exception $e) {
    //2. Gestionar el error si hubiera
    echo 'Error en la conexión: ' . $e->getMessage();
}
finally {
    // Cerrar la conexión si se estableció
    if (isset($conexion) && $conexion->connect_errno === 0) {
        $conexion->close();
    }
}

echo '<h3>Crear BD y tabla mysqli orientación a objetos</h3>';
try {
    //1. Crear la conexión sin indicar BD
    $conexion = new mysqli('db', 'root', 'test');
    echo 'Conexión correcta<br>';

    //3. Crear base de datos
    $sql = 'CREATE DATABASE myDBoo';
    if($conexion->query($sql)) {
        echo 'Base de datos creada correctamente <br>';
    }
    else {
        echo 'Error creando la base de datos: ' . $conexion->error . '<br>';
    }
    //4. Crear la tabla
    $sql = 'CREATE TABLE clientes(
        id INT(6) AUTO_INCREMENT PRIMARY KEY, 
        nombre VARCHAR(30) NOT NULL, 
        apellido VARCHAR(30) NOT NULL,
        email VARCHAR(50)
    )';
    $conexion->select_db('myDBoo');
    if ($conexion->query($sql)) {
        echo 'Tabla creada correctamente <br>';
    }
    else {
        echo 'Error creando la tabla' . $conexion->error . '<br>';
    }
}
catch (mysqli_sql_exception $e) {
    //2. Gestionar el error si hubiera
    echo 'Error en la conexión: ' . $e->getMessage() . '<br>';
} finally {
    //5. Cerrar la conexión si se estableció
    if (isset($conexion) && $conexion->connect_errno === 0) {
        $conexion->close();
        echo 'Conexión cerrada';
    }
}

echo '<h3>Crear BD y tabla mysqli procedimental</h3>';
//1. Crear la conexión
$con = mysqli_connect('db', 'root', 'test');
//2. Comprobar la conexión
if(!$con) {
    die('Fallo en la conexión:' . mysqli_connect_error() . '<br>');
}
echo 'Conexión procedimental correcta<br>';
//3. Crear base de datos
$sql = 'CREATE DATABASE myDBproc';
if (mysqli_query($con, $sql)) {
    echo 'Base de datos creada correctamente <br>';
}
else {
    echo 'Error creando base de datos: ' . mysqli_error($con);
}
//4. Crear la tabla
$sql = 'CREATE TABLE clientes(
    id INT(6) AUTO_INCREMENT PRIMARY KEY, 
    nombre VARCHAR(30) NOT NULL, 
    apellido VARCHAR(30) NOT NULL,
    email VARCHAR(50)
)';
mysqli_select_db($con, 'myDBproc');
if(mysqli_query($con, $sql)) {
    echo 'Tabla creada correctamente <br>';
}
else {
    echo 'Error creando la tabla ' . mysqli_error($con) . '<br>';
}
//5. Cerrar la conexión
mysqli_close($con);
echo 'Conexión cerrada';


echo '<h3>Crear BD y tabla PDO</h3>';
$servername = 'db';
$username = 'root';
$password = 'test';

try {
    //1. Crear la conexión
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Conexión PDO correcta<br>';
    //2. Crear BD
    $sql = 'CREATE DATABASE myDBPDO';
    //Se usa exec() porque no devuelve resultados
    $conn->exec($sql);
    echo 'Base de datos creada correctamente<br>';
    //3. Crear tabla
    $sql = 'CREATE TABLE clientes(
        id INT(6) AUTO_INCREMENT PRIMARY KEY, 
        nombre VARCHAR(30) NOT NULL,
        apellido VARCHAR(30) NOT NULL, 
        email VARCHAR(50)
    )';
    $conn->exec("USE myDBPDO");
    $conn->exec($sql);
    echo 'Tabla creada correctamente <br>';
}
catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage() . '<br>';
}
finally {
    //4. Cerrar la conexión
    $conn = null;
    echo 'Conexión cerrada';
}

