class employeejobtitles
{
private $EmployeeNumber;
private $EffectiveStartDateTime;
private $EffectiveEndDateTime;
private $Insertedat;
private $Deletedat;
private $JobTitleID;
function __getEmployeeNumber ($EmployeeNumber)
{
    return $this->$EmployeeNumber;
}

function __setEmployeeNumber ($EmployeeNumber, $newEmployeeNumber)
{
    $this->$EmployeeNumber = $newEmployeeNumber;
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

function __getJobTitleID ($JobTitleID)
{
    return $this->$JobTitleID;
}

function __setJobTitleID ($JobTitleID, $newJobTitleID)
{
    $this->$JobTitleID = $newJobTitleID;
}

