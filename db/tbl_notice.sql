create table tbl_notice(
	id int not null auto_increment primary key,
	title varchar(100) not null,
	content varchar(200) not null,
	reg_date date not null,
	user_id int not null,
	hit int not null,
	foreign key (user_id) references tbl_user(id)
);