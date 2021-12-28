<!-- Llegar a esta pagina solo si hay sesion -->
<?php require_once 'includes/redireccion.php'; ?>

<?php require_once 'includes/cabecera.php'; ?>

<!-- BLOGS -->
<div id="principal">
    <h1>Crear Categorías</h1>
    <br/>
    <p>Añade nuevas categorias al blog para que los usuarios puedan usarlas al crear sus entradas.</p>
    <br/>
    <form action="guardar_categoria.php" method="post">
        <label for="nombre">Nombre de la Categoría:</label>
        <input type="text" name="nombre"/>

        <input type="submit" value="Guardar">
    </form>

</div>

<?php require_once 'includes/lateral.php'; ?>

<?php require_once 'includes/pie.php';?>

