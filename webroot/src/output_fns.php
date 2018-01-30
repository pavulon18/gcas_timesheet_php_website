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

function do_html_header($title)
{
    // print an HTML header
    ?>
    <!doctype html>
    <html>
        <head>
            <meta charset="utf-8">
            <title><?php echo $title; ?></title>
            <style>
                body { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
                li, td { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
                hr { color: #3333cc;}
                a { color: #000 }
                div.formblock
                { background: #ccc; width: 300px; padding: 6px; border: 1px solid #000;}
            </style>
        </head>
        <body>
            <div>
                <img src="" alt="GCAS Logo" height="55" width="57" style="float: left; padding-right: 6px;" />
                <h1>GCAS Employee Web Portal</h1>
            </div>
            <hr />
            <?php
            if ($title)
            {
                do_html_heading($title);
            }
        }

        function do_html_footer()
        {
            // print an HTML footer
            ?>
        </body>
    </html>
    <?php
}

function do_html_heading($heading)
{
    // print heading
    ?>
    <h2><?php echo $heading; ?></h2>
    <?php
}

function do_html_URL($url, $name)
{
    // output URL as link and br
    ?>
    <br><a href="<?php echo $url; ?>"><?php echo $name; ?></a><br>
    <?php
}

function display_site_info()
{
    // display some marketing info
    ?>
    <ul>
        <li>Welcome to the Gibson County Ambulance Service Employee Web Portal!</li>
        <li></li>
        <li></li>
    </ul>
    <?php
}

function display_login_form()
{

    ?>
    <!--<p><a href="register_form.php">Not a member?</a></p> -->
    <form method="post" action="\webroot\src\employees\member.php">

        <div class="formblock">
            <h2>Members Log In Here</h2>

            <p><label for="username">Username:</label><br/>
                <input type="text" name="username" id="username" /></p>

            <p><label for="password">Password:</label><br/>
                <input type="password" name="password" id="password" /></p>

            <button type="submit">Log In</button>

            <p><a href="\webroot\src\forgot_form.php">Forgot your password?</a></p>
        </div>

    </form>
    <?php
}



function display_registration_form()
{
    ?>
    <form method="post" action="admin/register_new.php">

        <div class="formblock">
            <h2>Register Now</h2>

            <p><label for="email">Email Address:</label><br/>
                <input type="email" name="email" id="email" 
                       size="30" maxlength="100" required /></p>

            <p><label for="username">Preferred Username <br>(max 16 chars):</label><br/>
                <input type="text" name="username" id="username" 
                       size="16" maxlength="16" required /></p>

            <p><label for="password">Password <br>(between 6 and 16 chars):</label><br/>
                <input type="password" name="password" id="passwd" 
                       size="16" maxlength="16" required /></p>

            <p><label for="password2">Confirm Password:</label><br/>
                <input type="password" name="password2" id="passwd2" 
                       size="16" maxlength="16" required /></p>


            <button type="submit">Register</button>

        </div>

    </form>
    <?php
}


function display_user_urls($url_array)
{
    // display the table of URLs
    // set global variable, so we can test later if this is on the page
    global $bm_table;
    $bm_table = true;
    ?>
    <br>
    <form name="bm_table" action="delete_bms.php" method="post">
        <table width="300" cellpadding="2" cellspacing="0">
            <?php
            $color = "#cccccc";
            echo "<tr bgcolor=\"" . $color . "\"><td><strong>Bookmark</strong></td>";
            echo "<td><strong>Delete?</strong></td></tr>";
            if ((is_array($url_array)) && (count($url_array) > 0))
            {
                foreach ($url_array as $url)
                {
                    if ($color == "#cccccc")
                    {
                        $color = "#ffffff";
                    } else
                    {
                        $color = "#cccccc";
                    }
                    //remember to call htmlspecialchars() when we are displaying user data
                    echo "<tr bgcolor=\"" . $color . "\"><td><a href=\"" . $url . "\">" . htmlspecialchars($url) . "</a></td>
            <td><input type=\"checkbox\" name=\"del_me[]\"
                value=\"" . $url . "\"></td>
            </tr>";
                }
            } else
            {
                echo "<tr><td>No data on record</td></tr>";
            }
            ?>
        </table>
    </form>
    <?php
}

function display_user_menu()
{
    // display the menu options on this page
    
 
    
    ?>
    <hr>
    <a href="member.php">Home</a> &nbsp;|&nbsp;
    <!--<a href="add_bm_form.php">Add BM</a> &nbsp;|&nbsp; -->
    <?php
    
 
    /*
    // only offer the delete option if bookmark table is on this page
    global $bm_table;
    if ($bm_table == true)
    {
        echo "<a href=\"#\" onClick=\"bm_table.submit();\">Delete BM</a> &nbsp;|&nbsp;";
    } else
    {
        echo "<span style=\"color: #cccccc\">Delete BM</span> &nbsp;|&nbsp;";
    }
     * 
     */
    
    ?>
    <a href="/webroot/src/change_passwd_form.php">Change password</a><br>
    <!-- <a href="recommend.php">Recommend URLs to me</a> &nbsp;|&nbsp; -->
    <a href="logout.php">Logout</a>
    <hr>

    <?php
}

/*
 * This function was part of the original bookmark project.  It will be deleted
 * once I have everything I need from it.
function display_add_bm_form()
{
    // display the form for people to ener a new bookmark in
    ?>
    <form name="bm_table" action="add_bms.php" method="post">

        <div class="formblock">
            <h2>New Bookmark</h2>

            <p>
                <input type="text" name="new_url" id="new_url" 
                       size="40"  maxlength="255" value="http://" required /></p>

            <button type="submit">Add Bookmark</button>

        </div>

    </form>
    <?php
}
 * 
 */

function display_password_form()
{
    // display html change password form
    ?>
    <br>
    <form action="change_passwd.php" method="post">

        <div class="formblock">
            <h2>Change Password</h2>

            <p><label for="old_passwd">Old Password:</label><br/>
                <input type="password" name="old_passwd" id="old_passwd" 
                       size="16" maxlength="16" required /></p>

            <p><label for="passwd2">New Password:</label><br/>
                <input type="password" name="new_passwd" id="new_passwd" 
                       size="16" maxlength="16" required /></p>

            <p><label for="passwd2">Repeat New Password:</label><br/>
                <input type="password" name="new_passwd2" id="new_passwd2" 
                       size="16" maxlength="16" required /></p>


            <button type="submit">Change Password</button>

        </div>
        <br>
    <?php
}

function display_forgot_form()
{
    // display HTML form to reset and email password
    ?>
        <br>
        <form action="forgot_passwd.php" method="post">

            <div class="formblock">
                <h2>Forgot Your Password?</h2>

                <p><label for="username">Enter Your Username:</label><br/>
                    <input type="text" name="username" id="username" 
                           size="16" maxlength="16" required /></p>

                <button type="submit">Change Password</button>

            </div>
            <br>
                <?php
            }

            function display_recommended_urls($url_array)
            {
                // similar output to display_user_urls
                // instead of displaying the users bookmarks, display recomendation
                ?>
            <br>
            <table width="300" cellpadding="2" cellspacing="0">
            <?php
            $color = "#cccccc";
            echo "<tr bgcolor=\"" . $color . "\">
        <td><strong>Recommendations</strong></td></tr>";
            if ((is_array($url_array)) && (count($url_array) > 0))
            {
                foreach ($url_array as $url)
                {
                    if ($color == "#cccccc")
                    {
                        $color = "#ffffff";
                    } else
                    {
                        $color = "#cccccc";
                    }
                    echo "<tr bgcolor=\"" . $color . "\">
            <td><a href=\"" . $url . "\">" . htmlspecialchars($url) . "</a></td></tr>";
                }
            } else
            {
                echo "<tr><td>No recommendations for you today.</td></tr>";
            }
            ?>
            </table>
    <?php
}
?>
