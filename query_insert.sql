
----------------------------------------------------------------------------------
----------------------------------------- lista de inserts 
----------------------------------------------------------------------------------
INSERT INTO [dbo].[Cargo_Lojas]
(Descricao)
VALUES
('Gerente'),('Vendedor');

INSERT INTO [dbo].fatores (descricaoFator, vlPorcentagem, vlReais, idCargo, ativo, create_time, update_time) VALUES ( 'Valor pago sobre o total de venda da loja', 1.3, NULL, 1, 1, '2018-05-23 13:08:48', NULL)
INSERT INTO [dbo].fatores (descricaoFator, vlPorcentagem, vlReais, idCargo, ativo, create_time, update_time) VALUES ( 'Prêmio por atingir 103% da meta da loja', NULL, 144.5, 1, 1, '2018-05-23 13:08:48', NULL)
INSERT INTO [dbo].fatores (descricaoFator, vlPorcentagem, vlReais, idCargo, ativo, create_time, update_time) VALUES ( 'Prêmio por atingir 107% da meta da loja', NULL, 120	, 1, 1, '2018-05-23 13:08:48', NULL)
INSERT INTO [dbo].fatores (descricaoFator, vlPorcentagem, vlReais, idCargo, ativo, create_time, update_time) VALUES ( 'Prêmio por atingir 110% da meta da loja', NULL, 500	, 1, 0, '2018-05-23 13:08:48', NULL)
INSERT INTO [dbo].fatores (descricaoFator, vlPorcentagem, vlReais, idCargo, ativo, create_time, update_time) VALUES ( 'Valor pago sobre o total de venda do vendedor', 2.9	, 1, 2, 0, '2018-05-23 13:08:48', NULL)

INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (2, 210, 'LJ.CLI-IGUATEMI', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (3, 309, 'LJ.CLI-J.SUL', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (4, 481, 'LJ.MAC-A.FRANCO', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (5, 562, 'LJ.CLI-V.LOBOS', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (6, 643, 'LJ.CLI-R.SUL', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (7, 724, 'ARM.SERRA', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (8, 805, 'LJ.MAC-CAMPINAS', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (9, 996, 'LJ.MAC-PAULISTA', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (10, 1020, 'LJ.CLI-CAMPINAS', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (11, 1100, 'LJ_CLI-MORUMBI', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (12, 1291, 'LJ.CLI-BARRA', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (13, 1372, 'LJ.MAC-HIGIENOP', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (14, 1453, 'LJ.MAC-PQ.BRASI', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (15, 1534, 'LJ.MAC-R.SUL', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (16, 1615, 'LJ.MAC-VITORIA', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (17, 1704, 'LJ.MAC-ALPHAVIL', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (18, 1887, 'LJ.MAC-MKTPLACE', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (19, 1968, 'LJ.MAC-V.LOBOS', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (20, 2000, 'LJ.MAC-S.CAETAN', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (21, 2182, 'LJ.MAC NITEROI', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (22, 2263, 'LJ.MAC-LEBLON', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (23, 2344, 'LJ.MAC VILLAGE', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (24, 2425, 'LJ.MAC-MORUMBI', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (25, 2506, 'LJ.MAC-SAVASSI', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (26, 2697, 'LJ.MAC-JK IGUAT', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (27, 2778, 'LJ.MAC-BARRA', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (28, 2859, 'LJ.MAC RECIFE', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (29, 2930, 'LJ.MAC-BH', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (30, 3073, 'LJ.MAC-FASHION', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (31, 3154, 'LJ.MAC-BOURBON', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (32, 3235, 'LJ.MAC-IGUATEMI', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (34, 3405, 'LJ.CLI-HIGIENOP', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (35, 3588, 'LJ.MAC-CAMP.II', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (36, 3669, 'LJ.MAC-BRASILII', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (37, 3740, 'LJ.MAC-RIBEIRAO', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (38, 3820, 'LJ.MAC-RIBEIRII', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (39, 3901, 'LJ.MAC-FLORIANOPOLIS', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (40, 4045, 'LJ.MAC-GOIANIA', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (41, 4126, 'LJ.MAC-SOROCABA', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (42, 4207, 'LJ.CLI-DIAMOND', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (43, 4398, 'LJ.MAC-FORTALEZA', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (44, 4479, 'LJ.MAC-CAMPO-GRANDE', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (45, 4550, 'LJ.MAC-BELEM', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (46, 4630, 'LJ.CLI-FORTALEZA', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (47, 4711, 'LJ.MAC-UBERLANDIA', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (48, 4800, 'CORPORATE STORE', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (49, 4983, 'LJ.MAC-RIOMAR', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (50, 5017, 'LJ.MAC-SALVADOR', NULL)
INSERT INTO lojas (idLojas, CNPJ, NomeLoja, Apelido_Loja) VALUES (51, 5106, 'LJ.MAC-MANAUS', NULL);

INSERT INTO tipo_usuarios (descricaoTipo, ativo, create_time) VALUES ( 'Administrador', 1, '2018-04-26 18:12:41');
INSERT INTO tipo_usuarios (descricaoTipo, ativo, create_time) VALUES ( 'Coordenador', 1, '2018-04-26 18:12:41');
INSERT INTO tipo_usuarios (descricaoTipo, ativo, create_time) VALUES ( 'RH', 1, '2018-04-26 18:12:41');

INSERT INTO usuarios (Nome, Email, Senha, idTipo, CPF, usuario, SenhaTemporaria, ativo, primeiroAcesso) VALUES
('Bruno Dantas', 'brunodantas01@gmail.com', '123', 1, '08356060400', 'bruno', '', 1, 1);

INSERT INTO vendedores (Nome, CPF, idCargo, idLojas) VALUES
('ELAINE DO NASCIMENTO BASTOS PEREIRA', '09017659700', 2, 12),
('MAYANNE  DOS SANTOS MELLO RODRIGUES', '12413850767', 2, 12),
('BARBARA LANGER GRETER', '33489217837', 2, 13),
('Vanusa Goese', '10794278728', 2, 16),
('ARTUR MAGALHAES  DE FIGUEIREDO', '14185498780', 1, 21),
('ALINE DONADELLI', '34981172893', 1, 24),
('PALOMA MOREIRA MALDONADO', '10410901709', 1, 27),
('VENDEDOR PADRAO', '20317647563', 1, 25),
('NADIA KUROKI', '33423591889', 1, 31),
('DANILO MATTOS DE CAMPOS', '35405505854', 1, 31),
('JAKELLINE OLIVEIRA DE FALCHI', '32562338804', 1, 32),
('ANA PAULA STELA FONSECA', '22484457847', 1, 34),
('FERNANDA POLO KISS', '39750006860', 1, 34),
('BARBARA HELENA AQUINO ROSSI', '73377732187', 1, 34),
('CAMILA MARTINS DUARTE', '26629495896', 1, 24),
('ROBERTA BOTTER', '04442394644', 1, 42),
('LUCIENE BRAGA BERTOLDO', '00066838193', 1, 36),
('NADIA SENOO', '23151891870', 1, 2),
('LIVIA ANCHIETA PINHEIRO BARBOSA LIMA', '38671004899', 1, 2),
('MATEUS JORGE', '33372919882', 1, 13),
('DIEGO RAFAEL CORTE', '07460804924', 1, 32),
('Amanda Isabella Mendes Silva', '10197660690', 1, 24),
( 'ADRIENNE CRISTINA DO AMARAL VASCONCELOS', '88028771220', 1, 45),
( 'ALEXANDRE LAURINDO', '02844108105', 1, 14),
( 'MARIA PATRICIA OLIVEIRA DE ANDRADE', '07212564494', 1, 49),
( 'DAVY BARBOSA DA SILVA SANTOS', '01360312269', 1, 51),
( 'ANA PATRICIA MOURA SILVA						', '00244552533', 1, 43),
( 'BIANCA DAUD MARELLI						', '34713347850', 1, 41),
( 'VIVIANI ALMEIDA MENDONÇA DO VALLE', '09804497743', 1, 27),
( 'ANA PAULA ALVES DE OLIVEIRA', '40122872819', 1, 11),
( 'WANESSA JULLIET CALDAS GONÇALVES', '38152474894', 1, 48),
( 'GRASIELA REGES DE MELO', '02424702543', 1, 50),
( 'VALDENE DA SILVA PEREIRA ROCHA', '07640007640', 1, 16),
( 'CRISTIANE APARECIDA DOS SANTOS KOPT', '00446944904', 1, 11),
( 'LUCIANA DANIELLE', '32085747892', 1, 11),
( 'ALINE PIRES', '32377794823', 1, 5),
( 'DÉBORA DE BESSA SANTOS', '06561297431', 1, 28),
( 'DAYANE CRISTINA DE OLIVEIRA PINTO', '08049242609', 1, 25),
( 'INGLITY THAINA MARQUES RABELO', '03588681140', 1, 36),
( 'MARIANA ISABEL BELTRAN BERROETA', '06394502707', 1, 22);
