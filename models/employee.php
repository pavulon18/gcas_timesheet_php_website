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

class EmployeeModel extends Model
{
    public function Index()
    {
        return;
    }
    
    public function register()
    {
        //Sanitize Post
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $pwHash = password_hash($post['password'], PASSWORD_DEFAULT);
        $payRate = $post['dollars'] + $post['cents']/100;
        
        print_r($post);
        
        if ($post['submit'])
        {
            $this->query('INSERT INTO employees (Employee_Number, First_Name, Middle_Name, Last_Name, Pay_Rate, Sick_Days_Remaining, Vacation_Days_Remaining, Personal_Days_Remaining, FMLA_Days_Remaining, Is_On_Short_Term_Disability, Is_On_Long_Term_Disability, Is_On_FMLA, username, password, email, Effective_Start_DateTime)'
                    . ' VALUES (:Employee_Number, :First_Name, :Middle_Name, :Last_Name, :Pay_Rate, :Sick_Days_Remaining, :Vacation_Days_Remaining, :Personal_Days_Remaining, :FMLA_Days_Remaining, :Is_On_Short_Term_Disability, :Is_On_Long_Term_Disability, :Is_On_FMLA, :username, :password, :email, :Effective_Start_DateTime)');
            $this->bind(':Employee_Number', $post['employeeNumber']);
            $this->bind(':First_Name', $post['firstName']);
            $this->bind(':Middle_Name', $post['middleName']);
            $this->bind(':Last_Name', $post['lastName']);
            $this->bind(':Pay_Rate', $payRate);
            $this->bind(':Sick_Days_Remaining', $post['sickDays']);
            $this->bind(':Vacation_Days_Remaining', $post['vacationDays']);
            $this->bind(':Personal_Days_Remaining', $post['personalDays']);
            $this->bind(':FMLA_Days_Remaining', $post['fmlaDays']);
            $this->bind(':Is_On_Short_Term_Disability', $post['isShortTerm']);
            $this->bind(':Is_On_Long_Term_Disability', $post['isLongTerm']);
            $this->bind(':Is_On_FMLA', $post['isFMLA']);
            $this->bind(':username', $post['username']);
            $this->bind(':password', $pwHash);
            $this->bind(':email', $post['email']);
            $this->execute();
            
            if ($this->lastInsertId())
            {
                //Redirect
                header('Location: ' . ROOT_URL . 'jobtitles/listjobs');
            }
        }
        return;
    }
    
    public function roster()
    {
        $this->query('SELECT * FROM employees');
        $rows = $this->resultSet();
        return $rows;
    }
    
    /*
     * 
     * The following function is here for reference.  I need the basic structure to modify it for the register function above.
     * after the register function is working, this code will be deleted.
     
           
        $startDate = $post['startYear'].'-'.$post['startMonth'].'-'.$post['startDay'].' 08:00:00';

        if ($post['submit'])
        {
            $this->query('INSERT INTO job_titles (Job_Title, Duties, Pay_Type, Pay_Rate_Basis, Effective_Start_DateTime) VALUES (:Job_Title, :Duties, :Pay_Type, :Pay_Rate_Basis, :Effective_Start_DateTime)');
            $this->bind(':Job_Title', $post['jobTitle']);
            $this->bind(':Duties', $post['duties']);
            $this->bind(':Pay_Type', $post['payType']);
            $this->bind(':Pay_Rate_Basis', $post['payRateBasis']);
            $this->bind(':Effective_Start_DateTime', $startDate);
            $this->execute();
            
            if ($this->lastInsertId())
            {
                //Redirect
                header('Location: ' . ROOT_URL . 'jobtitles/listjobs');
            }
        }
        return;
    }
    */
}