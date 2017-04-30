create database caiwuu;
use caiwuu;

/* 基本表 */
create table user_info(
	/* 用户基本信息 */
	user_id int(12) primary key auto_increment,
	user_name varchar(32) not null,
	user_password varchar(32) not null,
	
	/* 用户管理信息 */
	user_authority int
)default charset=utf8;

/* 与产品有关的数据表  */
create table product_type(
	type_id int(12) primary key auto_increment,
	type_name varchar(128) not null,
	
	/* 所属用户 */
	user_id int(12) not null,
	
	foreign key(user_id) references user_info(user_id)
)default charset=utf8;

create table product_info(
	product_id int(12) primary key auto_increment,
	product_name varchar(128) not null,

	/* 链接外键 */
	type_id int(12) not null,
	user_id int(12) not null,
	
	foreign key(type_id) references product_type(type_id),
	foreign key(user_id) references user_info(user_id)
)default charset=utf8;

/* 进货 */
create table product_in(
	in_number int not null,
	in_date date not null,
	/* 链接到外键 */
	product_id int(12) not null,
	foreign key(product_id) references product_info(product_id)
)default charset=utf8;

/* 卖货 */
create table product_out(
	out_number int not null,
	out_date date not null,
	/* 链接到外键 */
	product_id int(12) not null,
	foreign key(product_id) references product_info(product_id)
)default charset=utf8;

/* 仓库 */
create table store_house(
	product_name varchar(128),
	product_number int(8),
	product_price int(8),
	
	/* 链接外键 */
	user_id int(12),
	product_id int(12),
	foreign key(user_id) references user_info(user_id)
)default charset=utf8;
/*
	产品类型
	产品信息
	
*/
