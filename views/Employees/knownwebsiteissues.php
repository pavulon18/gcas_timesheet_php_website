<!DOCTYPE html>
<!--
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
-->

<body>
    <?php
    
    
    /*
      $ch = curl_init("https://github.com/pavulon18/gcas_timesheet_php_website/issues");
      $fp = fopen("example_homepage.txt", "w");

      curl_setopt($ch, CURLOPT_FILE, $fp);
      curl_setopt($ch, CURLOPT_HEADER, 0);

      curl_exec($ch);
      curl_close($ch);
      fclose($fp);
     * 
     */

    //$handle = fopen("https://api.github.com/repos/pavulon18/gcas_timesheet_php_website/issues", "r");
    //$handle = http_get("https://github.com/pavulon18/gcas_timesheet_php_website/issues");
    //echo $handle;
    //print file_get_contents('https://api.github.com/repos/pavulon18/gcas_timesheet_php_website/issues');

    /*
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, 'https://api.github.com/repos/pavulon18/gcas_timesheet_php_website/issues?status=open');
    curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    $buffer = curl_exec($curl_handle);
    curl_close($curl_handle);
    if (empty($buffer))
    {
        print "Nothing returned from url.<p>";
    } else
    {
        print $buffer;
    }
     * 
     * *****************************************************
     * query {
  repository(owner:"pavulon18", name:"gcas_timesheet_php_website") {
    issues(first:100, states:OPEN) {
      edges {
        node {
          title
          url
          labels(first:5) {
            edges {
              node {
                name
              }
            }
          }
        }
      }
    }
  }
}
     */
    ?>

    <p>To see a list of the currently known list of issues with this website, please visit 
        <a href="https://github.com/pavulon18/gcas_timesheet_php_website/issues">https://github.com/pavulon18/gcas_timesheet_php_website/issues</a><br></p>
    <p>If you would like to add an issue to this list, you will need to either create an account on
        <a href="https://github.com"> GitHub </a>or you may contact me directly.</p>


</body>