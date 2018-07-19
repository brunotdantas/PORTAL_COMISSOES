-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15-Mar-2018 às 23:49
-- Versão do servidor: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal`
--

create database portal;


use portal;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lojas`
--

CREATE TABLE `lojas` (
  `idLojas` int(11) NOT NULL,
  `CNPJ` int(11) DEFAULT NULL,
  `Meta` decimal(10,0) DEFAULT NULL,
  `NomeLoja` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `metas`
--

CREATE TABLE `metas` (
  `idMetas` int(11) NOT NULL,
  `idLojas` int(11) DEFAULT NULL,
  `valorMeta` decimal(10,0) DEFAULT NULL,
  `periodo` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuariotipo`
--

CREATE TABLE `usuariotipo` (
  `idusuarioTipo` int(11) NOT NULL,
  `Descricao` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `usuariotipo`(`idusuarioTipo`, `Descricao`) VALUES (0,'Administrador');
INSERT INTO `usuariotipo`(`idusuarioTipo`, `Descricao`) VALUES (1,'Coordenador');
INSERT INTO `usuariotipo`(`idusuarioTipo`, `Descricao`) VALUES (2,'RH');


-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `IDusuario` int(11) NOT NULL,
  `Nome` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Senha` varchar(45) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `CPF` varchar(11) NOT NULL,
  `AlteraSenha` binary(1) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `usuarios`(`IDusuario`, `Nome`, `Email`, `Senha`, `tipo`, `CPF`, `AlteraSenha`, `usuario`) VALUES (0,'admin','admin@admin.com','admin',0,'08356060400',0,'admin');
INSERT INTO `usuarios`(`IDusuario`, `Nome`, `Email`, `Senha`, `tipo`, `CPF`, `AlteraSenha`, `usuario`) VALUES (1,'coordenador','coordenador@coordenador.com','coordenador',1,'08356060401',0,'coordenador');
INSERT INTO `usuarios`(`IDusuario`, `Nome`, `Email`, `Senha`, `tipo`, `CPF`, `AlteraSenha`, `usuario`) VALUES (2,'rh','rh@rh.com','rh',2,'08356060402',0,'rh');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendascabec`
--

CREATE TABLE `vendascabec` (
  `idVenda` int(11) NOT NULL,
  `numVenda` varchar(55) DEFAULT NULL,
  `idVendedor` int(11) DEFAULT NULL,
  `ValorTotal` varchar(45) DEFAULT NULL,
  `idLojas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendedor`
--

CREATE TABLE `vendedor` (
  `idVendedor` int(11) NOT NULL,
  `Nome` varchar(45) DEFAULT NULL,
  `CPF` int(11) DEFAULT NULL,
  `Cargo` varchar(45) DEFAULT NULL,
  `idLojas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lojas`
--
ALTER TABLE `lojas`
  ADD PRIMARY KEY (`idLojas`);

--
-- Indexes for table `metas`
--
ALTER TABLE `metas`
  ADD PRIMARY KEY (`idMetas`),
  ADD KEY `lojaPertence_idx` (`idLojas`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IDusuario`),
  ADD UNIQUE KEY `CPF_UNIQUE` (`CPF`),
  ADD KEY `tipoUsuario_idx` (`tipo`);

--
-- Indexes for table `usuariotipo`
--
ALTER TABLE `usuariotipo`
  ADD PRIMARY KEY (`idusuarioTipo`);

--
-- Indexes for table `vendascabec`
--
ALTER TABLE `vendascabec`
  ADD PRIMARY KEY (`idVenda`),
  ADD KEY `vendedores_idx` (`idVendedor`),
  ADD KEY `lojaPertence_idx` (`idLojas`);

--
-- Indexes for table `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`idVendedor`),
  ADD KEY `loja_pertence_idx` (`idLojas`);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `tipoUsuario` FOREIGN KEY (`tipo`) REFERENCES `usuariotipo` (`idusuarioTipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `vendascabec`
--
ALTER TABLE `vendascabec`
  ADD CONSTRAINT `lojaPertence` FOREIGN KEY (`idLojas`) REFERENCES `lojas` (`idLojas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `vendedores` FOREIGN KEY (`idVendedor`) REFERENCES `vendedor` (`idVendedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `vendedor`
--
ALTER TABLE `vendedor`
  ADD CONSTRAINT `loja_pertence` FOREIGN KEY (`idLojas`) REFERENCES `lojas` (`idLojas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
