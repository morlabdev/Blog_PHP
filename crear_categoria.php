<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/sidebar.php'; ?>


<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Crear categorías</h1>

    <p>
      Añade nuevas categorias al blog para que los usuarios puedan
      usarlas al crear sus entradas.
    </p>
    <br>
    <form action="acciones/guardar_categoria.php" method="post">
      <label for="nombre">Nombre de la categoria: </label>
      <input type="text" name="nombre">

      <input type="submit" value="Guardar">
    </form>

</div>
<!-- FIN PRINCIPAL -->

<?php require_once 'includes/footer.php'; ?>
