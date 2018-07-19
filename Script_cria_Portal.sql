
-- MySQL Script generated by MySQL Workbench
-- Thu May 24 14:04:01 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering
SET foreign_key_checks = 'OFF';
-- MySQL Script generated by MySQL Workbench
-- Mon May 28 11:43:35 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

-- -----------------------------------------------------
-- Schema Portal
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `Portal` ;

-- -----------------------------------------------------
-- Schema Portal
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Portal` DEFAULT CHARACTER SET utf8 ;
USE `Portal` ;

-- -----------------------------------------------------
-- Table `Portal`.`tipo_usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Portal`.`tipo_usuarios` (
  `idTipo` INT NOT NULL AUTO_INCREMENT,
  `descricaoTipo` VARCHAR(255) NOT NULL,
  `ativo` INT NOT NULL,
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idTipo`),
  UNIQUE INDEX `descricaoTipo_UNIQUE` (`descricaoTipo` ASC)) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Portal`.`Usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Portal`.`Usuarios` (
  `IDusuario` INT NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(45) NULL,
  `Email` VARCHAR(45) NOT NULL,
  `Senha` VARCHAR(255) NOT NULL,
  `idTipo` INT NOT NULL,
  `CPF` VARCHAR(11) NOT NULL,
  `SenhaTemporaria` VARCHAR(255) NULL,
  `usuario` VARCHAR(45) NOT NULL,
  `ativo` INT NOT NULL,
  `primeiroAcesso` INT NOT NULL,
  PRIMARY KEY (`IDusuario`),
  UNIQUE INDEX `CPF_UNIQUE` (`CPF` ASC),
  UNIQUE INDEX `Email_UNIQUE` (`Email` ASC),
  UNIQUE INDEX `usuario_UNIQUE` (`usuario` ASC),
  CONSTRAINT `Usu_fk_tipos`
    FOREIGN KEY (`idTipo`)
    REFERENCES `Portal`.`tipo_usuarios` (`idTipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Portal`.`Lojas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Portal`.`Lojas` (
  `idLojas` INT NOT NULL,
  `CNPJ` VARCHAR(20) NOT NULL,
  `NomeLoja` VARCHAR(45) NULL,
  `Apelido_Loja` VARCHAR(45) NULL,
  PRIMARY KEY (`idLojas`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Portal`.`Cargo_Lojas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Portal`.`Cargo_Lojas` (
  `idCargo` INT NOT NULL AUTO_INCREMENT,
  `Descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCargo`),
  UNIQUE INDEX `Descricao_UNIQUE` (`Descricao` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Portal`.`vendedores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Portal`.`vendedores` (
  `idVendedor` INT NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(45) NULL,
  `CPF` VARCHAR(11) NULL,
  `idCargo` INT NULL,
  `idLojas` INT NULL,
  `idLINX` VARCHAR(255) NOT NULL DEFAULT 'DEFAULT 0',
  PRIMARY KEY (`idVendedor`),
  CONSTRAINT `VENDEDOR_FK_loja_pertence`
    FOREIGN KEY (`idLojas`)
    REFERENCES `Portal`.`Lojas` (`idLojas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `VENDEDOR_FK_cargo`
    FOREIGN KEY (`idCargo`)
    REFERENCES `Portal`.`Cargo_Lojas` (`idCargo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Portal`.`VendasCabec`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Portal`.`VendasCabec` (
  `idVenda` INT NOT NULL,
  `numVenda` VARCHAR(55) NULL,
  `idVendedor` INT NULL,
  `ValorTotal` VARCHAR(45) NULL,
  `idLojas` INT NULL,
  PRIMARY KEY (`idVenda`),
  CONSTRAINT `VENDA_FK_lojaPertence`
    FOREIGN KEY (`idLojas`)
    REFERENCES `Portal`.`Lojas` (`idLojas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `VENDA_FK_vendedores`
    FOREIGN KEY (`idVendedor`)
    REFERENCES `Portal`.`vendedores` (`idVendedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Portal`.`Metas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Portal`.`Metas` (
  `idMetas` INT NOT NULL AUTO_INCREMENT,
  `idLojas` INT NULL,
  `valorMeta` DECIMAL NULL,
  `periodo` VARCHAR(6) NULL,
  CONSTRAINT C_Metas UNIQUE (idLojas,periodo),
  PRIMARY KEY (`idMetas`),
  CONSTRAINT `lojaPertence`
    FOREIGN KEY (`idLojas`)
    REFERENCES `Portal`.`Lojas` (`idLojas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Portal`.`fatores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Portal`.`fatores` (
  `idFator` INT NOT NULL AUTO_INCREMENT,
  `descricaoFator` VARCHAR(45) NOT NULL,
  `vlPorcentagem` INT NULL,
  `vlReais` DOUBLE NULL,
  `ativo` INT NULL,
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
  `idCargo` INT NULL,
  PRIMARY KEY (`idFator`),
  CONSTRAINT `FATORES_FK_cargo`
    FOREIGN KEY (`idCargo`)
    REFERENCES `Portal`.`Cargo_Lojas` (`idCargo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `Portal`.`param_usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Portal`.`param_usuarios` (
  `IDusuario` INT NOT NULL,
  `ativo` TINYINT NULL,
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE INDEX `IDusuario_UNIQUE` (`IDusuario` ASC),
  PRIMARY KEY (`IDusuario`),
  CONSTRAINT `PARAM_fk_user`
    FOREIGN KEY (`IDusuario`)
    REFERENCES `Portal`.`Usuarios` (`IDusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `Portal`.`lista_acessos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Portal`.`lista_acessos` (
  `id_acesso` INT NOT NULL AUTO_INCREMENT,
  `desc_acesso` VARCHAR(255) NULL,
  `idTipo` INT NULL,
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_acesso`),
  CONSTRAINT `LISTA_fk_tipos`
    FOREIGN KEY (`idTipo`)
    REFERENCES `Portal`.`tipo_usuarios` (`idTipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `Portal`.`Log_erros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Portal`.`Log_erros` (
  `idLog` INT NOT NULL AUTO_INCREMENT,
  `arquivo_php` VARCHAR(45) NULL,
  `Erro_Descricao` VARCHAR(255) NULL,
  `created` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario_executou` VARCHAR(255) NULL,
  PRIMARY KEY (`idLog`))
ENGINE = InnoDB;

SET foreign_key_checks = 'ON';


----------------------------------------------------------------------------------
----------------------------------------- lista de inserts 
----------------------------------------------------------------------------------
INSERT INTO `portal`.`cargo_lojas`
(`Descricao`)
VALUES
('Gerente'),('Vendedor');

INSERT INTO `fatores` (`descricaoFator`, `vlPorcentagem`, `vlReais`, `idCargo`, `ativo`, `create_time`, `update_time`) VALUES
( 'Valor pago sobre o total de venda da loja', 1.3, NULL, 1, 1, '2018-05-23 13:08:48', NULL),
( 'Prêmio por atingir 103% da meta da loja', NULL, 144.5, 1, 1, '2018-05-23 13:08:48', NULL),
( 'Prêmio por atingir 107% da meta da loja', NULL, 120, 1, 1, '2018-05-23 13:08:48', NULL),
( 'Prêmio por atingir 110% da meta da loja', NULL, 500, 1, 0, '2018-05-23 13:08:48', NULL),
( 'Valor pago sobre o total de venda do vendedor', 2.9, NULL, 0, 0, '2018-05-23 13:08:48', NULL);


INSERT INTO `lojas` (`idLojas`, `CNPJ`, `NomeLoja`, `Apelido_Loja`) VALUES
(2, 210, 'LJ.CLI-IGUATEMI', NULL),
(3, 309, 'LJ.CLI-J.SUL', NULL),
(4, 481, 'LJ.MAC-A.FRANCO', NULL),
(5, 562, 'LJ.CLI-V.LOBOS', NULL),
(6, 643, 'LJ.CLI-R.SUL', NULL),
(7, 724, 'ARM.SERRA', NULL),
(8, 805, 'LJ.MAC-CAMPINAS', NULL),
(9, 996, 'LJ.MAC-PAULISTA', NULL),
(10, 1020, 'LJ.CLI-CAMPINAS', NULL),
(11, 1100, 'LJ_CLI-MORUMBI', NULL),
(12, 1291, 'LJ.CLI-BARRA', NULL),
(13, 1372, 'LJ.MAC-HIGIENOP', NULL),
(14, 1453, 'LJ.MAC-PQ.BRASI', NULL),
(15, 1534, 'LJ.MAC-R.SUL', NULL),
(16, 1615, 'LJ.MAC-VITORIA', NULL),
(17, 1704, 'LJ.MAC-ALPHAVIL', NULL),
(18, 1887, 'LJ.MAC-MKTPLACE', NULL),
(19, 1968, 'LJ.MAC-V.LOBOS', NULL),
(20, 2000, 'LJ.MAC-S.CAETAN', NULL),
(21, 2182, 'LJ.MAC NITEROI', NULL),
(22, 2263, 'LJ.MAC-LEBLON', NULL),
(23, 2344, 'LJ.MAC VILLAGE', NULL),
(24, 2425, 'LJ.MAC-MORUMBI', NULL),
(25, 2506, 'LJ.MAC-SAVASSI', NULL),
(26, 2697, 'LJ.MAC-JK IGUAT', NULL),
(27, 2778, 'LJ.MAC-BARRA', NULL),
(28, 2859, 'LJ.MAC RECIFE', NULL),
(29, 2930, 'LJ.MAC-BH', NULL),
(30, 3073, 'LJ.MAC-FASHION', NULL),
(31, 3154, 'LJ.MAC-BOURBON', NULL),
(32, 3235, 'LJ.MAC-IGUATEMI', NULL),
(34, 3405, 'LJ.CLI-HIGIENOP', NULL),
(35, 3588, 'LJ.MAC-CAMP.II', NULL),
(36, 3669, 'LJ.MAC-BRASILII', NULL),
(37, 3740, 'LJ.MAC-RIBEIRAO', NULL),
(38, 3820, 'LJ.MAC-RIBEIRII', NULL),
(39, 3901, 'LJ.MAC-FLORIANOPOLIS', NULL),
(40, 4045, 'LJ.MAC-GOIANIA', NULL),
(41, 4126, 'LJ.MAC-SOROCABA', NULL),
(42, 4207, 'LJ.CLI-DIAMOND', NULL),
(43, 4398, 'LJ.MAC-FORTALEZA', NULL),
(44, 4479, 'LJ.MAC-CAMPO-GRANDE', NULL),
(45, 4550, 'LJ.MAC-BELEM', NULL),
(46, 4630, 'LJ.CLI-FORTALEZA', NULL),
(47, 4711, 'LJ.MAC-UBERLANDIA', NULL),
(48, 4800, 'CORPORATE STORE', NULL),
(49, 4983, 'LJ.MAC-RIOMAR', NULL),
(50, 5017, 'LJ.MAC-SALVADOR', NULL),
(51, 5106, 'LJ.MAC-MANAUS', NULL);


INSERT INTO `tipo_usuarios` (`descricaoTipo`, `ativo`, `create_time`) VALUES ( 'Administrador', 1, '2018-04-26 18:12:41');
INSERT INTO `tipo_usuarios` (`descricaoTipo`, `ativo`, `create_time`) VALUES ( 'Coordenador', 1, '2018-04-26 18:12:41');
INSERT INTO `tipo_usuarios` (`descricaoTipo`, `ativo`, `create_time`) VALUES ( 'RH', 1, '2018-04-26 18:12:41');

INSERT INTO `usuarios` (`Nome`, `Email`, `Senha`, `idTipo`, `CPF`, `usuario`, `SenhaTemporaria`, `ativo`, `primeiroAcesso`) VALUES
('Bruno Dantas', 'brunodantas01@gmail.com', '123', 1, '08356060400', 'bruno', '', 1, 1);

INSERT INTO `vendedores` (`idVendedor`, `Nome`, `CPF`, `idCargo`, `idLojas`) VALUES
(292, 'ELAINE DO NASCIMENTO BASTOS PEREIRA', '09017659700', 2, 12),
(304, 'MAYANNE  DOS SANTOS MELLO RODRIGUES', '12413850767', 2, 12),
(329, 'BARBARA LANGER GRETER', '33489217837', 2, 13),
(360, 'Vanusa Goese', '10794278728', 2, 16),
(436, 'ARTUR MAGALHAES  DE FIGUEIREDO', '14185498780', 1, 21),
(468, 'ALINE DONADELLI', '34981172893', 1, 24),
(534, 'PALOMA MOREIRA MALDONADO', '10410901709', 1, 27),
(563, 'VENDEDOR PADRAO', '20317647563', 1, 25),
(603, 'NADIA KUROKI', '33423591889', 1, 31),
(605, 'DANILO MATTOS DE CAMPOS', '35405505854', 1, 31),
(630, 'JAKELLINE OLIVEIRA DE FALCHI', '32562338804', 1, 32),
(639, 'ANA PAULA STELA FONSECA', '22484457847', 1, 34),
(640, 'FERNANDA POLO KISS', '39750006860', 1, 34),
(641, 'BARBARA HELENA AQUINO ROSSI', '73377732187', 1, 34),
(712, 'CAMILA MARTINS DUARTE', '26629495896', 1, 24),
(749, 'ROBERTA BOTTER', '04442394644', 1, 42),
(809, 'LUCIENE BRAGA BERTOLDO', '00066838193', 1, 36),
(848, 'NADIA SENOO', '23151891870', 1, 2),
(888, 'LIVIA ANCHIETA PINHEIRO BARBOSA LIMA', '38671004899', 1, 2),
(936, 'MATEUS JORGE', '33372919882', 1, 13),
(937, 'DIEGO RAFAEL CORTE', '07460804924', 1, 32),
(997, 'Amanda Isabella Mendes Silva', '10197660690', 1, 24),
(1012, 'ADRIENNE CRISTINA DO AMARAL VASCONCELOS', '88028771220', 1, 45),
(1022, 'ALEXANDRE LAURINDO', '02844108105', 1, 14),
(1035, 'MARIA PATRICIA OLIVEIRA DE ANDRADE', '07212564494', 1, 49),
(1073, 'DAVY BARBOSA DA SILVA SANTOS', '01360312269', 1, 51),
(1179, 'VENDEDOR PADRAO', '20317647563', 1, 16),
(1200, 'ANA PATRICIA MOURA SILVA						', '00244552533', 1, 43),
(1202, 'BIANCA DAUD MARELLI						', '34713347850', 1, 41),
(1311, 'VIVIANI ALMEIDA MENDONÇA DO VALLE', '09804497743', 1, 27),
(1327, 'ANA PAULA ALVES DE OLIVEIRA', '40122872819', 1, 11),
(1393, 'WANESSA JULLIET CALDAS GONÇALVES', '38152474894', 1, 48),
(1407, 'GRASIELA REGES DE MELO', '02424702543', 1, 50),
(1462, 'VALDENE DA SILVA PEREIRA ROCHA', '07640007640', 1, 16),
(1473, 'CRISTIANE APARECIDA DOS SANTOS KOPT', '00446944904', 1, 11),
(1529, 'LUCIANA DANIELLE', '32085747892', 1, 11),
(1565, 'ALINE PIRES', '32377794823', 1, 5),
(1600, 'DÉBORA DE BESSA SANTOS', '06561297431', 1, 28),
(1778, 'DAYANE CRISTINA DE OLIVEIRA PINTO', '08049242609', 1, 25),
(1852, 'INGLITY THAINA MARQUES RABELO', '03588681140', 1, 36),
(1862, 'MARIANA ISABEL BELTRAN BERROETA', '06394502707', 1, 22);
