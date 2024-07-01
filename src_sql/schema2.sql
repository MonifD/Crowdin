DROP DATABASE IF EXISTS crowdin;
CREATE DATABASE crowdin;

USE crowdin;

CREATE TABLE user (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(45) NOT NULL,
  last_name VARCHAR(45) NOT NULL,
  username VARCHAR(45) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(245) NOT NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  is_trad TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE language (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  langue VARCHAR(45) NOT NULL,
  tag VARCHAR(45) NOT NULL,
  description VARCHAR(45) NOT NULL
);

CREATE TABLE project (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(45) NOT NULL,
  user_id INT NOT NULL,
  contenu VARCHAR(450) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES user (id)
);

CREATE TABLE source (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  project_id INT NOT NULL,
  nom VARCHAR(45) NOT NULL,
  description VARCHAR(45) NOT NULL,
  FOREIGN KEY (project_id) REFERENCES project (id)
);

CREATE TABLE language_cible (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  language_id INT NOT NULL,
  FOREIGN KEY (language_id) REFERENCES language (id)
);

CREATE TABLE language_origin (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  language_id INT NOT NULL,
  FOREIGN KEY (language_id) REFERENCES language (id)
);

CREATE TABLE source_language (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  source_id INT NOT NULL,
  language_cible_id INT,
  language_origin_id INT,
  FOREIGN KEY (source_id) REFERENCES source (id),
  FOREIGN KEY (language_origin_id) REFERENCES language_origin (id),
  FOREIGN KEY (language_cible_id) REFERENCES language_cible (id)
);

CREATE TABLE user_language (
  user_id INT NOT NULL,
  language_id INT NOT NULL,
  level VARCHAR(45) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES user (id),
  FOREIGN KEY (language_id) REFERENCES language (id)
);

-- Insertions pour la table user
INSERT INTO user (first_name, last_name, username, email, password, created_at, updated_at, is_trad) VALUES
('John', 'Doe', 'jdoe', 'jdoe@example.com', 'password1', NOW(), NOW(), 1),
('Jane', 'Smith', 'jsmith', 'jsmith@example.com', 'password2', NOW(), NOW(), 0),
('Alice', 'Johnson', 'ajohnson', 'ajohnson@example.com', 'password3', NOW(), NOW(), 1),
('Bob', 'Brown', 'bbrown', 'bbrown@example.com', 'password4', NOW(), NOW(), 0),
('Charlie', 'Davis', 'cdavis', 'cdavis@example.com', 'password5', NOW(), NOW(), 1),
('Diana', 'Evans', 'devans', 'devans@example.com', 'password6', NOW(), NOW(), 0),
('Edward', 'Green', 'egreen', 'egreen@example.com', 'password7', NOW(), NOW(), 1),
('Fiona', 'Harris', 'fharris', 'fharris@example.com', 'password8', NOW(), NOW(), 0),
('George', 'Ivory', 'givory', 'givory@example.com', 'password9', NOW(), NOW(), 1),
('Hannah', 'Jackson', 'hjackson', 'hjackson@example.com', 'password10', NOW(), NOW(), 0);

-- Insertions pour la table language
INSERT INTO language (langue, tag, description) VALUES
('English', 'EN', 'English language'),
('French', 'FR', 'French language'),
('Spanish', 'ES', 'Spanish language'),
('German', 'DE', 'German language'),
('Chinese', 'ZH', 'Chinese language'),
('Japanese', 'JA', 'Japanese language'),
('Korean', 'KO', 'Korean language'),
('Russian', 'RU', 'Russian language'),
('Italian', 'IT', 'Italian language'),
('Portuguese', 'PT', 'Portuguese language');

-- Insertions pour la table project
INSERT INTO project (name, user_id, contenu) VALUES
('Project 1', 1, 'Content of project 1'),
('Project 2', 2, 'Content of project 2'),
('Project 3', 3, 'Content of project 3'),
('Project 4', 4, 'Content of project 4'),
('Project 5', 5, 'Content of project 5'),
('Project 6', 6, 'Content of project 6'),
('Project 7', 7, 'Content of project 7'),
('Project 8', 8, 'Content of project 8'),
('Project 9', 9, 'Content of project 9'),
('Project 10', 10, 'Content of project 10');

-- Insertions pour la table source
INSERT INTO source (project_id, nom, description) VALUES
(1, 'Source 1', 'Description of source 1'),
(2, 'Source 2', 'Description of source 2'),
(3, 'Source 3', 'Description of source 3'),
(4, 'Source 4', 'Description of source 4'),
(5, 'Source 5', 'Description of source 5'),
(6, 'Source 6', 'Description of source 6'),
(7, 'Source 7', 'Description of source 7'),
(8, 'Source 8', 'Description of source 8'),
(9, 'Source 9', 'Description of source 9'),
(10, 'Source 10', 'Description of source 10');

-- Insertions pour la table language_cible
INSERT INTO language_cible (language_id) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10);

-- Insertions pour la table language_origin
INSERT INTO language_origin (language_id) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10);

-- Insertions pour la table source_language
INSERT INTO source_language (source_id, language_cible_id, language_origin_id) VALUES
(1, 1, 2),
(2, 2, 3),
(3, 3, 4),
(4, 4, 5),
(5, 5, 6),
(6, 6, 7),
(7, 7, 8),
(8, 8, 9),
(9, 9, 10),
(10, 10, 1);

-- Insertions pour la table user_language
INSERT INTO user_language (user_id, language_id, level) VALUES
(1, 1, 'Advanced'),
(1, 2, 'Advanced'),
(2, 2, 'Intermediate'),
(3, 3, 'Beginner'),
(4, 4, 'Advanced'),
(5, 5, 'Intermediate'),
(6, 6, 'Beginner'),
(7, 7, 'Advanced'),
(8, 8, 'Intermediate'),
(9, 9, 'Beginner'),
(10, 10, 'Advanced');
