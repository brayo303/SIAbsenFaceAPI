<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@500&family=Roboto:wght@700&display=swap" rel="stylesheet">

    <style>
        .form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .form-grid {
            display:grid;
            grid-template-columns: max-content max-content;
            grid-gap:5px;
        }

        .form-grid label {
            text-align:right;
        }

        .form-grid label:after {
            content: ":";
        }

        .submit {
            margin-top: 10px;
        }
    </style>

    <title>Pendaftaran Mahasiswa</title>
</head>

<body class="bg-dark">
    <div class="mt-5 container text-center mx-auto text-light">
        <form class="form" action="datar_action.php" method="post" enctype="multipart/form-data">
            <div class="form-grid">
                <label for="">Nama</label>
                <input type="text" id="nama" name="nama" />
                <label for="">NPM</label>
                <input type="text" id="npm" name="npm" />
                <label for="">Upload foto</label>
                <input type="file" name="photo" id="photo" />
            </div>
            <input class="submit" type="submit" value="Daftar">
        </form>
    </div>
</body>

</html>