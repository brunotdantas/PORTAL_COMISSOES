DECLARE @DataINI varchar(30) = FORMAT(DATEADD(MONTH, DATEDIFF(MONTH, 0, GETDATE()),   0 ),'yyyyMMdd') -- < primeiro dia do mes corrente  > -- 
DECLARE @DataFIM varchar(30) = FORMAT(DATEADD(MONTH, DATEDIFF(MONTH, -1, GETDATE()), -1),'yyyyMMdd') -- < ultimo dia do mes corrente  > -- 

declare @curDate datetime = @dataINI

begin try drop table #days end try begin catch end catch
select @curDate as DataVenda ,0 qtdVenda into #days

while(@curDate < @DataFIM ) 
begin 
	set @curDate = DATEADD(d, 1, @curDate)
	insert into #days values (@curDate,0)
end 

select format(d.DataVenda,'dd/MM/yyyy') ,isnull(sum(convert(money,v.ValorTotal)),0) as quantidade from #days d
left join VendasCabec v on v.dataVenda = d.DataVenda
group by d.DataVenda
