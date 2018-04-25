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

//This is an example of the config file.  You will need to enter your own database
//details to make this work.

//Define DB Parameters
define("DB_HOST", "");
define("DB_USER", "");
define("DB_PASS", "");
define("DB_NAME", "gcas_payroll");

// Define URL
define("ROOT_PATH", "/");
define("ROOT_URL", "http://gcastimesheet");

// Define Website Constants
define("PAGE_TITLE", "Gibson County Ambuance Service Web Portal");

// Define Reference Date.  This is the first day of a pay period.
// This value will be used to calculate every other pay period.
define("REFERENCE_DATE", "2015-02-12 08:00:00");
