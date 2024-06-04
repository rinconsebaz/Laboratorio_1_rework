<?php
require '../Controllers/FacturaControllers.php';
require '../Controllers/database/ConexionDBController.php';

use App\Controllers\FacturaController;
use App\Controllers\databasee\ConexionDBController;

if (isset($_GET['referencia'])) {
    
    $conexion = new ConexionDBController(); 
    $facturaController = new FacturaController($conexion);
    $referencia = $_GET['referencia'];
    $factura = $facturaController->obtenerFacturaPorReferencia($referencia);
    $detalles = $facturaController->obtenerDetallesFactura($referencia);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de la Factura</title>

</head>
<body>
    <div class="container">
        <h2>~~Detalle de Factura~~</h2>
        <div>
            <?php if(isset($factura)): ?>
                <h3>Num. referencia: 
                    <?php 
                    echo htmlspecialchars($factura['referencia']); 
                    ?></h3>
                <p>Fecha: 
                    <?php 
                    echo htmlspecialchars($factura['fecha']); 
                    ?></p>
                <p>Estado: 
                    <?php 
                    echo htmlspecialchars($factura['estado']); 
                    ?></p>

                <h3>---[Informacion del Cliente]---</h3>

                <p>Nombre: 
                    <?php 
                    echo isset($factura['nombreCompleto']) ? htmlspecialchars($factura['nombreCompleto']) : ''; 
                    ?></p>
                <p>Tipo de Documento: 
                    <?php 
                    echo isset($factura['tipoDocumento']) ? htmlspecialchars($factura['tipoDocumento']) : '';
                    ?></p>
                <p>Num. Documento: 
                    <?php 
                    echo isset($factura['numeroDocumento']) ? htmlspecialchars($factura['numeroDocumento']) : ''; 
                    ?></p>
                <p>Telefono: 
                    <?php 
                    echo isset($factura['telefono']) ? htmlspecialchars($factura['telefono']) : ''; 
                    ?></p>
                <p>Email: 
                    <?php 
                    echo isset($factura['email']) ? htmlspecialchars($factura['email']) : ''; 
                    ?></p>

                <h3>---[Lista de Productos]---</h3>

                <?php if (!empty($detalles)): ?>
                    <table class="detalles-table">
                        <thead>
                            <tr>
                                <th>Nombre del Producto</th>
                                <th>Precio Unitario</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detalles as $detalle): ?>

                                <tr>
                                    <td><?php 
                                    echo isset($detalle['nombreProducto']) ? htmlspecialchars($detalle['nombreProducto']) : ''; 
                                        ?></td>
                                    <td><?php 
                                    echo isset($detalle['precioUnitario']) ? htmlspecialchars($detalle['precioUnitario']) : ''; 
                                        ?></td>
                                    <td><?php 
                                    echo isset($detalle['cantidad']) ? htmlspecialchars($detalle['cantidad']) : ''; 
                                        ?></td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>[**No existe detalles de la factura disponibles**]</p>
                <?php endif; ?>

                <h3>-[Descuento y Total]-</h3>

                <p>-Descuento: 
                    <?php 
                    echo isset($factura['descuento']) ? htmlspecialchars($factura['descuento']) . '%' : '0%'; 
                    ?></p>
                <p>->Total a pagar: 
                    <?php 
                    echo isset($factura['total']) ? htmlspecialchars($factura['total']) : ''; 
                    ?></p>
            <?php else: ?>

                <p>[**Detalle de factura no encontrado**]</p>
                
            <?php endif; ?>
        </div>
        <a href="menu.php" class="boton" >Volver al Menú</a>
        <a href="registroFactura.php" class="boton">Volver al registro de Facturas Previas</a>
    </div>
</body>
</html>
