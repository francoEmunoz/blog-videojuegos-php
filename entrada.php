<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php 
    $entrada_actual = getEntrada($db, $_GET['id']);

    if(!isset($entrada_actual['id'])) {
        header("Location: index.php");
    }
?>

<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<div id="principal">
    <h1><?= $entrada_actual['titulo'] ?></h1>
    <h2><?= $entrada_actual['categoria'] ?></h2>
    <p><?= $entrada_actual['descripcion'] ?></p>
    <br>
    <h4><?= $entrada_actual['fecha'] ?></h4>

    <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']): ?>
        <a href="editar-entrada.php?id=<?=$entrada_actual['id']?>" class="boton boton-verde">Editar</a>
        <a href="borrar-entrada.php?id=<?=$entrada_actual['id']?>" class="boton boton-rojo">Eliminar</a>
    <?php endif ?>

    <div id="ver-todas">
        <a href="entradas.php">Ver todas las entradas</a>
    </div>

</div>

<?php require_once 'includes/pie.php'; ?>