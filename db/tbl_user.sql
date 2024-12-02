CREATE TABLE tbl_user (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_email VARCHAR(20) NOT NULL,
    user_password VARCHAR(20) NOT NULL,
    user_nickname VARCHAR(20) NOT NULL,
    user_roll VARCHAR(20) NOT NULL
);

INSERT INTO tbl_user
(user_email, user_password, user_nickname, user_roll)
VALUES('admin@naver.com', 'admin1234', '관리자', 'ADMIN');
