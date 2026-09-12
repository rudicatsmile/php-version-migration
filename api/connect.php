<?php
date_default_timezone_set('Asia/Jakarta');

define('host', 'db-server');
define('name', 'root');
define('pass', 'ra11-192011');
define('dbase', 'simbada');
$conn = mysqli_connect(host, name, pass, dbase, 3306) or die('Unable to connect');

