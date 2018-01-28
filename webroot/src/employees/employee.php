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
class employee
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
}
