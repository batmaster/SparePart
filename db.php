<?php
header("Content-Type: text/html; charset=UTF-8");

require_once("db_info.php");

$conn = mysql_connect($host, $user, $pass) or die("ไม่สามารถเชื่อมต่อฐานข้อมูลได้"); // เชื่อมต่อ ฐานข้อมูล
mysql_select_db($dbname, $conn); // เลือกฐานข้อมูล
mysql_query("SET NAMES utf8"); // กำหนด charset ให้ฐานข้อมูล เพื่ออ่านภาษาไทย


if (isset($_POST["function"])) {

    if ($_POST["function"] == "get_recommend_add_device") {
        $model_part = $_POST["model_part"];

        $sql = "SELECT DISTINCT model FROM board WHERE model LIKE '%$number_part%' ORDER BY id DESC LIMIT 10";

        $result = mysql_query($sql);
        $rows = array();
        while($r = mysql_fetch_assoc($result)) {
            $rows[] = $r[model];
        }
        echo json_encode($rows);
    }

    else if ($_POST["function"] == "check_has_sn") {
        $sn = $_POST["sn"];

        $sql = "SELECT COUNT(*) count FROM board b WHERE sn='$sn'";
        $result = mysql_query($sql);
        $rows = array();
        while($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }

    else if ($_POST["function"] == "add") {
        $brand = $_POST["brand"];
        $model = $_POST["model"];
        $sn = $_POST["sn"];
        $type = $_POST["type"];
        $date = $_POST["date"];
        $note = $_POST["note"];

        $sql = "INSERT INTO board (brand, model, sn, type, date) VALUES ('$brand', '$model', '$sn', '$type', '$date')";
        mysql_query($sql);

        $sql = "INSERT INTO transaction (number, type, date, note) VALUES ('added', 1, '$date', '$note')";
        mysql_query($sql);

        $sql = "INSERT INTO transaction_order (board_id, transaction_id) VALUES (
            (SELECT id FROM board WHERE sn='$sn'),
            (SELECT id FROM transaction WHERE number='added' AND date='$date')
        )";
        mysql_query($sql);
    }

}

?>
