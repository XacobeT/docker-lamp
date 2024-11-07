<?php
include 'utils.php';

$tareas = obtenerTareas();
?>
<html>
    <head>
        <title>UD2 - Xacobe Tarrio</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <?php include 'header.php'; ?>

        <div class="container-fluid">
            <div class="row">
                <?php include 'menu.php'; ?>

                <main>
                   <div>
                       <h2>Lista de Tareas</h2>
                   </div>
                   <div class="container">
                           <table class="table">
                               <thead class="thead">
                                   <tr>
                                       <th>Titulo</th>
                                       <th>Descripción</th>
                                       <th>Estado</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   <?php if (!empty($tareas)) : ?>
                                       <?php foreach ($tareas as $tarea) : ?>
                                           <tr>
                                               <td><?php echo htmlspecialchars($tarea['titulo']); ?></td>
                                               <td><?php echo htmlspecialchars($tarea['descripcion']); ?></td>
                                               <td><?php echo htmlspecialchars($tarea['estado']); ?></td>
                                           </tr>
                                       <?php endforeach; ?>
                                   <?php else : ?>
                                       <tr>
                                           <td colspan="3" class="text-center">No hay tareas disponibles.</td>
                                       </tr>
                                   <?php endif; ?>
                               </tbody>
                           </table>
                   </div>
                </main>
            </div>
        </div>

        <?php include 'footer.php'; ?>
    </body>
</html>