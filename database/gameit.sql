
CREATE TABLE GameItUser (
    idUser INTEGER NOT NULL PRIMARY KEY,
    username TEXT NOT NULL,
    pass TEXT NOT NULL,
    email TEXT NOT NULL,
    age INTEGER

    --TODO
);

-- Super class for Stories and Comments
CREATE TABLE Commentable(
    idCommentable INTEGER PRIMARY KEY,
    textC TEXT NOT NULL,
    dateC DATE NOT NULL,
    
    --n_upvotes INTEGER NOT NULL,  ->  trigger
    --n_downvotes INTEGER NOT NULL,  ->  trigger
    
    idUser INTEGER REFERENCES GameItUser (idUser)

    --TODO
);

CREATE TABLE Story(
    idStory INTEGER PRIMARY KEY,

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
    PRIMARY KEY (idUser, idCommentable),

    voteVal INTEGER, -- either 1 or -1

    idUser INTEGER REFERENCES GameItUser(idUser),
    idCommentable INTEGER REFERENCES GameItUser(idCommentable)
    --TODO
);

