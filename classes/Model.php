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

abstract class Model
{

    protected $dbh;
    protected $stmt;
    protected $error;

    public function __construct()
    {
        $options = [PDO::ATTR_PERSISTENT    => true,
                    PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
            ];
        
        try
        {
            $this->dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            $this->error= $e->getMessage();
        }
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    //Binds the prep statement
    public function bind($param, $value, $type = null)
    {
        if (is_null($type))
        {
            switch (true)
            {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    public function execute()
    {
        $this->stmt->execute();
    }
    
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
    
    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    public function transactionStart()
    {
        $this->dbh->beginTransaction();
    }
    
    public function transactionCommit()
    {
        $this->dbh->commit();
    }
    
    public function transactionRollback()
    {
        $this->dbh->rollBack();
    }
    
    public function passwordChangeEngine($pwHash, $row)
    {
        try
        {
            $this->transactionStart();
            $this->query('UPDATE employees'
                    . ' SET Deleted_at = NOW()'
                    . ' WHERE Employee_Number = :Employee_Number'
                    . ' ORDER BY Inserted_at DESC LIMIT 1');
            $this->bind(':Employee_Number', $row['Employee_Number']);
            $this->execute();

            $this->query('INSERT INTO employees (Employee_Number, First_Name, Middle_Name, Last_Name, Pay_Rate, Sick_Days_Remaining, Vacation_Days_Remaining, Personal_Days_Remaining, FMLA_Days_Remaining, Is_On_Short_Term_Disability, Is_On_Long_Term_Disability, Is_On_FMLA, username, password, email, Is_PW_Expired, remember_me)'
                    . ' VALUES (:Employee_Number, :First_Name, :Middle_Name, :Last_Name, :Pay_Rate, :Sick_Days_Remaining, :Vacation_Days_Remaining, :Personal_Days_Remaining, :FMLA_Days_Remaining, :Is_On_Short_Term_Disability, :Is_On_Long_Term_Disability, :Is_On_FMLA, :username, :password, :email, :isPWExpired, :rememberMe)');
            $this->bind(':Employee_Number', $row['Employee_Number']);
            $this->bind(':First_Name', $row['First_Name']);
            $this->bind(':Middle_Name', $row['Middle_Name']);
            $this->bind(':Last_Name', $row['Last_Name']);
            $this->bind(':Pay_Rate', $row['Pay_Rate']);
            $this->bind(':Sick_Days_Remaining', $row['Sick_Days_Remaining']);
            $this->bind(':Vacation_Days_Remaining', $row['Vacation_Days_Remaining']);
            $this->bind(':Personal_Days_Remaining', $row['Personal_Days_Remaining']);
            $this->bind(':FMLA_Days_Remaining', $row['FMLA_Days_Remaining']);
            $this->bind(':Is_On_Short_Term_Disability', $row['Is_On_Short_Term_Disability']);
            $this->bind(':Is_On_Long_Term_Disability', $row['Is_On_Long_Term_Disability']);
            $this->bind(':Is_On_FMLA', $row['Is_On_FMLA']);
            $this->bind(':username', $row['username']);
            $this->bind(':password', $pwHash);
            $this->bind(':email', $row['email']);
            $this->bind(':isPWExpired', 0);
            $this->bind('rememberMe', $row['remember_me']);
            $this->execute();
            $this->transactionCommit();
        } catch (PDOException $ex)
        {
            $this->transactionRollback();
            echo $ex->getMessage();
        }
        return;
    }
    
    public function startTimeAdjust($unadjustedTime) // Adjusts the start time up to 15 minutes to favor the employee
    {
        if ($unadjustedTime >= 0 || $unadjustedTime <= 14)
        {
            return 0;
        }
        else if ($unadjustedTime >= 15 || $unadjustedTime <= 29)
        {
            return 15;
        }
        else if ($unadjustedTime >= 30 || $unadjustedTime <= 44)
        {
            return 30;
        }
        else
        {
            return 45;
        }
    }
    
    public function endTimeAdjust($unadjustedTime) // Adjusts the end time up to 15 minutes to favor the employee
    {
        if ($unadjustedTime >= 1 || $unadjustedTime <= 15)
        {
            return 15;
        }
        else if ($unadjustedTime >= 16 || $unadjustedTime <= 30)
        {
            return 30;
        }
        else if ($unadjustedTime >= 31 || $unadjustedTime <= 45)
        {
            return 45;
        }
        else
        {
            return 0;
        }
    }
}