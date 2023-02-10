<?php include_once("common/cabecera.php"); ?>

<body>
    <?php include_once("common/menu.php"); ?>
    <h1 style="text-align:center;">CATEGORÍAS</h1>
    <br>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">CATEGORIA</th>
            </tr>
        </thead>
        <?php

        foreach ($categorias as $categoria) {
        ?>
            <tbody>
                <tr>
                    <td><?php echo $categoria->getCategoriaId(); ?></td>
                    <td>
                        <?php echo $categoria->getCategoriaNombre(); ?>
                    </td>
                    <td><a href="index.php?controlador=categoria&accion=editar&cat_id=<?php echo $categoria->getCategoriaId() ?>">Editar</a>
                    </td>
                    <td><a href="index.php?controlador=categoria&accion=borrar&cat_id=<?php echo $categoria->getCategoriaId() ?>" onclick="return confirm('Estás seguro de que quieres borrar la categoría <?php echo $categoria->getCategoriaNombre(); ?> ?')">Borrar</a>
                    </td>

                </tr>
            <?php
        }
            ?>
            </tbody>
    </table>
    <a class="btn btn-primary" href="index.php?controlador=categoria&accion=nuevo">Crear nueva categoria</a>

</body>

</html>