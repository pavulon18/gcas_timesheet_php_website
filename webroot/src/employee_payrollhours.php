class employeepayrollhours
{
private $EmployeeNumber;
private $DateTimeIn;
private $DateTimeOut;
private $Is24HourShift;
private $IsSickDay;
private $IsVacationDay;
private $IsHoliday;
private $IsBerevementDay;
private $IsFMLADay;
private $IsShortTermDisabilityDay;
private $IsLongTermDisabilityDay;
private $IsNightRun;
private $IsPayrollApproved;
private $PayrollApprovedBy;
private $PayrollApprovalDate;
private $RegularTime;
private $OverTime;
private $NonWorkTime;
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

function __getDateTimeIn ($DateTimeIn)
{
    return $this->$DateTimeIn;
}

function __setDateTimeIn ($DateTimeIn, $newDateTimeIn)
{
    $this->$DateTimeIn = $newDateTimeIn;
}

function __getDateTimeOut ($DateTimeOut)
{
    return $this->$DateTimeOut;
}

function __setDateTimeOut ($DateTimeOut, $newDateTimeOut)
{
    $this->$DateTimeOut = $newDateTimeOut;
}

function __getIs24HourShift ($Is24HourShift)
{
    return $this->$Is24HourShift;
}

function __setIs24HourShift ($Is24HourShift, $newIs24HourShift)
{
    $this->$Is24HourShift = $newIs24HourShift;
}

function __getIsSickDay ($IsSickDay)
{
    return $this->$IsSickDay;
}

function __setIsSickDay ($IsSickDay, $newIsSickDay)
{
    $this->$IsSickDay = $newIsSickDay;
}

function __getIsVacationDay ($IsVacationDay)
{
    return $this->$IsVacationDay;
}

function __setIsVacationDay ($IsVacationDay, $newIsVacationDay)
{
    $this->$IsVacationDay = $newIsVacationDay;
}

function __getIsHoliday ($IsHoliday)
{
    return $this->$IsHoliday;
}

function __setIsHoliday ($IsHoliday, $newIsHoliday)
{
    $this->$IsHoliday = $newIsHoliday;
}

function __getIsBerevementDay ($IsBerevementDay)
{
    return $this->$IsBerevementDay;
}

function __setIsBerevementDay ($IsBerevementDay, $newIsBerevementDay)
{
    $this->$IsBerevementDay = $newIsBerevementDay;
}

function __getIsFMLADay ($IsFMLADay)
{
    return $this->$IsFMLADay;
}

function __setIsFMLADay ($IsFMLADay, $newIsFMLADay)
{
    $this->$IsFMLADay = $newIsFMLADay;
}

function __getIsShortTermDisabilityDay ($IsShortTermDisabilityDay)
{
    return $this->$IsShortTermDisabilityDay;
}

function __setIsShortTermDisabilityDay ($IsShortTermDisabilityDay, $newIsShortTermDisabilityDay)
{
    $this->$IsShortTermDisabilityDay = $newIsShortTermDisabilityDay;
}

function __getIsLongTermDisabilityDay ($IsLongTermDisabilityDay)
{
    return $this->$IsLongTermDisabilityDay;
}

function __setIsLongTermDisabilityDay ($IsLongTermDisabilityDay, $newIsLongTermDisabilityDay)
{
    $this->$IsLongTermDisabilityDay = $newIsLongTermDisabilityDay;
}

function __getIsNightRun ($IsNightRun)
{
    return $this->$IsNightRun;
}

function __setIsNightRun ($IsNightRun, $newIsNightRun)
{
    $this->$IsNightRun = $newIsNightRun;
}

function __getIsPayrollApproved ($IsPayrollApproved)
{
    return $this->$IsPayrollApproved;
}

function __setIsPayrollApproved ($IsPayrollApproved, $newIsPayrollApproved)
{
    $this->$IsPayrollApproved = $newIsPayrollApproved;
}

function __getPayrollApprovedBy ($PayrollApprovedBy)
{
    return $this->$PayrollApprovedBy;
}

function __setPayrollApprovedBy ($PayrollApprovedBy, $newPayrollApprovedBy)
{
    $this->$PayrollApprovedBy = $newPayrollApprovedBy;
}

function __getPayrollApprovalDate ($PayrollApprovalDate)
{
    return $this->$PayrollApprovalDate;
}

function __setPayrollApprovalDate ($PayrollApprovalDate, $newPayrollApprovalDate)
{
    $this->$PayrollApprovalDate = $newPayrollApprovalDate;
}

function __getRegularTime ($RegularTime)
{
    return $this->$RegularTime;
}

function __setRegularTime ($RegularTime, $newRegularTime)
{
    $this->$RegularTime = $newRegularTime;
}

function __getOverTime ($OverTime)
{
    return $this->$OverTime;
}

function __setOverTime ($OverTime, $newOverTime)
{
    $this->$OverTime = $newOverTime;
}

function __getNonWorkTime ($NonWorkTime)
{
    return $this->$NonWorkTime;
}

function __setNonWorkTime ($NonWorkTime, $newNonWorkTime)
{
    $this->$NonWorkTime = $newNonWorkTime;
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

