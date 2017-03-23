CREATE TABLE Player(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
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
);