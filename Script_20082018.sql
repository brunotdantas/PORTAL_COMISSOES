USE master IF EXISTS(select * from sys.databases where name='Portal') 
--DROP DATABASE Portal
begin
	ALTER DATABASE Portal SET SINGLE_USER WITH ROLLBACK IMMEDIATE;
	DROP DATABASE Portal ;
end
go

USE [master]
GO
begin try DROP LOGIN php;  end try begin catch end catch
GO
CREATE LOGIN [php] WITH PASSWORD=N'portal', DEFAULT_DATABASE=[master], CHECK_EXPIRATION=OFF, CHECK_POLICY=OFF
GO
EXEC master..sp_addsrvrolemember @loginame = N'php', @rolename = N'sysadmin'
GO


CREATE DATABASE Portal;
go
USE [Portal] ;
go
-- -----------------------------------------------------
-- Table tipo_usuarios
-- -----------------------------------------------------
IF OBJECT_ID('tipo_usuarios', 'U') IS NOT NULL DROP TABLE tipo_usuarios
CREATE TABLE tipo_usuarios (
  idTipo INT NOT NULL IDENTITY(1,1),
  descricaoTipo VARCHAR(255) NOT NULL UNIQUE,
  ativo INT NOT NULL,
  create_time DATETIME NULL DEFAULT GETDATE(),
  PRIMARY KEY (idTipo))
--  UNIQUE INDEX descricaoTipo_UNIQUE (descricaoTipo ASC));


-- -----------------------------------------------------
-- Table Usuarios
-- -----------------------------------------------------
IF OBJECT_ID('Usuarios', 'U') IS NOT NULL DROP TABLE Usuarios
CREATE TABLE  Usuarios (
  IDusuario INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
  Nome VARCHAR(45) NULL,
  Email VARCHAR(45) NOT NULL UNIQUE,
  Senha VARCHAR(255) NOT NULL,
  idTipo INT NOT NULL,
  CPF VARCHAR(11) NOT NULL UNIQUE,
  SenhaTemporaria VARCHAR(255) NULL,
  usuario VARCHAR(45) NOT NULL UNIQUE,
  ativo INT NOT NULL,
  primeiroAcesso INT NOT NULL,
  CONSTRAINT Usu_fk_tipos
    FOREIGN KEY (idTipo)
    REFERENCES tipo_usuarios (idTipo)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)

-- -----------------------------------------------------
-- Table Lojas
-- -----------------------------------------------------
IF OBJECT_ID('Lojas', 'U') IS NOT NULL DROP TABLE Lojas
CREATE TABLE  Lojas (
  idLojas INT NOT NULL,
  CNPJ VARCHAR(20) NOT NULL,
  NomeLoja VARCHAR(45) NULL,
  Apelido_Loja VARCHAR(45) NULL default '',
  PRIMARY KEY (idLojas))

-- -----------------------------------------------------
-- Table Cargo_Lojas
-- -----------------------------------------------------
IF OBJECT_ID('Cargo_Lojas', 'U') IS NOT NULL DROP TABLE Cargo_Lojas
CREATE TABLE  Cargo_Lojas (
  idCargo INT NOT NULL,
  Descricao VARCHAR(45) NOT NULL UNIQUE,
  PRIMARY KEY (idCargo))

-- -----------------------------------------------------
-- Table vendedores
-- -----------------------------------------------------
IF OBJECT_ID('vendedores', 'U') IS NOT NULL DROP TABLE vendedores
CREATE TABLE  vendedores (
  idVendedor INT NOT NULL IDENTITY(1,1),
  Nome VARCHAR(45) NULL,
  CPF VARCHAR(11) NULL UNIQUE,
  idCargo INT NULL,
  idLojas INT NULL,
  idLINX VARCHAR(255) NOT NULL DEFAULT 0,
  PRIMARY KEY (idVendedor),
  CONSTRAINT VENDEDOR_FK_loja_pertence
    FOREIGN KEY (idLojas)
    REFERENCES Lojas (idLojas)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT VENDEDOR_FK_cargo
    FOREIGN KEY (idCargo)
    REFERENCES Cargo_Lojas (idCargo)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)

-- -----------------------------------------------------
-- Table VendasCabec
-- -----------------------------------------------------
IF OBJECT_ID('VendasCabec', 'U') IS NOT NULL DROP TABLE VendasCabec
CREATE TABLE  VendasCabec (
  idVenda INT NOT NULL,
  numVenda VARCHAR(55) NULL,
  idVendedor INT NULL,
  ValorTotal VARCHAR(45) NULL,
  idLojas INT NULL,
  dataVenda datetime,
  PRIMARY KEY (idVenda),
  CONSTRAINT VENDA_FK_lojaPertence
    FOREIGN KEY (idLojas)
    REFERENCES Lojas (idLojas)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT VENDA_FK_vendedores
    FOREIGN KEY (idVendedor)
    REFERENCES vendedores (idVendedor)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)

-- -----------------------------------------------------
-- Table Metas
-- -----------------------------------------------------
IF OBJECT_ID('Metas', 'U') IS NOT NULL DROP TABLE Metas
CREATE TABLE  Metas (
  idMetas INT NOT NULL IDENTITY(1,1),
  idLojas INT NULL,
  valorMeta DECIMAL NULL,
  mes varchar(2) not NULL,
  ano varchar(4) not NULL,
  PRIMARY KEY (idMetas),
  CONSTRAINT lojaPertence
    FOREIGN KEY (idLojas)
    REFERENCES Lojas (idLojas)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)

-- -----------------------------------------------------
-- Table fatores
-- -----------------------------------------------------
IF OBJECT_ID('fatores', 'U') IS NOT NULL DROP TABLE fatores
CREATE TABLE  fatores (
  idFator INT NOT NULL IDENTITY(1,1),
  descricaoFator VARCHAR(45) NOT NULL,
  vlPorcentagem INT NULL,
  vlReais DECIMAL(19, 4) NULL,
  ativo INT NULL,
  create_time DATETIME NULL DEFAULT GETDATE(),
  update_time DATETIME NULL ,
  idCargo int FOREIGN KEY REFERENCES Cargo_Lojas(idCargo)
  )



-- -----------------------------------------------------
-- Table param_usuarios
-- -----------------------------------------------------
IF OBJECT_ID('param_usuarios', 'U') IS NOT NULL DROP TABLE param_usuarios
CREATE TABLE  param_usuarios (
  IDusuario int FOREIGN KEY REFERENCES dbo.Usuarios(IDusuario),
  ativo TINYINT NULL,
  create_time DATETIME NULL DEFAULT GETDATE())
go
-- -----------------------------------------------------
-- Table lista_acessos
-- -----------------------------------------------------
IF OBJECT_ID('lista_acessos', 'U') IS NOT NULL DROP TABLE lista_acessos
CREATE TABLE  lista_acessos (
  id_acesso INT NOT NULL IDENTITY(1,1) primary key,
  desc_acesso VARCHAR(255) NULL,
  idTipo int FOREIGN KEY REFERENCES tipo_usuarios (idTipo),
  create_time DATETIME NULL DEFAULT GETDATE(),
  update_time DATETIME NULL )
go 

-- -----------------------------------------------------
-- Table Log_erros
-- -----------------------------------------------------
IF OBJECT_ID('Log_erros', 'U') IS NOT NULL DROP TABLE Log_erros
CREATE TABLE  Log_erros (
  idLog INT NOT NULL IDENTITY(1,1) primary key,
  arquivo_php VARCHAR(45) NULL,
  Erro_Descricao VARCHAR(255) NULL,
  created DATETIME NULL DEFAULT GETDATE(),
  modified DATETIME NULL ,
  usuario_executou VARCHAR(255) NULL)
go 



------------------------------
-- TRIGGERS 
------------------------------
-- trigger atualização 
IF EXISTS (SELECT * FROM sys.triggers WHERE object_id = OBJECT_ID(N'[dbo].[trgAfterUpdate_Log_erros]'))
DROP TRIGGER [dbo].[trgAfterUpdate_Log_erros]
go

CREATE TRIGGER dbo.trgAfterUpdate_Log_erros ON dbo.Log_erros
AFTER INSERT, UPDATE 
AS
  UPDATE dbo.Log_erros set modified=GETDATE() 
  FROM 
  dbo.Log_erros AS f 
  INNER JOIN inserted 
  AS i 
  ON f.idLog = i.idLog;
go


IF EXISTS (SELECT * FROM sys.triggers WHERE object_id = OBJECT_ID(N'[dbo].[trgAfterUpdate_fatores]'))
DROP TRIGGER [dbo].[trgAfterUpdate_fatores]
go
-- trigger atualização 
CREATE TRIGGER dbo.trgAfterUpdate_fatores ON dbo.fatores
AFTER INSERT, UPDATE 
AS
  UPDATE dbo.fatores set update_time=GETDATE() 
  FROM 
  dbo.fatores AS f 
  INNER JOIN inserted 
  AS i 
  ON f.idFator = i.idFator;

-- trigger atualização 
IF EXISTS (SELECT * FROM sys.triggers WHERE object_id = OBJECT_ID(N'[dbo].[trgAfterUpdate_lista_acessos]'))
DROP TRIGGER [dbo].[trgAfterUpdate_lista_acessos]
go

CREATE TRIGGER dbo.trgAfterUpdate_lista_acessos ON dbo.lista_acessos
AFTER INSERT, UPDATE 
AS
  UPDATE dbo.lista_acessos set update_time=GETDATE() 
  FROM 
  dbo.lista_acessos AS f 
  INNER JOIN inserted 
  AS i 
  ON f.id_acesso = i.id_acesso;
go
