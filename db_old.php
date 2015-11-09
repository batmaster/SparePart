<?php
header("Content-Type: text/html; charset=UTF-8");

require_once("db_info.php");

$conn = mysql_connect($host, $user, $pass) or die("ไม่สามารถเชื่อมต่อฐานข้อมูลได้"); // เชื่อมต่อ ฐานข้อมูล
mysql_select_db($dbname, $conn); // เลือกฐานข้อมูล
mysql_query("SET NAMES utf8"); // กำหนด charset ให้ฐานข้อมูล เพื่ออ่านภาษาไทย


if (isset($_POST["function"])) {
    // if ($_POST["function"] == "add") {
    //     $brand = $_POST["brand"];
    //     $model = $_POST["model"];
    //     $sn = $_POST["sn"];
    //     $type = $_POST["type"];
    //     $date = $_POST["date"];
    //     $number = $_POST["number"];
    //     $code = $_POST["code"];
    //     $note = $_POST["note"];
    //
    //     $sql = "INSERT INTO board (brand, model, sn, type, date, number, code) VALUES ('$brand', '$model', '$sn', '$type', '$date', '$number', '$code')";
    //     mysql_query($sql);
    //
    //     $sql = "INSERT INTO retrieve (number) VALUES ('$number')";
    //     mysql_query($sql);
    //
    //     $sql = "INSERT INTO transaction (board_id, transaction_id, date, type, note) VALUES (
    //         (SELECT id FROM board WHERE brand='$brand' AND model='$model' AND sn='$sn' AND type='$type'AND date='$date'AND number='$number'AND code='$code'),
    //         (SELECT id FROM retrieve WHERE number='$number' ORDER BY id DESC LIMIT 1),
    //         '$date', 1, '$note')";
    //     mysql_query($sql);
    //         // echo $sql;
    // }
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

        /*if ($status == "Broken")
        else */if ($status == "Claiming")
            $sql = "SELECT b.*, (SELECT CASE t.type WHEN 0 THEN 'Claiming' ELSE 'In stock' END FROM transaction t WHERE t.board_id=b.id ORDER BY date DESC LIMIT 1) status, (SELECT t.note FROM transaction t WHERE t.board_id=b.id ORDER BY date DESC LIMIT 1) note FROM board b WHERE b.brand LIKE '%$brand%' AND b.model LIKE '%$model%' AND b.type LIKE '%$type%' AND (SELECT t.type FROM transaction t WHERE t.board_id=b.id ORDER BY date DESC LIMIT 1)=0";
        else if ($status == "In stock")
            $sql = "SELECT b.*, (SELECT CASE t.type WHEN 0 THEN 'Claiming' ELSE 'In stock' END FROM transaction t WHERE t.board_id=b.id ORDER BY date DESC LIMIT 1) status, (SELECT t.note FROM transaction t WHERE t.board_id=b.id ORDER BY date DESC LIMIT 1) note FROM board b WHERE b.brand LIKE '%$brand%' AND b.model LIKE '%$model%' AND b.type LIKE '%$type%' AND (SELECT t.type FROM transaction t WHERE t.board_id=b.id ORDER BY date DESC LIMIT 1)=1";
        else
            $sql = "SELECT b.*, (SELECT CASE t.type WHEN 0 THEN 'Claiming' ELSE 'In stock' END FROM transaction t WHERE t.board_id=b.id ORDER BY date DESC LIMIT 1) status, (SELECT t.note FROM transaction t WHERE t.board_id=b.id ORDER BY date DESC LIMIT 1) note FROM board b WHERE b.brand LIKE '%$brand%' AND b.model LIKE '%$model%' AND b.type LIKE '%$type%'";

        $result = mysql_query($sql);
        $rows = array();
        while($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }
    else if ($_POST["function"] == "search_rows") {
        $sql = "SELECT FOUND_ROWS()";
        $result = mysql_query($sql);
        $row_num = mysql_result($result, 0, 0);
        echo json_encode($row_num);
    }
    else if ($_POST["function"] == "claim") {
        $sn = $_POST["sn"];
        $brand = $_POST["brand"];
        $model = $_POST["model"];
        $date = $_POST["date"];
        $number = $_POST["number"];
        $location = $_POST["location"];
        $note = $_POST["note"];

        $sql = "INSERT INTO claim (number,location) VALUES ('$number','$location')";
        mysql_query($sql);

        $sql = "INSERT INTO transaction (board_id, transaction_id, date, type, note) VALUES (
            (SELECT id FROM board WHERE  brand='$brand' AND model='$model' AND sn='$sn'),
            (SELECT id FROM claim WHERE number='$number' AND location='$location' ORDER BY id DESC LIMIT 1),
            '$date', 0, '$note')";
            mysql_query($sql);
    }
    else if ($_POST["function"] == "retrieve") {
        $sn = $_POST["sn"];
        $brand = $_POST["brand"];
        $model = $_POST["model"];
        $date = $_POST["date"];
        $number = $_POST["number"];
        $note = $_POST["note"];

        $sql = "INSERT INTO retrieve (number) VALUES ('$number')";
        mysql_query($sql);

        $sql = "INSERT INTO transaction (board_id, transaction_id, date, type, note) VALUES (
            (SELECT id FROM board WHERE  brand='$brand' AND model='$model' AND sn='$sn'),
            (SELECT id FROM retrieve WHERE number='$number' ORDER BY id DESC LIMIT 1),
            '$date', 1, '$note')";
            mysql_query($sql);
    }
    else if ($_POST["function"] == "user") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $name = $_POST["name"];
        $surename = $_POST["surename"];


        $sql = "INSERT INTO user (username,password,name,surename) VALUES ('$username','$password','$name','$surename')";

        mysql_query($sql);
    }
    else if ($_POST["function"] == "get_description") {
        $sn = $_POST["sn"];

        $sql = "SELECT * FROM board WHERE sn='$sn'";
        $result = mysql_query($sql);
        $rows;
        while($r = mysql_fetch_assoc($result)) {
            $rows = $r;
        }
        echo json_encode($rows);
    }
    else if ($_POST["function"] == "get_transactions_for_sn") {
        $sn = $_POST["sn"];

        $sql = "SELECT * FROM
            (SELECT c.id transaction_id, c.number, c.location, t.type, t.date, t.note FROM board b, transaction t, claim c WHERE b.sn='$sn' AND b.id=t.board_id AND c.id=t.transaction_id AND t.type=0
            UNION ALL
            SELECT r.id transaction_id, r.number, null location, t.type, t.date, t.note FROM board b, transaction t, retrieve r WHERE b.sn='$sn' AND b.id=t.board_id AND r.id=t.transaction_id AND t.type=1
            UNION ALL
            SELECT '0' transaction_id, '0' number, null location, t.type, t.date, t.note FROM board b, transaction t WHERE b.sn='$sn' AND b.id=t.board_id AND t.type=-1) result
        ORDER BY date";

        $result = mysql_query($sql);
        $rows = array();
        while($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }
    else if ($_POST["function"] == "count_by_model_instock") {

        $sql = "SELECT brand, model, COUNT(*) amount FROM board b WHERE (SELECT t.type FROM transaction t WHERE t.board_id=b.id ORDER BY t.date DESC LIMIT 1)=1 GROUP BY brand, model";
        $result = mysql_query($sql);
        $rows = array();
        while($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }
    else if ($_POST["function"] == "count_by_model_claimimg") {

        $sql = "SELECT brand, model, COUNT(*) amount FROM board b WHERE (SELECT t.type FROM transaction t WHERE t.board_id=b.id ORDER BY t.date DESC LIMIT 1)=0 GROUP BY brand, model";
        $result = mysql_query($sql);
        $rows = array();
        while($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }
    // else if ($_POST["function"] == "count_by_type_instock") {
    //
    //     $sql = "SELECT type, COUNT(*) amount FROM board b WHERE (SELECT t.type FROM transaction t WHERE t.board_id=b.id ORDER BY t.date DESC LIMIT 1)=1 GROUP BY type";
    //     $result = mysql_query($sql);
    //     $rows = array();
    //     while($r = mysql_fetch_assoc($result)) {
    //         $rows[] = $r;
    //     }
    //     echo json_encode($rows);
    // }
    else if ($_POST["function"] == "get_available_sn_claim") {
        $sn_part = $_POST["sn_part"];

        $sql = "SELECT sn FROM board b WHERE (SELECT t.type FROM transaction t WHERE t.board_id=b.id ORDER BY t.date DESC LIMIT 1)=1 AND sn LIKE '%$sn_part%'";
        $result = mysql_query($sql);
        $rows = array();
        while($r = mysql_fetch_assoc($result)) {
            $rows[] = $r[sn];
        }
        echo json_encode($rows);
    }
    else if ($_POST["function"] == "get_available_sn_retrieve") {
        $sn_part = $_POST["sn_part"];

        $sql = "SELECT sn FROM board b WHERE (SELECT t.type FROM transaction t WHERE t.board_id=b.id ORDER BY t.date DESC LIMIT 1)=0  AND sn LIKE '%$sn_part%'";
        $result = mysql_query($sql);
        $rows = array();
        while($r = mysql_fetch_assoc($result)) {
            $rows[] = $r[sn];
        }
        echo json_encode($rows);
    }
    // else if ($_POST["function"] == "check_has_sn") {
    //     $sn = $_POST["sn"];
    //
    //     $sql = "SELECT COUNT(*) count FROM board b WHERE sn='$sn'";
    //     $result = mysql_query($sql);
    //     $rows = array();
    //     while($r = mysql_fetch_assoc($result)) {
    //         $rows[] = $r;
    //     }
    //     echo json_encode($rows);
    // }
    else if ($_POST["function"] == "check_sn_available_for_claim") {
        $sn = $_POST["sn"];

        $sql = "SELECT COUNT(*) count FROM board b WHERE sn='$sn' AND (SELECT t.type FROM transaction t WHERE t.board_id=b.id ORDER BY t.date DESC LIMIT 1)=1";
        $result = mysql_query($sql);
        $rows = array();
        while($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }
    else if ($_POST["function"] == "check_sn_available_for_retrieve") {
        $sn = $_POST["sn"];

        $sql = "SELECT COUNT(*) count FROM board b WHERE sn='$sn' AND (SELECT t.type FROM transaction t WHERE t.board_id=b.id ORDER BY t.date DESC LIMIT 1)=0";
        $result = mysql_query($sql);
        $rows = array();
        while($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }
    else if ($_POST["function"] == "get_detail_by_sn") {
        $sn = $_POST["sn"];

        $sql = "SELECT * FROM board WHERE sn='$sn'";
        $result = mysql_query($sql);
        $rows = array();
        while($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }
    // else if ($_POST["function"] == "get_recommend_add_device") {
    //     $model_part = $_POST["model_part"];
    //
    //     $sql = "SELECT DISTINCT model FROM board WHERE model LIKE '%$number_part%' ORDER BY id DESC LIMIT 10";
    //
    //     $result = mysql_query($sql);
    //     $rows = array();
    //     while($r = mysql_fetch_assoc($result)) {
    //         $rows[] = $r[model];
    //     }
    //     echo json_encode($rows);
    // }
    else if ($_POST["function"] == "get_recommend_claim_number") {
        $number_part = $_POST["number_part"];

        $sql = "SELECT DISTINCT number FROM claim WHERE number LIKE '%$number_part%' ORDER BY id DESC LIMIT 10";

        $result = mysql_query($sql);
        $rows = array();
        while($r = mysql_fetch_assoc($result)) {
            $rows[] = $r[number];
        }
        echo json_encode($rows);
    }
    else if ($_POST["function"] == "get_recommend_retrieve_number") {
        $number_part = $_POST["number_part"];

        $sql = "SELECT DISTINCT number FROM retrieve WHERE number LIKE '%$number_part%' ORDER BY id DESC LIMIT 10";

        $result = mysql_query($sql);
        $rows = array();
        while($r = mysql_fetch_assoc($result)) {
            $rows[] = $r[number];
        }
        echo json_encode($rows);
    }
    else if ($_POST["function"] == "get_recommend_claim_location") {
        $location_part = $_POST["location_part"];

        $sql = "SELECT DISTINCT location FROM claim WHERE location LIKE '%$location_part%' ORDER BY id DESC LIMIT 10";

        $result = mysql_query($sql);
        $rows = array();
        while($r = mysql_fetch_assoc($result)) {
            $rows[] = $r[location];
        }
        echo json_encode($rows);
    }
    else if ($_POST["function"] == "get_recommend_retrieve_note") {
        $number_part = $_POST["number_part"];

        $sql = "SELECT note FROM transaction where type=1 ORDER BY date DESC LIMIT 10";

        $result = mysql_query($sql);
        $rows = array();
        while($r = mysql_fetch_assoc($result)) {
            $rows[] = $r[note];
        }
        echo json_encode($rows);
    }
    else if ($_POST["function"] == "get_recommend_claim_note") {
        $number_part = $_POST["number_part"];

        $sql = "SELECT note FROM transaction where type=0 ORDER BY date DESC LIMIT 10";

        $result = mysql_query($sql);
        $rows = array();
        while($r = mysql_fetch_assoc($result)) {
            $rows[] = $r[note];
        }
        echo json_encode($rows);
    }
    else if ($_POST["function"] == "get_search_brands") {
        $sql = "SELECT DISTINCT brand FROM board";

        $result = mysql_query($sql);
        $rows = array();
        while($r = mysql_fetch_assoc($result)) {
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
        while($r = mysql_fetch_assoc($result)) {
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
        while($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }
    else if ($_POST["function"] == "broken") {
        $sn = $_POST["sn"];

        $sql = "INSERT INTO transaction (board_id, transaction_id, date, type, note) VALUES (
            (SELECT id FROM board WHERE sn='$sn'), 0, NOW(), -1, 'เสียโดยสิ้นเชิง')";
        mysql_query($sql);
            // echo $sql;
    }
    else if ($_POST["function"] == "number_report") {
        $number_part = $_POST["number_path"];
        $date_start = $_POST["date-start"];
        $date_end = $_POST["number"];

        $sql = "SELECT c.number, t.type, COUNT(*) amount, (SELECT t.date FROM transaction t WHERE t.transaction_id=c.id ORDER BY t.date DESC LIMIT 1) date FROM claim c, transaction t WHERE t.type=0 AND t.transaction_id=c.id GROUP BY c.number
          UNION
          SELECT r.number, t.type, COUNT(*) amount, (SELECT t.date FROM transaction t WHERE t.transaction_id=r.id ORDER BY t.date DESC LIMIT 1) date FROM retrieve r, transaction t WHERE t.type=1 AND t.transaction_id=r.id GROUP BY r.number";
        $result = mysql_query($sql);
        $rows = array();
        while($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }


}

?>
