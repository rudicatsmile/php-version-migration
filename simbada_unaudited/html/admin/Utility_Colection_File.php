<?
//SEPARATOR
$array = array('lastname', 'email', 'phone');
$comma_separated = implode("=", $array);
echo $comma_separated; // lastname,email,phone

//SPLIT
$date = "04/30/1973";
list($month, $day, $year) = split('[/.-]', $date);
echo "Month: $month; Day: $day; Year: $year<br />\n";

//Java
//alert(navigator.appName);

//getdate()
/*Array
(
    [seconds] => 40
    [minutes] => 58
    [hours]   => 21
    [mday]    => 17
    [wday]    => 2		minggu ke...
    [mon]     => 6
    [year]    => 2003
    [yday]    => 167	hari dalam tahun
    [weekday] => Tuesday
    [month]   => June
    [0]       => 1055901520
)
*/

$number = 123456789.12345;
 
// menampilkan 123,456,789
$bil = number_format($number);
echo $bil."&lt;br&gt;";
 
// menampilkan 123,456,789.12
$bil = number_format($number, 2);
echo $bil."&lt;br&gt;";
 
// menampilkan 123.456.789,12
$bil = number_format($number, 2, ",", ".");
echo $bil."&lt;br&gt;";
 
// menampilkan 123#456#789-12
$bil = number_format($number, 2, "-", "#");
echo $bil."&lt;br&gt;";
 
$bil = number_format($number, 0, ",", ".");
echo "Rp. ".$bil.",-";Â  // menampilkan Rp. 123.456.789,-

?>