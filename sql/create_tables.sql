-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kayttaja(
id SERIAL PRIMARY KEY,
name varchar(50) NOT NULL,
password varchar(50) NOT NULL,
);

CREATE TABLE Askare(
id SERIAL PRIMARY KEY,
kayttaja_id INTEGER REFERENCES Kayttaja(id),
name varchar(50) NOT NULL,
suoritettu boolean DEFAULT FALSE,
description varchar(400),
lisatty DATE,
deadline DATE,
tarkeysaste INTEGER
);
    