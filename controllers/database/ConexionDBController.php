<?php

namespace App\controllers;

use mysqli;

class ConexionDBController
{
    private $host = 'localhost';
    private $user = 'root';
    private $pwd = '';
    private $db = 'facturacion_tienda_db';
    private $conex;

    function __construct()
    {
        $this->conex = new mysqli(
            $this->host,
            $this->user,
            $this->pwd,
            $this->db
        );
    }

    function execSql($sql)
    {
        if ($this->conex->connect_error) {
            die('Error en la conexión a db');
        }
        return $this->conex->query($sql);
    }

    public function getConnection()
    {
        return $this->conex;
    }

    public function close()
    {
        $this->conex->close();
    }
   
}
