<?php
//echo $TimeZ;
if (isset($ConSB) && $ConSB) {
	mysql_close($ConSB);
} else {
	mysql_close();
}
?>