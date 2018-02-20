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

abstract class Model
{

    protected $dbh;
    protected $stmt;
    protected $error;

    public function __construct()
    {
        $options = [PDO::ATTR_PERSISTENT    => true,
                    PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
            ];
        
        try
        {
            $this->dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            $this->error= $e->getMessage();
        }
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    //Binds the prep statement
    public function bind($param, $value, $type = null)
    {
        if (is_null($type))
        {
            switch (true)
            {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    public function execute()
    {
        $this->stmt->execute();
    }
    
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
    
    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}
