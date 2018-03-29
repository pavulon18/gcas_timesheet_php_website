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

 //open a connection to the DB
require_once('db_fns.php');


function get_user_pto($pto_array)
{
    
    // retrieve the user's PTO days information
    //$conn = db_connect();

    // check if username is unique
    $result = $conn->query("select sick_days_remaining, vacation_days_remaining, personal_days_reamaining"
            . "from employees"
            . "where username='" . $username . "'"
            . "order by Inserted_at desc limit 1");
    if (!$result)
    {
        throw new Exception('Could not execute query');
    }

    

   
    //
    //select sick_days_remaining, vacation_days_remaining, personal_days_reamaining
    //from employees
    //where username = current user and date is most recent (not sure if I need the most recent effective date or inserted date or some combination)
    //close DB connection
    //send information to be displayed
}