<?php include_once("common/cabecera.php"); ?>

<body>
	<?php include_once("common/menu.php"); ?>


	<form action="index.php">

		<input type="hidden" name="controlador" value="articulo">
		<input type="hidden" name="accion" value="nuevo">

		<?php echo isset($errores["articulo"]) ? "*" : "" ?>
		<label for="art_nombre">Nombre artículo</label>
		<input type="text" name="art_nombre" maxlength="20">
        <br>
        <label for="art_categoria">Categoría</label>
		<?php
		require "models/CategoriaModel.php";
		$categorias = new CategoriaModel();
        
        $listado = $categorias->getAll();
		echo"<select name='art_categoria'>";
		foreach ($listado as $categoria){
			echo "<option value = ' {$categoria->getCategoriaId()}'>{$categoria->getCategoriaNombre()}</option>";
		}
	?> 
		<br>
	</select>
        <br>
        <label for="art_cantidad">Cantidad</label>
		<input type="text" name="art_cantidad" maxlength="3">
		<br><br>
		<input class="btn btn-primary" type="submit" name="submit" value="Aceptar">
	</form>
	<br>
	<form action="index.php">
		<input type="hidden" name="controlador" value="articulo">
		<input type="hidden" name="accion" value="listar">
		<input class="btn btn-primary" type="submit" name="cancel" value="Cancelar">
	</form>
	</br>
	<?php
	if (isset($errores)):
		foreach ($errores as $key => $error):
			echo $error . "</br>";
		endforeach;
	endif;
	?>

</body>

</html>