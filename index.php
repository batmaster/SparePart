<html>
<head>
    <title>Spare Part</title>
    <meta charset="utf-8">
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/jquery.filthypillow.js"></script>
    <script type="text/javascript" src="js/moment.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.filthypillow.css">


    <style>
        .a-disabled {
            color: #eee;
            pointer-events: none;
        }
        .ui-autocomplete {
            position: absolute;
            z-index: 1000;
            cursor: default;
            padding: 0;
            margin-top: 2px;
            list-style: none;
            background-color: #ffffff;
            border: 1px solid #ccc
            -webkit-border-radius: 5px;
               -moz-border-radius: 5px;
                    border-radius: 5px;
            -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
               -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
                    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
        .ui-autocomplete > li {
          padding: 3px 20px;
        }
        .ui-autocomplete > li.ui-state-focus {
          background-color: #DDD;
        }
        .ui-helper-hidden-accessible {
          display: none;
        }
    </style>
    <?php include('config.php'); ?>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Spare Part</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="?page=summary-device">รายการอุปกรณ์</a></li>
                    <li><a href="#">#เพิ่มภายหลัง เผื่อมี</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a><?php echo $version; ?></a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li <?php if (!isset($_GET["page"]) || $_GET["page"] == "summary-device") echo 'class="active"';?>><a href="?page=summary-device">สรุปยอด</a></li>
                    <li <?php if ($_GET["page"] == "search-device") echo 'class="active"';?>><a href="?page=search-device">ค้นหาอุปกรณ์</a></li>
                    <li <?php if ($_GET["page"] == "add-device") echo 'class="active"';?>><a href="?page=add-device">เพิ่มอุปกรณ์</a></li>
                    <li <?php if ($_GET["page"] == "claim-device") echo 'class="active"';?>><a href="?page=claim-device">รายการส่งซ่อม</a></li>
                    <li <?php if ($_GET["page"] == "retrieve-device") echo 'class="active"';?>><a href="?page=retrieve-device">รายการรับคืน</a></li>
                </ul>
                <ul class="nav nav-sidebar">
                    <li <?php if ($_GET["page"] == "number-report" || $_GET["page"] == "board-list-report") echo 'class="active"';?>><a href="?page=number-report">รายงานเลขที่หนังสือรับส่ง</a></li>
                    <li <?php if ($_GET["page"] == "monthly-report") echo 'class="active"';?>><a href="?page=monthly-report">#รายงานผลรายเดือน</a></li>
                </ul>
                <ul class="nav nav-sidebar">
                    <li <?php if ($_GET["page"] == "info") echo 'class="active"';?>><a href="?page=info">#ข้อมูลเพิ่มเติม</a></li>
                    <li <?php if ($_GET["page"] == "user") echo 'class="active"';?>><a href="?page=user">#ข้อมูลผู้ใช้</a></li>
                </ul>


</div>





            </div>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <?php
                if (isset($_GET["page"]))
                    include($_GET["page"].".php");
                else
                    include("summary-device.php");
            ?>
        </div>
    </div>

</body>
</html>
