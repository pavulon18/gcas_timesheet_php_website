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
?>

<div class="container">
    <div>
        <div class="row justify-content-md-center">
            <div class="col">
                <?php echo 'First Name' ?>
            </div>
            <div class="col">
                <?php echo 'Last Name' ?>
            </div>
            <div class="col">
                <?php echo 'Sick Days Remaining' ?>
            </div>
            <div class="col">
                <?php echo 'Vacation Days Remaining' ?>
            </div>
            <div class="col">
                <?php echo 'Personal Days Remaining' ?>
            </div>
        </div>
   
       
        <div class="row justify-content-md-center">
            <div class="col">
                <?php echo $viewmodel['First_Name']; ?>
            </div>
            <div class="col">
                <?php echo $viewmodel['Last_Name']; ?>
            </div>
            <div class="col">
                <?php echo $viewmodel['Sick_Days_Remaining']; ?>
            </div>
            <div class="col">
                <?php echo $viewmodel['Vacation_Days_Remaining']; ?>
            </div>
            <div class="col">
                <?php echo $viewmodel['Personal_Days_Remaining']; ?>
            </div>
        </div>
   
</div>
