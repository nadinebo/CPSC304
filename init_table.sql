drop database if exists Houns;

create database Houns;

use Houns;

drop table if exists Customer;
create table Customer
	(cid int auto_increment not null,
	password char(32) not null,
	name char(100),
	address char(100),
	phone char(16),
	primary key (cid));


drop table if exists Item_;
create table Item_
	(upc int not null,
	title char(100),
	type char(10) not null,
	category char(100),
	company char(100),
	year int,
	price int,
	stock int not null,
	primary key (upc));


drop table if exists LeadSinger;
create table LeadSinger
	(upc int not null,
	name char(100) not null,
	primary key (upc, name));


drop table if exists HasSong;
create table hasSong (
	upc int not null,
	title char(100) not null,
	primary key (upc, title),
	foreign key (upc) references Item_ (upc) on delete cascade on update cascade);


drop table if exists Order_;
create table Order_ (
	receiptId int auto_increment not null,
	date date not null,
	cid int not null,
	cardNum int not null,
	expiryDate date not null,
	expectedDate date not null,
	deliveredDate date,
	primary key (receiptID),
	foreign key (cid) references Customer (cid) on delete cascade on update cascade);


drop table if exists PurchaseItem;
create table PurchaseItem
	(receiptID int not null,
	upc int not null,
	quantity int not null,
	primary key (receiptID, upc),
	foreign key (receiptID) references Order_ (receiptID) on delete cascade on update cascade,
	foreign key (upc) references Item_ (upc) on delete cascade on update cascade);


drop table if exists Return_;
create table Return_
	(retID int auto_increment not null,
	returnDate date not null,
	receiptID int not null unique,
	primary key (retID),
	foreign key (receiptID) references PurchaseItem (receiptID) on delete cascade on update cascade);


drop table if exists ReturnItem;
create table ReturnItem
	(retID int not null,
	returnQuantity int not null,
	upc int not null,
	primary key (retID, upc),
	foreign key (retID) references Return_ (retID) on delete cascade on update cascade,
	foreign key (upc) references Item_ (upc) on delete cascade on update cascade);


commit;
