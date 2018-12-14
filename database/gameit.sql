

DROP TABLE IF EXISTS Story;
DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS UserVote;
DROP TABLE IF EXISTS Commentable;
DROP TABLE IF EXISTS GameItUser;

DROP VIEW IF EXISTS View_UV;

DROP TRIGGER IF EXISTS Upvote;
DROP TRIGGER IF EXISTS Downvote;
DROP TRIGGER IF EXISTS UpdatePointsInsert;
DROP TRIGGER IF EXISTS UpdatePointsUpdate;
DROP TRIGGER IF EXISTS UpdatePointsDelete;


CREATE TABLE GameItUser(
    idUser INTEGER NOT NULL PRIMARY KEY,
    username TEXT NOT NULL UNIQUE,
    pass TEXT NOT NULL,
    email TEXT NOT NULL,
    age INTEGER NOT NULL, -- ^ Campos obrigatorio
    descriptionUser TEXT, -- Campo não obrigatorio
    n_points INTEGER NOT NULL  --   ->  trigger
);

-- Super class for Stories and Comments
CREATE TABLE Commentable(
    idCommentable INTEGER NOT NULL PRIMARY KEY,
    textC TEXT NOT NULL,
    dateC DATE NOT NULL,
    idUser INTEGER REFERENCES GameItUser(idUser),
    n_upvotes INTEGER NOT NULL,  --   ->  trigger
    n_downvotes INTEGER NOT NULL  --   ->  trigger
);

CREATE TABLE Story(
    idStory INTEGER PRIMARY KEY,
    title TEXT NOT NULL,
    -- TODO Maybe have an image?
    FOREIGN KEY (idStory) REFERENCES Commentable(idCommentable)
);

CREATE TABLE Comment(
    idComment INTEGER PRIMARY KEY,
    idParent INTEGER NOT NULL,

    FOREIGN KEY (idComment) REFERENCES Commentable(idCommentable),
    FOREIGN KEY (idParent) REFERENCES Commentable(idCommentable)
);


CREATE TABLE UserVote(
    voteVal INTEGER, -- either 1 or -1

    idUser INTEGER REFERENCES GameItUser(idUser),
    idCommentable INTEGER REFERENCES Commentable(idCommentable),
    PRIMARY KEY (idUser, idCommentable)
);

--CREATE VIEW IF NOT EXISTS View_UV AS SELECT * FROM UserVote;

insert into GameItUser values (1,"Nando","12345","mail@mail.com",20, "Likes to run",0);
insert into GameItUser values (2,"Juan","qwerty","mymail@mail.com",20, "Likes to sleep",0);
insert into GameItUser values (3,"Carlitos","password","nomail@mail.com",20, "Likes to stream",0);

-- SELECT * FROM GameItUser;

-- SELECT * FROM GameItUser WHERE idUser = 1;


insert into Commentable values (1, "Hoje chumbei a PLOG", Datetime('2018-12-05 12:00'), 1,0,0);
insert into Commentable values (2, "Eu tambem e adorei", Datetime('2018-12-05 12:09'), 2,0,0);
insert into Commentable values (3, "Para o ano ha mais", Datetime('2018-12-05 12:12'), 1,0,0);
insert into Commentable values (4, "Tamos juntos", Datetime('2018-12-05 12:14'), 3,0,0);
insert into Commentable values (5, "Siga entao", Datetime('2018-12-05 12:17'), 1,0,0);

insert into Commentable values (6, "Renda 150€ por mes", Datetime('2018-12-06 14:00'), 3,0,0);
insert into Commentable values (7, "Mandei MP", Datetime('2018-12-06 14:09'), 2,0,0);
insert into Commentable values (8, "Ja respondi!", Datetime('2018-12-06 14:12'), 3,0,0);

insert into Commentable values (9, "Teste Upvotes", Datetime('2018-12-10 14:11'), 3,0,0);
insert into Commentable values (10, "Teste Contro", Datetime('2018-12-10 14:12'), 3,0,0);


-- insert into Story values (1, "Bad day");
-- insert into Story values (6, "Quarto para arrendar");
-- insert into Story values (9, "Teste Upvotes1");
-- insert into Story values (10, "Teste Contro1");

insert into Comment values (2, 1);
insert into Comment values (3, 1);
insert into Comment values (4, 1);
insert into Comment values (5, 1);

insert into Comment values (7, 6);
insert into Comment values (8, 6);

/*
CREATE TRIGGER IF NOT EXISTS Upvote
INSTEAD OF INSERT
ON View_UV
WHEN new.voteVal = 1
BEGIN
    --DELETE FROM UserVote WHERE UserVote.idUser = new.idUser AND UserVote.idCommentable = new.idCommentable;
    INSERT OR REPLACE INTO UserVote VALUES (1,new.idUser,new.idCommentable);
END;


CREATE TRIGGER IF NOT EXISTS Downvote
INSTEAD OF INSERT
ON View_UV
WHEN new.voteVal = -1
BEGIN
    DELETE FROM UserVote WHERE UserVote.idUser = new.idUser AND UserVote.idCommentable = new.idCommentable;
    INSERT INTO UserVote VALUES (-1,new.idUser,new.idCommentable);
END;
*/

CREATE TRIGGER IF NOT EXISTS UpdatePointsInsert
AFTER INSERT ON UserVote
BEGIN
    UPDATE Commentable SET n_upvotes = (SELECT count(*) FROM UserVote WHERE idCommentable = new.idCommentable AND voteVal = 1) WHERE Commentable.idCommentable = new.idCommentable;
    UPDATE Commentable SET n_downvotes = (SELECT count(*) FROM UserVote WHERE idCommentable = new.idCommentable AND voteVal =-1) WHERE Commentable.idCommentable = new.idCommentable;
    UPDATE GameItUser SET n_points = (SELECT sum(n_upvotes)-sum(n_downvotes) FROM Commentable WHERE idUser = (SELECT Commentable.idUser FROM Commentable, UserVote WHERE UserVote.idCommentable = Commentable.idCommentable)) WHERE GameItUser.idUser = (SELECT Commentable.idUser FROM Commentable, UserVote WHERE UserVote.idCommentable = Commentable.idCommentable);
END;

CREATE TRIGGER IF NOT EXISTS UpdatePointsUpdate
AFTER UPDATE ON UserVote
BEGIN
    UPDATE Commentable SET n_upvotes = (SELECT count(*) FROM UserVote WHERE idCommentable = new.idCommentable AND voteVal = 1) WHERE Commentable.idCommentable = new.idCommentable;
    UPDATE Commentable SET n_downvotes = (SELECT count(*) FROM UserVote WHERE idCommentable = new.idCommentable AND voteVal =-1) WHERE Commentable.idCommentable = new.idCommentable;
    UPDATE GameItUser SET n_points = (SELECT sum(n_upvotes)-sum(n_downvotes) FROM Commentable WHERE idUser = (SELECT Commentable.idUser FROM Commentable, UserVote WHERE UserVote.idCommentable = Commentable.idCommentable)) WHERE GameItUser.idUser = (SELECT Commentable.idUser FROM Commentable, UserVote WHERE UserVote.idCommentable = Commentable.idCommentable);
END;

CREATE TRIGGER IF NOT EXISTS UpdatePointsDelete
AFTER DELETE ON UserVote
BEGIN
    UPDATE Commentable SET n_upvotes = (SELECT count(*) FROM UserVote WHERE idCommentable = old.idCommentable AND voteVal = 1) WHERE Commentable.idCommentable = old.idCommentable;
    UPDATE Commentable SET n_downvotes = (SELECT count(*) FROM UserVote WHERE idCommentable = old.idCommentable AND voteVal =-1) WHERE Commentable.idCommentable = old.idCommentable;
    UPDATE GameItUser SET n_points = (SELECT sum(n_upvotes)-sum(n_downvotes) FROM Commentable WHERE idUser = (SELECT Commentable.idUser FROM Commentable, UserVote WHERE UserVote.idCommentable = Commentable.idCommentable)) WHERE GameItUser.idUser = (SELECT Commentable.idUser FROM Commentable, UserVote WHERE UserVote.idCommentable = Commentable.idCommentable);
END;

