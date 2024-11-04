<html>
    <head>
    <title>DWCS UD2. Boletín 4. Solución</title>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <h1>Anexo 4. Funciones</h1>
            <br />
            <h3>Tarea 1. Uso de funciones</h3> 
            
            <?php
                function esDigito($caracter)
                {
                    if (ctype_digit($caracter) && intval($caracter) >= 0 && intval($caracter) <= 9) {
                        echo "El carácter $caracter es un dígito entre 0 y 9.<br>";
                    } else {
                        echo "El carácter $caracter no es un dígito entre 0 y 9.<br>";
                    }
                }
                
                function longitudString($string)
                {
                    return strlen($string);
                }
                
                function elevar($a, $b)
                {
                    return pow($a, $b);
                }
                
                function esVocal($caracter)
                {
                    return in_array(strtolower($caracter), ['a', 'e', 'i', 'o', 'u']);
                }
                
                function parImpar($numero)
                {
                    if ($numero % 2 == 0) {
                        return "El número $numero es par.<br>";
                    } else {
                        return "El número $numero es impar.<br>";
                    }
                }
                
                function convertirMayusculas($string)
                {
                    return strtoupper($string);
                }
                
                function imprimirZonaHoraria()
                {
                    echo 'La zona horaria por defecto es: ' . date_default_timezone_get() . '<br>';
                }
                
                function imprimirSalidaPuestaSol($latitud = 42.8782, $longitud = -8.5448)
                {
                    $info = date_sun_info(time(), $latitud, $longitud);
                    /*foreach ($info as $key => $val)
                    {
                        echo "$key: " . date("H:i:s", $val) . '<br>';
                    }*/
                
                    echo 'Hora de salida del sol: ' . date("H:i:s", $info['sunrise']) . '<br>';
                    echo 'Hora de puesta del sol: ' . date("H:i:s", $info['sunset']) . '<br>';
                }
                
                echo '<h2>Resultados</h2>';
                
                esDigito('5');
                esDigito('a');
                
                echo 'La longitud de Marco es: ' . longitudString("Marco") . '<br>';
                
                echo '2 elevado a 3 es: ' . elevar(2, 3) . '<br>';
                
                echo 'a es vocal? ' . (esVocal('a') ? 'Sí' : 'No') . '<br>';
                echo 'b es vocal? ' . (esVocal('b') ? 'Sí' : 'No') . '<br>';
                
                echo parImpar(4);
                echo parImpar(7);

                echo 'En mayúsculas: ' . convertirMayusculas('hola mundo') . '<br>';
                
                imprimirZonaHoraria();
                
                imprimirSalidaPuestaSol();
            ?>

            <br />
            <h3>Tarea 2. Programa DNI</h3> 

            <?php
                function comprobar_nif($nif) {
                    if (strlen($nif) != 9) {
                        return false;
                    }

                    $numero = substr($nif, 0, 8);
                    $letra = strtoupper(substr($nif, -1));

                    if (!ctype_digit($numero)) {
                        return false;
                    }

                    $letras_validas = 'TRWAGMYFPDXBNJZSQVHLCKE';

                    $indice = intval($numero) % 23;
                    $letra_correcta = $letras_validas[$indice];

                    return $letra === $letra_correcta;
                }

                $nif = "12345678Z";
                if (comprobar_nif($nif)) {
                    echo "El NIF $nif es correcto. <br>";
                } else {
                    echo "El NIF $nif no es correcto. <br>";
                }
            ?>


        </div>  
    </body>
</html>
