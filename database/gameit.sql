PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS GameItUser;
DROP TABLE IF EXISTS Commentable;
DROP TABLE IF EXISTS Story;
DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS UserVote;


CREATE TABLE GameItUser(
    idUser INTEGER NOT NULL PRIMARY KEY,
    username TEXT NOT NULL,
    pass TEXT NOT NULL,
    email TEXT NOT NULL,
    age INTEGER, -- ^ Campos obrigatorio
    descriptionUser TEXT -- Campo não obrigatorio

    --n_points INTEGER NOT NULL,  ->  trigger
);

-- Super class for Stories and Comments
CREATE TABLE Commentable(
    idCommentable INTEGER PRIMARY KEY,
    textC TEXT NOT NULL,
    dateC DATE NOT NULL,
    
    --n_upvotes INTEGER NOT NULL,  ->  trigger
    --n_downvotes INTEGER NOT NULL,  ->  trigger
    
    idUser INTEGER REFERENCES GameItUser(idUser)

    --TODO
);

CREATE TABLE Story(
    idStory INTEGER PRIMARY KEY,
    title TEXT NOT NULL,

    -- Maybe have an image?

    FOREIGN KEY (idStory) REFERENCES Commentable(idCommentable)
    --TODO
);

CREATE TABLE Comment(
    idComment INTEGER PRIMARY KEY,

    FOREIGN KEY (idComment) REFERENCES Commentable(idCommentable)

    --TODO
);


CREATE TABLE UserVote(
    voteVal INTEGER, -- either 1 or -1

    idUser INTEGER REFERENCES GameItUser(idUser),
    idCommentable INTEGER REFERENCES GameItUser(idCommentable),
    PRIMARY KEY (idUser, idCommentable)
    --TODO
);

