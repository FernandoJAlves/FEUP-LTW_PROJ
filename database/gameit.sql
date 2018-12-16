

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
    n_points INTEGER NOT NULL
);

-- Super class for Stories and Comments
CREATE TABLE Commentable(
    idCommentable INTEGER NOT NULL PRIMARY KEY,
    textC TEXT NOT NULL,
    dateC DATE NOT NULL,
    idUser INTEGER REFERENCES GameItUser(idUser),
    n_upvotes INTEGER NOT NULL,
    n_downvotes INTEGER NOT NULL
);

CREATE TABLE Story(
    idStory INTEGER PRIMARY KEY,
    title TEXT NOT NULL,
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

