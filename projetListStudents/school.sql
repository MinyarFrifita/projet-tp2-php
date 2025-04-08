CREATE DATABASE IF NOT EXISTS school;
USE school;

-- Users table for authentication
CREATE TABLE IF NOT EXISTS user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
);

-- Sections table
CREATE TABLE IF NOT EXISTS section (
    id INT PRIMARY KEY AUTO_INCREMENT,
    designation VARCHAR(10) NOT NULL UNIQUE,
    description VARCHAR(255)
);

--  students table
CREATE TABLE IF NOT EXISTS student (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    birthday DATE NOT NULL,
    image VARCHAR(255),
    section_id INT,
    FOREIGN KEY (section_id) REFERENCES section(id)
);

-- Sample data
INSERT INTO section (designation, description) VALUES
('GI', 'Génie Logiciel'),
('RT', 'Réseau et Télécommunication');

INSERT INTO student (name, birthday, section_id) VALUES
('Aymen', '1982-02-07', 1),
('Skander', '2018-07-11', 1);

-- Admin user (password: admin123)
INSERT INTO user (username, email, password, role) VALUES
('admin', 'admin@school.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

GRANT ALL PRIVILEGES ON school.* TO 'root'@'localhost';
FLUSH PRIVILEGES;
