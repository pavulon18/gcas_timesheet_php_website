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
 */
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="GCAS Web Portal and Time Sheet">
        <meta name="author" content="Jim Baize">
        <link rel="icon" href="/assets/graphics/favicon.ico">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

        <title>Gibson County EMS Employee Web Portal</title>

    </head>

    <body>
        <nav class="navbar navbar-expand-sm navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="<?php echo ROOT_URL; ?>">GEMS Web Portal</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['is_logged_in'])) : ?>
                        <li><a href="<?php echo ROOT_URL; ?>"> Welcome <?php echo $_SESSION['user_data']['firstName']; ?> </a></li>
                        <li><a href="<?php echo ROOT_URL; ?>employees/logout"> Logout </a></li>
                    <?php else : ?>
                        <li><a href="<?php echo ROOT_URL; ?>employees/login"> Login </a></li>
                    <?php endif; ?>
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

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

        

    <!--jquery validate -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
    
    <script> // https://jqueryvalidation.org/ this is the website to use to find information on the validation
            $("form").validate();
        </script>

    <!--pform information -->
    <link rel="stylesheet" type="text/css" href="/assets/css/view.css" media="all">
    <script type="text/javascript" src="/assets/js/view.js"></script>
    <script type="text/javascript" src="/assets/js/calendar.js"></script>
    
    
</body>
</html>
