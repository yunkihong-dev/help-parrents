CREATE TABLE tbl_goods_comment (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    content VARCHAR(20) NOT NULL,
    goods_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (goods_id) REFERENCES tini_goods_info(id),
    FOREIGN KEY (user_id) REFERENCES tbl_user(id)
);
