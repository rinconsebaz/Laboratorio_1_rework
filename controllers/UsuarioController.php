<?php

namespace App\controllers;

class UsuarioController
{
    private $db;

    function __construct()
    {
        $this->db = new ConexionDBController();
    }

    public function login($usuario, $pwd)
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND pwd = '$pwd'";
        $result = $this->db->execSql($sql);
        if ($result->num_rows > 0) {
            return true;
        }
        return false;
    }

    function __destruct()
    {
        $this->db->close();
    }
}
?>
