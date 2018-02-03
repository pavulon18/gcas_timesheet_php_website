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
        if (empty($empNumber))
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

    function __getMiddleName($middleName)
    {
        return $this->$middleName;
    }

    function __getLastName($lastName)
    {
        return $this->$lastName;
    }
// From here on down, I should fix the variable names to keep the same
// variable conventions.  These were all made from my script.  The script
// still needs some work but at least it is operational.
    function __getPay_Rate($Pay_Rate)
    {
        return $this->$Pay_Rate;
    }

    function __setPay_Rate($Pay_Rate, $new_Pay_Rate)
    {
        $this->$Pay_Rate = $new_Pay_Rate;
    }

    function __getSick_Days_Remaining($Sick_Days_Remaining)
    {
        return $this->$Sick_Days_Remaining;
    }

    function __setSick_Days_Remaining($Sick_Days_Remaining, $new_Sick_Days_Remaining)
    {
        $this->$Sick_Days_Remaining = $new_Sick_Days_Remaining;
    }

    function __getVacation_Days_Remaining($Vacation_Days_Remaining)
    {
        return $this->$Vacation_Days_Remaining;
    }

    function __setVacation_Days_Remaining($Vacation_Days_Remaining, $new_Vacation_Days_Remaining)
    {
        $this->$Vacation_Days_Remaining = $new_Vacation_Days_Remaining;
    }

    function __getPersonal_Days_Remaining($Personal_Days_Remaining)
    {
        return $this->$Personal_Days_Remaining;
    }

    function __setPersonal_Days_Remaining($Personal_Days_Remaining, $new_Personal_Days_Remaining)
    {
        $this->$Personal_Days_Remaining = $new_Personal_Days_Remaining;
    }

    function __getFMLA_Days_Remaining($FMLA_Days_Remaining)
    {
        return $this->$FMLA_Days_Remaining;
    }

    function __setFMLA_Days_Remaining($FMLA_Days_Remaining, $new_FMLA_Days_Remaining)
    {
        $this->$FMLA_Days_Remaining = $new_FMLA_Days_Remaining;
    }

    function __getIs_Currently_Employed($Is_Currently_Employed)
    {
        return $this->$Is_Currently_Employed;
    }

    function __setIs_Currently_Employed($Is_Currently_Employed, $new_Is_Currently_Employed)
    {
        $this->$Is_Currently_Employed = $new_Is_Currently_Employed;
    }

    function __getIs_On_Short_Term_Disability($Is_On_Short_Term_Disability)
    {
        return $this->$Is_On_Short_Term_Disability;
    }

    function __setIs_On_Short_Term_Disability($Is_On_Short_Term_Disability, $new_Is_On_Short_Term_Disability)
    {
        $this->$Is_On_Short_Term_Disability = $new_Is_On_Short_Term_Disability;
    }

    function __getIs_On_Long_Term_Disability($Is_On_Long_Term_Disability)
    {
        return $this->$Is_On_Long_Term_Disability;
    }

    function __setIs_On_Long_Term_Disability($Is_On_Long_Term_Disability, $new_Is_On_Long_Term_Disability)
    {
        $this->$Is_On_Long_Term_Disability = $new_Is_On_Long_Term_Disability;
    }

    function __getIs_On_FMLA($Is_On_FMLA)
    {
        return $this->$Is_On_FMLA;
    }

    function __setIs_On_FMLA($Is_On_FMLA, $new_Is_On_FMLA)
    {
        $this->$Is_On_FMLA = $new_Is_On_FMLA;
    }

    function __getusername($username)
    {
        return $this->$username;
    }

    function __setusername($username, $new_username)
    {
        $this->$username = $new_username;
    }

    function __getpassword($password)
    {
        return $this->$password;
    }

    function __setpassword($password, $new_password)
    {
        $this->$password = $new_password;
    }

    function __getremember_me($remember_me)
    {
        return $this->$remember_me;
    }

    function __setremember_me($remember_me, $new_remember_me)
    {
        $this->$remember_me = $new_remember_me;
    }

    function __getemail($email)
    {
        return $this->$email;
    }

    function __setemail($email, $new_email)
    {
        $this->$email = $new_email;
    }

    function __getEffective_Start_DateTime($Effective_Start_DateTime)
    {
        return $this->$Effective_Start_DateTime;
    }

    function __setEffective_Start_DateTime($Effective_Start_DateTime, $new_Effective_Start_DateTime)
    {
        $this->$Effective_Start_DateTime = $new_Effective_Start_DateTime;
    }

    function __getEffective_End_DateTime($Effective_End_DateTime)
    {
        return $this->$Effective_End_DateTime;
    }

    function __setEffective_End_DateTime($Effective_End_DateTime, $new_Effective_End_DateTime)
    {
        $this->$Effective_End_DateTime = $new_Effective_End_DateTime;
    }

    function __getInserted_at($Inserted_at)
    {
        return $this->$Inserted_at;
    }

    function __setInserted_at($Inserted_at, $new_Inserted_at)
    {
        $this->$Inserted_at = $new_Inserted_at;
    }

    function __getDeleted_at($Deleted_at)
    {
        return $this->$Deleted_at;
    }

    function __setDeleted_at($Deleted_at, $new_Deleted_at)
    {
        $this->$Deleted_at = $new_Deleted_at;
    }

}
