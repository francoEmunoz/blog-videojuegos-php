<?php 
    if(!isset($_POST['busqueda'])) {
        header("Location: index.php");
    }
?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<div id="principal">
    <h1>Busqueda: <?= $_POST['busqueda'] ?></h1>

    <?php
        $entradas = getEntradas($db, null, null, $_POST['busqueda']);
        if(!empty($entradas) && mysqli_num_rows($entradas) >= 1):
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