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

    public static function startTimeAdjust($unadjustedTime) // Adjusts the start time up to 15 minutes to favor the employee
    {
        if ($unadjustedTime['startMin'] >= 0 && $unadjustedTime['startMin'] <= 14)
        {
            $unadjustedTime['startMin'] = 0;
            return $unadjustedTime;
        } else if ($unadjustedTime['startMin'] >= 15 && $unadjustedTime['startMin'] <= 29)
        {
            $unadjustedTime['startMin'] = 15;
            return $unadjustedTime;
        } else if ($unadjustedTime['startMin'] >= 30 && $unadjustedTime['startMin'] <= 44)
        {
            $unadjustedTime['startMin'] = 30;
            return $unadjustedTime;
        } else
        {
            $unadjustedTime['startMin'] = 45;
            return $unadjustedTime;
        }
    }

    public static function endTimeAdjust($unadjustedTime) // Adjusts the end time up to 15 minutes to favor the employee
    {
        if ($unadjustedTime['endMin'] >= 1 && $unadjustedTime['endMin'] <= 15)
        {
            $unadjustedTime['endMin'] = 15;
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

    public static function calculateTime($post, $adjustedStartTime, $adjustedEndTime)
    {
        if ($post['is24HrShift'])
        {
            if (!$post['isNightRun'] && !$post['isHoliday'] && !$post['isPTO'])
            {
                $regHours = 16;
                $otHours = 0;
                $nonWorkHours = 0;
                return [$regHours, $otHours, $nonWorkHours];
            } else if ($post['isNightRun'] && !$post['isHoliday'] && !$post['isPTO'])
            {
                $regHours = 0;
                $otHours = $adjustedEndTime - $adjustedStartTime;
                $nonWorkHours = 0;
                return [$regHours, $otHours, $nonWorkHours];
            } else if (!$post['isNightRun'] && $post['isHoliday'] && !$post['isPTO'])
            {
                $regHours = 0;
                $otHours = 16;
                $nonWorkHours = 8;
                return [$regHours, $otHours, $nonWorkHours];
            } else if (!$post['isNightRun'] && !$post['isHoliday'] && $post['isPTO'])
            {
                $regHours = 0;
                $otHours = 0;
                $nonWorkHours = 16;
                return [$regHours, $otHours, $nonWorkHours];
            }
        } else if (!$post['is24HrShift'])
        {
            if (!$post['isNightRun'] && !$post['isHoliday'] && $post['isPTO'])
            {
                $regHours = 0;
                $otHours = 0;
                $nonWorkHours = $adjustedEndTime - $adjustedStartTime;
                return [$regHours, $otHours, $nonWorkHours];
            }
            else if (!$post['isNightRun'] && $post['isHoliday'] && !$post['isPTO']) // Need to differentiate between when one works and does not work
            {
                $regHours = 0;
                $otHours = $adjustedEndTime - $adjustedStartTime;
                $nonWorkHours = 8;
                return [$regHours, $otHours, $nonWorkHours];
            }
        } else
        {
            echo 'there was a problem</p><br>';
        }
    }

}
