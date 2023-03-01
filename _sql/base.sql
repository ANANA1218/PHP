CREATE DATABASE videogames;

USE videogames;

CREATE TABLE game
(
    id TINYINT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    release_date DATE,
    poster VARCHAR(255),
    price DECIMAL(5,2)
);


