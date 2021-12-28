<!-- Llegar a esta pagina solo si hay sesion -->
<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>

<?php 
    $entrada_actual = conseguirEntrada($db, $_GET['id']);

    if( !isset($entrada_actual['id']) ){
        header('Location: index.php');
    }
?>

<?php require_once 'includes/cabecera.php'; ?>

<!-- Principal -->
<div id="principal">
    <h1>Editar Entrada</h1>
    <br/>
    <p>Edita tu entrada <?=$entrada_actual['titulo']?></p>
    <br/>
    <form action="guardar_entrada.php?editar=<?=$entrada_actual['id']?>" method="post">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" value="<?=$entrada_actual['titulo']?>"/>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : "" ;?>

        <label for="descripcion">Descripción:</label>
        <br/>
        <textarea name="descripcion">
            <?=$entrada_actual['descripcion']?>
        </textarea>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : "" ;?>


        <br/><br/>
        <label for="categoria">Categoría:</label>
        <select name="categoria">
            <?php 
                $categorias = conseguirCategorias($db);
                if(!empty($categorias)):
                    while($categoria = mysqli_fetch_assoc($categorias) ):
            ?>
                <option value="<?= $categoria['id'] ?>"
                <?= ($categoria['id'] == $entrada_actual['categoria_id']) ? 'selected="selected"' : '' ?>
                >
                    <?= $categoria['nombre'] ?>
                </option>
            <?php
                    endwhile;
                endif;
            ?>
        </select>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : "" ;?>
        <br/>

        <input type="submit" value="Actualizar">
    </form>
    <?php borrarErrores(); ?>

</div>

<?php require_once 'includes/lateral.php'; ?>
<!-- <br /><br /><br /><br /><br /><br /> -->

<?php require_once 'includes/pie.php'; ?>