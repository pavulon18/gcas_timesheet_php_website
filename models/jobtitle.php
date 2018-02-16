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

class JobTitleModel extends Model
{

    public function Index()
    {
        $this->query('SELECT * FROM job_titles');
        $rows = $this->resultSet();
        return $rows;
    }

    public function add()
    {
        //Sanatize Post
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        if($post['submit'])
        {
           $this->query('INSERT INTO job_titles (Job_Title, Duties, Pay_Type, Pay_Rate_Basis, Effective_Start_DateTime) VALUES()');
           $this->bind(':Job_Title', $post['Job_Title']);
           $this->bind(':Duties', $post['Duties']);
           $this->bind('Pay_Type', $post['Pay_Type']);
           $this->bind('Pay_Rate_Basis', $post['Pay_Rate_Basis']);
           $this->bind('Effective_Start_DateTime', $post['Effective_Start_DateTime']);
        }
    }

}
