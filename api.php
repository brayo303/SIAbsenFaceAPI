<?php
    include "./DotEnv.php";

    (new DotEnv(__DIR__ . '/.env'))->load();

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
        function getAllMahasiswaById($personId){
            $curl = curl_init();
            $headers = array(
                'Ocp-Apim-Subscription-Key: '.$_ENV['API_KEY'],
                'Content-Type: application/json',
            
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_URL, "https://unparfaceapi.cognitiveservices.azure.com/face/v1.0/persongroups/groupmahasiswa/persons");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $array= json_decode(curl_exec($curl));
           
            $person = array();
            
            for ($it = 0; $it < sizeof($array); $it++) {
                $curobj =  get_object_vars($array[$it]);
                $person[]=new Person($array[$it]->personId,$array[$it]->persistedFaceIds,$array[$it]->name);
            } 
            return $person;
        }
    }

    $api = new API();
    var_dump($api->getAllMahasiswa());
?>