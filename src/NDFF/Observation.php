<?php

/**
 * Author: jos
 * Date: 5/15/13
 * Class ndff_observation
 * Creates a NDFF observation object with default values
 */

namespace NDFF;

class Observation
{
    var $abundanceSchema;
    var $abundanceValue;
    var $activity;
    var $biotope;
    var $dataset;
    var $determinationMethod;
    var $extrainfo = [];
    var $identity;
    var $involved = [];
    var $lifestage;
    var $location = [];
    var $periodStart;
    var $periodStop;
    var $sex;
    var $subjectType;
    var $surveyMethod;
    var $taxon;
    
    /**
     * Create new Observation with default values
     */
    public function __construct() {
        $this->setAbundanceSchema('http://ndff-ecogrid.nl/codes/scales/exact_count');
        $this->setAbundanceValue(0);
        $this->setActivity('http://ndff-ecogrid.nl/codes/domainvalues/observation/activities/unknown');
        $this->setBiotope('http://ndff-ecogrid.nl/codes/domainvalues/location/biotopes/unknown');
        $this->setDeterminationMethod('http://ndff-ecogrid.nl/codes/domainvalues/observation/determinationmethods/unknown');
        $this->setLifestage('http://ndff-ecogrid.nl/codes/domainvalues/observation/lifestages/unknown');
        $this->setLocation(0, '');
        $this->setPeriodStart(date('o-m-d\TH:i:s'));
        $this->setSex('http://ndff-ecogrid.nl/codes/domainvalues/observation/sexes/undefined');
        $this->setSubjectType('http://ndff-ecogrid.nl/codes/subjecttypes/live/individual');
        $this->setSurveyMethod('http://ndff-ecogrid.nl/codes/domainvalues/survey/surveymethods/unknown');
    }


    public function getAbundanceSchema()    {
        return $this->abundanceSchema;
    }
    /**
     *
     * @param string $abundanceSchema
     */
    public function setAbundanceSchema($abundanceSchema)    {
        $this->abundanceSchema = $abundanceSchema;
    }

    public function getAbundanceValue()    {
        return $this->abundanceValue;
    }
    /**
     *
     * @param string $abundanceValue
     */
    public function setAbundanceValue($abundanceValue)    {
        $this->abundanceValue = $abundanceValue;
    }

    public function getActivity()    {
        return $this->activity;
    }
    /**
     *
     * @param string $activity
     */
    public function setActivity($activity)    {
        $this->activity = $activity;
    }

    public function getBiotope()    {
        return $this->biotope;
    }
    /**
     *
     * @param string $biotope
     */
    public function setBiotope($biotope)    {
        $this->biotope = $biotope;
    }

    public function getDataset()    {
        return $this->dataset;
    }
    /**
     *
     * @param string $dataset
     */
    public function setDataset($dataset)    {
        $this->dataset = $dataset;
    }

    public function getDeterminationMethod()    {
        return $this->determinationMethod;
    }
    /**
     *
     * @param string $determinationMethod
     */
    public function setDeterminationMethod($determinationMethod)    {
        $this->determinationMethod = $determinationMethod;
    }

    /**
     *
     * @param string $key , keyidentity id van extra-info veld
     * @param string $value waarde voor veld
     * @return int
     */
    public function addExtrainfo($key, $value) {
        return array_push($this->extrainfo, array('key' => $key,'value' => $value));
    }

    public function getExtrainfo()    {
        return $this->extrainfo;
    }

    public function setExtrainfo($extrainfo)    {
        $this->extrainfo = $extrainfo;
    }

    public function getInvolved()    {
        return $this->involved;
    }

    public function setInvolved($involved)    {
        $this->involved = $involved;
    }
    /**
     *
     * @param string $person id (URI) van persoon
     * @param string $involvement_type
     */
    public function addInvolved($person, $involvement_type) {
        array_push($this->involved, array('person' => $person, 'involvementType' => $involvement_type));
    }
    public function getLifestage()    {
        return $this->lifestage;
    }
    /**
     *
     * @param string $lifestage
     */
    public function setLifestage($lifestage)    {
        $this->lifestage = $lifestage;
    }

    public function getLocation()    {
        return $this->location;
    }
    /**
     *
     * @param int $buffer
     * @param string $geometry
     */
    public function setLocation($buffer, $geometry)    {
        $this->location['buffer'] = $buffer;
        $this->location['geometry'] = $geometry;
    }

    public function getIdentity()    {
        return $this->identity;
    }
    /**
     *
     * @param string $identity
     */
    public function setIdentity($identity)    {
        $this->identity = $identity;
    }

    public function getPeriodStart()    {
        return $this->periodStart;
    }
    /**
     * 
     * @param string $periodStart
     */
    public function setPeriodStart($periodStart)    {
        $this->periodStart = $periodStart;
    }

    public function getPeriodStop()    {
        return $this->periodStop;
    }
    /**
     * 
     * @param string $periodStop
     */
    public function setPeriodStop($periodStop)    {
        $this->periodStop = $periodStop;
    }

    public function getSex()    {
        return $this->sex;
    }
    /**
     *
     * @param string $sex
     */
    public function setSex($sex)    {
        $this->sex = $sex;
    }

    public function getSubjectType()    {
        return $this->subjectType;
    }
    /**
     *
     * @param string $subjectType
     */
    public function setSubjectType($subjectType)    {
        $this->subjectType = $subjectType;
    }

    public function getSurveyMethod()    {
        return $this->surveyMethod;
    }
    /**
     *
     * @param string $surveyMethod
     */
    public function setSurveyMethod($surveyMethod)    {
        $this->surveyMethod = $surveyMethod;
    }

    public function getTaxon()    {
        return $this->taxon;
    }
    /**
     * 
     * @param string $taxon
     */
    public function setTaxon($taxon)    {
        $this->taxon = $taxon;
    }

}
