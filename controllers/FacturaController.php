<?php

namespace App\controllers;

class FacturaController
{
    private $db;

    function __construct()
    {
        $this->db = new ConexionDBController();
    }

    public function crearFactura($idCliente, $productos, $descuento)
    {
        $referencia = uniqid('FACT-'); // Genera una referencia única
        $fecha = date('Y-m-d H:i:s');
        $estado = 'Pagada';

        // Inserta la factura
        $sql = "INSERT INTO facturas (referencia, fecha, idCliente, estado, descuento) VALUES ('$referencia', '$fecha', '$idCliente', '$estado', '$descuento')";
        $this->db->execSql($sql);

        // Inserta los detalles de la factura
        foreach ($productos as $producto) {
            $idArticulo = $producto['idArticulo'];
            $cantidad = $producto['cantidad'];
            $precioUnitario = $producto['precioUnitario'];
            $sql = "INSERT INTO detalleFacturas (cantidad, precioUnitario, idArticulo, referenciaFactura) VALUES ('$cantidad', '$precioUnitario', '$idArticulo', '$referencia')";
            $this->db->execSql($sql);
        }

        return $referencia;
    }

    public function obtenerFactura($referencia)
    {
        // Obtiene la factura
        $sql = "SELECT * FROM facturas WHERE referencia = '$referencia'";
        $factura = $this->db->execSql($sql)->fetch_assoc();

        // Obtiene los detalles de la factura
        $sql = "SELECT * FROM detalleFacturas WHERE referenciaFactura = '$referencia'";
        $result = $this->db->execSql($sql);
        $detalles = [];
        while ($row = $result->fetch_assoc()) {
            $detalles[] = $row;
        }

        // Obtiene la información del cliente
        $idCliente = $factura['idCliente'];
        $sql = "SELECT * FROM clientes WHERE id = '$idCliente'";
        $cliente = $this->db->execSql($sql)->fetch_assoc();

        return [
            'factura' => $factura,
            'detalles' => $detalles,
            'cliente' => $cliente
        ];
    }

    public function actualizarEstadoFactura($referencia, $estado)
    {
        $sql = "UPDATE facturas SET estado = '$estado' WHERE referencia = '$referencia'";
        return $this->db->execSql($sql);
    }

    function __destruct()
    {
        $this->db->close();
    }
}
?>
