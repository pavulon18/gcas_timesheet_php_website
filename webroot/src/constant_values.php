<?php

class constantvalues
{

    private $ID;
    private $referenceDate;
    
    function __construct()
    {
        
    }

    function __getID($ID)
    {
        return $this->$ID;
    }

    function __setID($ID, $newID)
    {
        $this->$ID = $newID;
    }

    function __getReferenceDate($referenceDate)
    {
        return $this->$referenceDate;
    }

    function __setReferenceDate($referenceDate, $newReferenceDate)
    {
        $this->$referenceDate = $newReferenceDate;
    }
    
}
