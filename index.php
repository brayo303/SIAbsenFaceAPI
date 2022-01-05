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
    <link rel="stylesheet" href="style.css">

    <title>Demo Webcam</title>
</head>

<body class="bg-dark">
    <div class="mt-5 container text-center mx-auto text-light">
        <div class="row">
            <div class="col-sm-6 d-flex justify-content-center align-items-center">
                <h1 class="display-6">Nama Matakuliah: </h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-center align-items-center">
                <div class="dropdown">
                    <button class="btn dropdown-toggle btn-secondary" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        Pilih Mata Kuliah
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item active" href="#">Matakuliah 1</a></li>
                        <li><a class="dropdown-item" href="#">Matakuliah 2</a></li>
                        <li><a class="dropdown-item" href="#">Matakuliah 3</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="my_camera" class="mx-auto mt-5 mb-4"></div>
        <form action="">
            <div id="pre_take_buttons">
                <!-- This button is shown before the user takes a snapshot -->
                <input type=button value="Ambil Gambar" onClick="preview_snapshot()" class="btn btn-primary">
            </div>
            <div id="post_take_buttons" style="display:none">
                <!-- These buttons are shown after a snapshot is taken -->
                <input type=button value="Ambil Ulang" onClick="cancel_preview()" class="btn btn-danger shadow rounded">
                <input type=button data-bs-toggle="modal" data-bs-target="#exampleModal" value="Simpan Gambar" onClick="save_photo()" class="btn btn-success shadow rounded">
            </div>
        </form>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hasil Gambar</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.reload();"></button>
                    </div>
                    <div class="modal-body" id="hasil-gambar">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="window.location.reload();">Tutup</button>
                        <button type=" button" class="btn btn-primary" onclick="simpanGambar()">Absen</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="results"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="webcam.min.js"></script>
    <div id="results" style="display:none">
        <!-- Your captured image will appear here... -->
    </div>
    <script>
        Webcam.set({
            // live preview size
            width: 320,
            height: 240,

            // device capture size
            dest_width: 640,
            dest_height: 480,

            // final cropped size
            crop_width: 480,
            crop_height: 480,

            // format and quality
            image_format: 'jpeg',
            jpeg_quality: 90,

            // flip horizontal (mirror mode)
            flip_horiz: true
        });
        Webcam.attach('#my_camera');
    </script>
    <!-- Code to handle taking the snapshot and displaying it locally -->
    <script>
        // preload shutter audio clip
        var shutter = new Audio();
        shutter.autoplay = false;
        shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';

        function preview_snapshot() {
            // play sound effect
            try {
                shutter.currentTime = 0;
            } catch (e) {
                ;
            } // fails in IE
            shutter.play();

            // freeze camera so user can preview current frame
            Webcam.freeze();

            // swap button sets
            document.getElementById('pre_take_buttons').style.display = 'none';
            document.getElementById('post_take_buttons').style.display = '';
        }

        function cancel_preview() {
            // cancel preview freeze and return to live camera view
            Webcam.unfreeze();

            // swap buttons back to first set
            document.getElementById('pre_take_buttons').style.display = '';
            document.getElementById('post_take_buttons').style.display = 'none';
        }
        var imageLinks = "";

        function save_photo() {
            // actually snap photo (from preview freeze) and display it
            Webcam.snap(function(data_uri) {
                // display results in page
                document.getElementById('hasil-gambar').innerHTML =
                    '<img src="' + data_uri + '"/><br/></br>';
                imageLinks = data_uri;
                // shut down camera, stop capturing
                Webcam.reset();

                // show results, hide photo booth
                document.getElementById('results').style.display = '';
                document.getElementById('my_photo_booth').style.display = 'none';

            });
        }

        function simpanGambar() {
            var gh = imageLinks;
            var a = document.createElement('a');
            a.href = gh;
            a.download = 'image.jpeg';

            a.click()
        }
    </script>
</body>

</html>