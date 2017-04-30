create database caiwuu;
alter database caiwuu character set utf8

create table user_info(
	user_id int primary key auto_increment,
	user_name varchar(32) not null,
	user_password varchar(32) not null
)default charset=utf8;