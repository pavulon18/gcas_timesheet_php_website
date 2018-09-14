<?php

/**
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
 * Description of administrator
 * functions for only administrator level users.
 *
 * @author Jim Baize <pavulon@hotmail.com>
 */
class AdministratorModel extends Model
{

    public function Index()
    {
        Miscellaneous::checkIsLoggedIn();
        Miscellaneous::checkIsAdmin();
        return;
    }

    public function register()
    {
        Miscellaneous::checkIsLoggedIn();
        Miscellaneous::checkIsAdmin();
        //Sanitize Post
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $payRate = $post['dollars'] + $post['cents'] / 100;
        $startDate = $post['startYear'] . '-' . $post['startMonth'] . '-' . $post['startDay'] . ' 08:00:00';

        if ($post['submit'])
        {
            $pwHash = password_hash($post['password'], PASSWORD_DEFAULT);
            if ($post['password'] != $post['password2'])
            {
                Messages::setMsg('The passwords do not match', 'error');
                header('Location: ' . ROOT_URL . 'administrators/register');
                die();
            }
            else
            {
                /**
                 * In this situation, I am inserting into three different tables.
                 * To make sure I don't have issues if something breaks, I am going 
                 * to use transactions. 
                 * */
                try
                {
                    $this->transactionStart();
                    $this->query('INSERT INTO employees (Employee_Number, First_Name, Middle_Name, Last_Name, Pay_Rate, Sick_Days_Remaining, Vacation_Days_Remaining, Personal_Days_Remaining, FMLA_Days_Remaining, Is_On_Short_Term_Disability, Is_On_Long_Term_Disability, Is_On_FMLA, username, password, email, Is_PW_Expired)'
                            . ' VALUES (:Employee_Number, :First_Name, :Middle_Name, :Last_Name, :Pay_Rate, :Sick_Days_Remaining, :Vacation_Days_Remaining, :Personal_Days_Remaining, :FMLA_Days_Remaining, :Is_On_Short_Term_Disability, :Is_On_Long_Term_Disability, :Is_On_FMLA, :username, :password, :email, 1)');
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
                    header('Location: ' . ROOT_URL . 'administrators/roster');
                    die();
                }
            }
        }
        return;
    }

    public function roster()
    {
        Miscellaneous::checkIsLoggedIn();
        Miscellaneous::checkIsAdmin();
        $this->query('SELECT * FROM employees e1'
                . ' WHERE Inserted_at = '
                . ' (SELECT MAX(e2.Inserted_at)'
                . ' FROM employees e2'
                . ' WHERE e1.Employee_Number = e2.Employee_Number)');
        $rows = $this->resultSet();
        return $rows;
        /*
         * I just realized this will list every employee past or present.
         * I will need to fix this.  I should probably give the administrator 
         * the ability to choose which option, either list all, list past, or list
         * present.
         */
    }

    public function changeuserpass()
    {
        Miscellaneous::checkIsLoggedIn();
        Miscellaneous::checkIsAdmin();

        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        if ($post['submit'])
        {
            $pwHash = password_hash($post['password'], PASSWORD_DEFAULT);
            if ($post['password'] === $post['password2'])
            {
                try
                {
                    //Start the transaction
                    $this->transactionStart();
                    $this->query('SELECT * FROM employees WHERE Employee_Number = :empNum ORDER BY Inserted_at DESC LIMIT 1');
                    $this->bind(':empNum', $post['empNum']);
                    $rows = $this->single();
                    
                    //copy the required data fields into a new row complete with time stamps changed as appropriate
                    $this->query('INSERT INTO employees (Employee_Number, First_Name, Middle_Name, Last_Name, Pay_Rate, Sick_Days_Remaining, Vacation_Days_Remaining, Personal_Days_Remaining, FMLA_Days_Remaining, Is_On_Short_Term_Disability, Is_On_Long_Term_Disability, Is_On_FMLA, username, password, email, Is_PW_Expired)'
                            . ' VALUES (:Employee_Number, :First_Name, :Middle_Name, :Last_Name, :Pay_Rate, :Sick_Days_Remaining, :Vacation_Days_Remaining, :Personal_Days_Remaining, :FMLA_Days_Remaining, :Is_On_Short_Term_Disability, :Is_On_Long_Term_Disability, :Is_On_FMLA, :username, :password, :email, :isPWExpired)');
                    $this->bind(':Employee_Number', $rows['Employee_Number']);
                    $this->bind(':First_Name', $rows['First_Name']);
                    $this->bind(':Middle_Name', $rows['Middle_Name']);
                    $this->bind(':Last_Name', $rows['Last_Name']);
                    $this->bind(':Pay_Rate', $rows['Pay_Rate']);
                    $this->bind(':Sick_Days_Remaining', $rows['Sick_Days_Remaining']);
                    $this->bind(':Vacation_Days_Remaining', $rows['Vacation_Days_Remaining']);
                    $this->bind(':Personal_Days_Remaining', $rows['Personal_Days_Remaining']);
                    $this->bind(':FMLA_Days_Remaining', $rows['FMLA_Days_Remaining']);
                    $this->bind(':Is_On_Short_Term_Disability', $rows['Is_On_Short_Term_Disability']);
                    $this->bind(':Is_On_Long_Term_Disability', $rows['Is_On_Long_Term_Disability']);
                    $this->bind(':Is_On_FMLA', $rows['Is_On_FMLA']);
                    $this->bind(':username', $rows['username']);
                    $this->bind(':password', $pwHash);
                    $this->bind(':email', $rows['email']);
                    $this->bind(':isPWExpired', $rows['Is_PW_Expired']);
                    $this->execute();

                    //update the above inserted row with the new password hash
                    $this->query('UPDATE employees SET password = :pwHash WHERE Employee_Number = :empNum ORDER BY Inserted_at DESC LIMIT 1');
                    $this->bind('empNum', $post['empNum']);
                    $this->bind(':pwHash', $pwHash);
                    $this->execute();

                    $this->transactionCommit();
                    
                    Messages::setMsg('Password successfully changed', 'success');
                    header('Location: ' . ROOT_URL . 'administrators');
                    die();
                }
                catch (PDOException $ex)
                {
                    $this->transactionRollback();
                    echo $ex->getMessage();
                    Messages::setMsg($ex->getMessage(), 'error');
                }
            }
            else
            {
                Messages::setMsg('There was an error.  Please try again.', 'error');
                header('Location: ' . ROOT_URL . 'administrators/changeuserpass');
                die();
            }
        }
        return;
    }

    public function currentpay()
    {
        
        Miscellaneous::checkIsLoggedIn();
        Miscellaneous::checkIsAdmin();
        /*
         * This method will be used to display the current pay period.
         * I am also going to try to add in the ability to enter new information
         * from this page using a modal.
         * 
         * 
         * 10) Display the current pay period information
         * 20) Display a button to add a new entry.
         * 30) Display buttons to delete or correct information already entered.
         * 
         */

        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $now = new DateTime("now");
        
        $firstDayObject = Miscellaneous::determineFirstDay($now);
        
        $lastDayObject = $firstDayObject; //+ DateTimeImmutable::add()
        $firstDayObject = DateTimeImmutable::createFromMutable( $firstDayObject );
        
        $lastDayObject->add(new DateInterval('P14D'));
        $firstDay = $firstDayObject->format('Y-m-d') . ' 08:00:00';
        $lastDay = $lastDayObject->format('Y-m-d') . ' 08:00:00';
        
        $this->query('SELECT e1.*, eprh.* FROM employees e1 '
                . 'LEFT OUTER JOIN employees e2 ON '
                . 'e1.employee_number = e2.employee_number AND '
                . 'e2.inserted_at > e1.inserted_at '
                . 'LEFT JOIN employee_payrollhours eprh ON '
                . 'eprh.employee_number = e1.employee_number '
                . 'WHERE e2.employee_number is null');
        //$this->bind(':empNum', $_SESSION['user_data']['empNum']);
        $this->bind('firstDay', $firstDay);
        $this->bind('lastDay', $lastDay);
        $rows = $this->resultSet();

        return $rows; 
    }
    
    public function historicalpay()
    {
        Miscellaneous::checkIsLoggedIn();
        Miscellaneous::checkIsAdmin();
        /**
         * This option is inserting '18:00' into the time fields
         * if the employee has 'null' times
         * Otherwise, it looks as if it is correct
         * 
         * I fixed the null issue.
         * 
         * Thank you to elyalvarado from StackOverflow for this
         * MySQL solution.
         * https://stackoverflow.com/users/3236163/elyalvarado
         */

        $this->query('SELECT e1.*, eprh.* FROM employees e1 '
                . 'LEFT OUTER JOIN employees e2 ON '
                . 'e1.employee_number = e2.employee_number AND '
                . 'e2.inserted_at > e1.inserted_at '
                . 'LEFT JOIN employee_payrollhours eprh ON '
                . 'eprh.employee_number = e1.employee_number '
                . 'WHERE e2.employee_number is null');
        $rows = $this->resultSet();
        return $rows;
        
        
        /**
         * Option #2
         * Test
         * 
         
        $this->query('SELECT e.*, p.* ' .
                'FROM (select *, max(inserted_at) AS most_recent ' .
                'FROM employees GROUP BY employee_number) e ' .
                'LEFT JOIN employee_payrollhours p ' .
                'ON p.employee_number = e.employee_number');
        $rows = $this->resultSet();
         * 
         *
        return $rows;
         * 
         */
    }
}
