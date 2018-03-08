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

        $payRate = $post['dollars'] + $post['cents'] / 100;
        $startDate = $post['startYear'] . '-' . $post['startMonth'] . '-' . $post['startDay'] . ' 08:00:00';

        if ($post['submit'])
        {
            $pwHash = password_hash($post['password'], PASSWORD_DEFAULT);
            //$pwHash2 = password_hash($post['password2'], PASSWORD_DEFAULT);
            if ($post['password'] != $post['password2'])
            {
                echo 'passwords do not match';
            } else
            {
                /**
                 * In this situation, I am inserting into three different tables.
                 * To make sure I don't have issues if something breaks, I am going 
                 * to use transactions. 
                 * */
                try
                {
                    $this->transactionStart();
                    $this->query('INSERT INTO employees (Employee_Number, First_Name, Middle_Name, Last_Name, Pay_Rate, Sick_Days_Remaining, Vacation_Days_Remaining, Personal_Days_Remaining, FMLA_Days_Remaining, Is_On_Short_Term_Disability, Is_On_Long_Term_Disability, Is_On_FMLA, username, password, email)'
                            . ' VALUES (:Employee_Number, :First_Name, :Middle_Name, :Last_Name, :Pay_Rate, :Sick_Days_Remaining, :Vacation_Days_Remaining, :Personal_Days_Remaining, :FMLA_Days_Remaining, :Is_On_Short_Term_Disability, :Is_On_Long_Term_Disability, :Is_On_FMLA, :username, :password, :email)');
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

                    $this->query('INSERT INTO employee_securityroles (Employee_Number, Security_Role_ID)'
                            . ' VALUES (:Employee_Number, :Security_Role_ID)');
                    $this->bind(':Employee_Number', $post['employeeNumber']);
                    $this->bind(':Security_Role_ID', $post['securityRole']);
                    $this->execute();

                    $this->query('INSERT INTO employee_hiredates (Employee_Number, Hire_Date)'
                            . ' VALUES (:Employee_Number, :Hire_Date)');
                    $this->bind(':Employee_Number', $post['employeeNumber']);
                    $this->bind(':Hire_Date', $startDate);
                    $this->execute();
                    
                    $this->transactionCommit();
                }
                catch (PDOException $ex)
                {
                    $this->transactionRollback();
                    echo $ex->getMessage();
                }

                if ($this->lastInsertId())
                {
                    //Redirect
                    header('Location: ' . ROOT_URL . 'employees/roster');
                }
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

    public function login()
    {
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //$pwHash = password_hash($post['password'], PASSWORD_DEFAULT);

        if ($post['submit'])
        {
            // Compare Login
            $this->query('SELECT * FROM employees WHERE username = :username ORDER BY Inserted_at DESC LIMIT 1');
            $this->bind(':username', $post['username']);
            $row = $this->single();

            if (empty($row))
            {
                Messages::setMsg('Incorrect Login', 'error');
                return;
            }
            $this->query('SELECT * FROM employee_securityroles WHERE employee_securityroles.Employee_Number = ' . $row['Employee_Number'] . ' ORDER BY Inserted_at DESC LIMIT 1');
            $this->bind(':empNumber', $row['Employee_Number']);
            $row2 = $this->single();

            if (password_verify($post['password'], $row['password']))
            {
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_data'] = array(
                    "empNum" => $row['Employee_Number'],
                    "firstName" => $row['First_Name'],
                    "lastName" => $row['Last_Name'],
                    "securityRole" => $row2['Security_Role_ID']
                );
                header('Location: ' . ROOT_URL . 'employees');
            } else
            {
                Messages::setMsg('Incorrect Login', 'error');
            }
        }
        return;
    }

}
