class employeehiredates
{
private $EmployeeNumber;
private $HireDate;
private $TerminationDate;
private $Insertedat;
private $Deletedat;
function __getEmployeeNumber ($EmployeeNumber)
{
    return $this->$EmployeeNumber;
}

function __setEmployeeNumber ($EmployeeNumber, $newEmployeeNumber)
{
    $this->$EmployeeNumber = $newEmployeeNumber;
}

function __getHireDate ($HireDate)
{
    return $this->$HireDate;
}

function __setHireDate ($HireDate, $newHireDate)
{
    $this->$HireDate = $newHireDate;
}

function __getTerminationDate ($TerminationDate)
{
    return $this->$TerminationDate;
}

function __setTerminationDate ($TerminationDate, $newTerminationDate)
{
    $this->$TerminationDate = $newTerminationDate;
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

