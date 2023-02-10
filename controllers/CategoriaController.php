<?php
class CategoriaController
{
    protected $view;

    function __construct()
    {
        //Creamos una instancia del mini motor de plantillas
        $this->view = new View();
    }


    public function listar()
    {
        //Inclimos el modelo categoria
        require 'models/CategoriaModel.php';

        //Creamos una instancia del modelo
        $categorias = new CategoriaModel();

        //Recuperamos todas las categorías
        $listado = $categorias->getAll();

        //Guardamos los datos en un array para luego pasarlos a la vista
        $data['categorias'] = $listado;


        //Utilizamos el método show para mostrarlos
        $this->view->show("listaCategoriaView.php", $data);
    }

    public function index()
    {
        //Inclimos el modelo categoria
        require_once 'models/CategoriaModel.php';

        //Creamos una instancia del modelo
        $categorias = new CategoriaModel();

        //Recuperamos todas las categorías
        $listado = $categorias->getAll();

        //Guardamos los datos en un array para luego pasarlos a la vista
        $data['categorias'] = $listado;

        //Utilizamos el método show para mostrarlos
        $this->view->show("listaCategoriaView.php", $data);
    }

    // Método para editar un artículo
    public function editar()
    {
        //Inclimos el modelo categoria
        require 'models/CategoriaModel.php';

        //Creamos una instancia del modelo
        $categorias = new CategoriaModel();

        //recuperamos el id de la categoría
        $categoria = $categorias->getById($_REQUEST['cat_id']);

        //si la categoría no tiene id muestra el error
        if ($categoria == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        }

        $errores = array();

        // Si venimos del formulario de edición 
        if (isset($_REQUEST['submit'])) {
            // Si no se ha puesto el nombre de categoría da un error
            if (!isset($_REQUEST['cat_nombre']) || empty($_REQUEST['cat_nombre']))
                $errores['categoria'] = "* Categoria: Hay que indicar un nombre de categoría";
            if (empty($errores)) {
                // Si no hay errores actualizamos el nombre, guardamos y volvemos a listar
                
                $categoria->setNombreCategoria($_REQUEST['cat_nombre']);
                $categoria->save();
                header("Location: index.php?controlador=categoria&accion=listar");
            }
        } 
        $this->view->show("editarCategoriaView.php", array('categoria' => $categoria, 'errores' => $errores));
    
}

    // Método para crear una nueva categoría
    public function nuevo()
    {
        require 'models/CategoriaModel.php';
        $categoria = new CategoriaModel();
        $errores = array();

        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['cat_nombre']) || empty($_REQUEST['cat_nombre']))
                $errores['categoria'] = "* Categoria: Hay que indicar un nombre de categoria";
            if (empty($errores)) {
                $categoria->setNombreCategoria($_REQUEST['cat_nombre']);
                $categoria->save();
                header("Location: index.php?controlador=categoria&accion=listar");
            }
        }

        $this->view->show("nuevoCategoriaView.php", array('errores' => $errores));
    }

    //Método para borrar una categoría
    public function borrar()
    {
        //Inclimos el modelo categoria
        require_once 'models/CategoriaModel.php';

        //Creamos una instancia del modelo
        $categorias = new CategoriaModel();

        // Recuperamos la categoría con el código recibido por GET o por POST
        $categoria = $categorias->getById($_REQUEST['cat_id']);

        if ($categoria == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        } else {
            // Si existe lo elimina de la base de datos y vuelve a la pantalla de listar
            $categoria->delete();
            header("Location: index.php?controlador=categoria&accion=listar");
        }
    }

}
