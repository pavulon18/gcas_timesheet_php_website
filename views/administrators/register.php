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

<img id="top" src="/assets/graphics/top.png" alt="">
<div id="form_container">

    <h1><a>Add New Employee</a></h1>
    <form id="register" class="appnitro"  method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form_description">
            <h2>Add New Employee</h2>
            <p></p>
        </div>						
        <ul >
            <li id="li_1" >
                <label class="description" for="employeeNumber">Employee Number </label>
                <div>
                    <input id="employeeNumber" name="employeeNumber" class="element text medium" type="text" minlength="9" maxlength="9" value="" required/> 
                </div> 
            </li>
            <li id="li_2" >
                <label class="description" for="name">Name </label>
                <span>
                    <input id="title" name="title" class="element text" maxlength="32" size="2" value=""/>
                    <label>Title</label>
                </span>
                <span>
                    <input id="firstName" name="firstName" class="element text" maxlength="255" size="8" value="" required=""/>
                    <label class="tam">First</label>
                </span>
                <span>
                    <input id="middleName" name="middleName" class="element text" maxlength="255" size="8" value=""/>
                    <label class="tam">Middle</label>
                </span>
                <span>
                    <input id="lastName" name="lastName" class="element text" maxlength="255" size="14" value="" required=""/>
                    <label class="tam">Last</label>
                </span>
                <span>
                    <input id="suffix" name="suffix" class="element text" maxlength="255" size="3" value=""/>
                    <label>Suffix</label>
                </span> 
            </li>
            <li id="li_3" >
                <label class="description" for="payRate">Pay Rate </label>
                <span class="symbol">$</span>
                <span>
                    <input id="dollars" name="dollars" class="element text currency" size="10" value="" type="text" required=""/> .		
                    <label for="dollars">Dollars</label>
                </span>
                <span>
                    <input id="cents" name="cents" class="element text" size="2" maxlength="2" value="" type="text" required=""/>
                    <label for="cents">Cents</label>
                </span>
                <p class="guidelines" id="guide_3"><small>18.52 for full time paramedics</small></p> 
            </li>
            <li id="li_4" >
                <label class="description" for="sickDays">Sick Days Remaining </label>
                <div>
                    <input id="sickDays" name="sickDays" class="element text medium" type="text" maxlength="5" value="0" required=""/> 
                </div> 
            </li>
            <li id="li_5" >
                <label class="description" for="vacationDays">Vacation Days Remaining </label>
                <div>
                    <input id="vacationDays" name="vacationDays" class="element text medium" type="text" maxlength="5" value="0" required=""/> 
                </div> 
            </li>
            <li id="li_6" >
                <label class="description" for="personalDays">Personal Days Remaining </label>
                <div>
                    <input id="personalDays" name="personalDays" class="element text medium" type="text" maxlength="5" value="0" required=""/> 
                </div> 
            </li>
            <li id="li_7" >
                <label class="description" for="fmlaDays">FMLA Days Remaining </label>
                <div>
                    <input id="fmlaDays" name="fmlaDays" class="element text medium" type="text" maxlength="5" value="0" required=""/> 
                </div> 
            </li>
            <li id="li_11" >
                <label class="description" for="checkBoxes">Check the options this employee is currently utilizing </label>
                <span>
                    <div>
                        Short Term Disability
                        <label class="radio-inline">
                            <input type="radio" name="isShortTerm" value="N" required="" checked="">No
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="isShortTerm" value="Y">Yes
                        </label>
                    </div>
                    <div>
                        Long Term Disability
                        <label class="radio-inline">
                            <input type="radio" name="isLongTerm" value="N" required="" checked="">No
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="isLongTerm" value="Y">Yes
                        </label>
                    </div>
                    <div>
                        FMLA Benefits
                        <label class="radio-inline">
                            <input type="radio" name="isFMLA" value="N" required="" checked="">No
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="isFMLA" value="Y">Yes
                        </label>
                    </div>
                </span> 
            </li>
            <li id="li_8" >
                <label class="description" for="username">Username </label>
                <div>
                    <input id="username" name="username" class="element text medium" type="text" maxlength="255" value="" required=""/> 
                </div> 
            </li>
            <li id="li_10" >
                <label class="description" for="password">Password </label>
                <div>
                    <input id="password" name="password" class="element text medium" type="password" maxlength="255" value="" required=""/> 
                </div> 
            </li>
            <li id="li_10" >
                <label class="description" for="password">Retype Password </label>
                <div>
                    <input id="password" name="password2" class="element text medium" type="password" maxlength="255" value="" required=""/> 
                </div> 
            </li>
            <li id="li_9" >
                <label class="description" for="email">Email </label>
                <div>
                    <input id="email" name="email" class="element text medium" type="text" maxlength="255" value="" required=""/> 
                </div> 
            </li>
            <li id="li_12" >
                <label class="description" for="securityRole">Security Role </label>
                <div>
                    <select class="element select medium" id="securityRole" name="securityRole" required="">
                        <?php
                        // Reads the names of the security roles from the database
                        // populates the dropdown with this information.
                        $dropDown = new Miscellaneous();

                        $query = 'SELECT * FROM security_roles';
                        $rows = $dropDown->dropdown($query);
                        foreach ($rows as $row) :
                            {
                                echo "<option value='" . $row['Security_Role_ID'] . "'>" . $row['Security_Role_Name'] . "</option>";
                            }
                        endforeach;
                        ?>

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
                <input type="hidden" name="register" value="register" />

                <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
                <input type="reset"/>
            </li>
        </ul>
    </form>	
    <div id="footer">
        Generated by <a href="http://www.phpform.org">pForm</a>
    </div>
</div>
<img id="bottom" src="/assets/graphics/bottom.png" alt="">

