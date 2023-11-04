use adsi1323395;
drop table inventario;
drop table pedido;
CREATE table inventario(
    codigobarra int PRIMARY key,
    cantidad int,
    fechaentrada date,
    fehcasalida date,
    lote int,
    foto longblob   
);

CREATE table pedido(
    id int auto_increment PRIMARY key,
    nombrearticulo varchar(40),
    cantidadpedido int,
    fechapedido date,
    fechaentrega date,
    foto longblob  
);
