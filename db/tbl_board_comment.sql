CREATE TABLE tbl_board_comment (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    content VARCHAR(20) NOT NULL,
    board_id INT NOT NULL,
	reg_date date not null,
    user_id INT NOT NULL,
    FOREIGN KEY (board_id) REFERENCES tbl_board(id),
    FOREIGN KEY (user_id) REFERENCES tbl_user(id)
);