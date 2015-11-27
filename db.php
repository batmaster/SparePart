<?php
header("Content-Type: text/html; charset=UTF-8");

require_once("db_info.php");

$conn = mysql_connect($host, $user, $pass) or die("ไม่สามารถเชื่อมต่อฐานข้อมูลได้"); // เชื่อมต่อ ฐานข้อมูล
mysql_select_db($dbname, $conn); // เลือกฐานข้อมูล
mysql_query("SET NAMES utf8"); // กำหนด charset ให้ฐานข้อมูล เพื่ออ่านภาษาไทย


if (isset($_POST["function"])) {

    /** ADD DEVICE **/
    if ($_POST["function"] == "get_recommended_model") {
        $model = $_POST["model"];

        $sql = "SELECT DISTINCT model FROM board WHERE model LIKE '%$model%'";
        $result = mysql_query($sql);
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r[model];
        }
        echo json_encode($rows);
    }

    else if ($_POST["function"] == "check_has_sn") {
        $sn = $_POST["sn"];

        $sql = "SELECT COUNT(*) count FROM board WHERE sn = '$sn'";
        $result = mysql_query($sql);
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }

    else if ($_POST["function"] == "add_device") {
        $brand = $_POST["brand"];
        $model = $_POST["model"];
        $sn = $_POST["sn"];
        $type = $_POST["type"];
        $date = $_POST["date"];
        $note = $_POST["note"];

        $sql = "INSERT INTO board (brand, model, sn, type, date) VALUES ('$brand', '$model', '$sn', '$type', '$date')";
        mysql_query($sql);

        $sql = "INSERT INTO transaction (number, type, location, date, note) VALUES ('เพิ่มอุปกรณ์', 1, '', '$date', '$note')";
        mysql_query($sql);

        $sql = "INSERT INTO transaction_order (board_id, transaction_id) VALUES (
            (SELECT id FROM board WHERE sn = '$sn'),
            (SELECT id FROM transaction WHERE number = 'เพิ่มอุปกรณ์' AND date = '$date' ORDER BY id DESC LIMIT 1)
        )";
        mysql_query($sql);
    }

    /** SUMMARY DEVICE **/
    else if ($_POST["function"] == "get_instock_summary") {
        $sql = "SELECT b.brand, b.model, COUNT(*) amount FROM board b WHERE
        (SELECT t.type FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.id DESC LIMIT 1) = 1
        GROUP BY b.brand, b.model";

        $result = mysql_query($sql);
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }

    else if ($_POST["function"] == "get_claiming_summary") {
        $sql = "SELECT b.brand, b.model, COUNT(*) amount FROM board b WHERE
        (SELECT t.type FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.id DESC LIMIT 1) = 0
        GROUP BY b.brand, b.model";

        $result = mysql_query($sql);
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }

    /** CLAIM DEVICE **/
    else if ($_POST["function"] == "get_claiming_number") {
        $sql = "SELECT DISTINCT number, type, to_location FROM transaction WHERE type = 0 OR type = 2 ORDER BY date DESC";

        $result = mysql_query($sql);
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }

    else if ($_POST["function"] == "check_has_number_claiming") {
        $sql = "SELECT COUNT(*) count FROM transaction WHERE number = '$number' AND type = 0";
        $result = mysql_query($sql);
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }

    else if ($_POST["function"] == "add_number_claiming") {
        $number = $_POST["number"];
        $from_location = $_POST["from_location"];
        $to_location = $_POST["to_location"];
        $date = $_POST["date"];
        $note_number = $_POST["note_number"];
        $type = $_POST["transfer"] == "true" ? 2 : 0;

        $sql = "INSERT INTO transaction (number, type, from_location, to_location, date, note) VALUES ('$number', $type, '$from_location', '$to_location', '$date', '$note_number')";
        mysql_query($sql);
    }

    else if ($_POST["function"] == "check_sn_available_for_claim") {
        $sn = $_POST["sn"];

        $sql = "SELECT b.* FROM board b WHERE
            (SELECT t.type FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.id DESC LIMIT 1) = 1 AND b.sn = '$sn'";

        $result = mysql_query($sql);
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }

    else if ($_POST["function"] == "claim") {
        $sn = $_POST["sn"];
        $number = $_POST["number"];
        $note = $_POST["note"];

        $sql = "INSERT INTO transaction_order (board_id, transaction_id, note) VALUES (
            (SELECT id FROM board WHERE sn = '$sn'),
            (SELECT id FROM transaction WHERE number = '$number' AND type = 0),
            '$note')";
        mysql_query($sql);
    }



    /** SEARCH DEVICE **/
    else if ($_POST["function"] == "get_search_brands") {
        $sql = "SELECT DISTINCT brand FROM board";

        $result = mysql_query($sql);
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }

    else if ($_POST["function"] == "get_search_models") {
        $brand = $_POST["brand"];

        if ($brand == "All")
            $brand = "";

        $sql = "SELECT DISTINCT model FROM board WHERE brand LIKE '%$brand%'";

        $result = mysql_query($sql);
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }

    else if ($_POST["function"] == "get_search_types") {
        $brand = $_POST["brand"];
        $model = $_POST["model"];

        if ($brand == "All")
            $brand = "";
        if ($model == "All")
            $model = "";

        $sql = "SELECT DISTINCT type FROM board WHERE brand LIKE '%$brand%' AND model LIKE '%$model%'";

        $result = mysql_query($sql);
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }
/*
    else if ($_POST["function"] == "search") {
        $brand = $_POST["brand"];
        $model = $_POST["model"];
        $type = $_POST["type"];
        $status = $_POST["status"];

        if ($brand == "All")
        $brand = "";
        if ($model == "All")
        $model = "";
        if ($type == "All")
        $type = "";

        if ($status == "Claiming")
            $sql = "SELECT b.brand, b.model, b.sn, b.type, t.type status, t.note FROM board b WHERE
            (SELECT t.type FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.id DESC LIMIT 1) = 0;

            $sql = "SELECT b.*,
            (SELECT CASE t.type WHEN 0 THEN 'Claiming' ELSE 'In stock' END FROM transaction t WHERE t.board_id=b.id ORDER BY date DESC LIMIT 1) status FROM board b WHERE b.brand LIKE '%$brand%' AND b.model LIKE '%$model%' AND b.type LIKE '%$type%' AND (SELECT t.type FROM transaction t WHERE t.board_id=b.id ORDER BY date DESC LIMIT 1)=0";
        else if ($status == "In stock")
            $sql = "SELECT b.*, (SELECT CASE t.type WHEN 0 THEN 'Claiming' ELSE 'In stock' END FROM transaction t WHERE t.board_id=b.id ORDER BY date DESC LIMIT 1) status FROM board b WHERE b.brand LIKE '%$brand%' AND b.model LIKE '%$model%' AND b.type LIKE '%$type%' AND (SELECT t.type FROM transaction t WHERE t.board_id=b.id ORDER BY date DESC LIMIT 1)=1";
        else
            $sql = "SELECT b.*, (SELECT CASE t.type WHEN 0 THEN 'Claiming' ELSE 'In stock' END FROM transaction t WHERE t.board_id=b.id ORDER BY date DESC LIMIT 1) status FROM board b WHERE b.brand LIKE '%$brand%' AND b.model LIKE '%$model%' AND b.type LIKE '%$type%'";
        $result = mysql_query($sql);
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }
*/
}

?>
