

DROP TABLE IF EXISTS Story;
DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS UserVote;
DROP TABLE IF EXISTS Commentable;
DROP TABLE IF EXISTS GameItUser;



CREATE TABLE GameItUser(
    idUser INTEGER NOT NULL PRIMARY KEY,
    username TEXT NOT NULL,
    pass TEXT NOT NULL,
    email TEXT NOT NULL,
    age INTEGER NOT NULL, -- ^ Campos obrigatorio
    descriptionUser TEXT -- Campo não obrigatorio

    --n_points INTEGER NOT NULL,  ->  trigger
);

-- Super class for Stories and Comments
CREATE TABLE Commentable(
    idCommentable INTEGER NOT NULL PRIMARY KEY,
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
    idParent INTEGER NOT NULL,

    FOREIGN KEY (idComment) REFERENCES Commentable(idCommentable),
    FOREIGN KEY (idParent) REFERENCES Commentable(idCommentable)

    --TODO
);


CREATE TABLE UserVote(
    voteVal INTEGER, -- either 1 or -1

    idUser INTEGER REFERENCES GameItUser(idUser),
    idCommentable INTEGER REFERENCES Commentable(idCommentable),
    PRIMARY KEY (idUser, idCommentable)
    --TODO
);

insert into GameItUser values (1,"Nando","12345","mail@mail.com",20, "Likes to run");
insert into GameItUser values (2,"Juan","qwerty","mymail@mail.com",20, "Likes to sleep");
insert into GameItUser values (3,"Carlitos","password","nomail@mail.com",20, "Likes to stream");

-- SELECT * FROM GameItUser;

-- SELECT * FROM GameItUser WHERE idUser = 1;


insert into Commentable values (1, "Hoje chumbei a PLOG", Date('2018-12-05 12:00'), 1);
insert into Commentable values (2, "Eu tambem e adorei", Date('2018-12-05 12:09'), 2);
insert into Commentable values (3, "Para o ano ha mais", Date('2018-12-05 12:12'), 1);
insert into Commentable values (4, "Tamos juntos", Date('2018-12-05 12:14'), 3);
insert into Commentable values (5, "Siga entao", Date('2018-12-05 12:17'), 1);

insert into Commentable values (6, "Renda 150€ por mes", Date('2018-12-06 14:00'), 3);
insert into Commentable values (7, "Mandei MP", Date('2018-12-06 14:09'), 2);
insert into Commentable values (8, "Ja respondi!", Date('2018-12-06 14:12'), 3);


insert into Story values (1, "Bad day");
insert into Story values (6, "Quarto para arrendar");

insert into Comment values (2, 1);
insert into Comment values (3, 1);
insert into Comment values (4, 1);
insert into Comment values (5, 1);

insert into Comment values (7, 6);
insert into Comment values (8, 6);


insert into UserVote values (1, 3, 3);
insert into UserVote values (1, 3, 6);

--SELECT * FROM Story, Commentable WHERE Story.idStory = Commentable.idCommentable;

/*
SELECT Story.title, count(Comment.idComment) AS N_Comments
FROM Story, Commentable, Comment
WHERE Story.idStory = Commentable.idCommentable AND Comment.idParent = Commentable.idCommentable  
GROUP BY Story.title;

SELECT Story.title, count(Comment.idComment) AS N_Comments
FROM Story, Commentable, Comment
WHERE Story.idStory = Commentable.idCommentable AND Comment.idParent = Commentable.idCommentable AND Story.idStory = 6;
*/

/*
SELECT Story.idStory, Story.title, Commentable.textC, Commentable.dateC, count(Comment.idComment) AS N_Comments
FROM Story,Commentable, Comment
WHERE Commentable.idCommentable = Story.idStory AND Comment.idParent = Commentable.idCommentable
GROUP BY Story.idStory
ORDER BY Commentable.dateC DESC;


SELECT Story.idStory, count(*) AS N_Likes
FROM Story, Commentable, UserVote
WHERE Commentable.idCommentable = Story.idStory AND UserVote.idCommentable = Commentable.idCommentable AND UserVote.voteVal = 1
GROUP BY Story.idStory;
*/


