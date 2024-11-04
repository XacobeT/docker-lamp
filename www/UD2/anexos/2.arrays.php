<html>
    <head>
    <title>DWCS UD2. Boletín 2. Solución</title>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <h1>Anexo 2. Arrays y estructuras de control</h1>
            <br />
            <h3>Tarea 1. Uso de arrays</h3> 
            <p>1. Almacena en un array los 10 primeros números pares. Imprímelos cada uno en una línea.</p>
            <?php
            echo 'Opción A <br />';
            $pares = [2, 4, 6, 8, 10, 12, 14, 16, 18, 20];
            for ($i = 0; $i < count($pares); $i++)
            {
                echo $pares[$i] . '<br />';
            }
            ?>
            <?php
            echo 'Opción B <br />';
            $pares = array();
            for ($i = 1; $i <= 10; $i++)
            {
                array_push($pares, $i*2);
            }
            for ($i = 0; $i < count($pares); $i++)
            {
                echo $pares[$i] . '<br />';
            }
            ?>
            <br />

            <p>2. Imprime los valores del array asociativo siguiente usando un foreach:</p>
            <?php
            $v[1]=90;
            $v[10] = 200;
            $v['hola']=43;
            $v[9]='e';
            foreach ($v as $e)
            {
                echo $e . '<br />';
            }
            ?>

            <br />
            <h3>Tarea 2. Arrays multidimensionales</h3> 
            <p>Almacena la información en un array multidimensional e imprímela usando bucles.</p>
            <?php
            echo 'Opción A: <br />';
            $array = [
                [
                    'name' => 'john',
                    'data' => [
                        'email' => 'john@demo.com',
                        'website' => 'www.john.com',
                        'age' => 22,
                        'password' => 'pass'
                    ]
                ],
                [
                    'name' => 'anna',
                    'data' => [
                        'email' => 'anna@demo.com',
                        'website' => 'www.anna.com',
                        'age' => 24,
                        'password' => 'pass'
                    ]
                ],
                [
                    'name' => 'peter',
                    'data' => [
                        'email' => 'peter@mail.com',
                        'website' => 'www.peter.com',
                        'age' => 42,
                        'password' => 'pass'
                    ]
                ],
                [
                    'name' => 'max',
                    'data' => [
                        'email' => 'max@mail.com',
                        'website' => 'www.max.com',
                        'age' => 33,
                        'password' => 'pass'
                    ]
                ]
            ];
            for ($i = 0; $i < count($array); $i++)
            {
                echo 'Name: ' . $array[$i]['name'] . ' - ';
                $datos = $array[$i]['data'];
                echo $datos['email'] . ' - ';
                echo $datos['website'] . ' - ';
                echo $datos['age'] . ' - ';
                echo $datos['password'] . '<br />';
            }
            echo 'Opción B: <br />';
            $array = [
                [
                    'john',
                    [
                        'john@demo.com',
                        'www.john.com',
                        22,
                        'pass'
                    ]
                ],
                [
                    'anna',
                    [
                        'anna@demo.com',
                        'www.anna.com',
                        24,
                        'pass'
                    ]
                ],
                [
                    'peter',
                    [
                        'peter@mail.com',
                        'www.peter.com',
                        42,
                        'pass'
                    ]
                ],
                [
                    'max',
                    [
                        'max@mail.com',
                        'www.max.com',
                        33,
                        'pass'
                    ]
                ]
            ];
            for ($i = 0; $i < count($array); $i++)
            {
                echo 'Name: ' . $array[$i][0];
                $datos = $array[$i][1];
                foreach ($datos as $dato)
                {
                    echo ' - '. $dato;
                }
                echo '<br />';
            }
            ?>

            <br />
            <h3>Tarea 3. Uso de Arrays</h3> 
            <p> Realiza los siguientes pasos. Utiliza <a href="https://www.php.net/manual/es/ref.array.php">funciones de matriz</a>.</p>

            <p>1. Crea una matriz con 30 posiciones y que contenga números aleatorios entre 0 y 20 (inclusive). Uso de la función <a href="https://www.php.net/manual/es/function.rand.php">rand</a>. Imprime la matriz creada anteriormente.</p>
            <?php
            $array = array();
            for ($i = 0; $i < 30; $i++)
            {
                array_push($array, rand(0, 20));
            }
            for ($i = 0; $i < count($array); $i++)
            {
                echo $array[$i]. ', ';
            }
            echo '<br /><br />';
            ?>
   
            <p>2. Crea una matriz con los siguientes datos: `Batman`, `Superman`, `Krusty`, `Bob`, `Mel` y `Barney`.</p>
            <ul>
                <li>Elimina la última posición de la matriz.</li>
                <li>Imprime la posición donde se encuentra la cadena 'Superman'.</li>
                <li>Agrega los siguientes elementos al final de la matriz: `Carl`, `Lenny`, `Burns` y `Lisa`.</li>
                <li>Ordena los elementos de la matriz e imprima la matriz ordenada.</li>
                <li>Agrega los siguientes elementos al comienzo de la matriz: `Apple`, `Melon`, `Watermelon`.</li>
            </ul>
            <?php
            $personajes = ['Batman', 'Superman', 'Krusty', 'Bob', 'Mel', 'Barney'];
            array_pop($personajes);
            $posicionSuperman = array_search('Superman', $personajes);
            echo 'La posición de Superman es: ' . $posicionSuperman . '<br />';
            array_push($personajes, 'Carl', 'Lenny', 'Burns', 'Lisa');
            sort($personajes);
            echo 'Ordenada: <br />';
            print_r($personajes);
            echo '<br />';
            array_unshift($personajes, 'Apple', 'Melon', 'Watermelon');
            echo 'Matriz final : <br />';
            print_r($personajes);
            ?>

            <br /><br />
            
            <p>3. Crea una copia de la matriz con el nombre `copia` con elementos del 3 al 5. Agrega el elemento `Pera` al final de la matriz.</p>
            <?php
            $copia = array_slice($personajes, 2, 3);
            array_push($copia, 'Pera');
            echo 'Copia: <br />';
            print_r($copia);
            ?>
            <br /><br />
            
            <h3>Tarea 4. Uso de arrays e Strings</h3> 
            <p> En un <strong>string</strong>, tenemos almacenados varios datos agrupados en ciudad, país y continente. El formato es `ciudad,pais,continente` y cada grupo *ciudad-pais-continente* se separa co un `;`.</p>

            <?php
            $informacion = "Tokyo,Japan,Asia;Mexico City,Mexico,North America;New York City,USA,North America;Mumbai,India,Asia;Seoul,Korea,Asia;Shanghai,China,Asia;Lagos,Nigeria,Africa;Buenos Aires,Argentina,South America;Cairo,Egypt,Africa;London,UK,Europe";
            ?>

            <p>Crea una aplicación PHP que imprima toda la información almacenada en el *string* en una tabla con 3 columnas.</p>
            
            <?php
            $ciudades = explode(';', $informacion);
            ?>
            <div class="table">
            <table class="table table-bordered mw-50 w-50" >
                <tr>
                    <th>Ciudad</th>
                    <th>País</th>
                    <th>Continente</th>
                </tr>
                
                <?php
                foreach ($ciudades as $ciudad) {
                    $detalles = explode(',', $ciudad);
                    echo '<tr>';
                    echo '<td>' . $detalles[0] . '</td>';
                    echo '<td>' . $detalles[1] . '</td>';
                    echo '<td>' . $detalles[2] . '</td>';
                    echo '</tr>';
                }
                ?>
            </table>
            </div>
            
            <p>Con la información anterior, realiza las seguintes tareas:</p>
            <p>1. Crea la estrutura de datos y almacena toda la información anterior en un array.</p>
            <p>2. Utilizando a instrución `foreach` e etiquetas HTML, imprime toda a información almacenada para que apareza de forma similar al ejemplo mostrado.</p>

            <?php

            $ciudades = explode(';', $informacion);
            $array_ciudades = [];
            
            foreach ($ciudades as $ciudad_info) {
                $detalles = explode(',', $ciudad_info);
                $array_ciudades[] = [
                    'ciudad' => $detalles[0],
                    'pais' => $detalles[1],
                    'continente' => $detalles[2]
                ];
            }
            
            echo '<div class="table">';
            echo '<table class="table table-bordered mw-50 w-50" >';
            echo '<tr><th>Ciudad</th><th>País</th><th>Continente</th></tr>';
            
            foreach ($array_ciudades as $entrada) {
                echo '<tr>';
                echo '<td>' . $entrada['ciudad'] . '</td>';
                echo '<td>' . $entrada['pais'] . '</td>';
                echo '<td>' . $entrada['continente'] . '</td>';
                echo '</tr>';
            }
            
            echo '</table></div>';            
            ?>

        </div>  
    </body>
</html>
