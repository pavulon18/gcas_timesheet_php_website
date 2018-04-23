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
        Miscellaneous::checkIsLoggedIn();
        return;
    }

    public function login()
    {
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

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
            //$this->bind(':empNumber', $row['Employee_Number']);   March 31 , 2018 I do not believe this line needs to be here.  I'm going to comment it out and see if that changes any functionality
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
                //Checking if the password has been expired.  If yes then the password will need to be changed.
                // Need to add this functionality
                header('Location: ' . ROOT_URL . 'employees');
            } else
            {
                Messages::setMsg('Incorrect Login', 'error');
            }
        }
        return;
    }

    public function forgotPassword()
    {
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        /* This method was modified from the original code.
         * The original code can be found at
         * https://www.martinstoeckli.ch/php/php.html#passwordreset
         * 
         * @author Martin Stoeckli - www.martinstoeckli.ch/php
         * @copyright Martin Stoeckli 2013, this code may be freely used in every
         *   type of project, it is provided without warranties of any kind.
         * @version 2.1
         */

        if ($post['submit'])
        {
            //Search the database for the given email address
            $this->query('SELECT * FROM employees WHERE email = :email ORDER BY Inserted_at DESC LIMIT 1');
            $this->bind(':email', $post['email']);
            $row = $this->single();
            $email = $row['email'];
            $empNumber = $row['Employee_Number'];

            if (!empty($row)) //checking if the search returned a value
            {
                // Generate a new token with its hash
                StoPasswordReset::generateToken($tokenForLink, $tokenHashForDatabase);

                // Store the hash together with the UserId and the creation date
                $this->query('INSERT INTO recoveryemails_enc (Employee_Number, Token)'
                        . ' VALUES (:empNumber, :token)');
                $this->bind(':token', $tokenHashForDatabase);
                $this->bind(':empNumber', $empNumber);
                $this->execute();

                // Send link with the original token
                $emailLink = ROOT_URL . 'employees/resetpassword/' . $tokenForLink;
                Miscellaneous::notify_password($email, $emailLink); // calls the method to send out the email to the user
            }
        }
    }

    public function resetpassword()
    {
        /* This method was modified from the original code by Jim Baize
         * March 2018.
         * The original code can be found at
         * https://www.martinstoeckli.ch/php/php.html#passwordreset
         * 
         * @author Martin Stoeckli - www.martinstoeckli.ch/php
         * @copyright Martin Stoeckli 2013, this code may be freely used in every
         *   type of project, it is provided without warranties of any kind.
         * @version 2.1
         */
        $id = $this->test_input($_GET['id']); // The token from the URL

        $this->query('SELECT * FROM recoveryemails_enc ORDER BY Creation_DateTime DESC LIMIT 1');
        $result = $this->single(); // Run the above query and return a single result

        $item = $this->test_input($result['Token']); // The hash of the token in the database
        $createDateTime = date_create($result['Creation_DateTime']);  // DateTime the token was first created and stored in the DB

        if (!isset($id) || !StoPasswordReset::isTokenValid($id))
        {
            Messages::setMsg('The token is invalid.', 'error');
            //header('Location: ' . ROOT_URL);
            return;
        } elseif (!hash_equals($item, hash('sha256', $id, FALSE)) || isset($result['Redeemed_DateTime'])) // March 13, 2018 -- Still need to test the Redeemed part of this statement
        {
            Messages::setMsg('<p>The token does not exist or has already been used.<br/></p>', 'error');
            //header('Location: ' . ROOT_URL);
        } elseif (StoPasswordReset::isTokenExpired($createDateTime))  // Check whether the token has expired
        {
            Messages::setMsg('The token has expired.', 'error');
        } else
        {
            $this->query('UPDATE recoveryemails_enc SET Redeemed_DateTime = now() where Token = :token');
            $this->bind(':token', hash('sha256', $id, FALSE));
            $this->execute();
            $_SESSION['empNum'] = $result['Employee_Number'];

            header('Location: ' . ROOT_URL . 'employees/changeforgottenpassword');
            /*
             * That brings up another thought.  How to restrict the number of requests?
             * What is a reasonable rate limit?
             */
        }
        return;
    }

    public function changeforgottenpassword()
    {
        /*
         * Allows users to change their own password.
         * This method is if the user has forgotten his password
         * and used the forgot password link
         */


        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $empNum = $this->test_input($_SESSION['empNum']);

        if ($post['submit'])
        {
            $this->query('SELECT * FROM employees WHERE Employee_Number = :empNum ORDER BY Inserted_at DESC LIMIT 1');
            $this->bind(':empNum', $empNum);
            $row = $this->single();

            if ($post['newPassword1'] === $post['newPassword2'])
            {
                $pwHash = password_hash($post['newPassword1'], PASSWORD_DEFAULT); //hash the password going to the database
                $this->passwordChangeEngine($pwHash, $row);
                if ($this->lastInsertId())
                {
                    //Redirect -- Need to come up with a solution to make this work.
                    // Under my current DB design, this system does not work.
                    header('Location: ' . ROOT_URL . 'employees');
                }
            }
        }
        header('Location: ' . ROOT_URL . 'employees');

        return;
    }

    public function changeknownpassword()
    {
        Miscellaneous::checkIsLoggedIn();
        /*
         * This method will allow the user to change his password
         * This will be used if the user has already logged in and knows the
         * current password
         */

        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if ($post['submit'])
        {
            $this->query('SELECT * FROM employees WHERE Employee_Number = :empNum ORDER BY Inserted_at DESC LIMIT 1');
            $this->bind(':empNum', $_SESSION['user_data']['empNum']);
            $row = $this->single();

            if (empty($post['oldPassword']))
            {
                Messages::setMsg('The old password must be supplied.', 'error');
                return; // do I want a return statement or do I want
                //header('Location: ' . ROOT_URL);  // this header statement?
            } elseif (!password_verify($post['oldPassword'], $row['password']))
            {
                Messages::setMsg('There was an error.  Please try again.', 'error');
                return; // do I want a return statement or do I want
                //header('Location: ' . ROOT_URL);  // this header statement?
            }

            if ($post['newPassword1'] === $post['newPassword2'])
            {
                $pwHash = password_hash($post['newPassword1'], PASSWORD_DEFAULT); //hash the password going to the database

                $this->passwordChangeEngine($pwHash, $row);

                if ($this->lastInsertId())
                {
                    //Redirect
                    header('Location: ' . ROOT_URL . 'employees');
                }
            }
        }
        return;
    }

    public function timeentrypage()
    {
        Miscellaneous::checkIsLoggedIn();
        $isVaca = 'N';
        $isPerson = 'N';
        $isSick = 'N';
        $isBerev = 'N';
        $isFMLA = 'N';
        $isNightRun = 'N';

        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        /*
         * Verify no overlap in any of the time entries 
         *  exceptions:
         *      night runs MUST overlap a 24 hour shift
         *      a night run must NOT overlap another night run
         */

        if ($post['submit'])
        {
            if ($post['is24HrShift'] == 1 && $post['isNightRun'] == 0)
            {
                $post['startHour'] = 8;
                $post['startMin'] = 0;
                $post['endHour'] = 8;
                $post['endMin'] = 0;
                /*
                 * first combine the $post[start data time] into a single unit.
                 * then convert it to a DateTime object
                 * add one day and assign that value to endDateTime
                 * convert startDateTime back to a format usable by the database
                 */
                $startDateTime = new DateTimeImmutable($post['startYear'] . '-' . $post['startMonth'] . '-' . $post['startDay'] . ' 08:00:00');
                $endDateTime = $startDateTime->modify('+1 day')->format('Y-m-d H:i:s');
                $startDateTime = $startDateTime->format('Y-m-d H:i:s');
                $endDTArray = date_parse($endDateTime);

                $post['endYear'] = $endDTArray['year'];
                $post['endMonth'] = $endDTArray['month'];
                $post['endDay'] = $endDTArray['day'];
                $post['endHour'] = $endDTArray['hour'];
                $post['endMin'] = $endDTArray['minute'];
            } else
            {
                $startDateTime = $post['startYear'] . '-' . $post['startMonth'] . '-' . $post['startDay'] . ' ' . $post['startHour'] . ':' . $post['startMin'] . ':00';
                $endDateTime = $post['endYear'] . '-' . $post['endMonth'] . '-' . $post['endDay'] . ' ' . $post['endHour'] . ':' . $post['endMin'] . ':00';
            }

            // Checks for null values.  If values are null, assign a value of 0
            if (!isset($post['isNightRun']))
            {
                $post['isNightRun'] = 0;
            }
            if (!isset($post['isPTO']))
            {
                $post['isPTO'] = 0;
            }
            if (!isset($post['isHoliday']))
            {
                $post['isHoliday'] = 0;
            }


            if (new DateTimeImmutable($startDateTime) > new DateTimeImmutable($endDateTime))
            {
                Messages::setMsg('The Start Date / Time must be earlier than the End Date / Time', 'error');
                return; // do I want a return statement or do I want something different?
            }

            if ($post['is24HrShift'] == 0)
            {
                $is24 = 'N';
            } else if ($post['is24HrShift'] == 1)
            {
                $is24 = 'Y';
            } else
            {
                Messages::setMsg('Invalid Entry.  Please Try again.', 'error');
            }

            if ($post['isHoliday'] == 0)
            {
                $isHoliday = 'N';
            } else if ($post['isHoliday'] == 1)
            {
                $isHoliday = 'Y';
            } else
            {
                Messages::setMsg('Invalid Entry.  Please Try again.', 'error');
            }

            if ($post['isPTO'] == 0)
            {
                $isPTO = 'N';
            } else if ($post['isPTO'] == 1)
            {
                $isPTO = 'Y';

                /*
                 * Pull the value of whichPTO obtained from the data input page
                 * and assign the appropriate PTO day a value of 'Y'.
                 * 
                 * Only one of these can be true at a time.
                 */
                switch ($post['whichPTO'])
                {
                    case whichPTOVaca: // PTO Vacation Day
                        $isVaca = 'Y';
                        $isPerson = 'N';
                        $isSick = 'N';
                        $isBerev = 'N';
                        $isFMLA = 'N';
                        break;
                    case whichPTOPerson: // PTO Personal Day
                        $isVaca = 'N';
                        $isPerson = 'Y';
                        $isSick = 'N';
                        $isBerev = 'N';
                        $isFMLA = 'N';
                        break;
                    case whichPTOSick;  // PTO Sick Day
                        $isVaca = 'N';
                        $isPerson = 'N';
                        $isSick = 'Y';
                        $isBerev = 'N';
                        $isFMLA = 'N';
                        break;
                    case whichPTODead; // PTO Berevement Day
                        $isVaca = 'N';
                        $isPerson = 'N';
                        $isSick = 'N';
                        $isBerev = 'Y';
                        $isFMLA = 'N';
                        break;
                    case whichPTOFMLA; // PTO FMLA Day
                        $isVaca = 'N';
                        $isPerson = 'N';
                        $isSick = 'N';
                        $isBerev = 'N';
                        $isFMLA = 'Y';
                        break;
                    default:
                        $isVaca = 'N';
                        $isPerson = 'N';
                        $isSick = 'N';
                        $isBerev = 'N';
                        $isFMLA = 'N';
                        break;
                }
            } else
            {
                Messages::setMsg('Invalid Entry.  Please Try again.', 'error');
            }

            if (!isset($post['isNightRun']))
            {
                $isNightRun = 'N';
                $post['isNightRun'] = 'N';
            } else if ($post['isNightRun'] == 0)
            {
                $isNightRun = 'N';
            } else if ($post['isNightRun'] == 1)
            {
                $isNightRun = 'Y';
            } else
            {
                Messages::setMsg('Invalid Entry.  Please Try again.', 'error');
            }

            $adjustedTime = Miscellaneous::timeAdjust($post);      //Adjusts the time to the nearest 15 min in favor of the employee

            $calculatedTime = Miscellaneous::calculateTime($adjustedTime);  // Calculates the time for worked hours, overtime hours and non-worked hours
            // for this one entry only.

            $regTime = $calculatedTime[0]->h . ':' . $calculatedTime[0]->i . ':00';
            $overTime = $calculatedTime[1]->h . ':' . $calculatedTime[1]->i . ':00';
            $nonWorkTime = $calculatedTime[2]->h . ':' . $calculatedTime[2]->i . ':00';

            try
            {
                $this->transactionStart(); // Starting a transaction so if any one part of this fails, the whole transaction will be rolled back.

                $this->query('INSERT INTO employee_payrollhours '
                        . '(Employee_Number, DateTime_In, DateTime_Out, Is_24Hour_Shift, Is_Sick_Day, Is_Vacation_Day, Is_Personal_Day, '
                        . 'Is_Holiday, Is_Berevement_Day, Is_FMLA_Day, Is_Night_Run, RegularTime, OverTime, NonWorkTime) '
                        . 'VALUES (:empNum, :startTime, :endTime, :is24, :isSick, :isVaca, :isPersonal, :isHoliday, :isBereve, :isFMLA, :isNight, '
                        . ':regTime, :overTime, :nonWorkTime)');
                $this->bind(':empNum', $_SESSION['user_data']['empNum']);
                $this->bind(':startTime', $startDateTime);
                $this->bind(':endTime', $endDateTime);
                $this->bind(':is24', $is24);
                $this->bind(':isSick', $isSick);
                $this->bind(':isVaca', $isVaca);
                $this->bind(':isPersonal', $isPerson);
                $this->bind(':isHoliday', $isHoliday);
                $this->bind(':isBereve', $isBerev);
                $this->bind(':isFMLA', $isFMLA);
                //$this->bind(':isShortTerm', $is) // does the administrator or employee need to set the long term and short term disability?
                $this->bind(':isNight', $isNightRun);
                $this->bind(':regTime', $regTime);
                $this->bind(':overTime', $overTime);
                $this->bind(':nonWorkTime', $nonWorkTime);
                $this->execute();

                $this->transactionCommit();
                Messages::setMsg('Success', 'success');
            } catch (PDOException $ex)
            {
                $this->transactionRollback();
                echo $ex->getMessage();
                Messages::setMsg($ex->getMessage(), 'error');
            }
        }
    }

    public function historicalpay()
    {
        Miscellaneous::checkIsLoggedIn();
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        /*
         * So far, I have not figured out a way to handle an entry if it has been 
         * soft deleted.  Actually, I think I might have, since I started typing this
         * 
         * This method will be used to display historical pay sheet for a particular
         * user.
         * 
         * Actually, after thinking about it, I think the orignial idea of having
         * to read each line and calculate the values is wrong.  I have columns
         * in the DB for the individual lines totals.  I can simply add those
         * together.  I will have the website calculate the final values as each
         * entry is made.
         * 
         * ***********************************************************************
         * 
         * I need to devise a layout scheme as well as the logic to pull the information.
         * I probably also need to have some sort of search function.
         * 
         * 10) will need to determine the desired date range to be displayed
         * 20) Will need to determine the first day of the pay period
         * 30) Will need to decide between a detailed view vs a composite view
         * 35) Start with the first day of a pay period
         * 40) Read a line of data
         * 45) Has this line of data been soft deleted?  If yes, go back to 40
         *      if no, continue.
         * 50) Determine if it is overtime, straight time, etc and assign it
         *      to the appropriate variable
         * 55) I will need to consolidate the time into each day and then into
         *      each week and then into each pay period.
         * 60) Read next line of data
         * 65) Has this line of data been soft deleted?  If yes, go back to 60
         *      if no, continue.
         * 67) Does it belong to the same "day"?  If yes, add it to the day's totals.
         *      If no, start a new day.
         * 70) Does it belong to the current week? if yes go back to 50
         *      if no then does it belong to the current pay period?
         *      if yes then start a new week and go back to 50
         *      if no then start a new pay period then go back to 50
         * 80) When all the lines of data have been processed, display the results
         * 
         * $createDateTime = date_create($result['Creation_DateTime']);  // DateTime the token was first created and stored in the DB
         */

        $weekOne = [];
        $weekTwo = [];
        $payPeriod = [$weekOne, $weekTwo];
      
        //$regHours = 0.0;        // Hours the employee was actually on the clock
        //$overtimeHours = 0.0;   // Overtime hours
        //$nonWorkHours = 0.0;    // Hours paid to the employee while the employee was not
        // working.  example:  Sick Day, Vacation Day, other PTO type days.

        /**
        $this->query('SELECT * FROM employee_payrollhours WHERE Employee_Number = :Employee_Number');
        $this->bind(':Employee_Number', $_SESSION['user_data']['empNum']);
        $resultSetPayroll = $this->resultSet();
        if (empty($resultSetPayroll))
        {
            Messages::setMsg('There is no data to retrieve for this user', 'error');
            header('Location: ' . ROOT_URL . 'employees');
        }

        $this->query('SELECT * FROM employees WHERE Employee_Number = :Employee_Number ORDER BY Inserted_at DESC LIMIT 1');
        $this->bind(':Employee_Number', $_SESSION['user_data']['empNum']);
        $resultSetEmployee = $this->resultSet();

        $dow = 1;  // $dow = day of week.  This is an internal counter to track the days.

        ${"day" . $dow} = array(
            '$regHours' => '0.0',
            '$overtimeHours' => '0.0',
            '$nonWorkHours' => '0.0',
        );


        $empNum = $resultSetPayroll['Employee_Number'];
        $dateTimeIn = $resultSetPayroll['DateTime_In'];
        $dateTimeOut = $resultSetPayroll['DateTime_Out'];
        $is24 = $resultSetPayroll['Is_24Hour_Shift'];
        $isSickDay = $resultSetPayroll['Is_Sick_Day'];
        $isVacation = $resultSetPayroll['Is_Vacation_Day'];
        $isHoliday = $resultSetPayroll['Is_Holiday'];
        $isBerevement = $resultSetPayroll['Is_Berevement_Day'];
        $isFMLA = $resultSetPayroll['Is_FMLA_Day'];
        $isShortTerm = $resultSetPayroll['Is_Short_Term_Disablility_Day'];
        $isLongTerm = $resultSetPayroll['Is_Long_Term_Disability_Day'];
        $isNightRun = $resultSetPayroll['Is_Night_Run'];

        $sickDays = $resultSetEmployee['Sick_Days_Remaining'];
        $vacaDays = $resultSetEmployee['Vacation_Days_Remaining'];
        $personDays = $resultSetEmployee['Personal_Days_Remaining'];
        $fmlaDays = $resultSetEmployee['FMLA_Days_Remaining'];
         * 
         */

        /*
          foreach ($resultSet as $key => $value)
          {
          if (!isset($resultSet['Deleted_at']))
          {
          if ($resultSet['Is_24Hour_Shift'])
          {
          // need some way to track to which day (variable) this is to be added.
          ${$day . $dow}['$regHours'] = ${$day . $dow}['$regHours'] + 16.0;
          }
          }
          }
         * 
         */

        /*
         * Take the user's requested first day of search and find the mod of it
         * and the reference date. If mod = 0, then it is the first day of a pay period
         * otherwise it is not.
         */        
    }

    public function ptodays()
    {
        Miscellaneous::checkIsLoggedIn();
        
        try
        {
            $this->query('SELECT * FROM employees WHERE Employee_Number = :Employee_Number ORDER BY Inserted_at DESC LIMIT 1');
            $this->bind(':Employee_Number', $_SESSION['user_data']['empNum']);
            $row = $this->single();
        } catch (PDOException $ex)
        //if (empty($row))
        {
            Messages::setMsg($ex->getMessage(), 'error');
            //Messages::setMsg('There was an error in your query.  Please try again', 'error');
            return;
        }
        return $row;
    }

    public function knownwebsiteissues()
    {
        Miscellaneous::checkIsLoggedIn();
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        /*
          $ch = curl_init("https://github.com/pavulon18/gcas_timesheet_php_website/issues");
          $fp = fopen("/views/employees/issues.html", "w");

          curl_setopt($ch, CURLOPT_FILE, $fp);
          curl_setopt($ch, CURLOPT_HEADER, 0);

          curl_exec($ch);
          curl_close($ch);
          fclose($fp);
          return;
         * 
         */
        return;
    }

    public function currentpay()
    {
        
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
        Miscellaneous::checkIsLoggedIn();
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $now = new DateTime("now");
        //$now = new DateTime('2018-04-15 08:00:00'); // This is for debugging the database
        
        $firstDayObject = Miscellaneous::determineFirstDay($now);
        
        $lastDayObject = $firstDayObject; //+ DateTimeImmutable::add()
        $firstDayObject = DateTimeImmutable::createFromMutable( $firstDayObject );
        
        $lastDayObject->add(new DateInterval('P14D'));
        //$lastDayObject->add(new DateInterval('P140D'));  // Debugging the database
        //$lastDayObject->add(new DateInterval('P200D'));
        //$lastDayObject->add(new DateInterval('P2D'));
        $firstDay = $firstDayObject->format('Y-m-d') . ' 08:00:00';
        $lastDay = $lastDayObject->format('Y-m-d') . ' 08:00:00';
        
        $this->query('SELECT * from employee_payrollhours where Employee_Number = :empNum and DateTime_In >= :firstDay and DateTime_In < :lastDay');
        $this->bind(':empNum', $_SESSION['user_data']['empNum']);
        $this->bind('firstDay', $firstDay);
        $this->bind('lastDay', $lastDay);
        $rows = $this->resultSet();
        return $rows;
    }
}
