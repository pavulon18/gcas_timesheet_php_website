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
            <title>Untitled Form</title>
            <link rel="stylesheet" type="text/css" href="./colors/color1/view.css" media="all">
                <script type="text/javascript" src="js/view.js"></script>
                <script type="text/javascript" src="js/calendar.js"></script>
                </head>
                <body id="main_body" >

                    <img id="top" src="images/top.png" alt="">
                        <div id="form_container">

                            <h1><a>Untitled Form</a></h1>
                            <form id="form_73259" class="appnitro"  method="post" action="/formbuilder/view.php">
                                <div class="form_description">
                                    <h2>Untitled Form</h2>
                                    <p>This is your form description. Click here to edit.</p>
                                </div>						
                                <ul >

                                    <li id="li_1" >
                                        <label class="description" for="element_1">Text </label>
                                        <div>
                                            <input id="element_1" name="element_1" class="element text medium" type="text" maxlength="255" value=""/> 
                                        </div> 
                                    </li>
                                    <li id="li_2" >
                                        <label class="description" for="element_2">Text </label>
                                        <div>
                                            <input id="element_2" name="element_2" class="element text medium" type="text" maxlength="255" value=""/> 
                                        </div> 
                                    </li>
                                    <li id="li_3" >
                                        <label class="description" for="element_3">Security Role </label>
                                        <div>
                                            <select class="element select medium" id="element_3" name="element_3"> 
                                                <option value="" selected="selected"></option>
                                                <option value="1" >First option</option>
                                                <option value="2" >Second option</option>
                                                <option value="3" >Third option</option>

                                            </select>
                                        </div> 
                                    </li>

                                    <li class="buttons">
                                        <input type="hidden" name="form_id" value="73259" />

                                        <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
                                    </li>
                                </ul>
                            </form>	
                            <div id="footer">
                                Generated by <a href="http://www.phpform.org">pForm</a>
                            </div>
                        </div>
                        <img id="bottom" src="images/bottom.png" alt="">
                            </body>
                            </html>