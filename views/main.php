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
 * 
 * Special thanks to: https://codepen.io/seanroche/# Sean Roche for his invaluable 
 * assistance on making this page work as intended.
 */
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="GCAS Web Portal and Time Sheet">
        <meta name="author" content="Jim Baize">
        <link rel="icon" href="/assets/graphics/favicon.ico">

        <title>Gibson County EMS Employee Web Portal</title>

        <!-- Bootstrap core CSS -->
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/assets/css/bootstrap.css">
        <link rel="stylesheet" href="/assets/css/style.css">

        <!-- Custom styles for this template -->
        <link href="/assets/css/navbar-top-fixed.css" rel="stylesheet">

        <!-- Custom Styles for the Add Job Title page -->
        <link rel="stylesheet" type="text/css" href="/assets/css/view.css" media="all">
        <script type="text/javascript" src="/assets/js/view.js"></script>
        <script type="text/javascript" src="/assets/js/calendar.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="#">GEMS Web Portal</a>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <?php if (isset($_SESSION['is_logged_in'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ROOT_URL; ?>">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ROOT_URL; ?>jobtitles"> Job Titles </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ROOT_URL; ?>employees"> Employees </a>
                        </li>
                        <?php if ($_SESSION['user_data']['securityRole'] === '2') : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo ROOT_URL; ?>administrators"> Administrators </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (isset($_SESSION['is_logged_in'])) : ?>
                            <li><a href="<?php echo ROOT_URL; ?>"> Welcome <?php echo $_SESSION['user_data']['firstName']; ?> </a></li>
                            <li><a href="<?php echo ROOT_URL; ?>employees/logout"> Logout </a></li>
                        <?php else : ?>
                            <li><a href="<?php echo ROOT_URL; ?>employees/login"> Login </a></li>
                        <?php endif; ?>
                    </ul>
                </ul>
            </div>
        </nav>

        <main role="main" class="container">
            <div class="jumbotron">
                <div class="row">
                    <?php Messages::display(); ?>
                    <?php require($view); ?>
                </div>
            </div>
        </main>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script>window.jQuery || document.write('<script src="/assets/js/jquery-slim.min.js"><\/script>');</script>
        <script src="/assets/js/popper.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <!-- ... -->
        <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous">
        </script>
        <script type="text/javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>
        <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <link rel="stylesheet/less" type="text/css" href="/assets/css/less/styles.less" />
        <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.0.0/less.min.js" ></script>

        <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.5/lodash.min.js"></script>

        <script type="text/javascript">
            const form = document.getElementById('form_1939');
            console.log(form);
            form.addEventListener('change', formUpdateHandler);

            function formUpdateHandler(e) {
                comboCheck(e);
                hideShowLogic(e);
            }

            function comboCheck(e) {
                const shift = document.querySelector('input[name="is24HrShift"]:checked').value;
                const nightRun = document.querySelector('input[name="isNightRun"]:checked').value;
                const pto = document.querySelector('input[name="isPTO"]:checked').value;

                const nightRuns = Array.from(document.getElementsByName('isNightRun'));

                if (shift === '0') {
                    nightRuns.forEach(x => {
                        if (x.value === '0')
                            x.checked = true;
                        x.disabled = true;
                    });
                } else {
                    nightRuns.forEach(x => x.disabled = false);
                }

                const ptos = Array.from(document.getElementsByName('isPTO'));

                if (shift === '1' && nightRun === '1') {
                    ptos.forEach(x => {
                        if (x.value === '0')
                            x.checked = true;
                        x.disabled = true;
                    });
                } else {
                    ptos.forEach(x => x.disabled = false);
                }

                if (pto === '1') {
                    nightRuns.forEach(x => {
                        if (x.value === '0')
                            x.checked = true;
                        x.disabled = true;
                    });
                }
            }

            function hideShowLogic(e) {
                const shift = document.querySelector('input[name="is24HrShift"]:checked').value;
                const nightRun = document.querySelector('input[name="isNightRun"]:checked').value;
                const pto = document.querySelector('input[name="isPTO"]:checked').value;

                const isNightRun = document.getElementById('isNightRun');
                const liReason = document.getElementById('reason');
                const liPto = document.getElementById('isPTO');
                const liWhichPTO = document.getElementById('whichPTO');
                const liStartDate = document.getElementById('startDate');
                const liStartTime = document.getElementById('startTime');
                const liEndTimeBlock = document.getElementById('endTimeBlock');

                if (shift === '1') {
                    if (nightRun === '0' && pto === '0')
                    {
                        isNightRun.style.display = '';// show isNightRun
                        liReason.style.display = 'none';// hide reason
                        liPto.style.display = '';// show isPTO
                        liWhichPTO.style.display = 'none';// hide whichPTO
                        liStartDate.style.display = ''; // Show startDate
                        liStartTime.style.display = 'none';// hide startTime
                        liEndTimeBlock.style.display = 'none';// hide endTimeBlock
                    }
                    if (nightRun === '1' && pto === '0')
                    {
                        isNightRun.style.display = '';// show isNightRun
                        liReason.style.display = '';// show reason
                        liPto.style.display = 'none';// hide isPTO
                        liWhichPTO.style.display = 'none';// hide whichPTO
                        liStartDate.style.display = ''; // Show startDate
                        liStartTime.style.display = '';// hide startTime
                        liEndTimeBlock.style.display = '';// hide endTimeBlock
                    }
                    if (nightRun === '0' && pto === '1')
                    {
                        isNightRun.style.display = 'none';// hide isNightRun
                        liReason.style.display = 'none';// hide reason
                        liPto.style.display = '';// show isPTO
                        liWhichPTO.style.display = '';// show whichPTO
                        liStartDate.style.display = ''; // Show startDate
                        liStartTime.style.display = 'none';// hide startTime
                        liEndTimeBlock.style.display = 'none';// hide endTimeBlock
                    }
                }
                if (shift === '0') {
                    if (nightRun === '0' && pto === '0')
                    {
                        isNightRun.style.display = 'none';// hide isNightRun
                        liReason.style.display = '';// show reason
                        liPto.style.display = '';// show isPTO
                        liWhichPTO.style.display = 'none';// hide whichPTO
                        liStartDate.style.display = ''; // Show startDate
                        liStartTime.style.display = '';// hide startTime
                        liEndTimeBlock.style.display = '';// hide endTimeBlock
                    }
                    if (nightRun === '0' && pto === '1')
                    {
                        isNightRun.style.display = 'none';// hide isNightRun
                        liReason.style.display = 'none';// hide reason
                        liPto.style.display = '';// show isPTO
                        liWhichPTO.style.display = '';// show whichPTO
                        liStartDate.style.display = ''; // Show startDate
                        liStartTime.style.display = '';// hide startTime
                        liEndTimeBlock.style.display = '';// hide endTimeBlock
                    }
                }
            }
        </script>
    </body>
</html>
