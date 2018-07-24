use Portal
----------------------------------------------------------------------------------
----------------------------------------- lista de inserts 
----------------------------------------------------------------------------------
INSERT INTO [dbo].[Cargo_Lojas]
(idCargo, Descricao)
VALUES
(1,'Vendedor'),(2,'Gerente');

INSERT INTO [dbo].fatores (descricaoFator, vlPorcentagem, vlReais, idCargo, ativo) VALUES ( 'Valor pago sobre o total de venda da loja', 1.3, NULL, 1, 1		)
INSERT INTO [dbo].fatores (descricaoFator, vlPorcentagem, vlReais, idCargo, ativo) VALUES ( 'Prêmio por atingir 103% da meta da loja', NULL, 144.5, 1, 1		)
INSERT INTO [dbo].fatores (descricaoFator, vlPorcentagem, vlReais, idCargo, ativo) VALUES ( 'Prêmio por atingir 107% da meta da loja', NULL, 120	, 1, 1		)
INSERT INTO [dbo].fatores (descricaoFator, vlPorcentagem, vlReais, idCargo, ativo) VALUES ( 'Prêmio por atingir 110% da meta da loja', NULL, 500	, 1, 0		)
INSERT INTO [dbo].fatores (descricaoFator, vlPorcentagem, vlReais, idCargo, ativo) VALUES ( 'Valor pago sobre o total de venda do vendedor', 2.9	, 1, 2, 0	)

INSERT INTO lojas (idLojas, CNPJ, NomeLoja) VALUES (1,'52543842000193','LOJA_A')
INSERT INTO lojas (idLojas, CNPJ, NomeLoja) VALUES (2,'28682238000163','LOJA_B')
INSERT INTO lojas (idLojas, CNPJ, NomeLoja) VALUES (3,'71525848000182','LOJA_C')
INSERT INTO lojas (idLojas, CNPJ, NomeLoja) VALUES (4,'11945243000119','LOJA_D')
INSERT INTO lojas (idLojas, CNPJ, NomeLoja) VALUES (5,'66927947000150','LOJA_E')
INSERT INTO lojas (idLojas, CNPJ, NomeLoja) VALUES (6,'77428857000131','LOJA_F')
INSERT INTO lojas (idLojas, CNPJ, NomeLoja) VALUES (7,'91124270000160','LOJA_G')
INSERT INTO lojas (idLojas, CNPJ, NomeLoja) VALUES (8,'62924437000179','LOJA_H')
INSERT INTO lojas (idLojas, CNPJ, NomeLoja) VALUES (9,'47510472000158','LOJA_I')
INSERT INTO lojas (idLojas, CNPJ, NomeLoja) VALUES (10,'01035543000107','LOJA_J')

INSERT INTO tipo_usuarios (descricaoTipo, ativo) VALUES ( 'Administrador', 1);
INSERT INTO tipo_usuarios (descricaoTipo, ativo) VALUES ( 'Coordenador', 1	);
INSERT INTO tipo_usuarios (descricaoTipo, ativo) VALUES ( 'RH', 1			);

INSERT INTO usuarios (Nome, Email, Senha, idTipo, CPF, usuario, SenhaTemporaria, ativo, primeiroAcesso) VALUES
('Bruno Dantas', 'brunodantas01@gmail.com', '123', 1, '08356060400', 'bruno', '', 1, 1);

INSERT INTO vendedores (Nome, CPF, idCargo, idLojas) VALUES
('ALEXANDRA FERREIRA DA SILVA','30727280899',1,1),
('ALINE FELIX DA SILVA SANTOS','36397581888',1,1),
('ALINE FERREIRA DOS SANTOS','33197258827',2,1),
('CIDILAINE DA SILVA','38344633885',1,2),
('CRISTIANE BARBOSA','29513624803',1,2),
('DAIANA ALBINO BARBOSA','21918047804',2,2),
('DANIELLE ALVES DE SOUZA PORTO','31449324851',1,3),
('DEBORA RIBEIRO SANTOS','40196159857',1,3),
('DENISE VIEIRA DE ALCANTARA','36737468802',2,3),
('ELIVELTON DOS SANTOS PIRES','39859064830',1,4),
('FRANCISCO MARTINS RODRIGUES FILHO','34139601809',1,4),
('GABRIELE SABINO ISABEL','36530701800',2,4),
('GESSICA DABILA DE MELLO DA SILVA','41234493870',1,5),
('GRAZIELE DO NASCIMENTO GONCALVES DIAS','40741077833',1,5),
('IARA JESUS DE ANDRADE','39947067858',2,5),
('IZABELA DA SILVA GUEDES','40988786826',1,6),
('JAQUELINE SANTOS DO NASCIMENTO','38613219802',1,6),
('JOSILENE DA CONCEICAO DOS SANTOS','23347027817',2,6),
('JULIANA MARQUES DA SILVA','38332080827',1,7),
('KAREN CRISTINE DE OLIVEIRA PEDROSA','39212375804',1,7),
('KATIA PEREIRA DA SILVA','32084999812',2,7),
('KELLY ANNE VICENTE DE LIMA','37756763840',1,8),
('KESIA IDAYANE DE MENEZES','07840562426',1,8),
('KIMAYR RODRIGUES DOS SANTOS','40302259856',2,8),
('MARCELO GONCALVES DEBASTIANI','34678898832',1,9),
('MARIANA DAHER DE CASTRO','39425050880',1,9),
('NATHALYA PEREIRA DA SILVA','37023808841',2,9),
('NELI CRISTINA DE ASSIS','31654083860',1,10),
('PAMELA TADEU SANTANA DO CARMO','42157300821',1,10),
('RENATA ROCHA LEAL','39762934822',2,10);
