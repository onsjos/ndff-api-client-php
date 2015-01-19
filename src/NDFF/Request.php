<?php

/**
 * Author: jos
 * Date: 5/15/13
 * Class api_request
 * Generic class for consuming an (RESTful) API.
 * Constructs a cUrl handler for GET, POST, PUT, DELETE methods,
 * authenticate, send request, receive response.
 * Data will be (de)serialized, prior to sending and upon receiving.
 * Todo: Create setters and getters for filtering, sorting, language
 */

namespace NDFF;

class Request
{
    var $username;
    var $password;

    var $encoding_format;
    var $content_type;

    var $base_url;
    var $url_params;
    var $resource_id;

    var $resource;
    var $request_url;
    var $request_data;
    var $serialized_request_data;
    var $request_headers;

    var $response_data;
    var $response_headers;
    var $response_headers_string;

    function __construct($url=false, $username=false, $password=false, $encoding_format=false) {
        $this->base_url = ($url) ? $url : false;
        $this->username = ($username) ? $username : false;
        $this->password = ($password) ? $password : false;
        $this->encoding_format= ($encoding_format) ? $encoding_format : 'json';
        $this->content_type = ($this->encoding_format) ? 'Content-type: application/' . $this->encoding_format : false;
    }

    function __destruct() {
    }

    function build_url() {
        $url = rtrim($this->base_url, '/') . '/' . $this->resource . '/';
        $url .= ($this->resource_id) ? $this->resource_id . '/' : '';
        $url .= ($this->url_params) ? $this->url_params : '';
        return $url;
    }

    function curl_construct($resource, $resource_id=false) {
        $this->resource = $resource;
        if ($resource_id) {
            $this->resource_id = $resource_id;
        }
        $ch = curl_init();
        $this->request_url = $this->build_url();
        if ($this->username && $this->password) {
            curl_setopt($ch, CURLOPT_USERPWD, "$this->username:$this->password");
        }
        curl_setopt($ch, CURLOPT_URL, $this->request_url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        return $ch;
    }

    function curl_get($ch) {
        $response = curl_exec($ch);
        if(!curl_errno($ch))
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        if (!empty($header_size)) {
            $this->response_headers_string = substr($response, 0, $header_size);
            $this->response_data = substr($response, $header_size);
        }
        $this->response_headers = curl_getinfo($ch);
        curl_close($ch);
        return $this->response_data;
    }

    function get_headers() {
        return $this->response_headers;
    }

    function get_header_string() {
        return $this->response_headers_string;
    }

    function get_http_code() {
        if (!empty($this->response_headers['http_code'])) return $this->response_headers['http_code'];
        return false;
    }

    function get_request_data() {
        return $this->serialized_request_data;
    }

    public function set_request_data($request_data) {
        $this->request_data = $request_data;
        $this->serialize();
    }

    function get_response_data() {
        return $this->response_data;
    }

    function resource_get($resource, $resource_id=false) {
        $ch = $this->curl_construct($resource, $resource_id);
        curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
        return $this->curl_get($ch);
    }

    function resource_post($resource) {
        $ch = $this->curl_construct($resource, false, $this->get_request_data());
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( $this->content_type ));
        curl_setopt($ch, CURLOPT_POST, count($this->get_request_data()));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->get_request_data());
        curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
        return $this->curl_get($ch);
    }

    function resource_put($resource, $resource_id) {
        if ($resource_id) {
            $ch = $this->curl_construct($resource, $resource_id, $this->get_request_data());
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array( $this->content_type ));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->get_request_data());
            curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
            return $this->curl_get($ch);
        }
        return false;
    }

    function resource_delete($resource, $resource_id) {
        if ($resource_id) {
            $ch = $this->curl_construct($resource, $resource_id);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array( $this->content_type ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
            return $this->curl_get($ch);
        }
        return false;
    }

    function response_is_error() {
        $http_code = $this->get_http_code();
        if (is_integer($http_code) && $http_code > 299) return true;
        return false;
    }

    function response_is_success() {
        $http_code = $this->get_http_code();
        if (is_integer($http_code) && $http_code > 199 && $http_code < 300) return true;
        return false;
    }

    function serialize_json() {
        return json_encode((array)$this->request_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    function serialize() {
        switch ($this->encoding_format) {
            case 'json':
                $this->serialized_request_data = $this->serialize_json();
                break;
            case 'xml':
                $this->serialized_request_data = $this->serialize_xml();
                break;
            default:
                $this->serialized_request_data = array();
        }
        return true;
    }

    public function serialize_xml($node_block='object') {
        $xml = '<?xml version="1.0" encoding="UTF-8" ?>' . "\n";
        $xml .= '<' . $node_block . '>' . "\n";
        $xml .= $this->xml_encode((array)$this->request_data);
        $xml .= '</' . $node_block . '>' . "\n";
        return $xml;
    }

    function xml_encode($array, $node_name='object') {
        $xml = '';

        if (is_array($array) || is_object($array)) {
            foreach ($array as $key=>$value) {
                if (is_numeric($key)) {
                    $key = $node_name;
                }
                $xml .= '<' . $key . '>' . $this->xml_encode($value, $node_name) . '</' . $key . '>' . PHP_EOL;
            }
        } else {
            $xml .= htmlspecialchars($array, ENT_QUOTES);
        }
        return $xml;
    }
}
