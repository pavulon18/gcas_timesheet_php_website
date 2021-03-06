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
        require_once('Mail.php');
        require_once('Mail/mime.php');
        $from = "GCEMS Website Admin <www-data@gcems.duckdns.org>";
        $mesg = "Someone has requested that your Gibson County Web Portal password be changed" . PHP_EOL
                . "Please click on the following link to change your password." . PHP_EOL
                . "<a href=" . $link . "></a>";
        $subj = "Gibson County Ambulance Service Login Information";
        $mime = new Mail_mime();
        $mime->setTXTBody($mesg);
        $body = $mime->get();

        $headers = array('From' => $from,
            'To' => $email,
            'Subject' => $subj);
        $headers = $mime->headers($headers);


        $smtp = Mail::factory('smtp', array('host' => SMTP_HOST,
                    'port' => SMTP_PORT,
                    'auth' => true,
                    'username' => SMTP_USER,
                    'password' => SMTP_PASS));

        $mail = $smtp->send($email, $headers, $body);

        if (PEAR::isError($mail))
        {
            Messages::setMsg($mail->getMessage(), 'error');
        }
        else
        {
            //echo("

              //  Message successfully sent!
               // ");
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
         * adjustments worked hours > 40 for the week will be made elsewhere.
         */
        /**
          echo '<pre>';
          print_r($adjustedTime);
          echo '</pre>';
          die();

          $otHours = 0;
          $regHours = 0;
          $nonWorkHours = 0;
          $nightHours = 0;
         * */
        $adjustedStartTime = new DateTimeImmutable($adjustedTime['startYear'] . '-' . $adjustedTime['startMonth'] . '-' . $adjustedTime['startDay'] . ' ' . $adjustedTime['startHour'] . ':' . $adjustedTime['startMin'] . ':00');
        $adjustedEndTime = new DateTimeImmutable($adjustedTime['endYear'] . '-' . $adjustedTime['endMonth'] . '-' . $adjustedTime['endDay'] . ' ' . $adjustedTime['endHour'] . ':' . $adjustedTime['endMin'] . ':00');

        if ($adjustedTime['is24HrShift'] === 'Y')
        {
            if ($adjustedTime['isNightRun'] === 'N' && $adjustedTime['isHoliday'] === 'N' && $adjustedTime['isPTO'] === 'N')
            {
                $regHours = new DateInterval("PT16H0M");
                $otHours = new DateInterval("PT0H0M");
                $nonWorkHours = new DateInterval("PT0H0M");
                $nightHours = new DateInterval("PT0H0M");
                return ["regHours" => $regHours,
                    "otHours" => $otHours,
                    "ptoHours" => $nonWorkHours,
                    "nightHours" => $nightHours];
            }
            else if ($adjustedTime['isNightRun'] === 'Y' && $adjustedTime['isHoliday'] === 'N' && $adjustedTime['isPTO'] === 'N')
            {
                // if the night run starts and ends within the designated sleep time (2300 - 0700)
                if ((($adjustedStartTime->format('H:i') >= '23:00' && $adjustedStartTime->format('H:i') <= '23:59') || ($adjustedStartTime->format('H:i') >= '00:00' && $adjustedStartTime->format('H:i') <= '07:00')) && (($adjustedEndTime->format('H:i') >= '23:00' && $adjustedEndTime->format('H:i') <= '23:59') || ($adjustedEndTime->format('H:i') >= '00:00' && $adjustedEndTime->format('H:i') <= '07:00')))
                {
                    $regHours = new DateInterval("PT0H0M");
                    $otHours = new DateInterval("PT0H0M");
                    $nonWorkHours = new DateInterval("PT0H0M");
                    $nightHours = $adjustedEndTime->diff($adjustedStartTime);
                    return ["regHours" => $regHours,
                        "otHours" => $otHours,
                        "ptoHours" => $nonWorkHours,
                        "nightHours" => $nightHours];
                }
                // if the night run starts between 2300 and 0700 and the end time is between 0700 and 0800
                elseif ((($adjustedStartTime->format('H:i') >= '23:00' && $adjustedStartTime->format('H:i') <= '23:59') || ($adjustedStartTime->format('H:i') >= '00:00' && $adjustedStartTime->format('H:i') <= '07:00')) && (($adjustedEndTime->format('H:i') >= '07:00' && $adjustedEndTime->format('H:i') <= '08:00')))
                {
                    $regHours = new DateInterval("PT0H0M");                    //  I need to figure out how to keep the date portion and set the time to 07:00.  I think I've done this some place else.  I will have to look for it.
                    $otHours = new DateInterval("PT0H0M");
                    $nonWorkHours = new DateInterval("PT0H0M");
                    $nightHours = (new DateTime($adjustedEndTime->setTime(7, 00, 00)))->diff($adjustedStartTime);
                    return ["regHours" => $regHours,
                        "otHours" => $otHours,
                        "ptoHours" => $nonWorkHours,
                        "nightHours" => $nightHours];
                }
                // if the night run starts between 2300 and 0700 and ends after 0800
                elseif ((($adjustedStartTime->format('H:i') >= '23:00' && $adjustedStartTime->format('H:i') <= '23:59') || ($adjustedStartTime->format('H:i') >= '00:00' && $adjustedStartTime->format('H:i') <= '07:00')) && (($adjustedEndTime->format('H:i') >= '08:00')))
                {
                    $regHours = new DateInterval("PT0H0M");
                    //  I need to figure out how to keep the date portion and set the time to 07:00.  I think I've done this some place else.  I will have to look for it.
                    // $otHours = new DateInterval($adjustedEndTime - (date of $adjustedEndTime @ 0800) *** This is finding the time after the end of the shift which is overtime but not night time hours.
                    $otHours = $adjustedEndTime->diff(new DateTime($adjustedEndTime->setTime(8, 00, 00)));
                    $nonWorkHours = new DateInterval("PT0H0M");
                    $nightHours = (new DateTime($adjustedEndTime->setTime(7, 00, 00)))->diff($adjustedStartTime);
                    return ["regHours" => $regHours,
                        "otHours" => $otHours,
                        "ptoHours" => $nonWorkHours,
                        "nightHours" => $nightHours];
                }
                // if the night run starts before 2300 and ends after 2300 and before 0700
                elseif ($adjustedStartTime->format('H:i') <= '23:00' && (($adjustedEndTime->format('H:i') >= '23:00' && $adjustedEndTime->format('H:i') <= '23:59') || ($adjustedEndTime->format('H:i') >= '00:00' && $adjustedEndTime->format('H:i') <= '07:00')))
                {
                    $regHours = new DateInterval("PT0H0M");
                    $otHours = new DateInterval("PT0H0M");
                    $nonWorkHours = new DateInterval("PT0H0M");
                    $adjustedStartTime->setTime(23, 00, 00);

                    $nightHours = $adjustedStartTime->diff($adjustedEndTime);

                    //$nightHours = new DateTime($adjustedEndTime->diff($adjustedStartTime));
                    return ["regHours" => $regHours,
                        "otHours" => $otHours,
                        "ptoHours" => $nonWorkHours,
                        "nightHours" => $nightHours];
                }
            }
            else if ($adjustedTime['isNightRun'] === 'N' && $adjustedTime['isHoliday'] === 'Y' && $adjustedTime['isPTO'] === 'N')
            {
                $regHours = new DateInterval("PT0H0M");
                $otHours = new DateInterval("PT16H0M");
                $nonWorkHours = new DateInterval("PT8H0M");
                $nightHours = new DateInterval("PT0H0M");
                return ["regHours" => $regHours,
                    "otHours" => $otHours,
                    "ptoHours" => $nonWorkHours,
                    "nightHours" => $nightHours];
            }
            else if ($adjustedTime['isNightRun'] === 'N' && $adjustedTime['isHoliday'] === 'N' && $adjustedTime['isPTO'] === 'Y')
            {
                $regHours = new DateInterval("PT0H0M");
                $otHours = new DateInterval("PT0H0M");
                $nonWorkHours = new DateInterval("PT16H0M");  // I think this is the way it should be calculated.
//                $nonWorkHours = new DateTimeImmutable('16:00'); // I think this might be wrong and might be causing me some errors.  I think it should be DateInterval just like the others
                $nightHours = new DateInterval("PT0H0M");
                return ["regHours" => $regHours,
                    "otHours" => $otHours,
                    "ptoHours" => $nonWorkHours,
                    "nightHours" => $nightHours];
            }
        }
        else if ($adjustedTime['is24HrShift'] === 'N')
        {
            if ($adjustedTime['isNightRun'] === 'N' && $adjustedTime['isHoliday'] === 'N' && $adjustedTime['isPTO'] === 'Y')
            {
                $regHours = new DateInterval("PT0H0M");
                $otHours = new DateInterval("PT0H0M");
                $nonWorkHours = $adjustedEndTime->diff($adjustedStartTime);
                $nightHours = new DateInterval("PT0H0M");
                return ["regHours" => $regHours,
                    "otHours" => $otHours,
                    "ptoHours" => $nonWorkHours,
                    "nightHours" => $nightHours];
            }
            else if ($adjustedTime['isNightRun'] === 'N' && $adjustedTime['isHoliday'] === 'Y' && $adjustedTime['isPTO'] === 'N') // Need to differentiate between when one works and does not work
            {
                $regHours = new DateInterval("PT0H0M");
                $otHours = $adjustedEndTime->diff($adjustedStartTime);
                $nonWorkHours = new DateInterval("PT8H0M");
                $nightHours = new DateInterval("PT0H0M");
                return ["regHours" => $regHours,
                    "otHours" => $otHours,
                    "ptoHours" => $nonWorkHours,
                    "nightHours" => $nightHours];
            }
            else if ($adjustedTime['isNightRun'] === 'N' && $adjustedTime['isHoliday'] === 'N' && $adjustedTime['isPTO'] === 'N') // Need to differentiate between when one works and does not work
            {
                $regHours = $adjustedEndTime->diff($adjustedStartTime);
                $otHours = new DateInterval("PT0H0M");
                $nonWorkHours = new DateInterval("PT0H0M");
                $nightHours = new DateInterval("PT0H0M");
                return ["regHours" => $regHours,
                    "otHours" => $otHours,
                    "ptoHours" => $nonWorkHours,
                    "nightHours" => $nightHours];
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
        $dayOne = new DateTime($currentDate->format('Y-m-d'));
        $dayOne->setTime(8, 00, 00);

        $interval = intval(($dayOne->diff($referenceDate, TRUE)->format('%R%a')));

        $i = 0;
        while (($interval % 14) != 0) // First day of the pay period prior to the user selected first day.
        {
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

    public static function definePayPeriod($currentDate)
    {
        /**
         * This will determine the first day of a pay period
         * The parameter passed to this function will be the date in question.
         * This function will then count backwards until it finds the first day
         * of the pay period.
         */
        $referenceDate = new DateTime(REFERENCE_DATE);
        $dayOne = new DateTime($currentDate->format('Y-m-d'));
        $dayOne->setTime(8, 00, 00);

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

        $middleDayObject = new DateTime($dayOne->format('Y-m-d'));
        $middleDayObject->add(new DateInterval('P7D'))->setTime(8, 00, 00);

        $lastDayObject = new DateTime($dayOne->format('Y-m-d'));
        $lastDayObject->add(new DateInterval('P14D'))->setTime(8, 00, 00);

        return ['firstDay' => $dayOne, 'middleDay' => $middleDayObject, 'lastDay' => $lastDayObject];
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

    public static function weeklyTotals($array)
    {
        $regularTime = 0;
        $overTime = 0;
        $nonWorkTime = 0;
        $nightTime = 0;

        foreach ($array as $counter)
        {
            /**
             * We need to lump all of the night's runs together.  In this method,
             * we will scan each of the entries for a 24 hour shift.  If the entry
             * is a 24 hour shift, check for any other entries that begin or end
             * during the sleep time.   These entries should be the night runs.
             * For each 24 hour shift, sum the night runs.  If they are equal to
             * or greater than 3 hours, set the night to 8 hours.
             */
            if ($counter['Is_Night_Run'] == 'N' && $counter['Is_24Hour_Shift'] == 'Y')
            {
                $nightTime = Miscellaneous::sumNightHours($counter['DateTime_In'], $array); // The night hours will be added to the over time hours before the end of this method.
                $regularTime += $counter['RegularTime'];
                $overTime += $counter['OverTime'];
                $nonWorkTime += $counter['NonWorkTime'];
            }
            elseif (!$counter['Is_Night_Run'])
            {
                $regularTime += $counter['RegularTime'];
                $overTime += $counter['OverTime'];
                $nonWorkTime += $counter['NonWorkTime'];
            }
        }
        //endforeach;

        if ($regularTime > 40)
        {
            $overTime += ($regularTime - 40);
            $regularTime = 40;
        }

        $regularTime += $nonWorkTime;
        $overTime += $nightTime;

        return ["regularTimeTotal" => $regularTime, "overTimeTotal" => $overTime];
    }

    public static function sumNightHours($startDateTime, $array)
    {
        $startNightTime = new DateTime($startDateTime);
        $startNightTime->setTime(23, 00, 00);
        //$startDateTime->format('Y-m-d H:i:s');

        $endNightTime = new DateTime($startDateTime);
        $endNightTime->modify('+1 day');
        $endNightTime->setTime(07, 00, 00);
        //$endDateTime->format('Y-m-d H:i:s');

        $nightTime = 0;

        foreach ($array as $item)
        {
            if ($item['Is_Night_Run'] === 'Y')
            {
                $nightTime += $item['NightTime'];
                if ($nightTime >= 3)
                {
                    $nightTime += 8; // I think this line should be $nightTime = 8;  I'll need to revisit this.
                    break;
                }
            }
        }
        return $nightTime;
    }

    public static function setStartEndTime($post)
    {
        // This method takes the input, decides if it is a pure 24 hour shift or
        // something else.
        // If it is a pure 24 hour shift, it sets the starting and ending variable times as 0800.
        // If is is something different, it sets variable times as the times entered by the user.
        if ($post['is24HrShift'] == 'Y' && $post['isNightRun'] == 'N')
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
        }
        else
        {
            $startDateTime = $post['startYear'] . '-' . $post['startMonth'] . '-' . $post['startDay'] . ' ' . $post['startHour'] . ':' . $post['startMin'] . ':00';
            $endDateTime = $post['endYear'] . '-' . $post['endMonth'] . '-' . $post['endDay'] . ' ' . $post['endHour'] . ':' . $post['endMin'] . ':00';
        }

        // now return the updated information back to the calling method

        return ["post" => $post,
            "start" => $startDateTime,
            "end" => $endDateTime];
    }

    public static function whichPTO($post)
    {
        switch ($post['whichPTO'])
        {
            case "whichPTOVaca": // PTO Vacation Day
                $isVaca = 'Y';
                $isPerson = 'N';
                $isSick = 'N';
                $isBerev = 'N';
                $isFMLA = 'N';
                break;
            case "whichPTOPerson": // PTO Personal Day
                $isVaca = 'N';
                $isPerson = 'Y';
                $isSick = 'N';
                $isBerev = 'N';
                $isFMLA = 'N';
                break;
            case "whichPTOSick";  // PTO Sick Day
                $isVaca = 'N';
                $isPerson = 'N';
                $isSick = 'Y';
                $isBerev = 'N';
                $isFMLA = 'N';
                break;
            case "whichPTODead"; // PTO Berevement Day
                $isVaca = 'N';
                $isPerson = 'N';
                $isSick = 'N';
                $isBerev = 'Y';
                $isFMLA = 'N';
                break;
            case "whichPTOFMLA"; // PTO FMLA Day
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
        return ["vaca" => $isVaca,
            "person" => $isPerson,
            "sick" => $isSick,
            "berev" => $isBerev,
            "fmla" => $isFMLA];
    }

}
