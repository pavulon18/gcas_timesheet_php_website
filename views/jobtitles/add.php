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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>New Job Title</title>
            <link rel="stylesheet" type="text/css" href="../assets/css/view.css" media="all">
                <script type="text/javascript" src="../assets/js/view.js"></script>
                <script type="text/javascript" src="../assets/js/calendar.js"></script>
                </head>
                <body id="main_body" >
                    <img id="top" src="../assets/graphics/top.png" alt="">
                        <div id="form_container">

                            <h1><a>New Job Title</a></h1>
                            <form id="form_71216" class="appnitro"  method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                <div class="form_description">
                                    <h2>New Job Title</h2>
                                    <p></p>
                                </div>						
                                <ul >

                                    <li id="li_1" >
                                        <label class="description" for="jobTitle">Job Title </label>
                                        <div>
                                            <input id="jobTitle" name="jobTitle" class="element text medium" type="text" maxlength="255" value=""/> 
                                        </div> 
                                    </li>
                                    <li id="li_2" >
                                        <label class="description" for="duties">Duties </label>
                                        <div>
                                            <textarea id="duties" name="duties" class="element textarea medium"></textarea> 
                                        </div> 
                                    </li>
                                    <li id="li_4" >
                                        <label class="description" for="payType">Pay Type </label>
                                        <div>
                                            <select class="element select medium" id="payType" name="payType"> 
                                                <option value="1" selected="selected">Hourly</option>
                                                <option value="2" >Salary</option>
                                                <option value="3" >Contract</option>
                                            </select>
                                        </div> 
                                    </li>
                                    <li id="li_5" >
                                        <label class="description" for="payRateBasis">Pay Rate Basis </label>
                                        <div>
                                            <select class="element select medium" id="payRateBasis" name="payRateBasis"> 
                                                <option value="1" selected="selected">Per Hour</option>
                                                <option value="2" >Per Month</option>
                                            </select>
                                        </div> 
                                    </li>
                                    <li id="li_3" >
                                        <label class="description" for="startDate">Effective Start Date </label>
                                        <span>
                                            <input id="startMonth" name="startMonth" class="element text" size="2" maxlength="2" value="" type="text"> /
                                                <label for="startMonth">MM</label>
                                        </span>
                                        <span>
                                            <input id="startDay" name="startDay" class="element text" size="2" maxlength="2" value="" type="text"> /
                                                <label for="startDay">DD</label>
                                        </span>
                                        <span>
                                            <input id="startYear" name="startYear" class="element text" size="4" maxlength="4" value="" type="text">
                                                <label for="startYear">YYYY</label>
                                        </span>

                                        <span id="calendar_3">
                                            <img id="cal_img_3" class="datepicker" src="/assets/graphics/calendar.gif" alt="Pick a date.">	
                                        </span>
                                        <script type="text/javascript">
                                            Calendar.setup({
                                                inputField: "startYear",
                                                baseField: "startDate",
                                                displayArea: "calendar_3",
                                                button: "cal_img_3",
                                                ifFormat: "%B %e, %Y",
                                                onSelect: selectDate
                                            });
                                        </script>

                                    </li>

                                    <li class="buttons">
                                        <input type="hidden" name="form_id" value="71216" />

                                        <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
                                        <a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>jobtitles">Cancel</a>
                                    </li>
                                </ul>
                            </form>	
                            <div id="footer">
                                Generated by <a href="http://www.phpform.org">pForm</a>
                            </div>
                        </div>
                        <img id="bottom" src="/assets/graphics/bottom.png" alt="">
                            </body>
                            </html>