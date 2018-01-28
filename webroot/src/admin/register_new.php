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
  require_once('src/timesheet_fns.php');

  //create short variable names
  $email=$_POST['email'];
  $username=$_POST['username'];
  $passwd=$_POST['passwd'];
  $passwd2=$_POST['passwd2'];
  // start session which may be needed later
  // start it now because it must go before headers
  session_start();
  try   {
    // check forms filled in

    if (!filled_out($_POST)) {
      throw new Exception('You have not filled the form out correctly - please go back and try again.');
    }

    // email address not valid
    if (!valid_email($email)) {
      throw new Exception('That is not a valid email address.  Please go back and try again.');
    }

    // passwords not the same
    if ($passwd != $passwd2) {
      throw new Exception('The passwords you entered do not match - please go back and try again.');
    }

    // check password length is ok
    // ok if username truncates, but passwords will get
    // munged if they are too long.
    if ((strlen($passwd) < 6) || (strlen($passwd) > 16)) {
      throw new Exception('Your password must be between 6 and 16 characters. Please go back and try again.');
    }

    // attempt to register
    // this function can also throw an exception
    register($username, $email, $passwd);
    // register session variable
    $_SESSION['valid_user'] = $username;

    // provide link to members page
    do_html_header('Registration successful');
    echo 'Your registration was successful.  Go to the members page to start setting up your bookmarks!';
    do_html_url('employees/member.php', 'Go to members page');

   // end page
   do_html_footer();
  }
  catch (Exception $e) {
     do_html_header('Problem:');
     echo $e->getMessage();
     do_html_footer();
     exit;
  }
?>
