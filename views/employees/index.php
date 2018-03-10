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
<!-- Tab links -->
        <div class="tab">
            <button class="tablinks" onclick="openUser(event, 'currtimesheet')">Current Time Sheet</button>
            <button class="tablinks" onclick="openUser(event, 'oldtimesheet')">Previous Time Sheets</button>
            <button class="tablinks" onclick="openUser(event, 'daysoffremaining')">PTO Days Remaining</button>
            <button class="tablinks" onclick="openUser(event, 'dayoffrequest')">Day Off Request Form</button>
        </div>

        <!-- Tab content -->
        <div id="currtimesheet" class="tabcontent">
            <h3>Current Time Sheet</h3>
            <p>This is will display and possibly edit the current time sheet</p>
        </div>

        <div id="oldtimesheet" class="tabcontent">
            <h3>Previous Time Sheets</h3>
            <p>This page will allow a user to display the user's own historical time sheets</p>
        </div>

        <div id="daysoffremaining" class="tabcontent">
            <h3>PTO Days</h3>

            <p>This will display a current accounting of the user's PTO days</p>
        </div>
        
        <div id="dayoffrequest" class="tabcontent">
            <h3>Day Off Request Form</h3>
            <p>This functionality is planned for a future version.</p>
            <p>This page will display a day off request form</p>
        </div>
        
        <script src="/assets/js/employee_base.js"></script>