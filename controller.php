<?php

namespace controllers;

use PDO;
use PDOException;

class Controller {
    protected $db;

    public function __construct()
    {
        try {
            $this->db = new PDO("sqlite:database.sqlite");
            $this->install();
        } catch (PDOException $e) {
            die("Database not connected!");
        } 
    }

    public function install() {
        $tb_Mahasiswa = "CREATE TABLE Mahasiswa (
                id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, 
                nama TEXT, 
                npm TEXT, 
                urlPhoto TEXT
            )";

        $tb_Jadwal = "CREATE TABLE Jadwal (
                idJ INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                startTime TEXT,
                endTime TEXT,
                namaMatkul TEXT
            )";

        $tb_Absen = "CREATE TABLE Absen (
                idA INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                confidence INTEGER,
                hadir INTEGER,
                id INTEGER NOT NULL,
                idJ INTEGER NOT NULL,
                CONSTRAINT fk_Mahasiswa FOREIGN KEY (id) REFERENCES Mahasiswa(id),
                CONSTRAINT fk_Jadwal FOREIGN KEY (idJ) REFERENCES Jadwal(idJ)
            )";
            
        $this->db->query($tb_Mahasiswa);
        $this->db->query($tb_Jadwal);
        $this->db->query($tb_Absen);

        // insert data Mahasiswa
        $this->db->exec("INSERT INTO Mahasiswa VALUES ('Geraldi', '6181801001', 'image/geraldi.png')");
        $this->db->exec("INSERT INTO Mahasiswa VALUES ('Denise', '6181801002', 'image/denise.png')");
        $this->db->exec("INSERT INTO Mahasiswa VALUES ('Julyus', '6181801003', 'image/julyus.png')");
        $this->db->exec("INSERT INTO Mahasiswa VALUES ('Chris', '6181801004', 'image/chris.png')");
        $this->db->exec("INSERT INTO Mahasiswa VALUES ('Bryan', '6181801005', 'image/bryan.png')");

        // insert data Jadwal
        $this->db->exec("INSERT INTO Jadwal VALUES ('2021-12-15 07:00:00.000', '2021-12-15 09:00:00.000', 'Layanan Berbasis Web');");
        $this->db->exec("INSERT INTO Jadwal VALUES ('2021-12-15 09:00:00.000', '2021-12-15 10:00:00.000', 'Dasar-dasar Pemrograman');");
        $this->db->exec("INSERT INTO Jadwal VALUES ('2021-12-15 11:00:00.000', '2021-12-15 13:00:00.000', 'Pemodelan untuk Komputasi');");
        $this->db->exec("INSERT INTO Jadwal VALUES ('2021-12-15 14:00:00.000', '2021-12-15 15:00:00.000', 'Matematika Dasar');");
    }

    public function getAll($table) {
        // statement
        $stmt = $this->db->prepare("SELECT * FROM $table");
        $stmt->execute();

        $data = array();
        while ($rows = $stmt->fetch()) {
            $data[] = $rows;
        }

        return $data;
    }

    public function insertAbsen() {
        $confidence = $_POST['confidence'];
        $hadir = $_POST['hadir'];
        $id = $_POST['id'];
        $idJ = $_POST['idJ'];

        $sql = "INSERT INTO Absen VALUES (:confidence, :hadir, :id, :idJ)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":confidence", $confidence);
        $stmt->bindParam(":hadir", $hadir);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":idJ", $idJ);
        $stmt->execute();
    }

    public function insertMahasiswa() {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $npm = $_POST['npm'];
        $urlPhoto = $_POST['urlPhoto'];

        $sql = "INSERT INTO Absen VALUES (:id, :nama, :npm, :urlPhoto)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nama", $nama);
        $stmt->bindParam(":npm", $npm);
        $stmt->bindParam(":urlPhoto", $urlPhoto);
        $stmt->execute();
    }

    public function insertJadwal() {
        $idJ = $_POST['idJ'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];
        $namaMatkul = $_POST['namaMatkul'];

        $sql = "INSERT INTO Absen VALUES (:idJ, :startTime, :endTime, :namaMatkul)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":idJ", $idJ);
        $stmt->bindParam(":startTime", $startTime);
        $stmt->bindParam(":endTime", $endTime);
        $stmt->bindParam(":namaMatkul", $namaMatkul);
        $stmt->execute();
    }

    public function delete($column, $table) {
        $id = $_POST['id'];

        $stmt = $this->db->prepare("DELETE FROM $table WHERE $column=:$column");
        $stmt->bindParam(":$column", $id);
        $stmt->execute();
    }
}