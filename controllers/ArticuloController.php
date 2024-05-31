<?php

namespace App\controllers;

class ArticuloController
{
    private $db;

    function __construct()
    {
        $this->db = new ConexionDBController();
    }

    public function obtenerArticulos()
    {
        $sql = "SELECT * FROM articulos";
        $result = $this->db->execSql($sql);
        $articulos = [];
        while ($row = $result->fetch_assoc()) {
            $articulos[] = $row;
        }
        return $articulos;
    }

    function __destruct()
    {
        $this->db->close();
    }
}
?>
