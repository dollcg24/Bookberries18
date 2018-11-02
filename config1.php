<?php
//We start sessions
session_start();

/******************************************************
------------------Required Configuration---------------
Please edit the following variables so the members area
can work correctly.
******************************************************/

//We log to the DataBase
mysql_connect('127.0.0.1', 'root', 'roshan333');
mysql_select_db('ip_project');

//Webmaster Email
$mail_webmaster = 'niksjadhav998@gmail.com';

//Top site root URL
$url_root = 'frontpg.html';

/******************************************************
-----------------Optional Configuration----------------
******************************************************/

//Home page file name
$url_home = 'index.php';

//Design Name
$design = 'default';
?>