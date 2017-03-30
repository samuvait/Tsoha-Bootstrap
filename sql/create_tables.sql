CREATE TABLE Kayttaja(
id SERIAL PRIMARY KEY,
name varchar(50) NOT NULL,
password varchar(50) NOT NULL
);

CREATE TABLE Askare(
id SERIAL PRIMARY KEY,
-- kayttaja_id INTEGER REFERENCES Kayttaja(id),
name varchar(50) NOT NULL,
luokka varchar(40),
done varchar(20),
description varchar(400),
added DATE,
deadline DATE,
importance INTEGER
);