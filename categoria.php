<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php 
    $categoria_actual = getCategoria($db, $_GET['id']);

    if(!isset($categoria_actual['id'])) {
        header("Location: index.php");
    }
?>

<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<div id="principal">
    <h1><?= $categoria_actual['nombre'] ?></h1>

    <?php
        $entradas = getEntradas($db, null, $categoria_actual['id']);
        if(!empty($entradas)):
            while($entrada = mysqli_fetch_assoc($entradas)):
    ?>
                <article class="entrada">
                    <h2><?= $entrada['titulo'] ?></h2>
                    <span class="fecha"><?= $entrada['categoria'].' | '.$entrada['fecha'] ?></span>
                    <p><?= substr($entrada['descripcion'], 0, 160) ?>...
                    <a href="entrada.php?id=<?=$entrada['id']?>">Ver más</a>
                    </p>
                </article>
    <?php
            endwhile;
        else:
    ?>
            <br>
            <div class="alerta">No hay entradas en esta categoría</div>
    <?php endif ?>

    <div id="ver-todas">
        <a href="entradas.php">Ver todas las entradas</a>
    </div>

</div>

<?php require_once 'includes/pie.php'; ?>