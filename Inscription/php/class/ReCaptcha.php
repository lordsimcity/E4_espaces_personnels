<?php

namespace Registration;

class ReCaptcha {

    private $_secret;

    function __construct($secret) {

        $this->secret = $secret; 
        
    }

    public function checkCode($code) {

        if(empty($code))
        {
            return false;
        }

        $url = "https://www.google.com/recaptcha/api/siteverify?secret={$this->secret}&response={$code}";

        if(function_exists('curl_version'))
        {
            $curl = curl_init($url);

            curl_setopt($curl, CURLOPT_HEADER, false);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            // Si le support Google n'est pas accessible, on abandonne la requête au bout d'1 seconde :
            curl_setopt($curl, CURLOPT_TIMEOUT, 1);

            $response = curl_exec($curl);

        }
        else
        {
            $response = file_get_contents($url);
        }


        if(empty($response) || is_null($response))
        {
            return false;
        }

        $json = json_decode($response);
        return $json->success;

    }

}