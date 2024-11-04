<html>
    <head>
        <title>DWCS UD2. Boletín 1. Solución</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container-fluid">
            <h1>Anexo 1. Introduccion</h1>
            <br />
            <h3>Tarea 1. Localizar errores.</h3> 
                <?php
                echo '¿Cómo estás? ';
                echo 'Estoy bien, gracias.';
                ?>
            <br />
            <h3>Tarea 2. Variable, declaración.</h3>
            <p>Indica cuál de los siguientes son nombres de variables válidas e inválidos e indica por qué:</p>
            <ul>
                <li>valor: falta el 'dólar'</li>
                <li>$_N: válida</li>
                <li>$valor_actual: válida </li>
                <li>$n: válida</li>
                <li>$#datos: # no es un caracter válido</li> 
                <li>$valorInicial0: válida</li>
                <li>$proba,valor: , no es un caracter válido</li>
                <li>$2saldo: no puede empezar por un número</li>
                <li>$n: válida</li>
                <li>$meuProblema: válida</li>
                <li>$meu Problema: no puede tener espacios</li>
                <li>$echo: válida</li>
                <li>$m&m: & no es un caracter válido</li>
                <li>$registro: válida</li>
                <li>$ABC: válida</li>
                <li>$85 Nome: no puede empezar por números ni tener espacios</li>
                <li>$AAAAAAAAA: válida</li>
                <li>$nome_apelidos: válida</li>
                <li>$saldoActual: válida</li>
                <li>$92: no puede empezar por números</li>
                <li>$*143idade: * no es un caracter válido</li>
            </ul>
            <br />

            <h3>Tarea 3. Funciones para trabajar con tipos de datos.</h3>

            <p>Busca en la documentación de PHP las funciones de <a href="http://www.php.net/manual/es/funcref.php">manejo de variables</a></p>
            
            <p>Comprueba el resultado devuelto por los siguientes fragmentos de código:</p>
            <?php
            $a = "true";
            echo 'is_bool($a): ' . is_bool($a) . '<br />';
            $b = 0;
            echo 'is_bool($b): ' . is_bool($b) . '<br />';
            if($b) 
            {
                echo 'se entra dentro de if($b)' . '<br />';
            }
            $c = "false";
            echo 'gettype($c): ' . gettype($c) . '<br />';
            $d = "";
            echo 'empty($d): ' . empty($d) . '<br />';
            $e = 0.0;
            echo 'empty($e): ' . empty($e) . '<br />';
            $f = 0;
            echo 'empty($f): ' . empty($f) . '<br />';
            $g = false;
            echo 'empty($g): ' . empty($g) . '<br />';
            $h;
            echo 'empty($h): ' . empty($h) . '<br />';
            $i = "0";
            echo 'empty($i): ' . empty($i) . '<br />';
            $j = "0.0";
            echo 'empty($j): ' . empty($j) . '<br />';
            $k = true;
            echo 'isset($k): ' . isset($k) . '<br />';
            $l = false;
            echo 'isset($l): ' . isset($l) . '<br />';
            $m = true;
            echo 'is_numeric($m): ' . is_numeric($m) . '<br />';
            $n = "";
            echo 'is_numeric($n): ' . is_numeric($n) . '<br />';
            ?>

            <h3>Tarea 4. Variables globales.</h3>
            Haz una página que ejecute la función phpinfo() y que muestre las principales variables de servidor mencionadas en teoría.
            <?php
            phpinfo(INFO_GENERAL);
            phpinfo(INFO_VARIABLES);
            ?>
            <br />

            <h3>Tarea 5. Operadores.</h3>
            
            <p>1. Escribe un programa que pase de grados Fahrenheit a Celsius. Para pasar de Fahrenheit a Celsius se resta 32 a la temperatura, se multiplica por 5 y se divide entre 9. Declara en una variable el valor inicial de los grados y en otra el final.</p>
            <?php
            $inicial = 100;
            echo 'Fahrenheit: ' . $inicial . '<br />';
            $final = ($inicial - 32) * 5 / 9;
            echo 'Celsius: ' . $final . '<br />';
            ?>
            <br />

            <p>2. Crea un programa en PHP que declare e inicialice dos variables x e y con los valores 20 y 10 respectivamente y muestre la suma, la resta, la multiplicación, la división y el módulo de ambas variables. (Optativo) Haz dos versiones de este ejercicios: guarda los resultados en nuevas variables; sin utilizar variables intermedias.</p>
            <?php
            $x = 20;
            $y = 10;
            echo 'Suma: ' . $x + $y . '<br />';
            echo 'Resta: ' . $x - $y . '<br />';
            echo 'Multiplicación: ' . $x * $y . '<br />';
            echo 'División: ' . $x / $y . '<br />';
            echo 'Módulo: ' . $x % $y . '<br />';
            $suma = $x + $y;
            $resta = $x - $y;
            $multiplicacion = $x * $y ;
            $division = $x / $y;
            $modulo = $x % $y;
            echo "Suma: $suma<br />";
            echo "Resta: $resta<br />";
            echo "Multiplicación: $multiplicacion<br />";
            echo "División: $division<br />";
            echo "Módulo: $modulo<br />";
            ?>
            <br />

            <p>3. Escribe un programa que imprima por pantalla los cuadrados de los 30 primeros números naturales.</p>
            <?php
            for ($i=1; $i<=30; $i++)
            {
                echo "Cuadrado de $i: " . $i**2 . "<br />";
            }
            ?>
            <br />

            <p>4. Haz un programa php que calcule el área y el perímetro de un rectángulo (```área=base*altura```) y (```perímetro=2*base+2*altura```). Debes declarar las variables base=20 y altura=10.</p>
            <?php
            $base = 20;
            $altura = 10;
            echo 'Área = ' . $base * $altura . '<br />';
            echo 'Perímetro = ' . 2 * $base + 2 * $altura . '<br />';
            ?>
            <br />
            
            <h3>Tarea 6. Cadenas.</h3>
            <p>Usando la instrucción ```echo``` crea un programa en PHP que muestre el mensaje: ```Hola, Mundo!```. Muéstralo en cursiva.</p>
            <h5><em><?php echo 'Hola, Mundo!' ?></em></h5>

            <p>Crea un programa en PHP que guarde en una variable tu nombre y lo muestre en negrita formando el siguiente mensaje: Bienvenido tu_nombre.</p>
            <?php
            $nombre = 'Marco';
            echo "Bienvenido, <strong>Marco!</strong><br />";
            ?>

        </div>  
    </body>
</html>
