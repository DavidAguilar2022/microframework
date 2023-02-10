<?php include_once("common/cabecera.php"); ?>

<body>
	<?php include_once("common/menu.php"); ?>


	<form action="index.php">

		<input type="hidden" name="controlador" value="categoria">
		<input type="hidden" name="accion" value="nuevo">

		<?php echo isset($errores["categoria"]) ? "*" : "" ?>
		<label for="categoria">Categoría</label>
		<input type="text" name="cat_nombre" maxlength="20">
		</br>
		<input class="btn btn-primary" type="submit" name="submit" value="Aceptar">
	</form>
	<br>
	<form action="index.php">
		<input type="hidden" name="controlador" value="categoria">
		<input type="hidden" name="accion" value="listar">
		<input class="btn btn-primary" type="submit" name="cancel" value="Cancelar">
	</form>
	</br>
	<?php
	if (isset($errores)): //Si hay errores se muestran
		foreach ($errores as $key => $error):
			echo $error . "</br>";
		endforeach;
	endif;
	?>

</body>

</html>