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
 * 
 * Special thanks to: https://github.com/flapjack17 Sean Roche for his invaluable 
 * assistance on making this page work as intended.
 * 
 * https://jqueryvalidation.org/
 */

Miscellaneous::checkIsLoggedIn();

?>

<div id="form_container">
    <h1><a>Time Entry Form</a></h1>
    <form id="form_1939" class="appnitro" method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form_description">
            <h2>Time Entry Form</h2>
            <p>You may enter the information for your time sheet here.</p>
        </div>						
        <ul >
            <li id="is24HrShift" >
                <label class="description" for="is24HrShift">Is this a 24 hour shift? </label>
                <span>
                    <input id="is24HrShiftYes" name="is24HrShift" class="element radio" type="radio" value="Y" checked="true" />
                    <label class="choice" for="is24HrShiftYes">Yes</label>
                    <input id="is24HrShiftNo" name="is24HrShift" class="element radio" type="radio" value="N"/>
                    <label class="choice" for="is24HrShiftNo">No</label>
                </span>
                <p class="guidelines" id="guide_4"><small>This includes full sick days, vacation days, and personal days.</small></p> 
            </li>
            <li id="isHoliday">
                <label class="description" for="isHoliday">Is this a holiday? </label>
                <span>
                    <input id="isHolidayYes" name="isHoliday" class="element radio" type="radio" value="Y" />
                    <label class="choice" for="isHolidayYes">Yes</label>
                    <input id="isHolidayNo" name="isHoliday" class="element radio" type="radio" value="N" checked="true" />
                    <label class="choice" for="isHolidayNo">No</label>
                </span> 
            </li>
            <div id="ptoBox">
                <li id="isPTO">
                    <label class="description" for="isPTO">Is this PTO time? </label>
                    <span>
                        <input id="isPTOYes" name="isPTO" class="element radio" type="radio" value="Y" />
                        <label class="choice" for="isPTOYes">Yes</label>
                        <input id="isPTONo" name="isPTO" class="element radio" type="radio" value="N" checked="true"/>
                        <label class="choice" for="isPTONo">No</label>
                    </span>
                    <p class="guidelines" id="guide_7">
                        <small>PTO time includes vacation days, personal days, sick days and other similar paid time off.</small>
                    </p> 
                </li>

                <li id="whichPTO" style="display: none">
                    <label class="description" for="whichPTO">Which type of PTO time is this? </label>
                    <div>
                        <select class="element select medium" id="whichPTO" name="whichPTO"> 
                            <option value="None" selected="selected">None</option>
                            <option value="whichPTOVaca" >Vacation</option>
                            <option value="whichPTOPerson" >Personal</option>
                            <option value="whichPTOSick" >Sick</option>
                            <option value="whichPTODead" >Berevement</option>
                            <option value="whichPTOFMLA" >FMLA</option>
                        </select>
                    </div> 
                </li>
            </div>
            <li id="isNightRun">
                <label class="description" for="isNightRun">Is this a night run? </label>
                <span>
                    <input id="isNightRunYes" name="isNightRun" class="element radio" type="radio" value="Y" />
                    <label class="choice" for="isNightRunYes">Yes</label>
                    <input id="isNightRunNo" name="isNightRun" class="element radio" type="radio" value="N" checked="true"/>
                    <label class="choice" for="isNightRunNo">No</label>
                </span>
                <p class="guidelines" id='nightRun'>
                    <small>Night Runs include those times when the employee is held past his or her scheduled quitting time</small>
                </p>
            </li>
            <li id="reason" style="display:none">
                <label class="description" for="reason">Run Number or Reason for the entry </label>
                <div>
                    <input id="reason" name="reason" class="element text medium" type="text" maxlength="256" value=""/> 
                </div> 
            </li>

            <li id="startDate" >
                <label class="description" for="startDate">Start Date </label>
                <span>
                    <input id="startMonth" name="startMonth" class="element text" size="2" maxlength="2" value="" type="text" required=""/>
                    <label for="startMonth">MM</label>
                </span>
                <span>
                    <input id="StartDay" name="startDay" class="element text" size="2" maxlength="2" value="" type="text" required=""/> 
                    <label for="startDay">DD</label>
                </span>
                <span>
                    <input id="startYear" name="startYear" class="element text" size="4" maxlength="4" value="" type="text" required=""/>
                    <label for="startYear">YYYY</label>
                </span>
                <span id="calendar_9">
                    <img id="cal_img_9" class="datepicker" src="/assets/graphics/calendar.gif" alt="Pick a date.">	
                </span>
                <p class="guidelines" id="guide_startTime">
                    <small>Enter times in 24 hour time format</small>
                </p> 
            </li>

            <li id="startTime" style="display: none">
                <label class="description" for="startTime">Start Time </label>
                <span>
                    <input id="startHour" name="startHour" class="element text " size="2" type="text" maxlength="2" value=""/> : 
                    <label>HH</label>
                </span>
                <span>
                    <input id="startMin" name="startMin" class="element text " size="2" type="text" maxlength="2" value=""/> : 
                    <label>MM</label>
                </span>
                <span style="display: none">
                    <input id="startSec" name="startSec" class="element text " size="2" type="text" maxlength="2" value="00" style=""/>
                    <label>SS</label>
                </span>
                <!--
                <span>
                    <select class="element select" style="width:4em" id="startAMPM" name="startAMPM">
                        <option value="AM" >AM</option>
                        <option value="PM" >PM</option>
                    </select>
                    <label>AM/PM</label>
                </span>
                -->
            </li>
            <div id="endTimeBlock" style="display: none">
                <li id="endDate" >
                    <label class="description" for="endDate">End Date </label>
                    <span>
                        <input id="endMonth" name="endMonth" class="element text" size="2" maxlength="2" value="" type="text"> /
                        <label for="endMonth">MM</label>
                    </span>
                    <span>
                        <input id="endDay" name="endDay" class="element text" size="2" maxlength="2" value="" type="text"> /
                        <label for="endDay">DD</label>
                    </span>
                    <span>
                        <input id="endYear" name="endYear" class="element text" size="4" maxlength="4" value="" type="text">
                        <label for="endYear">YYYY</label>
                    </span>
                    <span id="calendar_10">
                        <img id="cal_img_10" class="datepicker" src="/assets/graphics/calendar.gif" alt="Pick a date.">	
                    </span>           
                </li>
                <li id="endTime" >
                    <label class="description" for="endTime">End Time </label>
                    <span>
                        <input id="endHour" name="endHour" class="element text " size="2" type="text" maxlength="2" value=""/> : 
                        <label>HH</label>
                    </span>
                    <span>
                        <input id="endMin" name="endMin" class="element text " size="2" type="text" maxlength="2" value=""/> : 
                        <label>MM</label>
                    </span>
                    <span style="display: none">
                        <input id="endSec" name="endSec" class="element text " size="2" type="text" maxlength="2" value="00" style=""/>
                        <label>SS</label>
                    </span>
                    <!--
                    <span>
                        <select class="element select" style="width:4em" id="endAMPM" name="endAMPM">
                            <option value="AM" >AM</option>
                            <option value="PM" >PM</option>
                        </select>
                        <label>AM/PM</label>
                    </span>
                    -->
                    <p class="guidelines" id="guide_endTime">
                        <small>Enter times in 24 hour time format</small>
                    </p> 
                </li>
            </div>
            <li class="buttons">
                <input type="hidden" name="form_id" value="1939" />
                <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
            </li>
        </ul>
    </form>	
    <div id="footer">
        Generated by <a href="http://www.phpform.org">pForm</a>
    </div>
</div>
<script type="text/javascript" src="/assets/js/time-entry-page.js"></script>

<?php
/**
 * For some reason, I had started to change variable naming convention so that
 * all the variable use the same convention.  This caused a problem with the time
 * entry page.  I've reverted the variable names back to the names that worked.
 * 
 * I will keep them this way until I can remember why I started to change them
 * in the first place.
 * July 3, 2018
 */

