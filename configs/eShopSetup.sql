create database if not exists `eShop`;
use `eShop`;
-- default: InnoDB, UTF8
-- manager table
drop table if exists `admin`;
create table `admin`(
	`id` tinyint unsigned auto_increment key, 
	`username` varchar(20) not null unique,
	`password` char(32) not null,
	`email` varchar(50) not null
);

-- category table
drop table if exists `category`;
create table `category` (
	`id` smallint unsigned auto_increment key,
	`cName` varchar(50) unique
);

-- product table
drop table if exists `product`;
create table `product` (
	`id` int unsigned auto_increment key,
	`pName` varchar(50) not null unique,
	`pSn` varchar(50) not null,
	`pNum` int unsigned default 1,
	`mPrice` decimal(10, 2) not null,
	`iPrice` decimal(10, 2) not null,
	`pDesc` text,
	`pImg` varchar(50) not null,
	`pubTime` int unsigned not null,
	`isShow` tinyint(1) default 1,	-- sell or not (like bool)
	`isHot` tinyint(1) default 0,	-- hot sell
	`cid` smallint unsigned not null
);

-- user table
drop table if exists `user`;
create table `user` (
	`id` int unsigned auto_increment key,
	`username` varchar(20) not null unique,
	`password` char(32) not null,
	`sex` enum("Man", "Woman", "Secret") not null default "Secret",
	`face` varchar(50) not null,
	`regTime` int unsigned not null
);

-- album table
drop table if exists `album`;
create table `album` (
	`id` int unsigned auto_increment key,
	`pid` int unsigned not null,
	`albumPath` varchar(50) not null
);
