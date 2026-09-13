<?php
if (!isset($_SESSION)) {session_start();}
echo isset($_SESSION["NaviG"]) ? $_SESSION["NaviG"] : "";
?>