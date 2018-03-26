<?php

/**
 * Author: jos
 * Date: 5/15/13
 * Class ndff_api_request
 * Extends class api_request by providing NDFF API domain(_id) to url
 */

namespace NDFF;



class ApiRequest extends Request
{
    var $token;
    var $domain_id;

    function __construct($domain_id=false, $token=false, $encoding_format=false) {
        $this->domain_id = ($domain_id) ? $domain_id : false;
        $this->token = ($token) ? $token : false;
        parent::__construct($encoding_format);
        parent::setBaseUrl(parent::API_URL);
    }

    function __destruct() {
        parent::__destruct();
    }

    private function map($resource, $data){
        switch ($resource) {
            case 'observations':
                $obj = new Observation();
                break;
            case 'datasets':
                $obj = new Dataset();
                break;
            case 'persons':
                $obj = new Person();
                break;
            case 'domains':
                $obj = new Domain();
                break;
            default:
                $obj = new \stdClass();
        }
        foreach ($obj as $key => $value) {
            if (array_key_exists($key, $data)) {
                $obj->$key = $data[$key];
            }
        }
        return $obj;
    }

    public function curl_get($ch) {
        $data = parent::curl_get($ch);
        return $this->map($this->resource, $data);
    }

    function curl_construct($resource, $resource_id=false) {
        $ch = parent::curl_construct($resource, $resource_id);
        if ($this->token) {
            $authorization = "Authorization: Bearer " . $this->token;
            curl_setopt($ch, CURLOPT_HTTPHEADER, array($authorization, $this->content_type));
        }
        return $ch;
    }

    public function getDomain() {
        return $this->domain_id;
    }


    /**
     * @param int $domain_id
     */
    public function setDomain($domain_id) {
        $this->domain_id = $domain_id;
    }

    function build_url() {
        if ($this->resource == 'domains') {
            $url = $this->base_url . $this->resource . '/';
        } else {
            $url = $this->base_url . 'domains/' . $this->domain_id . '/' . $this->resource . '/';
        }
        $url .= ($this->resource_id) ? $this->resource_id . '/' : '';
        if ($this->url_params) {
            $url .= '?' . http_build_query($this->url_params);
        }
        return $url;
    }

}