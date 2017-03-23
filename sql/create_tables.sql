-- Lisää CREATE TABLE lauseet tähän tiedostoon
-- CREATE TABLE Kayttaja(
-- id SERIAL PRIMARY KEY,
-- name varchar(50) NOT NULL,
-- password varchar(50) NOT NULL
-- );
-- 
-- CREATE TABLE Askare(
-- id SERIAL PRIMARY KEY,
-- kayttaja_id INTEGER REFERENCES Kayttaja(id),
-- name varchar(50) NOT NULL,
-- suoritettu boolean DEFAULT FALSE,
-- description varchar(400),
-- lisatty DATE,
-- deadline DATE,
-- tarkeysaste INTEGER
-- );
CREATE TABLE Player(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  name varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  password varchar(50) NOT NULL
);

CREATE TABLE Game(
  id SERIAL PRIMARY KEY,
  player_id INTEGER REFERENCES Player(id), -- Viiteavain Player-tauluun
  name varchar(50) NOT NULL,
  played boolean DEFAULT FALSE,
  description varchar(400),
  published DATE,
  publisher varchar(50),
  added DATE