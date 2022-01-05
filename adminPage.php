<?php namespace controllers; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Website Example</title>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    .fakeimg {
        height: 200px;
        background: #aaa;
        margin-top: 100px;
        margin-bottom: 100px;
        margin-right: 150px;
        margin-left: 80px;
    }
    </style>
</head>
<body>
    <div class="container text-center">
        <div class="jumbotron">
            <div class="h1 mt-4">Admin Page</div>
        </div>
        <div class="text-center" style="margin-top: 5%;">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Mahasiswa</th>
                    <th scope="col">Hadir</th>
                    <th scope="col">Confidence</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once "controller.php";

                        $con = new Controller();

                        // Dummy Data Absen
                        // $con->insertAbsen(100, 1, 1, 1);
                        // $con->insertAbsen(100, 1, 2, 2);

                        $absenList = $con->getAll('Absen');

                        $rowNum = 1;

                        // var_dump($absenList);

                        foreach($absenList as $absen) {
                            $data = $con->searchMahasiswaById($absen['id']);
                            // var_dump($data);

                            echo '<tr>';
                            echo '<th scope="row">' . $rowNum . '</th>';
                            echo '<td>' . $data[0]['nama'] . '</td>';
                            echo '<td>' . $absen['hadir'] . '</td>';
                            echo '<td>' . $absen['confidence'] . '</td>';
                            echo '</tr>';

                            $rowNum++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>