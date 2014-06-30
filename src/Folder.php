<?php

/**
 * Author: jos
 * Date: 5/15/13
 * Class NDFF folder
 * Creates a NDFF folder object
 */

namespace NDFF;

class Folder
{

    var $parentidentity;
    var $identity;
    var $description;
    var $foldertype;

    function __construct() {
        $this->setFoldertype('http://telmee.nl/folders/foldertypes/1');
        $this->setDescription('new folder');
    }

    function getParentidentity()     {
        return $this->parentidentity;
    }

    public function setParentidentity($parentidentity)    {
        $this->parentidentity = $parentidentity;
    }

    public function getIdentity()
    {
        return $this->identity;
    }

    public function setIdentity($identity)
    {
        $this->identity = $identity;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getFoldertype()
    {
        return $this->foldertype;
    }

    public function setFoldertype($foldertype)
    {
        $this->foldertype = $foldertype;
    }

}
