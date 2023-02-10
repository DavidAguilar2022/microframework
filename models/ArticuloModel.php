<?php
class ArticuloModel
{
    protected $db;

    private $art_id;
    private $art_nombre;
    private $art_categoria;
    private $art_cantidad;


    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }

    //Métodos getters y setters

    public function getArticuloId()
    {
        return $this->art_id;
    }

    public function getNombreArticulo()
    {
        return $this->art_nombre;
    }

    public function setNombreArticulo($nombre)
    {
        $this->art_nombre = $nombre;
    }

    public function getNombreCategoria()
    {
        return $this->art_categoria;
    }

    public function setNombreCategoria($nombre)
    {
        $this->art_categoria = $nombre;
    }

    public function getCantidadArticulo()
    {
        return $this->art_cantidad;
    }

    public function setCantidadArticulo($cantidad)
    {
        $this->art_cantidad = $cantidad;
    }



    //Método para recuperar los datos de un artículo indicando el id del artículo
    public function getById($codigo)
    {
        //realizamos la consulta de todos los items en la que el id es el que indicamos como parámetro
        $consulta = $this->db->prepare('SELECT * FROM ARTICULOS where art_id = ?');
        $consulta->bindParam(1, $codigo);
        $consulta->execute();

        $consulta->setFetchMode(PDO::FETCH_CLASS, "ArticuloModel");
        $resultado = $consulta->fetch();


        return $resultado;
    }

    public function getAll() //Método para recuperar todos los artículos
    {
        $consulta = $this->db->prepare('SELECT * FROM ARTICULOS');
        $consulta->execute();

        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "ArticuloModel");
        return $resultado;
    }



    // Método para añadir un nuevo artículo o para actualizar un artículo existente
    public function save()
    {
        if (!isset($this->art_id)) {
            $consulta = $this->db->prepare('INSERT INTO ARTICULOS ( art_nombre,art_categoria,art_cantidad ) values ( ?,?,? )');
            $consulta->bindParam(1, $this->art_nombre);
            $consulta->bindParam(2, $this->art_categoria);
            $consulta->bindParam(3, $this->art_cantidad);
            $consulta->execute();
        } else {
            $consulta = $this->db->prepare('UPDATE ARTICULOS SET art_nombre = ? , art_categoria = ?, art_cantidad = ? WHERE art_id =  ?');
            $consulta->bindParam(1, $this->art_nombre);
            $consulta->bindParam(2, $this->art_categoria);
            $consulta->bindParam(3, $this->art_cantidad);
            $consulta->bindParam(4, $this->art_id);
            $consulta->execute();
        }
    }

    //Método para borrar
    public function delete()
    {
        $consulta = $this->db->prepare('DELETE FROM ARTICULOS WHERE art_id =  ?');
        $consulta->bindParam(1, $this->art_id);
        $consulta->execute();
    }
}
