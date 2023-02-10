<?php include_once("common/cabecera.php"); ?>

<body>
	<?php include_once("common/menu.php"); ?>

	<form action="index.php">

		<input type="hidden" name="controlador" value="categoria">
		<input type="hidden" name="accion" value="editar">

		<label for="cat_id">Codigo</label>
		<input type="text" readonly name="cat_id" value="<?php echo $categoria->getCategoriaId(); ?>">
		</br>

		<?php echo isset($errores["categoria"]) ? "*" : "" ?>
		<label for="equipo">Categoria</label>
		<input type="text" name="cat_nombre" maxlength="20" value="<?php echo $categoria->getCategoriaNombre(); ?>">
		</br>
		<br>
		<input class="btn btn-primary" type="submit" name="submit" value="Aceptar" onclick="return confirm ('Estás seguro de que quieres modificar la categoría que anteriormente tenía el valor <?php echo $categoria->getCategoriaNombre(); ?>?')">
		<!--No he puesto los valores nuevos porque eso habría que hacerlo todo con javascript-->
	</form>
	<br>
	<form action="index.php">
		<input type="hidden" name="controlador" value="categoria">
		<input type="hidden" name="accion" value="listar">
		<input class="btn btn-primary" type="submit" name="cancel" value="Cancelar">
	</form>
	</br>
	<?php
	if (isset($errores)) :
		foreach ($errores as $key => $error) :
			echo $error . "</br>";
		endforeach;
	endif;
	?>
</body>

</html>