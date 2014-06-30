<?php

/**
 * Author: jos
 * Date: 5/15/13
 * Get codes from the NDFF API
 * Todo: should only allow GET as it is a readonly resource
  */

namespace NDFF;

use NDFF\Request;

class CodeRequest extends Request
{

    var $project;

    function __construct($encoding_format=false) {
        $this->base_url = 'http://testapi.ndff.nl/list/v1/';
        // no authentication required
        parent::__construct($this->base_url, false, false, $encoding_format);
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

}
