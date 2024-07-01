DROP DATABASE IF EXISTS crowdin;
CREATE DATABASE crowdin;

USE crowdin;

CREATE TABLE IF NOT EXISTS languages (
  ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(30),
  family VARCHAR(20),
  branch VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS levels (
  ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(2),
  description VARCHAR(300)
);

CREATE TABLE IF NOT EXISTS user_languages (
  ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  languageID_1 int,
  languageLevelID_1 int,
  languageID_2 int,
  languageLevelID_2 int,
  languageID_3 int,
  languageLevelID_3 int,
  languageID_4 int,
  languageLevelID_4 int,
  languageID_5 int,
  languageLevelID_5 int,

  FOREIGN KEY (languageID_1) REFERENCES languages(ID),
  FOREIGN KEY (languageID_2) REFERENCES languages(ID),
  FOREIGN KEY (languageID_3) REFERENCES languages(ID),
  FOREIGN KEY (languageID_4) REFERENCES languages(ID),
  FOREIGN KEY (languageID_5) REFERENCES languages(ID),

  FOREIGN KEY (languageLevelID_1) REFERENCES levels(ID),
  FOREIGN KEY (languageLevelID_2) REFERENCES levels(ID),
  FOREIGN KEY (languageLevelID_3) REFERENCES levels(ID),
  FOREIGN KEY (languageLevelID_4) REFERENCES levels(ID),
  FOREIGN KEY (languageLevelID_5) REFERENCES levels(ID)
);

CREATE TABLE IF NOT EXISTS users (
  ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(20),
  speakingID int NOT NULL,
  is_translator boolean DEFAULT false,
  user_languagesID int DEFAULT NULL,
  created_at timestamp,

  FOREIGN KEY (user_languagesID) REFERENCES user_languages(ID),
  FOREIGN KEY (speakingID) REFERENCES languages(ID)
);

CREATE TABLE IF NOT EXISTS sources (
  ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  userID int NOT NULL,
  origin_langID int,
  filename varchar(50),
  size int,
  created_at timestamp,
  updated_at timestamp,
  tag varchar(20),

  FOREIGN KEY (userID) REFERENCES users(ID),
  FOREIGN KEY (origin_langID) REFERENCES languages(ID)
);

CREATE TABLE IF NOT EXISTS sub_projects (
  ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  sourceID int NOT NULL,
  translation_ask_1 int,
  translation_ask_2 int,
  translation_ask_3 int,
  response_1 int,
  response_2 int,
  response_3 int,
  response_4 int,
  response_5 int,
  response_6 int,
  response_7 int,
  response_8 int,
  response_9 int,
  response_10 int,

  FOREIGN KEY (sourceID) REFERENCES sources(ID),

  FOREIGN KEY (translation_ask_1) REFERENCES languages(ID),
  FOREIGN KEY (translation_ask_2) REFERENCES languages(ID),
  FOREIGN KEY (translation_ask_3) REFERENCES languages(ID),

  FOREIGN KEY (response_1) REFERENCES sources(ID),
  FOREIGN KEY (response_2) REFERENCES sources(ID),
  FOREIGN KEY (response_3) REFERENCES sources(ID),
  FOREIGN KEY (response_4) REFERENCES sources(ID),
  FOREIGN KEY (response_5) REFERENCES sources(ID),
  FOREIGN KEY (response_6) REFERENCES sources(ID),
  FOREIGN KEY (response_7) REFERENCES sources(ID),
  FOREIGN KEY (response_8) REFERENCES sources(ID),
  FOREIGN KEY (response_9) REFERENCES sources(ID),
  FOREIGN KEY (response_10) REFERENCES sources(ID)
);

CREATE TABLE IF NOT EXISTS projects (
  ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(20) NOT NULL,
  sub_project_1 int,
  sub_project_2 int,
  sub_project_3 int,
  created_at timestamp NOT NULL,
  updated_at timestamp,

  FOREIGN KEY (sub_project_1) REFERENCES sub_projects(ID),
  FOREIGN KEY (sub_project_2) REFERENCES sub_projects(ID),
  FOREIGN KEY (sub_project_3) REFERENCES sub_projects(ID)
);

CREATE TABLE IF NOT EXISTS users_projects (
  ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  userID int,
  projectID int,

  FOREIGN KEY (userID) REFERENCES users(ID),
  FOREIGN KEY (projectID) REFERENCES projects(ID)
);


/* seed the LANGUAGES */
INSERT INTO languages (name, family, branch) VALUES ('English', 'Indo-European', 'Germanic');
INSERT INTO languages (name, family, branch) VALUES ('Chinese Mandarin', 'Sino-Tibetan', 'Sinitic');
INSERT INTO languages (name, family, branch) VALUES ('Hindi', 'Indo-European', 'Indo-Aryan');
INSERT INTO languages (name, family, branch) VALUES ('Spanich', 'Indo-European', 'Romance');
INSERT INTO languages (name, family, branch) VALUES ('French', 'Indo-European', 'Romance');
INSERT INTO languages (name, family, branch) VALUES ('Arabic Modern Standard', 'Afro-Asiatic', 'Semitic');
INSERT INTO languages (name, family, branch) VALUES ('Bengali', 'Indo-European', 'Indo-Aryan');
INSERT INTO languages (name, family, branch) VALUES ('Portuguese', 'Indo-European', 'Romance');
INSERT INTO languages (name, family, branch) VALUES ('Russian', 'Indo-European', 'Balto-Slavic');
INSERT INTO languages (name, family, branch) VALUES ('Urdu', 'Indo-European', 'Indo-Aryan');
INSERT INTO languages (name, family, branch) VALUES ('Indonesian', 'Austonesian', 'Malayo-polynesian');
INSERT INTO languages (name, family, branch) VALUES ('German Standard', 'Indo-European', 'Germanic');
INSERT INTO languages (name, family) VALUES ('Japanese', 'Japonic');
INSERT INTO languages (name, family, branch) VALUES ('Nigerian Pidgin', 'English Creole', 'Krio');
INSERT INTO languages (name, family, branch) VALUES ('Arabic Egyptian', 'Afro-Asiatic', 'Semitic');
INSERT INTO languages (name, family, branch) VALUES ('Marathi', 'Indo-European', 'Indo-Aryan');
INSERT INTO languages (name, family, branch) VALUES ('Telugu', 'Dravidian', 'South-Central');
INSERT INTO languages (name, family, branch) VALUES ('Turkish', 'Turkic', 'Oghuz');
INSERT INTO languages (name, family, branch) VALUES ('Tamil', 'Dravidian', 'South-Central');
INSERT INTO languages (name, family, branch) VALUES ('Chinese Yue', 'Sino-Tibetan', 'Sinitic');
INSERT INTO languages (name, family, branch) VALUES ('Vietnamese', 'Austroasiatic', 'Vietic');
INSERT INTO languages (name, family, branch) VALUES ('Chinese Wu', 'Sino-Tibetan', 'Sinitic');
INSERT INTO languages (name, family, branch) VALUES ('Tagalog', 'Austronesian', 'Malayo-Polynesian');
INSERT INTO languages (name, family) VALUES ('Korean', 'Koreanic');
INSERT INTO languages (name, family, branch) VALUES ('Persian Iranian', 'Indo-European', 'Iranian');
INSERT INTO languages (name, family, branch) VALUES ('Hausa', 'Afro-Asiatic', 'Chadic');
INSERT INTO languages (name, family, branch) VALUES ('Swahili', 'Niger-Congo', 'Bantu');
INSERT INTO languages (name, family, branch) VALUES ('Javanese', 'Austronesian', 'Malayo-Polynesian');
INSERT INTO languages (name, family, branch) VALUES ('Italian', 'Indo-European', 'Romance');
INSERT INTO languages (name, family, branch) VALUES ('Thai', 'Kra-Dai', 'Zhuang-Tai');

/* seed the LEVELS */
INSERT INTO levels (name, description) VALUES ('A1', "niveau d'utilisateur élémentaire (niveau introductif ou de découverte). Comprendre et utiliser des expressions familières et quotidiennes et des énoncés très simples qui visent à satisfaire des besoins concrets");
INSERT INTO levels (name, description) VALUES ('A2', "niveau d'utilisateur élémentaire (niveau intermédiaire ou usuel). Comprendre des phrases isolées et des expressions fréquemment utilisées en relation avec des domaines de l'environnement quotidien");
INSERT INTO levels (name, description) VALUES ('B1', "niveau d'utilisateur indépendant (niveau seuil). Comprendre les points essentiels d'une discussion quand un langage clair et standard est utilisé et s'il s'agit de choses familières au travail, à l'école, aux loisirs, etc.");
INSERT INTO levels (name, description) VALUES ('B2', "niveau d'utilisateur indépendant (niveau avancé ou indépendant). Comprendre le contenu essentiel de sujets concrets ou abstraits dans un texte complexe, y compris une discussion technique dans sa spécialité");
INSERT INTO levels (name, description) VALUES ('C1', "niveau d'utilisateur expérimenté (niveau autonome). Comprendre des textes longs et exigeants et saisir des significations implicites");
INSERT INTO levels (name, description) VALUES ('C2', "niveau d'utilisateur expérimenté (niveau maîtrise). Comprendre sans effort pratiquement tout ce qui est lu ou entendu");


/* seed the USERS */
INSERT INTO users (name, speakingID, created_at) VALUES ('caroll', 5, '2024-03-01');
INSERT INTO users (name, speakingID, is_translator, created_at) VALUES ('Mohamad', 6, false, '2024-02-25');
INSERT INTO users (name, speakingID, created_at) VALUES ('Eddy', 5, '2024-01-15');

/* seed the USER_LANGUAGES */
INSERT INTO user_languages (languageID_1, languageLevelID_1, languageID_2, languageLevelID_2) VALUES (5, 6, 1, 3);
UPDATE users SET is_translator = false, user_languagesID = 1 WHERE ID = 1;

INSERT INTO user_languages (languageID_1, languageLevelID_1, languageID_2, languageLevelID_2) VALUES (6, 6, 5, 5);
UPDATE users SET is_translator = true, user_languagesID = 1 WHERE ID = 2;

INSERT INTO user_languages (languageID_1, languageLevelID_1, languageID_2, languageLevelID_2) VALUES (5, 6, 29, 6);
UPDATE users SET is_translator = true, user_languagesID = 1 WHERE ID = 3;

/* seed the SOURCES */
INSERT INTO sources (userID, origin_langID, filename, size, created_at, tag) VALUES (1, 5, "Le_corbeau_et_le_renard.pdf", 80, '2024-03-01', "poetry");
INSERT INTO sources (userID, origin_langID, filename, size, created_at) VALUES (1, 5, "test.txt", 48, '2024-03-08');
INSERT INTO sources (userID, origin_langID, filename, size, created_at) VALUES (3, 29, "IlCorvo&LaVolpe.txt", 63, '2024-03-02');
INSERT INTO sources (userID, origin_langID, filename, size, created_at) VALUES (2, 6, "test.txt", 92, '2024-03-15');
INSERT INTO sources (userID, origin_langID, filename, size, created_at) VALUES (2, 29, "CorvoVolpe.pdf", 120, '2024-02-25');
INSERT INTO sources (userID, origin_langID, filename, size, created_at) VALUES (3, 5, "Le-corbeau-et-le-renard.txt", 56, '2024-04-15');

/* seed the PROJECTS */
INSERT INTO projects (name, created_at) VALUES ("La Fontaine", '2024-03-01');
INSERT INTO projects (name, created_at) VALUES ("FONTAINE", '2024-02-27');

/* seed the SUB_PROJECT */
INSERT INTO sub_projects (sourceID, translation_ask_1, translation_ask_2) VALUES (1, 6, 29);
/*first response*/
UPDATE projects SET sub_project_1 = 1 WHERE ID = 1;
UPDATE sub_projects SET response_1 = 3 WHERE ID = 1;
UPDATE projects SET updated_at = '2024-03-02' WHERE ID= 1;
/*second response*/
UPDATE projects SET sub_project_1 = 1 WHERE ID = 1;
UPDATE sub_projects SET response_2 = 4 WHERE ID = 1;
UPDATE projects SET updated_at = '2024-03-28' WHERE ID = 1;

INSERT INTO sub_projects (sourceID, translation_ask_1) VALUES (5, 29);
/*first reponse*/
UPDATE projects SET sub_project_1 = 2 WHERE ID = 2;
UPDATE sub_projects SET response_1 = 6 WHERE ID = 2;
UPDATE projects SET updated_at = '2024-04-15' WHERE ID= 2;

/* seed the USER_PROJECTS */
INSERT INTO users_projects (userID, projectID) VALUES (1, 1);
INSERT INTO users_projects (userID, projectID) VALUES (2, 2);

/* 
SQL TEST 


SELECT * 
FROM user_languages
LEFT JOIN users ON users.user_languagesID = user_languages.ID
WHERE users.ID = 2;

SELECT * 
FROM users
WHERE is_translator = true;

SELECT projects.name, sub_projects.sourceID, sub_projects.response_1 
FROM sub_projects
INNER JOIN projects ON sub_projects.ID = projects.sub_project_1
WHERE projects.ID = 1;

*/