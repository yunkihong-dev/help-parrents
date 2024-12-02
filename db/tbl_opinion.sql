create table tbl_opinion(
	id int not null auto_increment primary key,
	title varchar(20) not null,
	content varchar(100) not null,
	user_id int not null, 
    likes INT NOT NULL DEFAULT 0,
	reg_date date not null,
	hit int not null default 0,
	foreign key (user_id) references tbl_user(id)
);