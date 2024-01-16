CREATE DATABASE IF NOT EXISTS wiki;


CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'auteur') NOT NULL
);


CREATE TABLE Categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT
);


CREATE TABLE Tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);


CREATE TABLE Wikis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_edit DATETIME ON UPDATE CURRENT_TIMESTAMP,
    auteur_id INT,
    categorie_id INT,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (auteur_id) REFERENCES Users(id),
    FOREIGN KEY (categorie_id) REFERENCES Categories(id)
);


CREATE TABLE Wiki_Tags (
    wiki_id INT,
    tag_id INT,
    PRIMARY KEY (wiki_id, tag_id),
    FOREIGN KEY (wiki_id) REFERENCES Wikis(id),
    FOREIGN KEY (tag_id) REFERENCES Tags(id)
);