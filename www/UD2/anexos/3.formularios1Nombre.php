<html>
    <head>
    <title>DWCS UD2. Boletín 3. Solución</title>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <h1>Anexo 3. Formularios</h1>
            <br />
            
            <h3>Tarea 1. Uso de arrays</h3>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'GET')
            {
                $nombre = $_GET['nombre'];
                $apellidos = $_GET['apellidos'];
                
                $longitudNombre = strlen($nombre);

                $primerosTresNombre = substr($nombre, 0, 3);
                
                $posicionA = stripos($apellidos, 'a');
                if ($posicionA === false) {
                    $posicionA = 'no encontrada';
                } else {
                    $posicionA++;
                }

                $cantidadAenNombre = substr_count(strtolower($nombre), 'a');

                echo "<p>Nombre: $nombre</p>";
                echo "<p>Apellidos: $apellidos</p>";
                echo "<p>Nombre y apellidos: $nombre $apellidos</p>";
                echo "<p>Su nombre tiene caracteres: $longitudNombre</p>";
                echo "<p>Los 3 primeros caracteres de tu nombre son: $primerosTresNombre</p>";
                echo "<p>La letra A fue encontrada en sus apellidos en la posición: $posicionA</p>";
                echo "<p>Su nombre contiene $cantidadAenNombre caracteres 'A'.</p>";
                echo "<p>Tu nombre en mayúsculas es: " . strtoupper($nombre) . "</p>";
                echo "<p>Sus apellidos en minúsculas son: " . strtolower($apellidos) . "</p>";
                echo "<p>Su nombre y apellidos en mayúsculas: " . strtoupper($nombre . ' ' . $apellidos) . "</p>";
                echo "<p>Tu nombre escrito al revés es: " . strrev($nombre) . "</p>";
            }
            ?>

            <a href="3.formularios.php" class="btn btn-info">Volver</a>

        </div>  
    </body>
</html>
