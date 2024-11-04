<?php
$GLOBALS['tareas'] = [
    ['id' => 1, 'titulo' => 'Informe semanal', 'descripcion' => 'Completar el informe semanal', 'estado' => 'pendiente'],
    ['id' => 2, 'titulo' => 'Revisión de código', 'descripcion' => 'Revisión del código del proyecto', 'estado' => 'en proceso'],
    ['id' => 3, 'titulo' => 'Presentación', 'descripcion' => 'Preparar presentación para la reunión', 'estado' => 'completada'],
];

function obtenerTareas() {
    return $GLOBALS['tareas'];
}

function filtrarCampo($campo) {
    $campo = trim($campo);
    $campo = preg_replace('/\s+/', ' ', $campo);
    $campo = htmlspecialchars($campo, ENT_QUOTES, 'UTF-8');
    return $campo;
}

function validarCampoTexto($campo) {
    if(empty($campo)){
        return false;
    }
    return true;
}

function guardarTarea($titulo, $descripcion, $estado) {
    $titulo = filtrarCampo($titulo);
    $descripcion = filtrarCampo($descripcion);
    $estado = filtrarCampo($estado);

    if (!validarCampoTexto($titulo) || !validarCampoTexto($descripcion)) {
        return false;
    }

    if (!in_array($estado, ['pendiente', 'en proceso', 'completada'])) {
        return false;
    }

    $nuevoId = count($GLOBALS['tareas']) + 1;

    $nuevaTarea = [
        'id' => $nuevoId,
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'estado' => $estado,
    ];

    $GLOBALS['tareas'][] = $nuevaTarea;
    return true;
}
?>