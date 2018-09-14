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

/*
 * Credit for this script goes to:
 * charles.fisher@arconic.com
 * https://secure.php.net/manual/en/function.mail.php#121858
 * 
 * His script was modified for my purposes.
 */

function xxmail($to, $subject, $body, $headers)
{
    $smtp = stream_socket_client('tcp://smtp.yourmail.com:25', $eno, $estr, 30);

    $B = 8192;
    $c = "\r\n";
    $s = 'myapp@someserver.com';

    fwrite($smtp, 'helo ' . $_ENV['HOSTNAME'] . $c);
    $junk = fgets($smtp, $B);

// Envelope
    fwrite($smtp, 'mail from: ' . $s . $c);
    $junk = fgets($smtp, $B);
    fwrite($smtp, 'rcpt to: ' . $to . $c);
    $junk = fgets($smtp, $B);
    fwrite($smtp, 'data' . $c);
    $junk = fgets($smtp, $B);

// Header
    fwrite($smtp, 'To: ' . $to . $c);
    if (strlen($subject))
    {
        fwrite($smtp, 'Subject: ' . $subject . $c);
    }
    if (strlen($headers))
    {
        fwrite($smtp, $headers); // Must be \r\n (delimited)
    }
    fwrite($smtp, $headers . $c);

// Body
    if (strlen($body))
    {
        fwrite($smtp, $body . $c);
    }
    fwrite($smtp, $c . '.' . $c);
    $junk = fgets($smtp, $B);

// Close
    fwrite($smtp, 'quit' . $c);
    $junk = fgets($smtp, $B);
    fclose($smtp);
}
