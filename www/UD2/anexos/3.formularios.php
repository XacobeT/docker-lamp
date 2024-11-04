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
            <p>Crea un formulario que solicite nombre y apellido. Cuando se reciben los datos, se debe mostrar la información.</p>
            
            <form method="GET" action="3.formularios1Nombre.php">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required><br><br>
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" required><br><br>
                <input type="submit" value="Enviar">
            </form>

            <br />
            
            <h3>Tarea 2. Envío de formularios</h3> 
            <p>Crea un formulario para solicitar una de las siguientes bebidas.</p>

            <form method="POST" action="3.formularios2Bebida.php">
                <label for="bebida">Selecciona una bebida:</label>
                <select id="bebida" name="bebida" required>
                    <option value="Coca Cola">Coca Cola - 1 €</option>
                    <option value="Pepsi Cola">Pepsi Cola - 0,80 €</option>
                    <option value="Fanta Naranja">Fanta Naranja - 0,90 €</option>
                    <option value="Trina Manzana">Trina Manzana - 1,10 €</option>
                </select><br><br>

                <label for="cantidad">Cantidad de bebidas:</label>
                <input type="number" id="cantidad" name="cantidad" min="1" required><br><br>

                <input type="submit" value="Solicitar">
            </form>


        </div>  
    </body>
</html>
