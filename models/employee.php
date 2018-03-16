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
            $this->bind(':empNumber', $row['Employee_Number']);
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

            header('Location: ' . ROOT_URL . 'employees/login');
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


        return;
    }

    public function changeknownpassword()
    {
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
    
    public function currentpay()
    {
        
    }
    
    public function ptodays()
    {
        $this->query('SELECT * FROM employees WHERE Employee_Number = :Employee_Number ORDER BY Inserted_at DESC LIMIT 1');
        $this->bind(':Employee_Number', $_SESSION['user_data']['empNum']);
        $row = $this->single();
        if(empty($row))
        {
            echo 'row is empty';
            die();
        }
        return $row;
    }
}
