/* 进货触发器 */
/* drop trigger if exists t_product_in_on_table */
delimiter $$
create trigger t_product_in_on_table
after insert on product_in
for each row
begin
	declare t_product_id int;
	declare t_in_number int;
	/* get info */
	/* get product_id */
	set t_product_id=(select product_id from
	product_in where product_id=new.product_id);
	
	/* get in_number */
	set t_in_number = (select in_number from
	product_in where product_id=new.product_id);
	
	/*set t_product_id,t_in_number=(select product_id,product_number from
	product_in where product_id=new.product_id);
	*/
	/* set info */
	update store_house set product_number=product_number+t_in_number where
	product_id=new.product_id;
end;
$$

/* 出货触发器 */
/* drop trigger if exists t_product_out_on_table */
delimiter $$
create trigger t_product_out_on_table
after insert on product_out
for each row
begin
	declare t_product_id int;
	declare t_out_number int;
	/* get info */
	/* get product_id */
	set t_product_id=(select product_id from
	product_out where product_id=new.product_id);
	set t_out_number=(select out_number from
	product_out where product_id=new.product_id);
	/* set info */
	update store_house set product_number=product_number+t_out_number where
	product_id=new.product_id;
end;
$$