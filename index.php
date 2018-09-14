<?php

/**
  The MIT License

  Copyright 2018 Jim Baize <pavulon@hotmail.com>.

  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files (the "Software"), to deal
  in the Software without restriction, including without limitation the rights
  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
  copies of the Software, and to permit persons to whom the Software is
  furnished to do so, subject to the following conditions:

  The above copyright notice and this permission notice shall be included in
  all copies or substantial portions of the Software.

  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
  THE SOFTWARE.
 * */
//Start Session
session_start();

//At least while in development, I need a way to see the testing server
//while I am on its local network.  The router will not do a turnaround.

if (checkIsLocalIP())
{
    require_once('configlocal.php');
}
else
{
    require_once('config.php');
}

require_once('classes/Bootstrap.php');
require_once('classes/Controller.php');
require_once('classes/Model.php');
require_once('classes/Messages.php');
require_once('classes/Miscellaneous.php');
require_once('classes/StoPasswordReset.php');

require_once('controllers/home.php');
require_once('controllers/employees.php');
require_once('controllers/jobtitles.php');
require_once('controllers/administrators.php');

require_once('models/home.php');
require_once('models/employee.php');
require_once('models/jobtitle.php');
require_once('models/administrator.php');

$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();

date_default_timezone_set(DEFAULT_TIMEZONE);

if ($controller)
{
    $controller->executeAction();
}

function checkIsLocalIP()
{
    /**
     * This first line was stolen from Josh123A123 (https://stackoverflow.com/users/2943432/josh123a123)
     * and kenorb (https://stackoverflow.com/users/55075/kenorb)
     * 
     * in this StackExchange discussion
     * https://stackoverflow.com/questions/3003145/how-to-get-the-client-ip-address-in-php
     * 
     */
    $ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];

    /**
     * The rest of this function was stolen from Mark Davidson (https://stackoverflow.com/users/50866/mark-davidson)
     * From the StackExchange discussion https://stackoverflow.com/questions/13818064/check-if-an-ip-address-is-private
     */
    $pri_addrs = array(
        '10.0.0.0|10.255.255.255', // single class A network
        '172.16.0.0|172.31.255.255', // 16 contiguous class B network
        '192.168.0.0|192.168.255.255', // 256 contiguous class C network
        '169.254.0.0|169.254.255.255', // Link-local address also refered to as Automatic Private IP Addressing
        '127.0.0.0|127.255.255.255' // localhost
    );

    $long_ip = ip2long($ip);
    if ($long_ip != -1)
    {

        foreach ($pri_addrs AS $pri_addr)
        {
            list ($start, $end) = explode('|', $pri_addr);

            // IF IS PRIVATE
            if ($long_ip >= ip2long($start) && $long_ip <= ip2long($end))
            {
                return true;
            }
        }
    }
    return false;
}
