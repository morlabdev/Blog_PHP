<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/sidebar.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Todas las entradas</h1>

    <?php
      $entradas = getEntradas($db);
      if (!empty($entradas)) :
        while ($entrada = mysqli_fetch_assoc($entradas)) :
     ?>

    <article class="entrada">
        <a href="entrada.php?id=<?=$entrada['id']?>">
            <h2><?=$entrada['titulo']?></h2>
            <span class="date"><?=$entrada['categoria'].' | '.$entrada['fecha']?></span>
            <p>
                <?=substr($entrada['descripcion'], 0, 180)."..."?>
            </p>
        </a>
    </article>

    <?php
        endwhile;
      endif;
     ?>

</div><!-- FIN PRINCIPAL -->

<?php require_once 'includes/footer.php'; ?>
