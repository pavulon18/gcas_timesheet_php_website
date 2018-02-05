class jobtitles
{
private $JobTitleID;
private $JobTitle;
private $Duties;
private $PayType;
private $PayRateBasis;
private $FullorPartTime;
private $EffectiveStartDateTime;
private $EffectiveEndDateTime;
private $Insertedat;
private $Deletedat;
function __getJobTitleID ($JobTitleID)
{
    return $this->$JobTitleID;
}

function __setJobTitleID ($JobTitleID, $newJobTitleID)
{
    $this->$JobTitleID = $newJobTitleID;
}

function __getJobTitle ($JobTitle)
{
    return $this->$JobTitle;
}

function __setJobTitle ($JobTitle, $newJobTitle)
{
    $this->$JobTitle = $newJobTitle;
}

function __getDuties ($Duties)
{
    return $this->$Duties;
}

function __setDuties ($Duties, $newDuties)
{
    $this->$Duties = $newDuties;
}

function __getPayType ($PayType)
{
    return $this->$PayType;
}

function __setPayType ($PayType, $newPayType)
{
    $this->$PayType = $newPayType;
}

function __getPayRateBasis ($PayRateBasis)
{
    return $this->$PayRateBasis;
}

function __setPayRateBasis ($PayRateBasis, $newPayRateBasis)
{
    $this->$PayRateBasis = $newPayRateBasis;
}

function __getFullorPartTime ($FullorPartTime)
{
    return $this->$FullorPartTime;
}

function __setFullorPartTime ($FullorPartTime, $newFullorPartTime)
{
    $this->$FullorPartTime = $newFullorPartTime;
}

function __getEffectiveStartDateTime ($EffectiveStartDateTime)
{
    return $this->$EffectiveStartDateTime;
}

function __setEffectiveStartDateTime ($EffectiveStartDateTime, $newEffectiveStartDateTime)
{
    $this->$EffectiveStartDateTime = $newEffectiveStartDateTime;
}

function __getEffectiveEndDateTime ($EffectiveEndDateTime)
{
    return $this->$EffectiveEndDateTime;
}

function __setEffectiveEndDateTime ($EffectiveEndDateTime, $newEffectiveEndDateTime)
{
    $this->$EffectiveEndDateTime = $newEffectiveEndDateTime;
}

function __getInsertedat ($Insertedat)
{
    return $this->$Insertedat;
}

function __setInsertedat ($Insertedat, $newInsertedat)
{
    $this->$Insertedat = $newInsertedat;
}

function __getDeletedat ($Deletedat)
{
    return $this->$Deletedat;
}

function __setDeletedat ($Deletedat, $newDeletedat)
{
    $this->$Deletedat = $newDeletedat;
}

