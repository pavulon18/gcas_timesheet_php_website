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
        $mesg = "Someone has requested that your Gibson County Web Portal password be changed"
                ."Please click on the following link to change your password."
                ."You will be asked to change your password before you can log in again."
                . $link;

        if (mail($email, 'Gibson County Ambulance Service login information', $mesg, $from))
        {
            return true;
        } else
        {
            throw new Exception('Could not send email.');
        }
        
        return;
    }
}
