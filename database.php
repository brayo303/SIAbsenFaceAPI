<?php

error_reporting(E_ALL - E_WARNING);
$db = getOrCreateDatabase();

function getOrCreateDatabase() {
    if (!file_exists('database.sqlite')) {
        $db = new SQLite3('database.sqlite');
        
        // create table Mahasiswa
        $db->exec(
            "CREATE TABLE Mahasiswa (
                id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, 
                nama TEXT, 
                npm TEXT, 
                urlPhoto TEXT
            );"
        );

        // create table Jadwal
        // format datetime YYYY-MM-DD HH:MM:SS.SSS
        $db->exec(
            "CREATE TABLE Jadwal (
                idJ INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                startTime TEXT,
                endTime TEXT,
                namaMatkul TEXT
            )"
        );

        // create table Absen
        $db->exec(
            "CREATE TABLE Absen (
                idA INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                confidence INTEGER,
                hadir INTEGER,
                id INTEGER NOT NULL,
                idJ INTEGER NOT NULL,
                CONSTRAINT fk_Mahasiswa FOREIGN KEY (id) REFERENCES Mahasiswa(id),
                CONSTRAINT fk_Jadwal FOREIGN KEY (idJ) REFERENCES Jadwal(idJ)
            )"
        );

        // insert data Mahasiswa
        $db->exec("INSERT INTO Mahasiswa VALUES ('Geraldi', '6181801001', 'image/geraldi.png')");
        $db->exec("INSERT INTO Mahasiswa VALUES ('Denise', '6181801002', 'image/denise.png')");
        $db->exec("INSERT INTO Mahasiswa VALUES ('Julyus', '6181801003', 'image/julyus.png')");
        $db->exec("INSERT INTO Mahasiswa VALUES ('Chris', '6181801004', 'image/chris.png')");
        $db->exec("INSERT INTO Mahasiswa VALUES ('Bryan', '6181801005', 'image/bryan.png')");

        // insert data Jadwal
        $db->exec("INSERT INTO Jadwal VALUES ('2021-12-15 07:00:00.000', '2021-12-15 09:00:00.000', 'Layanan Berbasis Web');");
        $db->exec("INSERT INTO Jadwal VALUES ('2021-12-15 09:00:00.000', '2021-12-15 10:00:00.000', 'Dasar-dasar Pemrograman');");
        $db->exec("INSERT INTO Jadwal VALUES ('2021-12-15 11:00:00.000', '2021-12-15 13:00:00.000', 'Pemodelan untuk Komputasi');");
        $db->exec("INSERT INTO Jadwal VALUES ('2021-12-15 14:00:00.000', '2021-12-15 15:00:00.000', 'Matematika Dasar');");

        // insert data Absen
        // $db->exec("INSERT INTO Absen VALUES (10, 1, 1, 1");
        
    } else {
        $db = new SQLite3('database.sqlite');
    }
    return $db;
}