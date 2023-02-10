<?php
class CategoriaModel
{
    protected $db;

    private $cat_id;
    private $cat_nombre;

    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }


    //Getters y setters

    public function getCategoriaId()
    {
        return $this->cat_id;
    }

    public function getCategoriaNombre()
    {
        return $this->cat_nombre;
    }

    public function setNombreCategoria($nombre) {
        $this->cat_nombre = $nombre;
    }


    public function getById($codigo)
    {
        $consulta = $this->db->prepare('SELECT * FROM CATEGORIAS where cat_id = ?');
        $consulta->bindParam(1, $codigo);
        $consulta->execute();

        $consulta->setFetchMode(PDO::FETCH_CLASS, "CategoriaModel");
        $resultado = $consulta->fetch();


        return $resultado;
    }

    public function getAll()
    {
        $consulta = $this->db->prepare('SELECT * FROM CATEGORIAS');
        $consulta->execute();

        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "CategoriaModel");
        return $resultado;
    }



 // Método para añadir un nuevo equipo o actualizar el nombre de uno existente
 public function save()
 {
    if (!isset($this->cat_id)) {
        $consulta = $this->db->prepare('INSERT INTO CATEGORIAS (cat_nombre) values (?)');
        $consulta->bindParam(1, $this->cat_nombre);
        $consulta->execute();
} else {
    $consulta = $this->db->prepare('UPDATE CATEGORIAS SET cat_nombre = ? WHERE cat_id =  ?');
    $consulta->bindParam(1, $this->cat_nombre);
    $consulta->bindParam(2, $this->cat_id);
    $consulta->execute();
     }
 }

//Método para borrar una categoría pero sólo si no tiene artículos asociados
 public function delete()
 {  
    //query para averiguar si hay artículos en la categoría
    $consulta = $this->db->prepare('SELECT * FROM ARTICULOS WHERE art_categoria = ?');
    $consulta->bindParam(1, $this->cat_id);
    $consulta->execute();
    $num_articulos = $consulta->rowCount(); //guardo el número de filas afectadas
    
    if($num_articulos == 0){ //si no hay filas, es decir que si no hay artículos entonces se borra la categoría
        $consulta = $this->db->prepare('DELETE FROM  CATEGORIAS WHERE cat_id =  ?');
                $consulta->bindParam(1, $this->cat_id);
                $consulta->execute();
    }
    
 }

}
