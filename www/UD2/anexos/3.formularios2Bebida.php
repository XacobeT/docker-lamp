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
            
            <h3>Tarea 2. Envío de formularios</h3> 
            <p>Crea un formulario para solicitar una de las siguientes bebidas.</p>
            
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $bebida = $_POST['bebida'];
                $cantidad = intval($_POST['cantidad']);
                $precio = 0;
                $nombreBebida = "";

                switch ($bebida) {
                    case "Coca Cola":
                        $precio = 1.00;
                        $nombreBebida = "Coca Cola";
                        break;
                    case "Pepsi Cola":
                        $precio = 0.80;
                        $nombreBebida = "Pepsi Cola";
                        break;
                    case "Fanta Naranja":
                        $precio = 0.90;
                        $nombreBebida = "Fanta Naranja";
                        break;
                    case "Trina Manzana":
                        $precio = 1.10;
                        $nombreBebida = "Trina Manzana";
                        break;
                    default:
                        echo "Bebida no válida.";
                        exit;
                }

                $precioTotal = $precio * $cantidad;

                echo "<p>Pediste $cantidad botellas de $nombreBebida. Precio total a pagar: $precioTotal Euros.</p>";
            }
            ?>
            <a href="3.formularios.php" class="btn btn-info">Volver</a>

        </div>  
    </body>
</html>
