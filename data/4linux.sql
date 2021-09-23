CREATE DATABASE if not exists `api4linux`;
ALTER DATABASE `api4linux` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE TABLE if not exists `consultores`(
    `id` int(100) not null auto_increment,
    `nome` varchar(100),
    `email` varchar(100),
    PRIMARY KEY (id)
);
CREATE TABLE if not exists `servicos`(
    `id` int(100) not null auto_increment,
    `descricao` varchar(100),
    PRIMARY KEY (id)
);
CREATE TABLE if not exists `rel_servico_consultor`(`id_servico` int(100), `id_consultor` int(100));
CREATE TABLE if not exists `agendamento`(
    `id` int(100) not null auto_increment,
    `data` date,
    `consultor` int(100),
    `servico` int(100),
    `email_cliente` varchar(100),
    PRIMARY KEY (id)
);
INSERT INTO `consultores`(`nome`, `email`)
VALUES('Aline Santos Ribeiro', 'aline.santos@gmail.com'),
    ('Carolina de Oliveira', 'carol.oliv@gmail.com');
INSERT INTO `servicos`(`descricao`)
VALUES('Desenvolvimento de Landing Page'),
    ('Customização de CSS'),
    ('Instalação de Wordpress'),
    ('Desenvolvimento de Plugin'),
    ('Desenvolvimento de Tema');
INSERT INTO `rel_servico_consultor`(`id_consultor`, `id_servico`)
VALUES(1, 4),
    (1, 5),
    (2, 1);