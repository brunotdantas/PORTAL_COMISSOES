# Portal de Comissões automatizadas - Projeto TCC - UMC 2018 #

### Autores: Bruno Dantas e Alexandre Mandri ###

**Proposta do trabalho:**

Desenvolver uma aplicação WEB capaz de calcular as comissões de cada vendedor de acordo com as metas e fatores cadastrados na ferramenta. 

Para que a plataforma performe os cálculos foram criadas estruturas de tabelas para integração de dados de vendedores, lojas e vendas. O cliente poderá carregar estas tabelas através de uma conexão entre bancos de dados. 

Muitas empresas fazem este processo manualmente ou através de planilha, o que pode gerar falhas nos cálculos ou problemas na manipulação de dados. A ferramenta busca eliminar isto e trazer mais segurança na troca de informações importantes da empresa.

Para que a plataforma realize os cálculos foram criadas estruturas de tabelas principais para integração de dados de: vendedores, lojas e vendas.

Após o cadastro de informações a ferramenta deve realizar o cálculo,  armazenar o resultado e permitir a consulta e extração destas informações, que normalmente é feita pelo time de RH que por sua vez faz o lançamento do valor comissionado de cada funcionário em seu sistema específico. 

Estrutura de desenvolvimento: 
- Para a parte visual e comportamental (front-end): Utilizado o framework [ADMIN LTE](https://adminlte.io/) como principal biblioteca CSS e JS, esta utiliza como base o [Bootstrap](https://getbootstrap.com/);
- Como banco de dados foi utilizado o SQL Server
- Para execução de cálculo foi implementada procedures em T-SQL (Transact SQL) no banco
- Para controle de sessão, exibição das informações, comunicação com fontes externas foi usado o PHP para controle Server Side da aplicação 

Os requisitos funcionais entregues neste projeto:

![image](https://user-images.githubusercontent.com/19207320/221709378-60ea15ee-7782-46db-88af-196b07e2b30e.png)

O projeto funcionando foi apresentado e aprovado pela banca no dia 12/12/2018
