CREATE DATABASE IF NOT EXISTS videoGameReviews;
USE videoGameReviews;

-- SHOW TABLE STATUS FROM viedoGameReviews;

DROP TABLE IF EXISTS Ratings;

CREATE TABLE Ratings(
  ratingID int NOT NULL AUTO_INCREMENT,
  reviewerID int,
  gameID int,
  gameRating int,
  notes varchar(100),
  PRIMARY KEY (ratingID),
  KEY FK (reviewerID, gameID)
);
INSERT INTO Ratings VALUES(null,'1','1', '10' , 'This game is a great classic');
INSERT INTO Ratings VALUES(null,'3','3', '10' , 'Good Puzzels and A great Subtle Story!');

CREATE INDEX gameRatings on Ratings(gameID,gameRating);
-- This will be usefull for figuring out the average review of a game as well as 
-- showing statistics on it, like how steam does with its reviews!

-- SELECT Rev.reviewName, gameRating, g.gameTitle, g.Developer,  g.ESRB, notes FROM Ratings Rat JOIN Games g ON Rat.gameID = g.gameID JOIN Reviewer Rev ON Rat.reviewerID = Rev.reviewerID;
-- SELECT  gameRating, g.gameTitle, g.Developer,  g.ESRB, notes FROM Ratings Rat JOIN Games g ON Rat.gameID = g.gameID;

DROP TABLE IF EXISTS Games;
CREATE TABLE Games (
  gameID int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  gameGenre varchar(10),
  consoleID int,
  gameTitle varchar(30),
  Publisher varchar(50),
  Developer varchar(50),
  ESRB varchar(2),
  releaseDate Date,
  -- PRIMARY KEY (gameID),
  KEY FK (consoleID)
);
INSERT INTO Games VALUES(null,'Platformer','1', 'Super Mario Bros' , 'Nintendo','Nintendo' , "E",  "1985-8-13");
INSERT INTO Games VALUES(null,'Platformer','2', 'Super Mario World', 'Nintendo','Nintendo' , "E",  "1990-11-21");
INSERT INTO Games VALUES(null,'Puzzle','12', 'Portal'   ,         'Steam','Steam' ,     "E",  "2007-10-9");

INSERT INTO Games VALUES(null,'Platformer','3', 'Super Mario 64'   , 'Nintendo','Nintendo' , "E",  "1996-6-23");

DROP TABLE IF EXISTS Reviewer;
CREATE TABLE Reviewer (
  reviewerID int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  reviewName varchar(20),
  favGenere varchar(10),
  favConcole varchar(30)
);
INSERT INTO Reviewer VALUES(null,'Matthew Ratajczyk','Stratagey', 'PC'   );
INSERT INTO Reviewer VALUES(null,'John Johnson'     ,'Shooter'  , 'xbox360'   );
INSERT INTO Reviewer VALUES(null,'Jeff Jefferson'   ,'JRPG'     , 'Playstation 3'   );

DROP TABLE IF EXISTS Consoles;
CREATE TABLE Consoles (
  consoleID int AUTO_INCREMENT,
  Name varchar(30),
  Specs varchar(100),
  Creator varchar(30),
  Generation int,
  ReleaseDate Date,
  PRIMARY KEY (consoleID)
);
INSERT INTO Consoles VALUES('1', 'Nintendo Entertainment System',       '8-bit' , 'Nintendo' ,'Generation III', '1983-15-6'   );
INSERT INTO Consoles VALUES('2', 'Super Nintendo Entertainment System', '16-bit', 'Nintendo' ,'Generation IV',  '1990-11-21'   );
INSERT INTO Consoles VALUES('3', 'Nintendo 64',                         '64-bit', 'Nintendo' ,'Generation V',   '1996-8-26'   );
INSERT INTO Consoles VALUES('4', 'Nintendo Gamecube'                   ,'3D',     'Nintendo' ,'Generation IV' , '2001-8-2001' );

INSERT INTO Consoles VALUES('5', 'PlayStation 1',       '8-bit' , 'Nintendo' ,'Generation V',   '1994-15-6'   );
INSERT INTO Consoles VALUES('6', 'PlayStation 2',       '16-bit', 'Nintendo' ,'Generation VI',  '2000-11-21'   );
INSERT INTO Consoles VALUES('7', 'PlayStation 3',       '64-bit', 'Nintendo' ,'Generation VII', '2006-8-26'   );
INSERT INTO Consoles VALUES('8', 'PlayStation 4'       ,'3D',     'Nintendo' ,'Generation VIII','2013-8-2001' );

INSERT INTO Consoles VALUES('9',  'Xbox',       '8-bit' , 'Nintendo' ,'Generation III', '1983-15-6'   );
INSERT INTO Consoles VALUES('10', 'Xbox 360', '16-bit', 'Nintendo' ,'Generation IV',  '1990-11-21'   );
INSERT INTO Consoles VALUES('11', 'Xbox One',                         '64-bit', 'Nintendo' ,'Generation V',   '1996-8-26'   );
INSERT INTO Consoles VALUES('12', 'PC(Computer)'                   ,'3D',     'Nintendo' ,'Generation IV' , '2001-8-2001' );

INSERT INTO Consoles VALUES('13', 'Sega Genesis',       '8-bit' , 'Nintendo' ,'Generation V',   '1994-15-6'   );
INSERT INTO Consoles VALUES('14', 'Dreamcast',       '16-bit', 'Nintendo' ,'Generation VI',  '2000-11-21'   );
INSERT INTO Consoles VALUES('15', 'Wii',       '64-bit', 'Nintendo' ,'Generation VII', '2006-8-26'   );
INSERT INTO Consoles VALUES('16', 'Nintendo Switch'       ,'3D',     'Nintendo' ,'Generation VIII','2013-8-2001' );

DROP VIEW IF EXISTS GameReviewView;
CREATE VIEW GameReviewView AS SELECT Rev.reviewName AS 'Reviewer Name', gameRating AS 'Score', g.gameTitle AS 'Title', g.Developer, g.Publisher,  g.ESRB , notes AS 'Review' FROM Ratings Rat 
  JOIN Games g ON Rat.gameID = g.gameID 
  JOIN Reviewer Rev ON Rat.reviewerID = Rev.reviewerID;

