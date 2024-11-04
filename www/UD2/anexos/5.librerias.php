<?php
/*
include:

    Incluye y evalúa un archivo especificado.
    Si el archivo no se encuentra o no se puede incluir, PHP genera una advertencia (warning) pero continúa la ejecución del script.
    Se utiliza cuando el archivo no es estrictamente necesario para que el script continúe.

include_once:

    Funciona igual que include, pero asegura que el archivo solo sea incluido una vez, incluso si la instrucción se ejecuta varias veces.
    Evita la inclusión repetida de un archivo, lo que podría provocar errores (por ejemplo, redefiniciones de funciones o clases).


require:

    Similar a include, pero si el archivo no se encuentra o no se puede incluir, genera un error fatal (fatal error) y detiene la ejecución del script.
    Se utiliza cuando el archivo es crucial para que el script funcione correctamente.

require_once:

    Igual que require, pero asegura que el archivo solo sea incluido una vez.
    Es útil para evitar errores relacionados con la inclusión múltiple del mismo archivo.
*/


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