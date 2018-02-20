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

<img id="top" src="top.png" alt="">
<div id="form_container">

    <h1><a>Add New Employee</a></h1>
    <form id="form_71954" class="appnitro"  method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <div class="form_description">
            <h2>Add New Employee</h2>
            <p></p>
        </div>						
        <ul >

            <li id="li_1" >
                <label class="description" for="element_1">Employee Number </label>
                <div>
                    <input id="element_1" name="element_1" class="element text medium" type="text" maxlength="255" value=""/> 
                </div> 
            </li>		<li id="li_2" >
                <label class="description" for="element_2">Name </label>
                <span>
                    <input id="element_2_1" name="element_2_1" class="element text" maxlength="255" size="2" value=""/>
                    <label>Title</label>
                </span>
                <span>
                    <input id="element_2_2" name="element_2_2" class="element text" maxlength="255" size="8" value=""/>
                    <label class="tam">First</label>
                </span>
                <span>
                    <input id="element_2_3" name="element_2_3" class="element text" maxlength="255" size="14" value=""/>
                    <label class="tam">Last</label>
                </span>
                <span>
                    <input id="element_2_4" name="element_2_4" class="element text" maxlength="255" size="3" value=""/>
                    <label>Suffix</label>
                </span> 
            </li>		<li id="li_3" >
                <label class="description" for="element_3">Pay Rate </label>
                <span class="symbol">$</span>
                <span>
                    <input id="element_3_1" name="element_3_1" class="element text currency" size="10" value="" type="text" /> .		
                    <label for="element_3_1">Dollars</label>
                </span>
                <span>
                    <input id="element_3_2" name="element_3_2" class="element text" size="2" maxlength="2" value="" type="text" />
                    <label for="element_3_2">Cents</label>
                </span>
                <p class="guidelines" id="guide_3"><small>18.52 for full time paramedics</small></p> 
            </li>		<li id="li_4" >
                <label class="description" for="element_4">Sick Days Remaining </label>
                <div>
                    <input id="element_4" name="element_4" class="element text medium" type="text" maxlength="255" value=""/> 
                </div> 
            </li>		<li id="li_5" >
                <label class="description" for="element_5">Vacation Days Remaining </label>
                <div>
                    <input id="element_5" name="element_5" class="element text medium" type="text" maxlength="255" value=""/> 
                </div> 
            </li>		<li id="li_6" >
                <label class="description" for="element_6">Personal Days Remaining </label>
                <div>
                    <input id="element_6" name="element_6" class="element text medium" type="text" maxlength="255" value=""/> 
                </div> 
            </li>		<li id="li_7" >
                <label class="description" for="element_7">FMLA Days Remaining </label>
                <div>
                    <input id="element_7" name="element_7" class="element text medium" type="text" maxlength="255" value=""/> 
                </div> 
            </li>		<li id="li_11" >
                <label class="description" for="element_11">Check the options this employee is currently utilizing </label>
                <span>
                    <input id="element_11_1" name="element_11_1" class="element checkbox" type="checkbox" value="1" />
                    <label class="choice" for="element_11_1">Short Term Disability</label>
                    <input id="element_11_2" name="element_11_2" class="element checkbox" type="checkbox" value="1" />
                    <label class="choice" for="element_11_2">Long Term Disability</label>
                    <input id="element_11_3" name="element_11_3" class="element checkbox" type="checkbox" value="1" />
                    <label class="choice" for="element_11_3">FMLA</label>

                </span> 
            </li>		<li id="li_8" >
                <label class="description" for="element_8">Username </label>
                <div>
                    <input id="element_8" name="element_8" class="element text medium" type="text" maxlength="255" value=""/> 
                </div> 
            </li>		<li id="li_10" >
                <label class="description" for="element_10">Password </label>
                <div>
                    <input id="element_10" name="element_10" class="element text medium" type="text" maxlength="255" value=""/> 
                </div> 
            </li>		<li id="li_9" >
                <label class="description" for="element_9">Email </label>
                <div>
                    <input id="element_9" name="element_9" class="element text medium" type="text" maxlength="255" value=""/> 
                </div> 
            </li>

            <li class="buttons">
                <input type="hidden" name="form_id" value="71954" />

                <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
            </li>
        </ul>
    </form>	
    <div id="footer">
        Generated by <a href="http://www.phpform.org">pForm</a>
    </div>
</div>
<img id="bottom" src="bottom.png" alt="">