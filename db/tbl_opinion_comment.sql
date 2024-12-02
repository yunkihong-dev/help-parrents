CREATE TABLE tbl_opinion_comment (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    content VARCHAR(20) NOT NULL,
    opinion_id INT NOT NULL,
    user_id INT NOT NULL,
	reg_date date not null,
    FOREIGN KEY (opinion_id) REFERENCES tbl_opinion(id),
    FOREIGN KEY (user_id) REFERENCES tbl_user(id)
);