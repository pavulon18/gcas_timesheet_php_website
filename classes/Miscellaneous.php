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
 * A exercise to see if I understand what I think I understand.
 * 
 * I am trying to populate the fields of a dropdown box.  I'm trying to reuse
 * the code I already have in my project.
 */

class Miscellaneous extends Model
{
    //put your code here
    public function dropdown($query)
    {
        // I am trying to populate dropdown lists from values from the database.
        // I should be able to do it with the code already written.  I need to 
        // figure out how to do it.  The options I have tried already have lead to
        // errors like:
        // PHP Deprecated:  Non-static method Model::populateDropdown() should not be called statically in C:\wamp64\www\GCASTimesheet\views\employees\register.php on line 165
        // or
        // PHP Fatal error:  Uncaught Error: Using $this when not in object context in C:\wamp64\www\GCASTimesheet\classes\Model.php:107
        // I'm trying to learn what I am doing wrong and how to fix it.
        
        $this->query($query);
        $rows = $this->resultSet();
        return $rows;

    }
}
