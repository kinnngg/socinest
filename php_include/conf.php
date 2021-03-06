<?php
if(basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])){header('Location: /');}
//makes this file include-only by checking if the requested file is the same as this file

/*                  -=[ Config file - conf.php ]=-
 *  
 *  Config file, db info, some funcs and suchs
 *  by FakeMessiah
 */
session_start();
/* For automatic session destroy after a period 
$inactive = 3600;
if(isset($_SESSION['timeout']) ) {
    $session_life = time() - $_SESSION['timeout'];
    if($session_life > $inactive) header("Location: ./?login=logout");
}
$_SESSION['timeout'] = time();
*/
$con=mysqli_connect("localhost","root","","flog");

if($con->connect_errno) {
    db_fatal(basename(__FILE__));
}

define("DB_SALT", $con->real_escape_string(
    "u%c[87@s/4*zyT]S(a'BT14LxMogDc}i6*@NFW;eCQG:hjv2QBl!Sz%R-9_gO3mL"));

function db_fatal($filename) {
    error_log("[!!] " . date("Y/m/d") . " in {$filename}" . ": Fatal database error: " .
        $con->error . "\n", 3, "./admin/errorlog");
    die("Fatal database error, see logs for further details");
}

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}
?>