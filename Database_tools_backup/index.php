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

define('MY_PATH', './data/');

function db_connect()
{
    $result = new mysqli('localhost', 'gcems', 'password', 'gcas_payroll');
    if (!$result)
    {
        throw new Exception('Could not connect to database server');
    } else
    {
        return $result;
    }
}

function build_tables_array()
{
    $conn = db_connect();
    $tables_array = [];
    $query = "show tables";

    if ($stmt = $conn->prepare($query))
    {
        $stmt->execute();
        $stmt->bind_result($field1);
        $i = 0;
        while ($stmt->fetch())
        {
            $tables_array[$i] = $field1;
            $i++;
        }
        $stmt->close();
    }
    return $tables_array;
}

function extract_column_names($tbl_array)
{
    $conn = db_connect();
    //$tbl_array = [];
    //$tbl_array = build_tables_array();

    for ($i = 0; $i < count($tbl_array); $i++)
    {
        //echo $tbl_array[$i]. ' $i = '.$i.'<br />';
        write_file_header($tbl_array[$i]);
        $query = "show columns from " . $tbl_array[$i]; // retrieves the names of the columns from the db

        if ($stmt = $conn->prepare($query)) // this has to be '=' and not '==' or '===', despite the netbeans warning.
        {
            $stmt->execute();
            $stmt->bind_result($field1, $field2, $field3, $field4, $field5, $field6);

            while ($stmt->fetch())
            {
                try
                {
                    write_set_get($field1, $tbl_array[$i]); // calls the setter/getter writer 
                    write_attributes($field1, $tbl_array[$i]);  //$field1 will be the method and $tbl_array[$i] will be the file name
                } catch (Exception $e)
                {
                    echo 'Bad things happened';
                }
            }
            $stmt->close();
        }
    }
}

function write_file_header($tmp_class_name)
{
    $string = 'class '.str_replace("_", "",$tmp_class_name).PHP_EOL
            .'{'.PHP_EOL;
    
    $file_name = MY_PATH.$tmp_class_name.'.php'; 
    
    file_put_contents($file_name, $string);
}

function write_attributes($att_name, $class_name)
{
    $att_name = str_replace("_", "", $att_name);
    $string_attribute = 'private $' . $att_name . ';' . PHP_EOL;
    $class_name = trim(preg_replace('/\s+/', ' ', trim($class_name)));

    $new_file_name = MY_PATH . $class_name . '.att'; //attributes file... see the note below, if it is still there.

    file_put_contents($new_file_name, $string_attribute, FILE_APPEND);
}

function write_set_get($column_name, $class_name)
{
    $column_name = str_replace("_", "", $column_name);
    $string_set = 'function __set' . $column_name . ' ($' . $column_name . ', $new' . $column_name . ')' . PHP_EOL
            . '{' . PHP_EOL
            . '    $this->$' . $column_name . ' = $new' . $column_name . ';' . PHP_EOL
            . '}' . PHP_EOL
            . PHP_EOL;
        
    $string_get = 'function __get' . $column_name . ' ($' . $column_name . ')' . PHP_EOL
            . '{' . PHP_EOL
            . '    return $this->$' . $column_name . ';' . PHP_EOL
            . '}' . PHP_EOL
            . PHP_EOL;

    $class_name = trim(preg_replace('/\s+/', ' ', trim($class_name)));

    $new_file_name = MY_PATH . $class_name . '.gs';
    
    file_put_contents($new_file_name, $string_get, FILE_APPEND);
    file_put_contents($new_file_name, $string_set, FILE_APPEND);
}

function merge_files($tables_array)
{
    foreach($tables_array as $class_name)
    {
        try
        {
            $file_name = MY_PATH.$class_name;
            $string = file_get_contents($file_name.'.att');
            file_put_contents($file_name.'.php', $string, FILE_APPEND);
            $string = file_get_contents($file_name.'.gs');
            file_put_contents($file_name.'.php', $string, FILE_APPEND);
        } catch (Exception $ex) // Dont know if this can be $ex or if it has to be $e.
        {    
            echo 'something happened while merging';
        }
    }
}

function start()
{
    //this will start it all
    $tables_array = [];
    $tables_array = build_tables_array();
    extract_column_names($tables_array); // opens the database, gets the table names, and the column names of all the tables.
    // it also writes the setters and getters to files.
    merge_files($tables_array);
}

start();


/*
 * Just had an idea.
 * make one file for the opening tags "<?php and class <classname> {
 * 
 * make a second file with the attributes declarations
 * 
 * make a third file with the setters and getters
 * 
 * then combine the three in order into the *.php file
 */