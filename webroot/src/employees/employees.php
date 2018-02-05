<?php

/*
 * The MIT License
 *
 * Copyright 2018 Jim Baize <pavulon@hotmail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Description of employee
 * 
 * (January 27, 2018)
 * Initial file build.
 * 
 * This class will build the employee object.  Each employee will have several
 * attributes associated with it.
 *
 * @author Jim Baize <pavulon@hotmail.com>
 */
class employees
{

//declare variables
    private $employeeNumber;
    private $firstName;
    private $middleName;
    private $lastName;
    private $payRate;
    private $sickDaysRemaining;
    private $vacationDaysRemaining;
    private $personalDaysRemaining;
    private $FMLADaysRemaining;
    private $isCurrentlyEmployed;
    private $isOnShortTerm_Disability;
    private $isOnLongTermDisability;
    private $isOnFMLA;
    private $username;
    private $password;
    private $rememberMe;
    private $email;
    private $effectiveStartDateTime;
    private $effectiveEndDateTime;
    private $insertedAt;
    private $deletedAt;

//put your code here
    function __construct()
    {
// My constructor function;
    }

//Every employee will have an Employee Number.  This number is assigned to 
//each employee by the county.  Although it is an integer, it might be a 
//good idea to manage the value as a string instead of an integer.
    function __getEmployeeNumber($employeeNumber)
    {
        return $this->$employeeNumber;
    }

    function __setEmployeeNumber($employeeNumber, $empNum)
    {
        $re = '/\d\d\d\d\d\d\d\d\d/'; //My regex code
        if (empty($empNum))
        {
//error handling routine
        } elseif (preg_match_all($re, $empNum, PREG_SET_ORDER, 0))
        {
            $this->$employeeNumber = $empNum;
        } else
        {
//another error handling routine
        }
    }

    function __getFirstName($firstName)
    {
        return $this->$firstName;
    }

    function __setFirstName($firstName, $newFirstName)
    {
        $this->$firstName = $newFirstName;
    }

    function __getMiddleName($middleName)
    {
        return $this->$middleName;
    }

    function __setMiddleName($middleName, $newMiddleName)
    {
        $this->$middleName = $newMiddleName;
    }

    function __getLastName($lastName)
    {
        return $this->$lastName;
    }

    function __setLastName($lastName, $newLastName)
    {
        $this->$lastName = newLastName;
    }

// Feb 3, 2018
// I've updated some of the scripts below and a couple above.
// 
// From here on down, I should fix the variable names to keep the same
// variable conventions.  These were all made from my script.  The script
// still needs some work but at least it is operational.
    function __getPayRate($payRate)
    {
        return $this->$payRate;
    }

    function __setPayRate($payRate, $newPayRate)
    {
        $this->$payRate = $newPayRate;
    }

    function __getSickDaysRemaining($sickDaysRemaining)
    {
        return $this->$sickDaysRemaining;
    }

    function __setSickDaysRemaining($sickDaysRemaining, $newSickDaysRemaining)
    {
        $this->$sickDaysRemaining = $newSickDaysRemaining;
    }

    function __getVacationDaysRemaining($vacationDaysRemaining)
    {
        return $this->$vacationDaysRemaining;
    }

    function __setVacationDaysRemaining($vacationDaysRemaining, $newVacationDaysRemaining)
    {
        $this->$vacationDaysRemaining = $newVacationDaysRemaining;
    }

    function __getPersonalDaysRemaining($personalDaysRemaining)
    {
        return $this->$personalDaysRemaining;
    }

    function __setPersonalDaysRemaining($personalDaysRemaining, $newPersonalDaysRemaining)
    {
        $this->$personalDaysRemaining = $newPersonalDaysRemaining;
    }

    function __getFMLADaysRemaining($FMLADaysRemaining)
    {
        return $this->$FMLADaysRemaining;
    }

    function __setFMLADaysRemaining($FMLADaysRemaining, $newFMLADaysRemaining)
    {
        $this->$FMLADaysRemaining = $newFMLADaysRemaining;
    }

    function __getIsCurrentlyEmployed($isCurrentlyEmployed)
    {
        return $this->$Is_Currently_Employed;
    }

    function __setIsCurrentlyEmployed($isCurrentlyEmployed, $newIsCurrentlyEmployed)
    {
        $this->$isCurrentlyEmployed = $newIsCurrentlyEmployed;
    }

    function __getIsOnShortTermDisability($isOnShortTermDisability)
    {
        return $this->$isOnShortTerm_Disability;
    }

    function __setIsOnShortTermDisability($isOnShortTermDisability, $newIsOnShortTermDisability)
    {
        $this->$isOnShortTermDisability = $newIsOnShortTermDisability;
    }

    function __getIsOnLongTermDisability($isOnLongTermDisability)
    {
        return $this->$isOnLongTermDisability;
    }

    function __setIsOnLongTermDisability($isOnLongTermDisability, $newIsOnLongTermDisability)
    {
        $this->$isOnLongTermDisability = $newIsOnLongTermDisability;
    }

    function __getIsOnFMLA($isOnFMLA)
    {
        return $this->$IsOnFMLA;
    }

    function __setIsOnFMLA($isOnFMLA, $newIsOnFMLA)
    {
        $this->$isOnFMLA = $newIsOnFMLA;
    }

    function __getUsername($username)
    {
        return $this->$username;
    }

    function __setUsername($username, $newUsername)
    {
        $this->$username = $newUsername;
    }

    function __getPassword($password)
    {
        return $this->$password;
    }

    function __setPassword($password, $newPassword)
    {
        $this->$password = $newpassword;
    }

    function __getRememberMe($rememberMe)
    {
        return $this->$rememberMe;
    }

    function __setRememberMe($rememberMe, $newRememberMe)
    {
        $this->$rememberMe = $newRememberMe;
    }

    function __getEmail($email)
    {
        return $this->$email;
    }

    function __setEmail($email, $newEmail)
    {
        $this->$email = $newEmail;
    }

    function __getEffectiveStartDateTime($effectiveStartDateTime)
    {
        return $this->$effectiveStartDateTime;
    }

    function __setEffectiveStartDateTime($effectiveStartDateTime, $newEffectiveStartDateTime)
    {
        $this->$effectiveStartDateTime = $newEffectiveStartDateTime;
    }

    function __getEffectiveEndDateTime($effectiveEndDateTime)
    {
        return $this->$effectiveEndDateTime;
    }

    function __setEffectiveEndDateTime($effectiveEndDateTime, $newEffectiveEndDateTime)
    {
        $this->$effectiveEndDateTime = $newEffectiveEndDateTime;
    }

    function __getInsertedAt($insertedAt)
    {
        return $this->$Insertedat;
    }

    function __setInsertedAt($insertedAt, $newInsertedAt)
    {
        $this->$insertedAt = $newInsertedAt;
    }

    function __getDeletedAt($deletedAt)
    {
        return $this->$deletedAt;
    }

    function __setDeletedAt($deletedAt, $newDeletedAt)
    {
        $this->$deletedAt = $newDeletedAt;
    }
}