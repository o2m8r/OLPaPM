CREATE DATABASE xcell;
USE xcell;

CREATE TABLE users_tbl(
    UserID INT NOT NULL AUTO_INCREMENT,
    UserName VARCHAR(50) NOT NULL,
    PRIMARY KEY(UserID)
);
CREATE TABLE xcell_tbl(
    XCellID INT NOT NULL AUTO_INCREMENT,
    UserID INT NOT NULL,
    XCellDataID INT,
    RowCount INT DEFAULT 2,
    ColCount INT DEFAULT 2,
    PRIMARY KEY (XCellID),
    FOREIGN KEY (UserID) REFERENCES  users_tbl(UserID)
);
CREATE TABLE xcell_data_tbl(
    XCellDataID INT NOT NULL AUTO_INCREMENT,
    Xrows VARCHAR(50),
    Ycolumns VARCHAR(50),
    FieldValue VARCHAR(50),
    XCellID INT,
    PRIMARY KEY (XCellDataID),
    FOREIGN KEY (XCellID) REFERENCES  xcell_tbl(XCellID)
);

INSERT INTO users_tbl(UserName) VALUES('Daniel');

--SELECT MAX(Xrows),MAX(Ycolumns) FROM xcell_data_tbl;
--SELECT * FROM xcell_data_tbl ORDER BY Xrows,Ycolumns;SELECT * FROM xcell_tbl;


