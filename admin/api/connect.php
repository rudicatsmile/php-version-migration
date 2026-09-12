<?php 
define('host','localhost');
define('name', 'proiso');
define('pass', 'ra11-192011');
define('dbase', 'simbada_data');

$conn = mysqli_connect(host, name, pass, dbase,3306) or die('Unable to connect');


?>
