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
        
        <div id="my_camera" class="mx-auto mt-5 mb-4"></div>
        <form action="">
            <div id="pre_take_buttons">
                <!-- This button is shown before the user takes a snapshot -->
                <input type=button value="Absen" onClick="preview_snapshot()" class="btn btn-primary">
            </div>
        </form>
        
    </div>
    <div class="modal " id ="modal" style="justify-content: center;" tabindex="-1" role="dialog">
        <div class="modal-dialog-centered" role="document" style = "width:50vh">
            <div class="modal-content bg-secondary">
            
                <div class="modal-header">
                    <h1 class="text-light" id="headermodal">Absensi Berhasil</h1>
                </div class="modal-body">
                <div style="padding:2vh">
                    <div class="rounded-circle" style="height:50vh;width:100%; overflow:hidden">
                        <img src = "upload/bryan.jpg" style= "width:100%" id ="foto">
                        
                    </div>
                    <h5 class="text-light" id = "nama" >Nama Mahasiswa : Bryan Heryanto</h1>
                <div>
            
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="webcam.min.js"></script>
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
        var photoLink;
        function preview_snapshot() {
            // play sound effect
            try {
                shutter.currentTime = 0;
            } catch (e) {
                ;
            } // fails in IE
            // shutter.play();

            // freeze camera so user can preview current frame
            //Webcam.freeze();

            // swap button sets
           
            save_photo();
            simpanGambar();
            //getResponse();
        }

        var imageLinks = "";

        function save_photo() {
            // actually snap photo (from preview freeze) and display it
            Webcam.snap(function(data_uri) {
                Webcam.freeze();
                imageLinks = data_uri;
                

                
                
               
            });

           
        }

        function simpanGambar() {
            Webcam.upload( imageLinks, 'upload.php', function(code, text) {
                var obj = JSON.parse(text);
                console.log(text);
                if(obj['status']==1){
                	document.querySelector("#headermodal").textContent='Berhasil Absen';
	                document.querySelector("#nama").textContent=obj['name'];
	                document.querySelector("#foto").src=obj['urlfoto'];
	                document.querySelector("#modal").style.display='flex';
            	}else{
            		document.querySelector("#headermodal").textContent='Gagal Absen';
	                document.querySelector("#foto").src='';
	                document.querySelector("#modal").style.display='flex';
	                document.querySelector("#nama").textContent='silakan coba lagi';
            	}
                setTimeout(reset, 1000);
            });
            

        }

        

        
        

        function reset(){
            Webcam.unfreeze();
            document.querySelector("#modal").style.display='none';
        }

        
    </script>
</body>

</html>