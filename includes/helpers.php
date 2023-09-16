<?php

function mostrarError($errores, $campo) {
    $alerta = '';
    if(isset($errores[$campo]) && !empty($campo)) {
        $alerta = "<div class='alerta alerta-error'>".$errores[$campo]."</div>";
    }

    return $alerta;
}

function borrarErrores() {
    $borrado = false;

    if(isset($_SESSION['errores'])) {
        unset($_SESSION['errores']);
        $borrado = true;
    }

    if(isset($_SESSION['error_login'])) {
        unset($_SESSION['error_login']);
        $borrado = true;
    }

    if(isset($_SESSION['errores_entrada'])) {
        unset($_SESSION['errores_entrada']);
        $borrado = true;
    }

    if(isset($_SESSION['completado'])) {
        unset($_SESSION['completado']);
        $borrado = true;
    }
    
    return $borrado;
}

function getCategorias($db) {
    $sql = "SELECT * FROM categorias ORDER BY id ASC";
    $categorias = mysqli_query($db, $sql);

    $resultado = [];
    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        $resultado = $categorias;
    }

    return $resultado;

}

function getCategoria($db, $id) {
    $sql = "SELECT * FROM categorias WHERE id = $id";
    $categoria = mysqli_query($db, $sql);

    $resultado = [];
    if ($categoria && mysqli_num_rows($categoria) >= 1) {
        $resultado = mysqli_fetch_assoc($categoria);
    }

    return $resultado;

}

function getEntradas($db, $limit = null, $categoria = null, $busqueda = null) {
    $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e ".
           "INNER JOIN categorias c ON e.categoria_id = c.id ";
    if(!empty($categoria)) {
        $sql .= "WHERE e.categoria_id = $categoria ";
    }
    if(!empty($busqueda)) {
        $sql .= "WHERE e.titulo LIKE '%$busqueda%' ";
    }
    $sql .= "ORDER BY e.id DESC ";
    if($limit) {
        $sql .= "LIMIT 4";
    }
    
    $entradas = mysqli_query($db, $sql);

    $resultado = [];
    if ($entradas && mysqli_num_rows($entradas) >= 1) {
        $resultado = $entradas;
    }

    return $resultado;

}

function getEntrada($db, $id) {
    $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e ".
           "INNER JOIN categorias c ON e.categoria_id = c.id ".
           "WHERE e.id = $id";
    $entrada = mysqli_query($db, $sql);

    $resultado = [];
    if ($entrada && mysqli_num_rows($entrada) >= 1) {
        $resultado = mysqli_fetch_assoc($entrada);
    }

    return $resultado;

}