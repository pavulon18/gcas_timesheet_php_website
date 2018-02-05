class employeesecurityroles
{
private $EffectiveStartDateTime;
private $EffectiveEndDateTime;
private $Insertedat;
private $Deletedat;
private $IDNumber;
private $EmployeeNumber;
private $SecurityRoleID;
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

function __getIDNumber ($IDNumber)
{
    return $this->$IDNumber;
}

function __setIDNumber ($IDNumber, $newIDNumber)
{
    $this->$IDNumber = $newIDNumber;
}

function __getEmployeeNumber ($EmployeeNumber)
{
    return $this->$EmployeeNumber;
}

function __setEmployeeNumber ($EmployeeNumber, $newEmployeeNumber)
{
    $this->$EmployeeNumber = $newEmployeeNumber;
}

function __getSecurityRoleID ($SecurityRoleID)
{
    return $this->$SecurityRoleID;
}

function __setSecurityRoleID ($SecurityRoleID, $newSecurityRoleID)
{
    $this->$SecurityRoleID = $newSecurityRoleID;
}

