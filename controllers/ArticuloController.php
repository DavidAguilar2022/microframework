<?php
class ArticuloController
{
    protected $view;

    function __construct()
    {
        //Creamos una instancia del mini motor de plantillas
        $this->view = new View();
    }


    public function listar()
    {
        //Inclimos el modelo articulo
        require 'models/ArticuloModel.php';

        //Creamos una instancia del modelo
        $articulos = new ArticuloModel();

        //Recuperamos todos los artículos
        $listado = $articulos->getAll();

        //Guardamos los datos en un array para luego pasarlos a la vista
        $data['articulos'] = $listado;


        //Utilizamos el método show para mostrarlos
        $this->view->show("listaArticuloView.php", $data);
    }

    public function index() //para listar
    {
        //Inclimos el modelo articulo
        require_once 'models/ArticuloModel.php';

        //Creamos una instancia del modelo
        $articulos = new ArticuloModel();

        //Recuperamos todos los artículos
        $listado = $articulos->getAll();

        //Guardamos los datos en un array para luego pasarlos a la vista
        $data['articulos'] = $listado;

        //Utilizamos el método show para mostrarlos
        $this->view->show("listaArticuloView.php", $data);
    }

    // Método para editar un artículo
    public function editar()
    {
        //Incluye el modelo artículo
        require 'models/ArticuloModel.php';

        //Creamos una instancia del modelo
        $articulos = new ArticuloModel();

        // Si venimos del formulario de edición
        if (isset($_REQUEST['submit'])) {
            // Comprobamos si se ha puesto nombre del artículo
            if (!isset($_REQUEST['art_nombre']) || empty($_REQUEST['art_nombre']))
                $errores['articulo'] = "* Articulo: Hay que indicar un nombre de artículo"; //si no se ha puesto aparece el error
            if (empty($errores)) {
                // Si no hay errores actualizamos el nombre, guardamos y volvemos a listar
                $articuloToUpdate = $articulos->getById($_REQUEST['art_id']);
                $articuloToUpdate->setNombreArticulo($_REQUEST['art_nombre']);
                $articuloToUpdate->setNombreCategoria($_REQUEST['art_categoria']);
                $articuloToUpdate->setCantidadArticulo($_REQUEST['art_cantidad']);
                $articuloToUpdate->save();
                header("Location: index.php?controlador=articulo&accion=listar");
            }

        } else {
            // Si hemos pulsado en editar (no en enviar)
            //Recuperamos el id del artículo
            $articuloToEdit = $articulos->getById($_GET['art_id']);

            //Pasamos a la vista toda la información que se desea representar
            $data['articulo'] = $articuloToEdit;

            //Mostramos la pagina en la que podemos editar los artículos
            if ($articuloToEdit != false)
                $this->view->show("editarArticuloView.php", $data);
            else{
                $this->view->show("errorView.php", array("error" => "No existe codigo", "enlace" => "index.php?controlador=categorias&action=listar"));
        }
    } 
}

    // Para crear un nuevo artículo
    public function nuevo()
    {
        require 'models/ArticuloModel.php'; //incluimos el modelo
        $articulo = new ArticuloModel(); //instanciamos un objeto del modelo
        $errores = array();

        if (isset($_REQUEST['submit'])) { //si venimos del formulario
            if (!isset($_REQUEST['art_nombre']) || empty($_REQUEST['art_nombre'])) //si hay errores se muestran los errores
                $errores['articulo'] = "* Artículo: Hay que indicar un nombre de artículo";
            if (empty($errores)) { //si no hay errores asigno los valores introducidos a los campos para crear el artículo nuevo
                $articulo->setNombreArticulo($_REQUEST['art_nombre']);
                $articulo->setNombreCategoria($_REQUEST['art_categoria']);
                $articulo->setCantidadArticulo($_REQUEST['art_cantidad']);
                $articulo->save();
                header("Location: index.php?controlador=articulo&accion=listar");
            }
        }

        $this->view->show("nuevoArticuloView.php", array('errores' => $errores));
    }

    //Método para borrar un artículo
    public function borrar()
    {
        //Incluye el modelo que corresponde
        require_once 'models/ArticuloModel.php';

        //Creamos una instancia de nuestro "modelo"
        $articulos = new ArticuloModel();

        // Recupera el id del artículo
        $articulo = $articulos->getById($_REQUEST['art_id']);

        if ($articulo == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        } else {
            // Si existe lo elimina de la base de datos y volvemos a la página principal
            $articulo->delete();
            header("Location: index.php");
        }
    }

}