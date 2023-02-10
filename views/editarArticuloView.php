<?php include_once("common/cabecera.php"); ?>

<body>
	<?php include_once("common/menu.php"); ?>

	<form action="index.php">

		<input type="hidden" name="controlador" value="articulo">
		<input type="hidden" name="accion" value="editar">

		<label for="art_id">Codigo</label>
		<input type="text" readonly name="art_id" value="<?php echo $articulo->getArticuloId(); ?>">
		<br> <!--De sólo lectura, para que no podamos modificar el id. El id es autoincrement, no se puede establecer -->

		<?php echo isset($errores["articulo"]) ? "*" : "" ?>
		<label for="equipo">Nombre Articulo</label>
		<input type="text" name="art_nombre" maxlength="20" value="<?php echo $articulo->getNombreArticulo(); ?>">
		<br>
		<label for="art_categoria">Nombre Categoria</label>
		<?php
		require "models/CategoriaModel.php";
		$categorias = new CategoriaModel();
		$listado = $categorias->getAll();
		echo "<select name='art_categoria'>";
		foreach ($listado as $categoria) {
			echo "<option value = ' {$categoria->getCategoriaId()}'>{$categoria->getCategoriaNombre()}</option>";
		}
		?>
		<br>
		</select>
		<br>
		<label for="equipo">Cantidad</label>
		<input type="text" name="art_cantidad" maxlength="3" value="<?php echo $articulo->getCantidadArticulo(); ?>">
		<br>
		<br>
		<input class="btn btn-primary" type="submit" name="submit" value="Aceptar" onclick="return confirm ('Estás seguro de que quieres modificar el artículo que anteriormente tenía los siguientes valores: <?php echo $articulo->getNombreArticulo(); ?>, de la categoría <?php echo $categoria->getCategoriaNombre(); ?> con <?php echo $articulo->getCantidadArticulo(); ?> unidades?')" >
	</form>

	<br>
	<form action="index.php">
		<input type="hidden" name="controlador" value="articulo">
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