<?php

$tareas = [
        [
            'id' => 1,
            'descripcion' => 'Corregir tarea unidad 2 grupo A',
            'estado' => 'Pendiente'
        ],
        [
            'id' => 2,
            'descripcion' => 'Corregir tarea unidad 2 grupo A',
            'estado' => 'Pendiente'
        ],
        [
            'id' => 3,
            'descripcion' => 'Preparación unidad 3',
            'estado' => 'En proceso'
        ],
        [
            'id' => 4,
            'descripcion' => 'Publicar en github solución de la tarea unidad 2',
            'estado' => 'Completada'
        ]
    ];

function tareas()
{
    global $tareas;
    return $tareas;
}

function filtraCampo($campo)
{
    $campo = trim($campo);
    $campo = stripslashes($campo);
    $campo = htmlspecialchars($campo);
    return $campo;
}

function esCampoValido($campo)
{
    return !empty(filtraCampo($campo));
}

function guardar($id, $desc, $est)
{
    if (esCampoValido($id) && esCampoValido($est) && esCampoValido($est))
    {
        global $tareas;
        $data =[
            'id' => filtraCampo($id),
            'descripcion' => filtraCampo($desc),
            'estado' => filtraCampo($est)
        ];
        array_push($tareas, $data);
        return true;
    }
    else
    {
        return false;
    }  
    
}

