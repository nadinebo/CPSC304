use Houns;

/*

procedure to get the daily sales 


set @date = '2014-11-01';
call dailySales (@date)

*/

drop procedure if exists dailySales;

create procedure dailySales (reportDate date)

	select 	p.upc as UPC, 
			category as Category, 
			sum(price) as ItemPrice, 
            sum(quantity) as Quantity, 
            sum(price * quantity) as Total
    from PurchaseItem p
    inner join Order_ o on p.receiptID = o.receiptID
    inner join Item_ i on p.upc = i.upc
    where datediff(reportDate,o.date) < 1
    group by category, p.upc with rollup;


