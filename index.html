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

<body>
    <div class="container text-center mx-auto">
        <div class="mb-5"></div>
        <h1>Demo Webcam</h1>
        <div class="mb-5"></div>
        <div id="my_camera" class="mx-auto"></div>
        <div class="mb-3"></div>
        <input type=button value="Configure" onClick="configure()" class="btn btn-primary">
        <input type=button value="Take Snapshot" onClick="take_snapshot()" class="btn btn-secondary">
        <input type=button value="Save Snapshot" onClick="saveSnap()" class="btn btn-success">
        <div class="mb-3"></div>
        <div id="results"></div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="webcam.min.js"></script>
    <script>
        // Configure a few settings and attach camera
        function configure() {
            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach('#my_camera');
        }
        // A button for taking snaps
        // preload shutter audio clip
        var shutter = new Audio();
        shutter.autoplay = false;
        shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';

        function take_snapshot() {
            // play sound effect
            shutter.play();

            // take snapshot and get image data
            Webcam.snap(function(data_uri) {
                // display results in page
                document.getElementById('results').innerHTML =
                    '<img id="imageprev" src="' + data_uri + '"/>';
            });

            Webcam.reset();
        }

        function saveSnap() {
            // Get base64 value from <img id='imageprev'> source
            var base64image = document.getElementById("imageprev").src;

            Webcam.upload(base64image, 'upload.php', function(code, text) {
                console.log('Save successfully');
                //console.log(text);
            });

        }
    </script>
</body>

</html>