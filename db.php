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

        $sql = "INSERT INTO transaction (number, type, date, note) VALUES ('เพิ่มอุปกรณ์', 1, '$date', '$note')";
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
        AND b.broken = 0
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
        AND b.broken = 0
        GROUP BY b.brand, b.model";

        $result = mysql_query($sql);
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }

    else if ($_POST["function"] == "get_transfer_summary") {
        $sql = "SELECT b.brand, b.model, COUNT(*) amount FROM board b WHERE
        (SELECT t.type FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.id DESC LIMIT 1) = 2
        AND b.broken = 0
        GROUP BY b.brand, b.model";

        $result = mysql_query($sql);
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }

    else if ($_POST["function"] == "get_broken_summary") {
        $sql = "SELECT b.brand, b.model, COUNT(*) amount FROM board b WHERE
        b.broken = 1";

        $result = mysql_query($sql);
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }

    /** CLAIM DEVICE **/
    else if ($_POST["function"] == "get_claiming_number") {
        $sql = "SELECT DISTINCT number FROM transaction WHERE type = 0 OR type = 2 ORDER BY date DESC";

        $result = mysql_query($sql);
        $rows = array();
        while ($r = mysql_fetch_assoc($result)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
    }

    else if ($_POST["function"] == "check_has_number_claiming") {
        $number = $_POST["number"];

        $sql = "SELECT COUNT(*) count FROM transaction WHERE number = '$number' AND (type = 0 OR type = 2)";
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
        (SELECT t.type FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY tor.id DESC LIMIT 1) = 1 AND b.sn = '$sn'";

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
            (SELECT id FROM transaction WHERE number = '$number' AND (type = 0 OR type = 2)),
            '$note')";
            mysql_query($sql);
        }

        /** RETRIEVE DEVICE **/
        else if ($_POST["function"] == "get_retrieve_number") {
            $sql = "SELECT DISTINCT number FROM transaction WHERE type = 1 AND number != 'เพิ่มอุปกรณ์' ORDER BY date DESC";

            $result = mysql_query($sql);
            $rows = array();
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            echo json_encode($rows);
        }

        else if ($_POST["function"] == "check_has_number_retrieve") {
            $number = $_POST["number"];

            $sql = "SELECT COUNT(*) count FROM transaction WHERE number = '$number' AND type = 1";
            $result = mysql_query($sql);
            $rows = array();
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            echo json_encode($rows);
        }

        else if ($_POST["function"] == "add_number_retrive") {
            $number = $_POST["number"];
            $date = $_POST["date"];
            $note_number = $_POST["note_number"];

            $sql = "INSERT INTO transaction (number, type, date, note) VALUES ('$number', 1, '$date', '$note_number')";
            mysql_query($sql);
        }

        else if ($_POST["function"] == "check_sn_available_for_retrieve") {
            $sn = $_POST["sn"];

            $sql = "SELECT b.* FROM board b WHERE
            (SELECT t.type FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY tor.id DESC LIMIT 1) = 0 AND b.sn = '$sn'";

            $result = mysql_query($sql);
            $rows = array();
            while ($r = mysql_fetch_assoc($result)) {
                $rows[] = $r;
            }
            echo json_encode($rows);
        }

        else if ($_POST["function"] == "retrieve") {
            $sn = $_POST["sn"];
            $number = $_POST["number"];
            $note = $_POST["note"];
            $broken = $_POST["broken"];

            $sql = "INSERT INTO transaction_order (board_id, transaction_id, note) VALUES (
                (SELECT id FROM board WHERE sn = '$sn'),
                (SELECT id FROM transaction WHERE number = '$number' AND type = 1),
                '$note')";
                mysql_query($sql);

                if ($broken == "true") {
                    $sql = "UPDATE board SET broken = 1 WHERE sn = '$sn'";
                    mysql_query($sql);
                }
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

                if ($brand == "ทั้งหมด")
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

                if ($brand == "ทั้งหมด")
                $brand = "";
                if ($model == "ทั้งหมด")
                $model = "";

                $sql = "SELECT DISTINCT type FROM board WHERE brand LIKE '%$brand%' AND model LIKE '%$model%'";

                $result = mysql_query($sql);
                $rows = array();
                while ($r = mysql_fetch_assoc($result)) {
                    $rows[] = $r;
                }
                echo json_encode($rows);
            }

            else if ($_POST["function"] == "search") {
                $brand = $_POST["brand"];
                $model = $_POST["model"];
                $type = $_POST["type"];
                $status = $_POST["status"];

                if ($brand == "ทั้งหมด")
                $brand = "";
                if ($model == "ทั้งหมด")
                $model = "";
                if ($type == "ทั้งหมด")
                $type = "";

                if ($status == "ในคลังและส่งซ่อม")
                    $sql = "SELECT b.brand, b.model, b.sn, b.type,
                    (SELECT t.type FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.date DESC LIMIT 1) status,
                    (SELECT tor.note FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.date DESC LIMIT 1) note
                    FROM board b
                    WHERE ((SELECT t.type FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.date DESC LIMIT 1) = 0
                    OR (SELECT t.type FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.date DESC LIMIT 1) = 1)
                    AND b.brand LIKE '%$brand%' AND b.model LIKE '%$model%' AND b.type LIKE '%$type%'";
                else if ($status == "ในคลัง")
                    $sql = "SELECT b.brand, b.model, b.sn, b.type,
                    (SELECT t.type FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.date DESC LIMIT 1) status,
                    (SELECT tor.note FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.date DESC LIMIT 1) note
                    FROM board b
                    WHERE (SELECT t.type FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.date DESC LIMIT 1) = 1";
                else if ($status == "ส่งซ่อม")
                    $sql = "SELECT b.brand, b.model, b.sn, b.type,
                    (SELECT t.type FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.date DESC LIMIT 1) status,
                    (SELECT tor.note FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.date DESC LIMIT 1) note
                    FROM board b
                    WHERE (SELECT t.type FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.date DESC LIMIT 1) = 0";
                else if ($status == "ส่งโอน")
                    $sql = "SELECT b.brand, b.model, b.sn, b.type,
                    (SELECT t.type FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.date DESC LIMIT 1) status,
                    (SELECT tor.note FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.date DESC LIMIT 1) note
                    FROM board b
                    WHERE (SELECT t.type FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.date DESC LIMIT 1) = 2";
                else if ($status == "เสียโดยสิ้นเชิง")
                    $sql = "SELECT b.brand, b.model, b.sn, b.type,
                    (SELECT t.type FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.date DESC LIMIT 1) status,
                    (SELECT tor.note FROM transaction t, transaction_order tor WHERE b.id = tor.board_id AND t.id = tor.transaction_id ORDER BY t.date DESC LIMIT 1) note
                    FROM board b
                    WHERE b.broken = 1";

                $result = mysql_query($sql);
                $rows = array();
                while ($r = mysql_fetch_assoc($result)) {
                    $rows[] = $r;
                }
                echo json_encode($rows);
                // echo $sql;
            }

            /** NUMBER REPORT **/
            else if ($_POST["function"] == "number_search") {
                $number = $_POST["number"];
                $date_from = $_POST["date_from"];
                $date_to = $_POST["date_to"];
                $mode = $_POST["mode"];
                $where = $mode == 0 ? " AND number LIKE '%$number%' " : " AND '$date_from' <= date AND date <= '$date_to' ";

                $sql = "SELECT t.number, t.type, (SELECT COUNT(*) FROM transaction_order tor WHERE t.id = tor.transaction_id) amount, t.date, t.note FROM transaction t WHERE number != 'เพิ่มอุปกรณ์' $where GROUP BY t.number ORDER BY t.date DESC";
                $result = mysql_query($sql);
                $rows = array();
                while ($r = mysql_fetch_assoc($result)) {
                    $rows[] = $r;
                }
                echo json_encode($rows);
            }

            /** NUMBER REPORT SUMMARY **/
            else if ($_POST["function"] == "number_summary") {
                $number = $_POST["number"];

                $sql = "SELECT b.brand, b.model, COUNT(*) amount FROM board b, transaction t, transaction_order tor WHERE t.number = '$number' AND b.id = tor.board_id AND t.id = tor.transaction_id GROUP BY b.brand, b.model";
                $result = mysql_query($sql);
                $rows = array();
                while ($r = mysql_fetch_assoc($result)) {
                    $rows[] = $r;
                }
                echo json_encode($rows);
            }

            else if ($_POST["function"] == "number_detail") {
                $number = $_POST["number"];

                $sql = "SELECT b.brand, b.model, b.sn, tor.note FROM board b, transaction t, transaction_order tor WHERE t.number = '$number' AND b.id = tor.board_id AND t.id = tor.transaction_id";
                $result = mysql_query($sql);
                $rows = array();
                while ($r = mysql_fetch_assoc($result)) {
                    $rows[] = $r;
                }
                echo json_encode($rows);
            }


        }

        ?>
