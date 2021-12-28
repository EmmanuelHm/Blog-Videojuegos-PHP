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

    <h1><?=$entrada_actual['titulo']; ?> </h1>
    <br/>
    <a href="categoria.php?id=<?=$entrada_actual['categoria_id']?>">
        <h2><?=$entrada_actual['categoria']; ?></h2>
    </a>
    <br/>
    <h6> Fecha: <?=$entrada_actual['fecha']; ?></h6>
    <h6> Autor: <?=$entrada_actual['usuario']; ?></h6>
    <br/>
    <p><?=$entrada_actual['descripcion']; ?></p>

    <?php if( isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id'] ): ?> 
        <br/><br/>
        <a href="editar_entrada.php?id=<?=$entrada_actual['id']?>" class="boton boton-azul">Editar entrada</a>
        <a href="borrar_entrada.php?id=<?=$entrada_actual['id']?>" class="boton">Eliminar entrada</a>
    <?php endif; ?>

</div>

<?php require_once 'includes/lateral.php'; ?>
<!-- <br /><br /><br /><br /><br /><br /> -->

<?php require_once 'includes/pie.php'; ?>