create database carves;
use carves;

create table imoveis (
	id_imovel int primary key auto_increment,
    titulo varchar(60) not null,
    cidade varchar(100) not null,
    bairro varchar(100) not null,
    rua varchar(100) not null,
    preco int(8) not null,
    descricao varchar(300) not null,
    nome varchar(90) not null,
    telefone int(11) not null,
    email varchar(60) not null,
    img_main varchar(255) not null
);
    