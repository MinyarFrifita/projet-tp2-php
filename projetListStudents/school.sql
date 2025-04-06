CREATE DATABASE IF NOT EXISTS school;
USE school;

CREATE TABLE IF NOT EXISTS student (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    birthday DATE NOT NULL
);

INSERT INTO student (name, birthday) VALUES
('Aymen', '1982-02-07'),
('Skander', '2018-07-11');
GRANT ALL PRIVILEGES ON school.* TO 'root'@'localhost';
FLUSH PRIVILEGES;