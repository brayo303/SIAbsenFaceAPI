<?php

    if (empty($_ENV)) {
        include "./DotEnv.php";
        (new DotEnv(__DIR__ . '/.env'))->load();
    }

    class API{

        // deskripsi: Mendapatkan semua daftar mahasiswa
        // return Array of Person
        function getAllMahasiswa(){
            //curl command
            $curl = curl_init();
            $headers = array(
                'Ocp-Apim-Subscription-Key: '.$_ENV['API_KEY'],
                'Content-Type: application/json',
            
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_URL, "https://unparfaceapi.cognitiveservices.azure.com/face/v1.0/persongroups/groupmahasiswa/persons");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
           
            return json_decode(curl_exec($curl));
        }

        // parameter personId
        // deskripsi: Mendapatkan semua daftar mahasiswa
        // return Array of Person
        function getMahasiswaById($personId){
            $curl = curl_init();
            $headers = array(
                'Ocp-Apim-Subscription-Key: '.$_ENV['API_KEY'],
                'Content-Type: application/json',
            
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_URL, "https://unparfaceapi.cognitiveservices.azure.com/face/v1.0/persongroups/groupmahasiswa/persons/".$personId);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            return json_decode(curl_exec($curl));
        }

        // parameter personId
        // deskripsi: Mendapatkan semua daftar mahasiswa
        // return Array of Person
        function detectFace($url){
            $curl = curl_init("https://unparfaceapi.cognitiveservices.azure.com/face/v1.0/detect?faceIdTimeToLive=300&recognitionModel=recognition_04");
            $headers = array(
                'Ocp-Apim-Subscription-Key: '.$_ENV['API_KEY'],
                'Content-Type: application/json',
            
            );
            $data = json_encode(array(
                'url' => $url
            ));

            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $array= json_decode(curl_exec($curl));
            curl_close($curl);

            $faceId = $array[0]->faceId;

            $curl = curl_init("https://unparfaceapi.cognitiveservices.azure.com/face/v1.0/identify");
            $headers = array(
                'Ocp-Apim-Subscription-Key: '.$_ENV['API_KEY'],
                'Content-Type: application/json',
            
            );
            $data = json_encode(array(
                "faceIds" => [
                    $faceId
                ],
                "personGroupId" => "groupmahasiswa",
                "maxNumOfCandidatesReturned" => 1,
                "confidenceThreshold" => 0.5
            ));

            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $array= json_decode(curl_exec($curl));
            curl_close($curl);

            $personId = $array[0]->candidates[0]->personId;
            $mahasiswa = $this->getMahasiswaById($personId);
            return $mahasiswa;
        }
    }

    $api = new API();
    $output = $api->detectFace('https://brayo303.github.io/img/6181801031_Bryan%20Heryanto_Foto.jpg');
    var_dump($output);

?>