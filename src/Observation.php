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

    var $activity;
    var $biotope;
    var $datasetidentity;
    var $determinationmethod;
    var $extrainfo = [];
    var $involved = [];
    var $lifestage;
    var $location = [];
    var $locationname;
    var $observationidentity;
    var $originalabundance;
    var $periodstart;
    var $periodstop;
    var $scaleidentity;
    var $sex;
    var $subjecttypeidentity;
    var $surveymethod;
    var $taxonidentity;

    public function __construct() {
        $this->setActivity('http://ndff-ecogrid.nl/codes/domainvalues/observation/activities/unknown');
        $this->setBiotope('http://ndff-ecogrid.nl/codes/domainvalues/location/biotopes/unknown');
        $this->setDeterminationmethod('http://ndff-ecogrid.nl/codes/domainvalues/observation/determinationmethods/unknown');
        $this->setLifestage('http://ndff-ecogrid.nl/codes/domainvalues/observation/lifestages/unknown');
        $this->setLocation(0, '', 'http://ndff-ecogrid.nl/codes/locationtypes/point');
        $this->setOriginalabundance(0);
        $this->setPeriodstart(date('o-m-N\TH:i:s'));
        $this->setPeriodstop(date('o-m-N\TH:i:s', strtotime(date('c')) + 1));
        $this->setScaleidentity('http://ndff-ecogrid.nl/codes/scales/exact_count');
        $this->setSex('http://ndff-ecogrid.nl/codes/domainvalues/observation/sexes/undefined');
        $this->setSubjecttypeidentity('http://ndff-ecogrid.nl/codes/subjecttypes/live/individual');
        $this->setSurveymethod('http://ndff-ecogrid.nl/codes/domainvalues/survey/surveymethods/unknown');
    }

    public function getActivity()    {
        return $this->activity;
    }

    public function setActivity($activity)    {
        $this->activity = $activity;
    }

    public function getBiotope()    {
        return $this->biotope;
    }

    public function setBiotope($biotope)    {
        $this->biotope = $biotope;
    }

    public function getDatasetidentity()    {
        return $this->datasetidentity;
    }

    public function setDatasetidentity($datasetidentity)    {
        $this->datasetidentity = $datasetidentity;
    }

    public function getDeterminationmethod()    {
        return $this->determinationmethod;
    }

    public function setDeterminationmethod($determinationmethod)    {
        $this->determinationmethod = $determinationmethod;
    }

    public function addExtrainfo($field_identity, $field_type, $field_value) {
        $ft  = ($field_type == 'nominal') ? $ft = 'nominalvalueidentity' : $ft = $field_type . 'value';
        $ei = array(
            'keyidentity' => $field_identity,
            'value' => array($ft => $field_value)
        );
        array_push($this->extrainfo, $ei);
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
    public function addInvolved($person_identity, $involvement_type_identity) {
        $inv = array(
            'personidentity' => $person_identity,
            'involvementtypeidentity' => $involvement_type_identity
        );
        array_push($this->involved, $inv);
    }
    public function getLifestage()    {
        return $this->lifestage;
    }

    public function setLifestage($lifestage)    {
        $this->lifestage = $lifestage;
    }

    public function getLocation()    {
        return $this->location;
    }

    public function setLocation($buffer, $ewkt, $locationtypeidentity)    {
        $this->location['buffer'] = $buffer;
        $this->location['ewkt'] = $ewkt;
        $this->location['locationtypeidentity'] = $locationtypeidentity;
    }

    public function getLocationname()    {
        return $this->locationname;
    }

    public function setLocationname($locationname)    {
        $this->locationname = $locationname;
    }

    public function getObservationidentity()    {
        return $this->observationidentity;
    }

    public function setObservationidentity($observationidentity)    {
        $this->observationidentity = $observationidentity;
    }

    public function getOriginalabundance()    {
        return $this->originalabundance;
    }

    public function setOriginalabundance($originalabundance)    {
        $this->originalabundance = $originalabundance;
    }

    public function getPeriodstart()    {
        return $this->periodstart;
    }

    public function setPeriodstart($periodstart)    {
        $this->periodstart = $periodstart;
    }

    public function getPeriodstop()    {
        return $this->periodstop;
    }

    public function setPeriodstop($periodstop)    {
        $this->periodstop = $periodstop;
    }

    public function getScaleidentity()    {
        return $this->scaleidentity;
    }

    public function setScaleidentity($scaleidentity)    {
        $this->scaleidentity = $scaleidentity;
    }

    public function getSex()    {
        return $this->sex;
    }

    public function setSex($sex)    {
        $this->sex = $sex;
    }

    public function getSubjecttypeidentity()    {
        return $this->subjecttypeidentity;
    }

    public function setSubjecttypeidentity($subjecttypeidentity)    {
        $this->subjecttypeidentity = $subjecttypeidentity;
    }

    public function getSurveymethod()    {
        return $this->surveymethod;
    }

    public function setSurveymethod($surveymethod)    {
        $this->surveymethod = $surveymethod;
    }

    public function getTaxonidentity()    {
        return $this->taxonidentity;
    }

    public function setTaxonidentity($taxonidentity)    {
        $this->taxonidentity = $taxonidentity;
    }

}
