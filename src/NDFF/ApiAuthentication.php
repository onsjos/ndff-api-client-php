<?php

/**
 * Author: jos
 * Date: 3/26/18
 * Class ndff_api_authentication
 */

namespace NDFF;

const TOKEN_URL = 'https://testapi.ndff.nl/o/v2/';

class ApiAuthentication
{

    var $token;

    public function getToken() {
        return $this->token;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function authenticate($username, $password, $client_id, $client_secret=false, $grant_type='password'){
        $ch = curl_init();
        $credentials = array(
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'grant_type' => $grant_type,
            'username' => $username,
            'password' => $password
        );

        curl_setopt_array($ch, array(
            CURLOPT_URL => TOKEN_URL . 'token/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($credentials),
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache",
                "Content-Type: application/x-www-form-urlencoded",
            ),
        ));

        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        if (array_key_exists('http_code', $info) && $info['http_code'] == 200) {
            $data = json_decode($response, true);
            $this->setToken($data['access_token']);
        }
        curl_close($ch);
        return $response;
    }


}