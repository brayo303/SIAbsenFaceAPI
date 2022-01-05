<?php
    namespace controllers;

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
                'Content-Type: application/json'
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
                'Content-Type: application/json'
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_URL, "https://unparfaceapi.cognitiveservices.azure.com/face/v1.0/persongroups/groupmahasiswa/persons/".$personId);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            return json_decode(curl_exec($curl));
        }

        // parameter url foto absen
        // deskripsi: mendapatkan nama dan confidence dari foto yang dibuat
        // return Array berisi personId, name, confidence
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

            if(empty($array)){
                return false;
            }
            $faceId = $array[0]->faceId;

            $curl = curl_init("https://unparfaceapi.cognitiveservices.azure.com/face/v1.0/identify");
            $headers = array(
                'Ocp-Apim-Subscription-Key: '.$_ENV['API_KEY'],
                'Content-Type: application/json'
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
            $confidence = $array[0]->candidates[0]->confidence;
            $name = $this->getMahasiswaById($personId)->name;

            $output = array(
                "personId" => $personId,
                "confidence" => $confidence,
                "name" => $name
            );
            return $output;
        }
        
        // parameter nama mahasiswa dan url gambar mahasiswa
        // deskripsi: memasukkan mahasiswa ke group dan wajahnya, juga melakukan train
        // return true jika berhasil, false jika gagal di salah satu langkah
        function addMahasiswa($name, $url){
            //add person
            $curl = curl_init('https://unparfaceapi.cognitiveservices.azure.com/face/v1.0/persongroups/groupmahasiswa/persons');
            $headers = array(
                'Ocp-Apim-Subscription-Key: '.$_ENV['API_KEY'],
                'Content-Type: application/json'
            );
            $data = json_encode(array(
                "name" => $name
            ));

            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $personId = (json_decode(curl_exec($curl)))->personId;
            curl_close($curl);

            //add face
            $curl = curl_init('https://unparfaceapi.cognitiveservices.azure.com/face/v1.0/persongroups/groupmahasiswa/persons/'.$personId.'/persistedFaces');
            $headers = array(
                'Ocp-Apim-Subscription-Key: '.$_ENV['API_KEY'],
                'Content-Type: application/json'
            );
            $data = json_encode(array(
                "url" => $url
            ));

            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            if(curl_exec($curl) === false){
                return false;
            }
            curl_close($curl);
            
            //train
            $curl = curl_init('https://unparfaceapi.cognitiveservices.azure.com/face/v1.0/persongroups/groupmahasiswa/train');
            $headers = array(
                'Ocp-Apim-Subscription-Key: '.$_ENV['API_KEY']
            );

            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, array());
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            if(curl_exec($curl) === false){
                return false;
            }
            curl_close($curl);

            return true;
        }
    }
?>