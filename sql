

CEci est un projet volontairement fragile pour une machine type ctf

CREATE DATABASE projet_demeter;
USE projet_demeter;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

INSERT INTO users (username, password) VALUES
('admin', 'admin123'), -- Mot de passe faible pour faciliter l'exploitation
('hermes', 'hacker123');
