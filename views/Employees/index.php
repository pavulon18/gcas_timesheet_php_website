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

    <p>IMPORTANT INFORMATION:</p>

    <p>This web site is still under development.  This should be considered pre-alpha.  This means that any data stored in this system could be compromised, corrupted or deleted.  Any and all functionality of this site could become non-operational at any time.  This web site should not be used as your only record keeping option.  The data currently stored in this system has a good chance of being dumped before the system is released for full use.</p>

    The layouts of the pages and the structures of the data could change without notice.  Always be mindful of the information being entered into the system.

    <p>In its current state, this web site should not be considered secure.  Although the designers are striving to build this web site from the ground up with safety and security in mind, there is currently no guarantee of security.

        You are encouraged to try to break the system.  If you believe you have found an error, bug, anomaly, or security related issue, please bring it to the attention of the designers.  If you have any suggestions for new features or improvements of the current features, please notify the designers in a timely fashion.

        If you would like to volunteer your time and talents to this project, there are plenty of ways you can contribute.  Simply by using this software and giving feedback will help move this project along to a product that is easy to understand and easy to use.  If you have any art work or pictures, to which you have the legal right to use, you may submit that for inclusion into the web site.  If you know how to code in HTML, PHP, JavaScript, CSS, or any other similar skills, feel free to tackle one or more of the issues located on <a href="https://github.com/pavulon18/gcas_timesheet_php_website/issues"></a>
        (April 11, 2018)
</div>
<div>
    <li><a href="<?php echo ROOT_URL; ?>employees/currentpay"> Current Pay Period </a></li>
    <li><a href="<?php echo ROOT_URL; ?>employees/historicalpay"> Historical Pay Period </a></li>
    <li><a href="<?php echo ROOT_URL; ?>employees/ptodays"> PTO Days Remaining </a></li>
    <li><a href="<?php echo ROOT_URL; ?>employees/changeknownpassword"> Change Password </a></li>
    <li><a href="<?php echo ROOT_URL; ?>employees/knownwebsiteissues"> Known Issues </a></li>
    <li><a href="<?php echo ROOT_URL; ?>employees/timeentrypage"> Time Entry Page </a></li>
</div>
