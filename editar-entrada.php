<?php require_once 'includes/redireccion.php'; ?>
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

    <h1 href="">Editar entrada</h1>
    <br>
    <form action="guardar-entrada.php?editar=<?= $entrada_actual['id'] ?>" method="POST">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" value="<?= $entrada_actual['titulo'] ?>" />
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''?>

        <label for="descripcion">Descripcion</label>
        <textarea rows="5" cols="100" name="descripcion"><?= $entrada_actual['descripcion'] ?></textarea>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''?>

        <label for="categoria">Categoría</label>
        <select name="categoria">
            <?php 
                $categorias = getCategorias($db);
                while($categoria = mysqli_fetch_assoc($categorias)):
            ?>
                    <option value="<?= $categoria['id'] ?>"
                    <?= ($categoria['id']==$entrada_actual['categoria_id']) ? 'selected="selected"' : '' ?>
                    >
                        <?= $categoria['nombre'] ?>
                    </option>
            <?php endwhile ?>
        </select>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : ''?>

        <input type="submit" name="submit" value="Guardar" />
    </form>

</div>

<?php require_once 'includes/pie.php'; ?>