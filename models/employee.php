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

        //$pwHash = password_hash($post['password'], PASSWORD_DEFAULT);

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
                //$creationDate = new DateTime();
                $this->query('INSERT INTO recoveryemails_enc (Employee_Number, Token)'
                        . ' VALUES (:empNumber, :token)');
                $this->bind(':token', $tokenHashForDatabase);
                $this->bind(':empNumber', $empNumber);
                $this->execute();
                
                // Send link with the original token
                $emailLink = ROOT_URL . 'employees/reset_password.php?tok=' . $tokenForLink;
            }
        }

        /**
         * psuedo-code for what I am trying to do
         * 
         * $userId = findUserByEmail($_POST['email']);
          if (!is_null($userId))
          {
          // Generate a new token with its hash
          StoPasswordReset::generateToken($tokenForLink, $tokenHashForDatabase);

          // Store the hash together with the UserId and the creation date
          $creationDate = new DateTime();
          savePasswordResetToDatabase($tokenHashForDatabase, $userId, $creationDate);

          // Send link with the original token
          $emailLink = 'https://www.example.com/reset_password.php?tok=' . $tokenForLink;
          sendPasswordResetEmail($emailLink);
          }
         */
    }

}
