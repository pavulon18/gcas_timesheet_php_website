<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

require('templates\PageTemplate.php');

$homepage = new PageTemplate();

$homepage->content="<!--Page Content -->"
        . "<section>"
        . "<h2>Welcome to Gibson County Ambulance Service Web Portal.</h2>"
        . "<p>Please Login to access the site's functionality</p>"
        . "</section>";

$homepage->Display();

require('login.php');
?>