-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Abr-2018 às 12:01
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `fatores`
--

CREATE TABLE `fatores` (
  `idFator` int(11) NOT NULL,
  `ativo` int(1) DEFAULT '0',
  `descricaoFator` varchar(255) DEFAULT NULL,
  `vlPorcentagem` double DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `seAplicaA` varchar(55) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fatores`
--

INSERT INTO `fatores` (`idFator`, `ativo`, `descricaoFator`, `vlPorcentagem`, `valor`, `seAplicaA`) VALUES
(1, 1, 'Valor pago sobre o total de venda da loja', 15, NULL, 'GERENTE'),
(2, 0, 'Prêmio por atingir 103% da meta da loja', NULL, 300, 'GERENTE'),
(3, 0, 'Prêmio por atingir 107% da meta da loja', NULL, 120, 'GERENTE'),
(4, 0, 'Prêmio por atingir 110% da meta da loja', NULL, 500, 'GERENTE'),
(5, 0, 'Valor pago sobre o total de venda do vendedor', 2.5, NULL, 'VENDEDOR');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lojas`
--

CREATE TABLE `lojas` (
  `idLojas` int(11) NOT NULL,
  `CNPJ` varchar(14) DEFAULT NULL,
  `NomeLoja` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `lojas`
--

INSERT INTO `lojas` (`idLojas`, `CNPJ`, `NomeLoja`) VALUES
(2, '00000000000210', 'LJ.CLI-IGUATEMI'),
(3, '00000000000309', 'LJ.CLI-J.SUL'),
(4, '00000000000481', 'LJ.MAC-A.FRANCO'),
(5, '00000000000562', 'LJ.CLI-V.LOBOS'),
(6, '00000000000643', 'LJ.CLI-R.SUL'),
(7, '00000000000724', 'ARM.SERRA'),
(8, '00000000000805', 'LJ.MAC-CAMPINAS'),
(9, '00000000000996', 'LJ.MAC-PAULISTA'),
(10, '00000000001020', 'LJ.CLI-CAMPINAS'),
(11, '00000000001100', 'LJ_CLI-MORUMBI'),
(12, '00000000001291', 'LJ.CLI-BARRA'),
(13, '00000000001372', 'LJ.MAC-HIGIENOP'),
(14, '00000000001453', 'LJ.MAC-PQ.BRASI'),
(15, '00000000001534', 'LJ.MAC-R.SUL'),
(16, '00000000001615', 'LJ.MAC-VITORIA'),
(17, '00000000001704', 'LJ.MAC-ALPHAVIL'),
(18, '00000000001887', 'LJ.MAC-MKTPLACE'),
(19, '00000000001968', 'LJ.MAC-V.LOBOS'),
(20, '00000000002000', 'LJ.MAC-S.CAETAN'),
(21, '00000000002182', 'LJ.MAC NITEROI'),
(22, '00000000002263', 'LJ.MAC-LEBLON'),
(23, '00000000002344', 'LJ.MAC VILLAGE'),
(24, '00000000002425', 'LJ.MAC-MORUMBI'),
(25, '00000000002506', 'LJ.MAC-SAVASSI'),
(26, '00000000002697', 'LJ.MAC-JK IGUAT'),
(27, '00000000002778', 'LJ.MAC-BARRA'),
(28, '00000000002859', 'LJ.MAC RECIFE'),
(29, '00000000002930', 'LJ.MAC-BH'),
(30, '00000000003073', 'LJ.MAC-FASHION'),
(31, '00000000003154', 'LJ.MAC-BOURBON'),
(32, '00000000003235', 'LJ.MAC-IGUATEMI'),
(34, '00000000003405', 'LJ.CLI-HIGIENOP'),
(35, '00000000003588', 'LJ.MAC-CAMP.II'),
(36, '00000000003669', 'LJ.MAC-BRASILII'),
(37, '00000000003740', 'LJ.MAC-RIBEIRAO'),
(38, '00000000003820', 'LJ.MAC-RIBEIRII'),
(39, '00000000003901', 'LJ.MAC-FLORIANOPOLIS'),
(40, '00000000004045', 'LJ.MAC-GOIANIA'),
(41, '00000000004126', 'LJ.MAC-SOROCABA'),
(42, '00000000004207', 'LJ.CLI-DIAMOND'),
(43, '00000000004398', 'LJ.MAC-FORTALEZA'),
(44, '00000000004479', 'LJ.MAC-CAMPO-GRANDE'),
(45, '00000000004550', 'LJ.MAC-BELEM'),
(46, '00000000004630', 'LJ.CLI-FORTALEZA'),
(47, '00000000004711', 'LJ.MAC-UBERLANDIA'),
(48, '00000000004800', 'CORPORATE STORE'),
(49, '00000000004983', 'LJ.MAC-RIOMAR'),
(50, '00000000005017', 'LJ.MAC-SALVADOR'),
(51, '00000000005106', 'LJ.MAC-MANAUS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `metas`
--

CREATE TABLE `metas` (
  `idMetas` int(11) NOT NULL,
  `idLojas` int(11) NOT NULL,
  `periodo` varchar(6) NOT NULL,
  `valorMeta` decimal(10,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `metas`
--

INSERT INTO `metas` (`idMetas`, `idLojas`, `periodo`, `valorMeta`) VALUES
(48, 2, '012018', '123444');

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

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`IDusuario`, `Nome`, `Email`, `Senha`, `tipo`, `CPF`, `AlteraSenha`, `usuario`) VALUES
(8, 'Bruno Dantas', 'brunodantas01@gmail.com', '123456', 0, '08356060400', 0x31, 'bruno'),
(9, 'Alexandre', 'alexandre@gmail.com', '123456', 1, '27861275809', 0x31, 'alexandre');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios_tipo`
--

CREATE TABLE `usuarios_tipo` (
  `idusuarioTipo` int(11) NOT NULL,
  `Descricao` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios_tipo`
--

INSERT INTO `usuarios_tipo` (`idusuarioTipo`, `Descricao`) VALUES
(0, 'Administrador'),
(1, 'Coordenador'),
(2, 'RH');

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
-- Estrutura da tabela `vendedores`
--

CREATE TABLE `vendedores` (
  `idVendedor` int(11) NOT NULL,
  `Nome` varchar(45) DEFAULT NULL,
  `CPF` varchar(11) DEFAULT NULL,
  `Cargo` varchar(45) DEFAULT NULL,
  `idLojas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `vendedores`
--

INSERT INTO `vendedores` (`idVendedor`, `Nome`, `CPF`, `Cargo`, `idLojas`) VALUES
(282, 'SCHERON GISELE PAESSENS MARINO', '07998921900', 'GERENTE', 11),
(292, 'ELAINE DO NASCIMENTO BASTOS PEREIRA', '09017659700', 'GERENTE', 12),
(304, 'MAYANNE  DOS SANTOS MELLO RODRIGUES', '12413850767', 'GERENTE', 12),
(329, 'BARBARA LANGER GRETER', '33489217837', 'GERENTE', 13),
(360, 'Vanusa Goese', '10794278728', 'GERENTE', 16),
(436, 'ARTUR MAGALHAES  DE FIGUEIREDO', '14185498780', 'GERENTE', 21),
(468, 'ALINE DONADELLI', '34981172893', 'GERENTE', 24),
(534, 'PALOMA MOREIRA MALDONADO', '10410901709', 'GERENTE', 27),
(563, 'VENDEDOR PADRAO', '20317647563', 'GERENTE', 25),
(603, 'NADIA KUROKI', '33423591889', 'GERENTE', 31),
(605, 'DANILO MATTOS DE CAMPOS', '35405505854', 'GERENTE', 31),
(630, 'JAKELLINE OLIVEIRA DE FALCHI', '32562338804', 'GERENTE', 32),
(639, 'ANA PAULA STELA FONSECA', '22484457847', 'GERENTE', 34),
(640, 'FERNANDA POLO KISS', '39750006860', 'GERENTE', 34),
(641, 'BARBARA HELENA AQUINO ROSSI', '73377732187', 'GERENTE', 34),
(712, 'CAMILA MARTINS DUARTE', '26629495896', 'GERENTE', 24),
(749, 'ROBERTA BOTTER', '04442394644', 'GERENTE', 42),
(809, 'LUCIENE BRAGA BERTOLDO', '00066838193', 'VENDEDOR', 36),
(848, 'NADIA SENOO', '23151891870', 'GERENTE', 2),
(888, 'LIVIA ANCHIETA PINHEIRO BARBOSA LIMA', '38671004899', 'GERENTE', 2),
(936, 'MATEUS JORGE', '33372919882', 'GERENTE', 13),
(937, 'DIEGO RAFAEL CORTE', '07460804924', 'GERENTE', 32),
(997, 'Amanda Isabella Mendes Silva', '10197660690', 'GERENTE', 24),
(1012, 'ADRIENNE CRISTINA DO AMARAL VASCONCELOS', '88028771220', 'GERENTE', 45),
(1022, 'ALEXANDRE LAURINDO', '02844108105', 'GERENTE', 14),
(1035, 'MARIA PATRICIA OLIVEIRA DE ANDRADE', '07212564494', 'GERENTE', 49),
(1073, 'DAVY BARBOSA DA SILVA SANTOS', '01360312269', 'GERENTE', 51),
(1179, 'VENDEDOR PADRAO', '20317647563', 'GERENTE', 16),
(1200, 'ANA PATRICIA MOURA SILVA						', '00244552533', 'GERENTE', 43),
(1202, 'BIANCA DAUD MARELLI						', '34713347850', 'GERENTE', 41),
(1311, 'VIVIANI ALMEIDA MENDONÇA DO VALLE', '09804497743', 'GERENTE', 27),
(1327, 'ANA PAULA ALVES DE OLIVEIRA', '40122872819', 'GERENTE', 11),
(1393, 'WANESSA JULLIET CALDAS GONÇALVES', '38152474894', 'GERENTE', 48),
(1407, 'GRASIELA REGES DE MELO', '02424702543', 'GERENTE', 50),
(1462, 'VALDENE DA SILVA PEREIRA ROCHA', '07640007640', 'GERENTE', 16),
(1473, 'CRISTIANE APARECIDA DOS SANTOS KOPT', '00446944904', 'VENDEDOR', 11),
(1529, 'LUCIANA DANIELLE', '32085747892', 'GERENTE', 11),
(1565, 'ALINE PIRES', '32377794823', 'VENDEDOR', 5),
(1600, 'DÉBORA DE BESSA SANTOS', '06561297431', 'GERENTE', 28),
(1778, 'DAYANE CRISTINA DE OLIVEIRA PINTO', '08049242609', 'GERENTE', 25),
(1852, 'INGLITY THAINA MARQUES RABELO', '03588681140', 'GERENTE', 36),
(1862, 'MARIANA ISABEL BELTRAN BERROETA', '06394502707', 'GERENTE', 22);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fatores`
--
ALTER TABLE `fatores`
  ADD PRIMARY KEY (`idFator`);

--
-- Indexes for table `lojas`
--
ALTER TABLE `lojas`
  ADD PRIMARY KEY (`idLojas`);

--
-- Indexes for table `metas`
--
ALTER TABLE `metas`
  ADD PRIMARY KEY (`idLojas`,`periodo`),
  ADD UNIQUE KEY `idMetas` (`idMetas`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IDusuario`),
  ADD UNIQUE KEY `CPF_UNIQUE` (`CPF`),
  ADD KEY `tipoUsuario_idx` (`tipo`);

--
-- Indexes for table `usuarios_tipo`
--
ALTER TABLE `usuarios_tipo`
  ADD PRIMARY KEY (`idusuarioTipo`);

--
-- Indexes for table `vendascabec`
--
ALTER TABLE `vendascabec`
  ADD PRIMARY KEY (`idVenda`),
  ADD KEY `vendedores_idx` (`idVendedor`),
  ADD KEY `lojaPertence_idx` (`idLojas`);

--
-- Indexes for table `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`idVendedor`),
  ADD KEY `loja_pertence_idx` (`idLojas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fatores`
--
ALTER TABLE `fatores`
  MODIFY `idFator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `metas`
--
ALTER TABLE `metas`
  MODIFY `idMetas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IDusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `tipoUsuario` FOREIGN KEY (`tipo`) REFERENCES `usuarios_tipo` (`idusuarioTipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `vendascabec`
--
ALTER TABLE `vendascabec`
  ADD CONSTRAINT `lojaPertence` FOREIGN KEY (`idLojas`) REFERENCES `lojas` (`idLojas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `vendedores` FOREIGN KEY (`idVendedor`) REFERENCES `vendedores` (`idVendedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `vendedores`
--
ALTER TABLE `vendedores`
  ADD CONSTRAINT `loja_pertence` FOREIGN KEY (`idLojas`) REFERENCES `lojas` (`idLojas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
