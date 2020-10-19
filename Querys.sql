#1. Query numero 1 
#(Mostrar el total de las ventas realizadas totalizadas por cliente, mostrando nombres y
#apellidos del cliente y la clasificación del tipo de cliente.):
SELECT c.idCliente,c.primerNombre,c.primerApellido,t.nombreTipoCliente , (SELECT SUM(f2.valorFactura) FROM factura f2 WHERE f2.idCliente = f.idCliente) "total"  FROM cliente c
LEFT JOIN factura f ON c.idCliente = f.idCliente
LEFT JOIN tipocliente t ON c.tipoCliente = t.idTipoCliente
GROUP BY idCliente;


#2. Query numero 2
#(Mostrar el nombre de los productos que se han vendido por factura, y el número de factura
#al que corresponde.)
SELECT p.nombreProducto,f.numeroFactura FROM detallefactura df
LEFT JOIN factura f ON df.idFactura = f.idFactura
LEFT JOIN producto p ON df.idProducto = p.idProducto
GROUP BY f.numeroFactura;


#4. Query numero 4
#(Mostrar el número de factura y la suma del costo de los productos vendidos por factura.)
SELECT f.numeroFactura, (SELECT SUM(f2.valorFactura) FROM factura f2 WHERE f2.idFactura = f.idFactura) "valor fact"FROM detallefactura df
LEFT JOIN factura f ON df.idFactura = f.idFactura
LEFT JOIN producto p ON df.idProducto = p.idProducto
GROUP BY f.numeroFactura;

