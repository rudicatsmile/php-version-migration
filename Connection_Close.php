<?php
if (file_exists(__DIR__ . '/admin/Connection_Close.php')) {
    require_once __DIR__ . '/admin/Connection_Close.php';
} else {
    if (isset($ConSB) && $ConSB) {
        mysql_close($ConSB);
    } else {
        mysql_close();
    }
}
