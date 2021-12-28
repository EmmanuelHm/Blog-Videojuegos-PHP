<?php 
    if( !isset($_POST['busqueda']) ){
        header('Location: index.php');
    }
?>

<?php require_once 'includes/cabecera.php'; ?>
<!-- Principal -->
<div id="principal">

    <h1>Busqueda: <?=$_POST['busqueda']; ?> </h1>

    <?php
    $entradas = conseguirEntradas($db, null, null, $_POST['busqueda']);

    if (!empty($entradas) && mysqli_num_rows($entradas) >= 1) :
        while ($entrada = mysqli_fetch_assoc($entradas)) :
    ?>
            <article class="entrada">
                <?php //var_dump($entrada); ?>
                <a href="entrada.php?id=<?=$entrada['id'];?>">
                    <h2><?= $entrada['titulo'] ?></h2>
                    <p class="fecha"><?= $entrada['categoria'] . ' | ' . $entrada['fecha'] ?></p>
                    <p class="entrada_desc"><?= substr($entrada['descripcion'], 0, 200) . "..." ?></p>
                </a>
            </article>
    <?php
        endwhile;
    else:
    ?>
        <br/>
        <div class="alerta alerta-info">No hay entradas en esta categoría</div>
    <?php
    endif;
    ?> 
</div>

<?php require_once 'includes/lateral.php'; ?>
<br /><br /><br /><br /><br /><br />

<?php require_once 'includes/pie.php'; ?>