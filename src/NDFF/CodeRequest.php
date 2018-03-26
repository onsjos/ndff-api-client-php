<?php

/**
 * Author: jos
 * Date: 5/15/13
 * Get codes from the NDFF API
 */

namespace NDFF;



class CodeRequest extends Request
{
    var $url_params = array('paginator' => 'None');

    function __construct() {
        // no authentication required
        parent::__construct(false);
        parent::setBaseUrl(parent::CODES_URL);
    }

    function __destruct() {
        parent::__destruct();
    }

    function readOnly() {
        try {
            $error = 'NDFF codes are readonly';
            throw new \Exception($error);
        } catch (\Exception $e) {
            echo 'Exception: ',  $e->getMessage(), "\n";
        }
    }
    function resource_post($resource, $data) {
        $this->readOnly();
    }

    public function resource_put($resource, $resource_id, $data) {
        $this->readOnly();
    }

    function resource_delete($resource, $resource_id) {
        $this->readOnly();
    }
}
