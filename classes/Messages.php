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

class Messages
{

    public static function setMsg($text, $type)
    {
        if ($type == 'error')
        {
            $_SESSION['errorMsg'] = $text;
        } elseif ($type == 'sucess')
        {
            $_SESSION['successMsg'] = $text;
        } else
        {
            $_SESSION['infoMsg'] = $text;
        }
    }

    public static function display()
    {
        if (isset($_SESSION['errorMsg']))
        {
            echo '<div class="alert alert-danger">' . $_SESSION['errorMsg'] . '</div>';
            unset($_SESSION['errorMsg']);
        }

        if (isset($_SESSION['successMsg']))
        {
            echo '<div class="alert alert-sucess">' . $_SESSION['successMsg'] . '</div>';
            unset($_SESSION['successMsg']);
        }
        
        if (isset($_SESSION['infoMsg']))
        {
            echo '<div class="alert alert-info">' . $_SESSION['infoMsg'] . '</div>';
            unset($_SESSION['infoMsg']);
        }
    }

}
