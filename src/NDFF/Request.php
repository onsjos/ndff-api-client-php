<?php

/**
 * Author: jos
 * Date: 5/15/13
 * Class api_request
 * Generic class for consuming NDFF API.
 * Constructs a cUrl handler for GET, POST, PUT, DELETE methods,
 * authenticate, send request, receive response.
 * Todo: Create setters and getters for filtering, sorting, language
 */

namespace NDFF;

class Request
{
    const API_URL = 'https://testapi.ndff.nl/api/v2/';
    const CODES_URL = 'https://testapi.ndff.nl/codes/v2/';

    var $content_type;

    var $base_url;
    var $url_params = [];
    var $resource_id;

    var $resource;
    var $request_url;
    var $request_data;
    var $request_headers;

    var $response_data;
    var $response_links;
    var $response_headers;
    var $response_headers_string;

    protected function __construct($token=false) {
        $this->content_type = 'Content-type: application/json';
    }

    protected function __destruct() {
    }

    public function getBaseUrl() {
        return $this->base_url;
    }

    /**
     * @param string $url
     */
    public function setBaseUrl($url) {
        $this->base_url = $url;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setUrlParameter($key, $value) {
        $this->url_params[$key] = $value;
    }

    function build_url() {
        $url = $this->getBaseUrl() . $this->resource . '/';
        $url .= ($this->resource_id) ? $this->resource_id . '/' : '';
        if ($this->url_params) {
                $url .= '?' . http_build_query($this->url_params);
        }
        return $url;
    }

    public function curl_construct($resource, $resource_id=false) {
        $this->resource = $resource;
        if ($resource_id) {
            $this->resource_id = $resource_id;
        }
        $ch = curl_init();
        $this->request_url = $this->build_url();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($this->content_type));
        curl_setopt($ch, CURLOPT_URL, $this->request_url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        return $ch;
    }

    public function curl_get($ch) {
        $response = curl_exec($ch);
        if(!curl_errno($ch))
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        if (!empty($header_size)) {
            $this->response_headers_string = substr($response, 0, $header_size);
            $data = json_decode(substr($response, $header_size), true);
            $this->response_data = $data;
        }
        $this->response_headers = curl_getinfo($ch);
        curl_close($ch);
        return $this->response_data;
    }

    public function get_headers() {
        return $this->response_headers;
    }

    public function get_header_string() {
        return $this->response_headers_string;
    }

    public function get_location_header() {
        if (preg_match('~Location: (.*)~i', $this->response_headers_string, $match)) {
            return trim($match[1]);
        }
    }

    public function get_http_code() {
        if (!empty($this->response_headers['http_code'])) return $this->response_headers['http_code'];
        return false;
    }

    public function get_request_data() {
        return $this->request_data;
    }

    public function set_request_data($request_data) {
        // $this->request_data = json_encode((array)$request_data, JSON_UNESCAPED_SLASHES);
        $this->request_data = json_encode((array)$request_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        print_r($this->get_request_data());
    }

    public function get_response_data() {
        return $this->response_data;
    }

    public function resource_get($resource, $resource_id=false) {
        $ch = $this->curl_construct($resource, $resource_id);
        curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
        return $this->curl_get($ch);
    }

    public function resource_post($resource, $data) {
        $this->set_request_data($data);
        $ch = $this->curl_construct($resource, false);
        curl_setopt($ch, CURLOPT_POST, count($this->get_request_data()));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->get_request_data());
        curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
        return $this->curl_get($ch);
    }

    public function resource_put($resource, $resource_id, $data) {
        if ($resource_id) {
            $this->set_request_data($data);
            $ch = $this->curl_construct($resource, $resource_id);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->get_request_data());
            curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
            return $this->curl_get($ch);
        }
        return false;
    }

    public function resource_delete($resource, $resource_id) {
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

    public function response_is_error() {
        $http_code = $this->get_http_code();
        if (is_integer($http_code) && $http_code > 299) return true;
        return false;
    }

    public function response_is_success() {
        $http_code = $this->get_http_code();
        if (is_integer($http_code) && $http_code > 199 && $http_code < 300) return true;
        return false;
    }

}
