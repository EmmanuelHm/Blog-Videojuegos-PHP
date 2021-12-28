<!-- Llegar a esta pagina solo si hay sesion -->
<?php require_once 'includes/redireccion.php'; ?>

<?php require_once 'includes/cabecera.php'; ?>

<!-- BLOGS -->
<div id="principal">
    <h1>Crear Entradas</h1>
    <br/>
    <p>Añade nuevas Entradas al blog para que los usuarios puedan leerlas y disfrutar de nuestro contenido.</p>
    <br/>
    <form action="guardar_entrada.php" method="post">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo"/>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : "" ;?>

        <label for="descripcion">Descripción:</label>
        <br/>
        <textarea name="descripcion"/></textarea>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : "" ;?>


        <br/><br/>
        <label for="categoria">Categoría:</label>
        <select name="categoria">
            <?php 
                $categorias = conseguirCategorias($db);
                if(!empty($categorias)):
                    while($categoria = mysqli_fetch_assoc($categorias) ):
            ?>
                <option value="<?= $categoria['id'] ?>">
                    <?= $categoria['nombre'] ?>
                </option>
            <?php
                    endwhile;
                endif;
            ?>
        </select>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : "" ;?>
        <br/>

        <input type="submit" value="Guardar">
    </form>
    <?php borrarErrores(); ?>

</div>

<?php require_once 'includes/lateral.php'; ?>

<?php require_once 'includes/pie.php';?>