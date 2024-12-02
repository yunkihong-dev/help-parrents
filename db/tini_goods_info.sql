CREATE TABLE tini_goods_info (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(20) NOT NULL,
    content VARCHAR(100) NOT NULL,
    place_name VARCHAR(20) NOT NULL,
	hit int not null,
	reg_date date not null,
    tini_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (tini_id) REFERENCES tbl_tiniping(id),
    FOREIGN KEY (user_id) REFERENCES tbl_user(id)
);