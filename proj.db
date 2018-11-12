.mode columns
.headers on

PRAGMA foreign_keys = ON;
--db.execSQL(ENABLE_FOREIGN_KEYS);

CREATE TABLE User(
    idUser INTEGER PRIMARY KEY,
    username TEXT NOT NULL,
    age INTEGER,
    n_points INTEGER NOT NULL
    --TODO
);

CREATE TABLE Story(
    idStory INTEGER PRIMARY KEY,
    text TEXT NOT NULL,
    date DATE NOT NULL,
    n_upvotes INTEGER NOT NULL,
    n_downvotes INTEGER NOT NULL,
    idUser INTEGER REFERENCES User(idUser)
    --TODO
);

CREATE TABLE Comment(
    idComment INTEGER PRIMARY KEY,
    text TEXT NOT NULL,
    date DATE NOT NULL,
    n_upvotes INTEGER NOT NULL,
    n_downvotes INTEGER NOT NULL,
    idUser INTEGER REFERENCES User(idUser),
    idStory INTEGER REFERENCES Story(idStory)
    --TODO
);

CREATE TABLE Comment_Relat(
    idChild INTEGER PRIMARY KEY,
    idParent INTEGER REFERENCES Comment(idComment),
    FOREIGN KEY (idChild) REFERENCES Comment(idComment)
    --TODO
);
