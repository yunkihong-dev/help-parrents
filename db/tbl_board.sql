CREATE TABLE tbl_board (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(20) NOT NULL,
    content VARCHAR(200) NOT NULL,
	hit int not null,
	reg_date date not null,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES tbl_user(id)
);