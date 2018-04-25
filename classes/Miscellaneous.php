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
 * Description of Miscellaneous
 *
 * @author Jim Baize <pavulon@hotmail.com>
 * 
 * This might be poor programming practice, but I don't know where else
 * to put the following methods.
 */
class Miscellaneous extends Model
{

    public function dropdown($query)
    {
        // This method makes it possible to populate a dropdown box using data
        // from the database.

        $this->query($query);
        $rows = $this->resultSet();
        return $rows;
    }

    public static function notify_password($email, $link)
    {
        $from = "From: jbaize@gibsoncounty-in.gov \r\n";
        $mesg = "Someone has requested that your Gibson County Web Portal password be changed" . PHP_EOL
                . "Please click on the following link to change your password." . PHP_EOL
                . "<a href=" . $link . "></a>";

        if (mail($email, 'Gibson County Ambulance Service login information', $mesg, $from))
        {
            return true;
        }
        else
        {
            throw new Exception('Could not send email.');
        }

        return;
    }

    public static function isPasswordExpired($empNumber)
    {
        /*
         * Set up the query to search for the employee number
         * if the flag in the DB is set to 1 then take the user to the password
         * change form
         */

        echo 'Set up the query to search for the employee number
         if the flag in the DB is set to 1 then take the user to the password
         change form';
    }

    public static function timeAdjust($unadjustedTime) // Adjusts the start time up to 15 minutes to favor the employee
    {
        if ($unadjustedTime['startMin'] >= 0 && $unadjustedTime['startMin'] <= 14)
        {
            $unadjustedTime['startMin'] = 0;
        }
        else if ($unadjustedTime['startMin'] >= 15 && $unadjustedTime['startMin'] <= 29)
        {
            $unadjustedTime['startMin'] = 15;
        }
        else if ($unadjustedTime['startMin'] >= 30 && $unadjustedTime['startMin'] <= 44)
        {
            $unadjustedTime['startMin'] = 30;
        }
        else if ($unadjustedTime['startMin'] >= 45 && $unadjustedTime['startMin'] <= 59)
        {
            $unadjustedTime['startMin'] = 45;
        }
        else
        {
            Messages::setMsg('Invalid Entry.  Please Try again.', 'error');
            return;
        }

        if ($unadjustedTime['endMin'] == 0)
        {
            $unadjustedTime['endMin'] = 0;
        }
        else if ($unadjustedTime['endMin'] >= 1 && $unadjustedTime['endMin'] <= 15)
        {
            $unadjustedTime['endMin'] = 15;
        }
        else if ($unadjustedTime['endMin'] >= 16 && $unadjustedTime['endMin'] <= 30)
        {
            $unadjustedTime['endMin'] = 30;
        }
        else if ($unadjustedTime['endMin'] >= 31 && $unadjustedTime['endMin'] <= 45)
        {
            $unadjustedTime['endMin'] = 45;
        }
        else if ($unadjustedTime['endMin'] >= 46 && $unadjustedTime['endMin'] <= 59)
        {
            $unadjustedTime['endMin'] = 0;
            $unadjustedTime['endHour'] = $unadjustedTime['endHour'] + 1;
        }
        else
        {
            Messages::setMsg('Invalid Entry.  Please Try again.', 'error');
            return;
        }
        return $unadjustedTime; // this is really now the adjusted time.
    }

    public static function calculateTime($adjustedTime)
    {
        /**
         * This method takes the responses from the user and decides how much time
         * to apply to the employees time sheet for each individual entry.
         * 
         * This method does not look at the total hours for a week.  The overtime
         * adjustments for the week will be made elsewhere.
         */
        $adjustedStartTime = new DateTimeImmutable($adjustedTime['startYear'] . '-' . $adjustedTime['startMonth'] . '-' . $adjustedTime['startDay'] . ' ' . $adjustedTime['startHour'] . ':' . $adjustedTime['startMin'] . ':00');
        $adjustedEndTime = new DateTimeImmutable($adjustedTime['endYear'] . '-' . $adjustedTime['endMonth'] . '-' . $adjustedTime['endDay'] . ' ' . $adjustedTime['endHour'] . ':' . $adjustedTime['endMin'] . ':00');

        if ($adjustedTime['is24HrShift'])
        {
            echo '<p>is24HrShift</p><br>';
            if (!$adjustedTime['isNightRun'] && !$adjustedTime['isHoliday'] && !$adjustedTime['isPTO'])
            {
                $regHours = new DateInterval("PT16H0M");
                $otHours = new DateInterval("PT0H0M");
                $nonWorkHours = new DateInterval("PT0H0M");
                return [$regHours, $otHours, $nonWorkHours];
            }
            else if ($adjustedTime['isNightRun'] && !$adjustedTime['isHoliday'] && !$adjustedTime['isPTO'])
            {
                $regHours = new DateInterval("PT0H0M");
                $otHours = $adjustedEndTime->diff($adjustedStartTime);
                if ($otHours >= new DateInterval("PT3H0M"))
                {
                    $otHours = new DateInterval("PT8H0M");
                }
                $nonWorkHours = new DateInterval("PT0H0M");
                return [$regHours, $otHours, $nonWorkHours];
            }
            else if (!$adjustedTime['isNightRun'] && $adjustedTime['isHoliday'] && !$adjustedTime['isPTO'])
            {
                $regHours = new DateInterval("PT0H0M");
                $otHours = new DateInterval("PT16H0M");
                $nonWorkHours = new DateInterval("PT8H0M");
                return [$regHours, $otHours, $nonWorkHours];
            }
            else if (!$adjustedTime['isNightRun'] && !$adjustedTime['isHoliday'] && $adjustedTime['isPTO'])
            {
                $regHours = new DateInterval("PT0H0M");
                $otHours = new DateInterval("PT0H0M");
                $nonWorkHours = new DateTimeImmutable('16:00');
                return [$regHours, $otHours, $nonWorkHours];
            }
        }
        else if (!$adjustedTime['is24HrShift'])
        {
            if (!$adjustedTime['isNightRun'] && !$adjustedTime['isHoliday'] && $adjustedTime['isPTO'])
            {
                $regHours = new DateInterval("PT0H0M");
                $otHours = new DateInterval("PT0H0M");
                $nonWorkHours = $adjustedEndTime->diff($adjustedStartTime);
                return [$regHours, $otHours, $nonWorkHours];
            }
            else if (!$adjustedTime['isNightRun'] && $adjustedTime['isHoliday'] && !$adjustedTime['isPTO']) // Need to differentiate between when one works and does not work
            {
                $regHours = new DateInterval("PT0H0M");
                $otHours = $adjustedEndTime->diff($adjustedStartTime);
                $nonWorkHours = new DateInterval("PT8H0M");
                return [$regHours, $otHours, $nonWorkHours];
            }
            else if (!$adjustedTime['isNightRun'] && !$adjustedTime['isHoliday'] && !$adjustedTime['isPTO']) // Need to differentiate between when one works and does not work
            {
                $regHours = $adjustedEndTime->diff($adjustedStartTime);
                $otHours = new DateInterval("PT0H0M");
                $nonWorkHours = new DateInterval("PT0H0M");
                return [$regHours, $otHours, $nonWorkHours];
            }
            else
            {
                Messages::setMsg('There was an error with non-24 hour work period', 'error');
            }
        }
        else
        {
            Messages::setMsg('<p>There was a problem</p><br>', 'error');
        }
    }

    public static function checkIsLoggedIn()
    {
        if (isset($_SESSION['is_logged_in']))
        {
            return;
        }
        else
        {
            $string = '<p>You are not logged in.</p><br><p>You must be logged in' .
                    ' to view this page.</p><br>';
            Messages::setMsg($string, 'info');
            echo "<META http-equiv='refresh' content='0;URL=" . ROOT_URL . "employees/login'>";
            die();
        }
    }

    public static function checkIsAdmin()
    {
        /**
         * I know it is bad form to have a "magic number" in this next line.
         * I need to think of a better of of doing this.  Until that time, 
         * 1 = employee
         * 2 = administrator
         */
        if (isset($_SESSION['is_logged_in']) && $_SESSION['user_data']['securityRole'] == 2)
        {

            return;
        }
        else
        {
            print_r($_SESSION);
            die();
            $string = '<p>You are not an administrator.</p><br><p>You must be' .
                    ' an administrator to view this page.</p><br>';
            Messages::setMsg($string, 'info');
            echo "<META http-equiv='refresh' content='0;URL=" . ROOT_URL . "employees'>";
            die();
        }
    }

    public static function determineFirstDay($currentDate)
    {
        /**
         * This will determine the first day of a pay period
         * The parameter passed to this function will be the date in question.
         * This function will then count backwards until it finds the first day
         * of the pay period.
         */
        $referenceDate = new DateTime(REFERENCE_DATE);
        $dayOne = $currentDate;

        $interval = intval(($dayOne->diff($referenceDate, TRUE)->format('%R%a')));

        $i = 0;
        while (($interval % 14) != 0) // If i have done my logic correctly, this will find the first
        {                                                       // day of the pay period prior to the user selected first day.
            $dayOne->modify("-1 day");
            $interval = intval(($dayOne->diff($referenceDate, TRUE)->format('%R%a')));
            $i++;
            if ($i > 20)
            {
                Messages::setMsg('There was a problem finding the first day of the pay period', 'error');
                echo "<META http-equiv='refresh' content='0;URL=" . ROOT_URL . "employees'>";
                die();
            }
        }
        return ($dayOne);
    }

    public static function mostRecentModifiedFileTime($dirName, $doRecursive)
    {
        $d = dir($dirName);
        $lastModified = 0;
        while ($entry = $d->read())
        {
            if ($entry != "." && $entry != "..")
            {
                if (!is_dir($dirName . "/" . $entry))
                {
                    $currentModified = filemtime($dirName . "/" . $entry);
                }
                else if ($doRecursive && is_dir($dirName . "/" . $entry))
                {
                    $currentModified = Miscellaneous::mostRecentModifiedFileTime($dirName . "/" . $entry, true);
                }
                if ($currentModified > $lastModified)
                {
                    $lastModified = $currentModified;
                }
            }
        }
        $d->close();
        return $lastModified;
    }

}
