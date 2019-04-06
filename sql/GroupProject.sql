Drop DATABASE IF EXISTS GroupProject;

Create Database GroupProject;

Use GroupProject;

CREATE TABLE User (
UserID INT NOT NULL AUTO_INCREMENT,
Username VarChar(50) NOT NULL,
Password VarChar(255) NOT NULL,
Primary key(UserID)
);

CREATE TABLE Address (
AddressID INT NOT NULL AUTO_INCREMENT,
UserID INT NOT NULL,
City VarChar(50) NULL,
Street VarChar(50) NULL,
State VarChar(50) NULL,
Primary key(AddressID, UserID),
Foreign Key(UserID) References User(UserID)
);

CREATE TABLE Movie (
MovieID INT NOT NULL AUTO_INCREMENT,
MovieName VarChar(100) NOT NULL,
Primary key(MovieID)
);

CREATE TABLE Review (
    ReviewID INT NOT NULL AUTO_INCREMENT,
    MovieID INT NOT NULL,
    UserID INT NOT NULL,
    ReviewDesc VarChar(300) NOT NULL,
    Rating INT NOT NULL,
    Date VarChar(20) NOT NULL,
    Primary key(ReviewID,MovieID,UserID),
    Foreign key(UserID) References User(UserID),
    Foreign key(MovieID) References Movie(MovieID)
);

INSERT INTO Movie (MovieName) VALUES
('Split'),
('Thor: Ragnarok'),
('Love of My Life'),
('Guardians of the Galaxy Vol. 2'),
('Justice League'),
('Star Wars: The Last Jedi'),
('Wonder Woman'),
('Spider-Man: Homecoming'),
('Blade Runner 2049'),
('Logan'),
('The Fate of the Furious'),
('The Ash Lad: In the Hall of the Mountain King'),
('Get Out'),
('War for the Planet of the Apes'),
('The Greatest Showman'),
('John Wick: Chapter 2'),
('Alien: Covenant'),
('Beauty and the Beast'),
('Dunkirk'),
('Kingsman: The Golden Circle');