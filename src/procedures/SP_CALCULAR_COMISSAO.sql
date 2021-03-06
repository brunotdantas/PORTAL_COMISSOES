USE [Portal]
GO
/****** Object:  StoredProcedure [dbo].[SP_CALCULAR_COMISSAO]    Script Date: 15/11/2018 15:09:45 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET NOCOUNT ON 
GO

-- =======================================================================                    
-- Author:  Bruno Dantas
-- Create date: 14/11/2018                  
-- Description: PROCEDURE QUE FAZ O CÁLCULO DAS COMISSÕES A PAGAR
-- Obs:       
-- =======================================================================
alter PROCEDURE [dbo].[SP_CALCULAR_COMISSOES](
	@periodoDE varchar(6),	-- YYYYMM
	@periodoATE varchar(6) = @periodoDE,	-- YYYYMM
	@status int OUTPUT
)                 
AS              
BEGIN                

	declare @valorApagar table 
	( 
      [idVendedor] int
      ,[valor_a_pagar] money
      ,[periodoDE] varchar(6)	
      ,[periodoATE] varchar(6)	
	) 

	declare @totalVendido money

	-- SELECIONA VENDAS DO PERÍODO PARA CÁLCULO 
	BEGIN TRY DROP TABLE #TAB_VENDAS_PERIODO END TRY BEGIN CATCH END CATCH 
	SELECT * INTO #TAB_VENDAS_PERIODO FROM  VendasCabec WITH (NOLOCK)
	WHERE FORMAT(dataVenda ,'yyyyMM') BETWEEN @periodoDE and @periodoATE

	if @@ROWCOUNT = 0 
	BEGIN
		PRINT 'NÃO EXISTEM VENDAS NO PERÍODO INFORMADO'
		RETURN 
	END

	-- IDENTIFICA SE EXISTEM METAS NO PERIODO METAS 
	BEGIN TRY DROP TABLE #METAS  END TRY BEGIN CATCH END CATCH 
	select * INTO #METAS from Metas where ano+mes between @periodoDE and @periodoATE
	if @@ROWCOUNT = 0 
	BEGIN
		PRINT 'NÃO EXISTEM METAS NO PERÍODO INFORMADO'
		RETURN 
	END

-------------------------------------------
	--------------- INICIO DO CALCULO 
-------------------------------------------
	DECLARE @idLoja int
	DECLARE cursor_lojas CURSOR FOR 
	SELECT distinct idLojas 
	FROM #TAB_VENDAS_PERIODO

	OPEN cursor_lojas  
	FETCH NEXT FROM cursor_lojas INTO @idLoja  

	WHILE @@FETCH_STATUS = 0  
	BEGIN  
		  -- Looping de lojas 
	
			-- Vendas da loja 
			BEGIN TRY DROP TABLE #vendasLoja  END TRY BEGIN CATCH END CATCH 
			select * into #vendasLoja from vendasCabec where idLojas = @idLoja

		-- Seleciona vendedores da loja corrente do looping
			BEGIN TRY DROP TABLE #vendedores  END TRY BEGIN CATCH END CATCH 
			select * into #vendedores from vendedores where idLojas = @idLoja

			-- Looping de vendedores desta loja 
			while exists(select 1 from #vendedores)
			begin 
				--select top 1 Nome from #vendedores
				-- monta temporária com todos os fatores que se aplicam a este vendedor 
				BEGIN TRY DROP TABLE #fatores  END TRY BEGIN CATCH END CATCH; select * into #fatores from fatores where idcargo = (select top 1 idcargo from #vendedores)

				-- Looping dos fatores encontrados 
				while exists (select 1 from #fatores)
				begin
					-- Soma venda baseado no parâmetro de cálculo 
					if (select top 1 calcula_em_cima_do_total from #fatores  where idcargo = (select top 1 idcargo from #vendedores))=0
						begin 
							--declare @totalVendido money

							set @totalVendido =
							(
								select isnull(sum(cast(ValorTotal as money)),0)  -- isnull pois se não existir venda o valor é 0 
								from #TAB_VENDAS_PERIODO  
								where idLojas = (select top 1 idLojas from #vendedores)
								and idVendedor = (select top 1 idVendedor from #vendedores)
							)


							-- > APLICA  O FATOR %
							if (select top 1 vlPorcentagem from #fatores  where idcargo = (select top 1 idcargo from #vendedores)) is not null							
								begin 
									insert into @valorApagar
									values ( 
										(select top 1 idVendedor from #vendedores),	
										(@totalVendido * (select top 1 vlPorcentagem from #fatores  where idcargo = (select top 1 idcargo from #vendedores)))/100,
										@periodoDE,
										@periodoATE
									)
								end
						end
					else 
						begin 

							-- GERENTE / quando fator se aplicar no total de vendas e não na venda do vendedor específico

							set @totalVendido =
							(
								select isnull(sum(cast(ValorTotal as money)),0)  -- isnull pois se não existir venda o valor é 0 
								from #TAB_VENDAS_PERIODO  
								where idLojas = (select top 1 idLojas from #vendedores)
							)

							if (select top 1 vlPorcentagem from #fatores  where idcargo = (select top 1 idcargo from #vendedores)) is not null							
								begin 
									insert into @valorApagar
									values ( 
										(select top 1 idVendedor from #vendedores),	
										(@totalVendido * (select top 1 vlPorcentagem from #fatores  where idcargo = (select top 1 idcargo from #vendedores)))/100,
										@periodoDE,
										@periodoATE
									)
								end
							else
								----------------- checa metas 
								begin 
								if @totalVendido > (SELECT valorMeta FROM #METAS where idLojas = @idLoja)
									begin 											
										insert into @valorApagar
										values ( 
											(select top 1 idVendedor from #vendedores),	
											(select top 1 vlReais from #fatores  where idcargo = (select top 1 idcargo from #vendedores)),
											@periodoDE,
											@periodoATE
										)
									end 

								end
						end

					delete from #fatores where 	idFator = (select top 1 idFator from #fatores)	
				end

				---	PROXIMO VENDEDOR
				delete from #vendedores where idVendedor = (select top 1 idVendedor  from #vendedores)
			end


		  FETCH NEXT FROM cursor_lojas INTO @idLoja   
	END 

	CLOSE cursor_lojas  
	DEALLOCATE cursor_lojas 

	INSERT INTO  comissoes_calculadas (idVendedor,valor_a_pagar,periodo)
	select idVendedor,sum(valor_a_pagar),periodoDE from @valorApagar
	group by idVendedor,periodoDE

	if @@ROWCOUNT = 0 
		set @status = -1
	else 
		set @status = 0

END

--SP_CALCULAR_COMISSOES '201809','201809',''

--select * from comissoes_calculadas