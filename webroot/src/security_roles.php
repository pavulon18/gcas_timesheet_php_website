class securityroles
{
private $EffectiveStartDateTime;
private $EffectiveEndDateTime;
private $Insertedat;
private $Deletedat;
private $SecurityRoleID;
private $SecurityRoleName;
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

function __getSecurityRoleID ($SecurityRoleID)
{
    return $this->$SecurityRoleID;
}

function __setSecurityRoleID ($SecurityRoleID, $newSecurityRoleID)
{
    $this->$SecurityRoleID = $newSecurityRoleID;
}

function __getSecurityRoleName ($SecurityRoleName)
{
    return $this->$SecurityRoleName;
}

function __setSecurityRoleName ($SecurityRoleName, $newSecurityRoleName)
{
    $this->$SecurityRoleName = $newSecurityRoleName;
}

