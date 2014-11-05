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

-- Nicole --

drop table if exists hasSong
create table hasSong (
upc int not null,
title char(100) not null
CONSTRAINT [PK_hasSong] PRIMARY KEY CLUSTERED 
(
	upc ASC,
	title ASC
)
)

drop table if exists Order
create table Order (
receiptId int primary key not null,
date datetime not null,
cid int foreign key references Customer not null,
card# int not null,
expiryDate int not null,
expectedDate datetime not null,
DeliveredDate datetime
)


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
	title char(100),
	_type char(10),
	category char(100),
	company char(100),
	year integer,
	price integer,
	stock integer,
	primary key (upc));

drop table if exists lead_singer;
create table lead_singer;
	(upc integer not null,
	name char(100) not null,
	primary key (upc, name));

-- Kevin --
-- * Done in Sublime Text * --

drop table if exists Purchase_Item;
create table Purchase_Item
	(receiptID char(10),
	upc char(10),
	quantity char(10)
	primary key (receiptID, upc),
	foreign key (receiptID) references Order,
	foreign key (upc) references Item);

drop table if exists Customer;
create table Customer
	(cid char(10),
	password char(100),
	name char(100),
	address char(100),
	phone char(10),
	primary key (cid));









-- Insert stuff before here --
commit;
