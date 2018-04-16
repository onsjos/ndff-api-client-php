<?php

/**
 * Author: jos
 * Date: 3/26/18
 * Class NDFF dataset
 * an NDFF Dataset object
 */

namespace NDFF;

class Dataset
{

    var $datasetType;
    var $description;
    var $duration;
    var $extrainfo;
    var $identity;
    var $involved;
    var $location;
    var $locationCoverage;
    var $parent;
    var $periodStart;
    var $periodStop;
    var $protocol;


    function __construct() {
    }

    /**
     * @return mixed
     */
    public function getDuration(){
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration){
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getExtrainfo()
    {
        return $this->extrainfo;
    }

    /**
     * @param mixed $extrainfo
     */
    public function setExtrainfo($extrainfo)
    {
        $this->extrainfo = $extrainfo;
    }

    /**
     * @return mixed
     */
    public function getInvolved()
    {
        return $this->involved;
    }

    /**
     * @param mixed $involved
     */
    public function setInvolved($involved)
    {
        $this->involved = $involved;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getLocationCoverage()
    {
        return $this->locationCoverage;
    }

    /**
     * @param mixed $locationCoverage
     */
    public function setLocationCoverage($locationCoverage)
    {
        $this->locationCoverage = $locationCoverage;
    }

    /**
     * @return mixed
     */
    public function getPeriodStart()
    {
        return $this->periodStart;
    }

    /**
     * @param mixed $periodStart
     */
    public function setPeriodStart($periodStart)
    {
        $this->periodStart = $periodStart;
    }

    /**
     * @return mixed
     */
    public function getPeriodStop()
    {
        return $this->periodStop;
    }

    /**
     * @param mixed $periodStop
     */
    public function setPeriodStop($periodStop)
    {
        $this->periodStop = $periodStop;
    }

    /**
     * @return mixed
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param mixed $protocol
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
    }

    function getParent()     {
        return $this->parent;
    }

    public function setParent($parent)    {
        $this->parent = $parent;
    }

    public function getIdentity(){
        return $this->identity;
    }

    public function setIdentity($identity){
        $this->identity = $identity;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getDatasetType(){
        return $this->datasetType;
    }

    public function setDatasetType($dataset_type)
    {
        $this->datasetType = $dataset_type;
    }

}
