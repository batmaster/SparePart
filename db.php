<?php
header("Content-Type: text/html; charset=UTF-8");

require_once("db_info.php");

$conn = mysql_connect($host, $user, $pass) or die("ไม่สามารถเชื่อมต่อฐานข้อมูลได้"); // เชื่อมต่อ ฐานข้อมูล
mysql_select_db($dbname, $conn); // เลือกฐานข้อมูล
mysql_query("SET NAMES utf8"); // กำหนด charset ให้ฐานข้อมูล เพื่ออ่านภาษาไทย


if (isset($_POST["function"])) {

    if ($_POST["function"] == "get_recommend_add_device") {

        
    }

}

?>
