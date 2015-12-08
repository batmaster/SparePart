<h1 class="page-header">รายงานผล</h1>
<h2 class="sub-header">เลขที่หนังสือรับส่งอุปกรณ์</h2>
<div class="row">
    <div class="col-xs-12">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#menu1">ระบุเลขที่หนังสือ</a></li>
            <li><a data-toggle="tab" href="#menu2">ระบุช่วงเวลา</a></li>
        </ul>

        <div class="tab-content">
            <div id="menu1" class="tab-pane fade in active">
                <div class="form-group" id="form-number">
                    <label>เลขที่หนังสือรับ/ส่ง</label>
                    <img src="images/ajax-loader.gif" id="number-loading" style="display: none"/>
                    <span id="error" style="color: red"></span>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-barcode"></span>
                        </span>
                        <input type="text" class="form-control" id="number" placeholder="ทุกเลขที่">
                    </div>
                </div>
            </div>

            <div id="menu2" class="tab-pane fade">
                <div class="form-group" id="form-date-start">
                    <label>ช่วงวันที่</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        <input type="text" class="form-control" id="date-from">
                    </div>
                    <div class="filthypillow" id="calendar-from"></div>
                </div>

                <div class="form-group" id="form-date-end">
                    <label>ถึงวันที่</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        <input type="text" class="form-control" id="date-to">
                    </div>
                    <div class="filthypillow" id="calendar-to"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="btn-group btn-outline">
        <button type="button" class="btn btn-warning" id="clear-button"><span class="glyphicon glyphicon-remove-circle"></span> ล้างฟอร์ม</button>
    </div>

    <div class="btn-group btn-outline">
        <button type="button" class="btn btn-info" id="search-button"><span class="glyphicon glyphicon-search"></span> ค้นหา</button>
    </div>

    <div class="panel panel-default">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>เลขที่หนังสือ</th>
                    <th>ประเภท</th>
                    <th>จำนวนอุปกรณ์</th>
                    <th>วันที่</th>
                    <th>หมายเหตุ</th>
                </tr>
            </thead>
            <tbody id="table-body-number">

            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function() {
    var highestTab = null;

    $(".tab-content > div").each(function() {
        var h = $(this).height();
        if (h > highestTab){
            highestTab = $(this).height();
        }
    });

    $(".tab-content > div").height(highestTab);

    var now = moment().subtract("seconds", 1);
    $("#date-from").val(now.format("YYYY-MM-DD HH:mm"));
    $("#date-to").val(now.format("YYYY-MM-DD HH:mm"));

    $("#search-button").click();
});

$(".filthypillow").filthypillow({
    calendar: {
        saveOnDateSelect: false,
        isPinned: true
    },
    exitOnBackgroundClick: false
});

$("#calendar-from").on("fp:save", function(e, dateObj) {
    $("#date-from").val(dateObj.format("YYYY-MM-DD HH:mm"));
    $("#calendar-from").filthypillow("hide");
});

$("#calendar-to").on("fp:save", function(e, dateObj) {
    $("#date-to").val(dateObj.format("YYYY-MM-DD HH:mm"));
    $("#calendar-to").filthypillow("hide");
});

$("#date-from").on("focus", function() {
    $("#calendar-from").filthypillow("show");
    $("#calendar-to").filthypillow("hide");
});

$("#date-to").on("focus", function() {
    $("#calendar-to").filthypillow("show");
    $("#calendar-from").filthypillow("hide");
});

$("#search-button").click(function() {
    $.ajax({
        url: 'db.php',
        type: "POST",
        dataType: "json",
        data: {
            "function": "number_search",
            "number": $("#number").val(),
            "date_from": $("#date-from").val(),
            "date_to": $("#date-to").val(),
            "mode": $("#menu1").hasClass("active") ? 0 : 1
        }
    }).done(function(results) {
        $("#table-body-number").empty();
        if (results.length == 0) {
            $("#table-body-number").append("<tr><th></th><td>ไม่พบ!</td><td></td><td></td><td></td><td></td></tr>");
        }
        for (var i = 0; i < results.length; i++) {
            $("#table-body-number").append("<tr><th>" + (i+1) + "</th><td><a href=\"?page=number-report-summary&number=" + results[i].number + "\">" + results[i].number + "</a></td><td>" + (results[i].type == 0 ? "ส่งซ่อม" : (results[i].type == 1 ? "รับคืน" : "ส่งโอน")) + "</td><td>" + results[i].amount + "</td><td>" + results[i].date + "</td><td>" + results[i].note + "</td></tr>");
        }
    });
});




</script>
