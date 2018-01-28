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
// include function files for this application
        
require_once('..\timesheet_fns.php');
session_start();

//create short variable names
if (!isset($_POST['username']))
{
    //if not isset -> set with dummy value 
    $_POST['username'] = " ";
}
$username = $_POST['username'];
if (!isset($_POST['passwd']))
{
    //if not isset -> set with dummy value 
    $_POST['passwd'] = " ";
}
$passwd = $_POST['passwd'];

if ($username && $passwd)
{
// they have just tried logging in
    try
    {
        login($username, $passwd);
        // if they are in the database register the user id
        $_SESSION['valid_user'] = $username;
    } catch (Exception $e)
    {
        // unsuccessful login
        do_html_header('Problem:');
        echo 'You could not be logged in.<br>
          You must be logged in to view this page.';
        do_html_url('../../login.php', 'Login');
        do_html_footer();
        exit;
    }
}

do_html_header('Home');
check_valid_user();
// get the bookmarks this user has saved
if ($url_array == get_user_urls($_SESSION['valid_user']))
{
    display_user_urls($url_array);
}

// give menu of options
display_user_menu();

do_html_footer();
?>
