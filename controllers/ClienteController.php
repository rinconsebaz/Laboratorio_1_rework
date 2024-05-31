<?php

namespace App\controllers;

class ClienteController
{
    private $db;

    function __construct()
    {
        $this->db = new ConexionDBController();
    }

    public function crearOActualizarCliente($nombre, $tipoDocumento, $numeroDocumento, $telefono, $email)
    {
        // Verifica si el cliente ya existe
        $sql = "SELECT * FROM clientes WHERE numeroDocumento = '$numeroDocumento'";
        $result = $this->db->execSql($sql);

        if ($result->num_rows > 0) {
            // Actualiza el cliente
            $sql = "UPDATE clientes SET nombreCompleto='$nombre', tipoDocumento='$tipoDocumento', telefono='$telefono', email='$email' WHERE numeroDocumento='$numeroDocumento'";
        } else {
            // Crea un nuevo cliente
            $sql = "INSERT INTO clientes (nombreCompleto, tipoDocumento, numeroDocumento, telefono, email) VALUES ('$nombre', '$tipoDocumento', '$numeroDocumento', '$telefono', '$email')";
        }
        return $this->db->execSql($sql);
    }

    function __destruct()
    {
        $this->db->close();
    }
}
?>
