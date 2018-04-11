--CREATE DATABASE xcell;
--USE xcell;


CREATE TABLE xcell_data_tbl(
    XCellDataID INT NOT NULL,
    Xrows VARCHAR(50),
    Ycolumns VARCHAR(50),
    FieldValue VARCHAR(50),
    PRIMARY KEY (XCellDataID)
);

CREATE TABLE xcell_tbl(
    XCellID INT NOT NULL AUTO_INCREMENT,
    XCellDataID INT,
    PRIMARY KEY (XCellID),
    FOREIGN KEY (XCellDataID) REFERENCES  xcell_data_tbl(XCellDataID)
);

