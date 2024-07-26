DROP DATABASE IF EXISTS note_lite;

CREATE DATABASE note_lite;

USE note_lite;

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(225),
    email VARCHAR(225),
    password VARCHAR(225)
);

CREATE TABLE notes(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(225),
    date DATE,
    content VARCHAR(225),
    user_id INT NOT NULL,

    FOREIGN KEY (user_id) REFERENCES users(id)
);
