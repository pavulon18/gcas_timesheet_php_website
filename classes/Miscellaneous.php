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
        } else
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
        } else if ($unadjustedTime['startMin'] >= 15 && $unadjustedTime['startMin'] <= 29)
        {
            $unadjustedTime['startMin'] = 15;
        } else if ($unadjustedTime['startMin'] >= 30 && $unadjustedTime['startMin'] <= 44)
        {
            $unadjustedTime['startMin'] = 30;
        } else if ($unadjustedTime['startMin'] >= 45 && $unadjustedTime['startMin'] <= 59)
        {
            $unadjustedTime['startMin'] = 45;
        } else
        {
            Messages::setMsg('Invalid Entry.  Please Try again.', 'error');
            return;
        }

        if ($unadjustedTime['endMin'] == 0)
        {
            $unadjustedTime['endMin'] = 0;
        } else if ($unadjustedTime['endMin'] >= 1 && $unadjustedTime['endMin'] <= 15)
        {
            $unadjustedTime['endMin'] = 15;
        } else if ($unadjustedTime['endMin'] >= 16 && $unadjustedTime['endMin'] <= 30)
        {
            $unadjustedTime['endMin'] = 30;
        } else if ($unadjustedTime['endMin'] >= 31 && $unadjustedTime['endMin'] <= 45)
        {
            $unadjustedTime['endMin'] = 45;
        } else if ($unadjustedTime['endMin'] >= 46 && $unadjustedTime['endMin'] <= 59)
        {
            $unadjustedTime['endMin'] = 0;
            $unadjustedTime['endHour'] = $unadjustedTime['endHour'] + 1;
        } else
        {
            Messages::setMsg('Invalid Entry.  Please Try again.', 'error');
            return;
        }
        return $unadjustedTime; // this is really now the adjusted time.
    }

    /*
      public static function endTimeAdjust($unadjustedTime) // Adjusts the end time up to 15 minutes to favor the employee
      {
      if ($unadjustedTime['endMin'] >= 1 && $unadjustedTime['endMin'] <= 15)
      {
      $unadjustedTime['endMin'] = 15;
      print_r($unadjustedTime);
      die();
      return $unadjustedTime;
      } else if ($unadjustedTime['endMin'] >= 16 && $unadjustedTime['endMin'] <= 30)
      {
      $unadjustedTime['endMin'] = 30;
      return $unadjustedTime;
      } else if ($unadjustedTime['endMin'] >= 31 && $unadjustedTime['endMin'] <= 45)
      {
      $unadjustedTime['endMin'] = 45;
      return $unadjustedTime;
      } else
      {
      $unadjustedTime['endMin'] = 0;
      $unadjustedTime['endHour'] ++;

      return $unadjustedTime;
      }
      }
     * 
     */

    public static function calculateTime($adjustedTime)
    {
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
            } else if ($adjustedTime['isNightRun'] && !$adjustedTime['isHoliday'] && !$adjustedTime['isPTO'])
            {
                $regHours = new DateInterval("PT0H0M");
                $otHours = $adjustedEndTime->diff($adjustedStartTime);
                $nonWorkHours = new DateInterval("PT0H0M");
                return [$regHours, $otHours, $nonWorkHours];
            } else if (!$adjustedTime['isNightRun'] && $adjustedTime['isHoliday'] && !$adjustedTime['isPTO'])
            {
                $regHours = new DateInterval("PT0H0M");
                $otHours = new DateInterval("PT16H0M");
                $nonWorkHours = new DateInterval("PT8H0M");
                return [$regHours, $otHours, $nonWorkHours];
            } else if (!$adjustedTime['isNightRun'] && !$adjustedTime['isHoliday'] && $adjustedTime['isPTO'])
            {
                $regHours = new DateInterval("PT0H0M");
                $otHours = new DateInterval("PT0H0M");
                $nonWorkHours = new DateTimeImmutable('16:00');
                return [$regHours, $otHours, $nonWorkHours];
            }
        } else if (!$adjustedTime['is24HrShift'])
        {
            if (!$adjustedTime['isNightRun'] && !$adjustedTime['isHoliday'] && $adjustedTime['isPTO'])
            {
                $regHours = new DateInterval("PT0H0M");
                $otHours = new DateInterval("PT0H0M");
                $nonWorkHours = $adjustedEndTime->diff($adjustedStartTime);
                return [$regHours, $otHours, $nonWorkHours];
            } else if (!$adjustedTime['isNightRun'] && $adjustedTime['isHoliday'] && !$adjustedTime['isPTO']) // Need to differentiate between when one works and does not work
            {
                $regHours = new DateInterval("PT0H0M");
                $otHours = $adjustedEndTime->diff($adjustedStartTime);
                $nonWorkHours = new DateInterval("PT8H0M");
                return [$regHours, $otHours, $nonWorkHours];
            } else if (!$adjustedTime['isNightRun'] && !$adjustedTime['isHoliday'] && !$adjustedTime['isPTO']) // Need to differentiate between when one works and does not work
            {
                $regHours = $adjustedEndTime->diff($adjustedStartTime);
                $otHours = new DateInterval("PT0H0M");
                $nonWorkHours = new DateInterval("PT0H0M");
                return [$regHours, $otHours, $nonWorkHours];
            } else
            {
                Messages::setMsg('There was an error with non-24 hour work period', 'error');
            }
        } else
        {
            Messages::setMsg('<p>There was a problem</p><br>', 'error');
        }
    }

    public static function checkIsLoggedIn()
    {
        if (isset($_SESSION['is_logged_in']))
        {
            return;
        } else
        {
            echo "<META http-equiv='refresh' content='0;URL=" . ROOT_URL . "'>";
        }
    }
    
    public static function checkIsAdmin()
    {
        if (isset($_SESSION['is_logged_in']))
        {
            return;
        } else
        {
            echo "<META http-equiv='refresh' content='0;URL=" . ROOT_URL . "'>";
            // flush(); // Flush the buffer
            // ob_flush();
            //header('Location: ' . ROOT_URL);
        }
    }
}
