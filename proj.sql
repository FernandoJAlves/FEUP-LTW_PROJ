.mode columns
.headers on

PRAGMA foreign_keys = ON;
--db.execSQL(ENABLE_FOREIGN_KEYS);

CREATE TABLE User(
    idUser INTEGER PRIMARY KEY,
    username TEXT NOT NULL,
    --Save here? -> hashedPass TEXT NOT NULL,
    email TEXT NOT NULL,
    age INTEGER

    
    --TODO
);

-- Super class for Stories and Comments
CREATE TABLE Commentable(
    idCommentable INTEGER PRIMARY KEY,
    textC TEXT NOT NULL,
    dateC DATE NOT NULL,
    
    --n_upvotes INTEGER NOT NULL,
    --n_downvotes INTEGER NOT NULL,
    
    idUser INTEGER REFERENCES User(idUser)

    
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

    -- Pointer to Commentable maybe? 

    --TODO
);


/*
CREATE TABLE Comment_Relat(
    idChild INTEGER PRIMARY KEY,
    idParent INTEGER REFERENCES Comment(idComment),
    FOREIGN KEY (idChild) REFERENCES Comment(idComment)
    --TODO
);
*/

