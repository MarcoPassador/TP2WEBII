<?php
function paginarArray($array, $itemsPorPagina = 10, $paginaActual = 1) {
    $totalItems = count($array);
    $totalPaginas = ceil($totalItems / $itemsPorPagina);
    $paginaActual = max(1, min($paginaActual, $totalPaginas));
    $inicio = ($paginaActual - 1) * $itemsPorPagina;
    $itemsPagina = array_slice($array, $inicio, $itemsPorPagina);
    return [
        'items' => $itemsPagina,
        'totalPaginas' => $totalPaginas,
        'paginaActual' => $paginaActual,
        'totalItems' => $totalItems
    ];
}
?>