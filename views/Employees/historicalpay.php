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

Miscellaneous::checkIsLoggedIn();

?>
<div>
    <li><h1>This page is still under construction</h1></li>
    <li>Devise a method to separate out the entries which belong to a particular pay period.</li>
    <li>Determine the format to display the information</li>
    <li>Devise a search function</li>

    <li id="daterange">
        <label class="description" for="daterange"> Which date range would you like listed? </label>
        <span>
            <input id="daterangeall" name="daterange" class="element radio" type="radio" value="all"/>
            <label class="choice" for="daterangeall">All</label>
            <input id="daterangeyear" name="daterange" class="element radio" type="radio" value="year"/>
            <label class="choice" for="daterangeyear">Current Year</label>
            <input id="daterangecustom" name="daterange" class="element radio" type="radio" value="custom"/>
            <label class="choice" for="daterangecustom">Custom Date Range</label>
        </span>
    </li>
</div>