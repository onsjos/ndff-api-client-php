<?php

/**
 * Author: jos
 * Date: 5/15/13
 * Class ndff_api_request
 * Extends class api_request by providing NDFF API project to url and some minor xml encoding adjustments
 */

namespace NDFF;

use NDFF\Request;

class ApiRequest extends Request
{

    var $project;

    function __construct($base_url = 'http://testapi.ndff.nl/api/v1/',$project=false, $username=false, $password=false, $encoding_format=false) {        
        $this->project = $project;
        parent::__construct($base_url, $username, $password, $encoding_format);
    }

    function __destruct() {
        parent::__destruct();
    }

    function build_url() {
        $url = rtrim($this->base_url, '/') . '/' . $this->project . '/' . $this->resource . '/';
        $url .= ($this->resource_id) ? $this->resource_id . '/' : '';
        $url .= ($this->url_params) ? $this->url_params : '';
        return $url;
    }

    function xml_encode($array, $node_name='object') {
        $xml = '';

        if (is_array($array) || is_object($array)) {
            foreach ($array as $key=>$value) {
                if (is_numeric($key)) {
                    $key = $node_name;
                }
                if (in_array($key, array('extrainfo', 'involved'))) {
                    $xml .= '<' . $key . ' type="list">' . $this->xml_encode($value, $node_name) . '</' . $key . '>' . PHP_EOL;
                } else if (in_array($key, array('value'))) {
                    $xml .= '<' . $key . ' type="hash">' . $this->xml_encode($value, $node_name) . '</' . $key . '>' . PHP_EOL;
                } else {
                    $xml .= '<' . $key . '>' . $this->xml_encode($value, $node_name) . '</' . $key . '>' . PHP_EOL;
                }
            }
        } else {
            $xml .= htmlspecialchars($array, ENT_QUOTES);
        }
        return $xml;
    }

}