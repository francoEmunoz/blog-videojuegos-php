<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>


<div id="principal">
    <h1 href="">Crear entradas</h1>
    <p>Añade nuevas entradas al blog para que los usuarios puedan leerlas y disfrutar de nuestro contenido.</p>
    <br />

    <form action="guardar-entrada.php" method="POST">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" />
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''?>

        <label for="descripcion">Descripcion</label>
        <textarea rows="5" cols="100" name="descripcion"></textarea>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''?>

        <label for="categoria">Categoría</label>
        <select name="categoria">
            <?php 
                $categorias = getCategorias($db);
                while($categoria = mysqli_fetch_assoc($categorias)):
            ?>
                    <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
            <?php endwhile ?>
        </select>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : ''?>

        <input type="submit" name="submit" value="Guardar" />
    </form>
    <?php borrarErrores(); ?>  
</div>

<?php require_once 'includes/pie.php'; ?>