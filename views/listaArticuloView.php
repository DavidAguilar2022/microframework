<?php include_once("common/cabecera.php"); ?>

<body>
    <?php include_once("common/menu.php"); ?>
    <h1 style="text-align:center;">ARTÍCULOS</h1>
    <br>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">CATEGORIA</th>
                <th scope="col">CANTIDAD</th>
            </tr>
        </thead>
        <?php

        foreach ($articulos as $articulo) {
        ?>
            <tbody>
                <tr>
                    <td><?php echo $articulo->getArticuloId(); ?></td>
                    <td>
                        <?php echo $articulo->getNombreArticulo(); ?>
                    </td>
                    <td><?php echo $articulo->getNombreCategoria(); ?></td>
                    <td><?php echo $articulo->getCantidadArticulo(); ?></td>
                    <td><a href="index.php?controlador=articulo&accion=editar&art_id=<?php echo $articulo->getArticuloId() ?>" >Editar</a>
                    </td>
                    <td><a href="index.php?controlador=articulo&accion=borrar&art_id=<?php echo $articulo->getArticuloId() ?>" onclick="return confirm ('Estás seguro de que quieres borrar el artículo <?php echo $articulo->getNombreArticulo(); ?> de la categoría <?php echo $articulo->getNombreCategoria(); ?> con una cantidad de <?php echo $articulo->getCantidadArticulo(); ?> ?')">Borrar</a>
                    </td>
                </tr>
            <?php
        }
            ?>
            </tbody>
    </table>
    <a class="btn btn-primary" href="index.php?controlador=articulo&accion=nuevo">Crear un nuevo artículo</a>

</body>

</html>