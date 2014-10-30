-- Put your tables here: --

-- ** NOTATION NOTES: 

-- id = ID

-- attribute for entity is: <entityname>_<attributename>
-- (eg. Store(name) = store_name) Use this notation for all
-- similar attribute names (eg. Return and Shipment both
-- have 'date', make it return_date and shipment_date,
-- however, Return has retID and no other table has that,
-- so retID doesn't need to be changed to return_retID)

-- if char is short make it char(10), if long = char(100)

-- name your tables with '_' between words so it is easier
-- to read (eg. returnItem = return_item)

-- if some table name might exist as a SQL command, add '_'
-- to its end (eg. 'return' = 'return_')


-- Nadine --
-- * Done in mySQL * --
-- Cannot test yet since some tables don't exist yet --

drop table if exists return_;
create table return_
	(retID char(10) not null,
	return_date char(10),
	receiptID char(10) not null unique,
	store_name char(100) not null unique,
	primary key (retID),
	foreign key (receiptID) references purchase);

drop table if exists return_item;
create table return_item
	(retID char(10) not null,
	return_quantity int,
	upc char(10) not null,
	primary key (retID, upc),
	foreign key (retID) references return,
	foreign key (upc) references item);

-- Stewart --
-- * Done in vim * --
drop table if exists item;
create table item
	(upc integer not null,
	item_title char(100),
	item_type char(10),
	item_category char(100),
	item_company char(100),
	item_year integer,
	item_price integer,
	item_stock integer,
	primary key (upc));

drop table if exists lead_singer;
create table lead_singer;
	(upc integer not null,
	lead_singer_name char(100) not null,
	primary key (upc, lead_singer_name));

	










-- Insert stuff before here --
commit;
