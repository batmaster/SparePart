<h1 class="page-header">Add Device</h1>
<h2 class="sub-header">Section title</h2>
<div class="row">
    <div class="col-xs-6">
        <div class="form-group" id="form-brand">
            <label>ยี่ห้อ *</label>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="brand" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <text>Dropdown</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="brand-dropdown" >
                    <li><a href="#">OPNET</a></li>
                    <li><a href="#">ERICSSON</a></li>
                    <li><a href="#">HUAWEI</a></li>
                    <li><a href="#">FORTH</a></li>
                    <li><a href="#">ZTE</a></li>
                    <li><a href="#">KEMINE</a></li>
                    <li><a href="#">ZYXEL</a></li>
                </ul>
            </div>
        </div>

        <div class="form-group" id="form-model">
            <label>ชื่ออุปกรณ์ *</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-barcode"></span>
                </span>
                <input type="text" class="form-control" id="model">
            </div>
        </div>

        <div class="form-group" id="form-sn">
            <label>S/N *</label>
            <img src="images/ajax-loader.gif" id="sn-loading" style="display: none"/>
            <span id="error" style="color: red"></span>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-barcode"></span>
                </span>
                <input type="text" class="form-control" id="sn">
            </div>
        </div>

        <div class="form-group" id="form-brand">
            <label>ประเภทการใช้งาน *</label>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="type" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <text>Dropdown</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="type-dropdown">
                    <li><a href="#">เลขหมาย</a></li>
                    <li><a href="#">CPU</a></li>
                    <li><a href="#">POWER</a></li>
                    <li><a href="#">TSW</a></li>
                    <li><a href="#">EMRP</a></li>
                    <li><a href="#">SLCT</a></li>
                    <li><a href="#">RP</a></li>
                    <li><a href="#">DCI</a></li>
                    <li><a href="#">CONTROL</a></li>
                    <li><a href="#">ADSL</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xs-6">
        <div class="form-group" id="form-date">
            <label>วันที่นำเข้า *</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <input type="text" class="form-control" id="date">
            </div>
            <div class="filthypillow"></div>
        </div>

        <div class="form-group">
            <label>เลขที่สินทรัพย์</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-book"></span>
                </span>
                <input type="text" class="form-control" id="number">
            </div>
        </div>

        <div class="form-group">
            <label>รหัสพัสดุ</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-book"></span>
                </span>
                <input type="text" class="form-control" id="code">
            </div>
        </div>

        <div class="form-group">
            <label>หมายเหตุ</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-pencil"></span>
                </span>
                <input type="text" class="form-control" id="note">
            </div>
        </div>
    </div>

    <div class="btn-group">
        <button type="button" class="btn btn-warning" ID="clear-button">Clear</button>
    </div>

    <div class="btn-group">
        <button type="button" class="btn btn-success" id="submit-button">Submit</button>
    </div>


</div>

<script type="text/javascript">

    $(document).ready(function() {
        var now = moment().subtract("seconds", 1);
        $("#date").val(now.format("YYYY-MM-DD HH:mm"));
    });

    $(".filthypillow").filthypillow({
        // minDateTime: function() {
        //     return moment().subtract("days", 1);
        // },
        // maxDateTime: function() {
        //     return moment().add("days", 7);
        // },
        calendar: {
            saveOnDateSelect: false,
            isPinned: true
        },
        exitOnBackgroundClick: false
    });

    $(".filthypillow").on("fp:save", function(e, dateObj) {
        $("#date").val(dateObj.format("YYYY-MM-DD HH:mm"));
        $(".filthypillow").filthypillow("hide");
    });

    $("#model").keyup(function() {
        $.ajax({
            url: 'db.php',
            type: "POST",
            dataType: "json",
            data: {
                "function": "get_recommend_add_device",
                "model_part": $("#model").val()
            },
            beforeSend: function() {

            },
            success: function(results) {
                console.log(results);
                $("#model").autocomplete({
                    source: results
                });
            },
            complete: function() {

            }
        });
    });

    var checkSNFunction = function () {
        $.ajax({
            url: 'db.php',
            type: "POST",
            dataType: "json",
            data: {
                "function": "check_has_sn",
                "sn": $("#sn").val()
            },
            beforeSend: function(){
                $("#sn-loading").show();
            },
            success: function(results) {
                if (results[0].count > 0) {
                    $("#form-sn").addClass("has-error");
                    $("#error").text("S/N ซ้ำ");
                }
                else {
                    $("#form-sn").removeClass("has-error");
                    $("#form-sn").addClass("has-success");
                    $("#error").text("");
                }
            },
            complete: function(results) {
                $("#sn-loading").hide();
            }
        });
    };

    $("#sn").on("blur change", checkSNFunction);
    $("#sn").on('keypress', function() {
         if (event.which === 13) {
             checkSNFunction();
         }
    });

    $("#date").on("focus", function() {
        $(".filthypillow").filthypillow("show");
    });

    $("#submit-button").click(function() {
        //        alert( $("#brand text").text()  +$("#model").val() + $("#sn").val() + $("#type text").text());
        // ส่งข้อมูลไป php
        $.ajax({
            url: 'db.php',
            type: "POST",
            //            contentType: "application/json",
            // dataType: "json",
            data: {
                "function": "add",
                "brand": $("#brand text").text(),
                "model": $("#model").val(),
                "sn": $("#sn").val(),
                "type": $("#type text").text(),
                "date": $("#date").val(),
                "number": $("#number").val(),
                "code": $("#code").val(),
            }
        }).done(function(result) {
            location.reload();
            // alert("น่าจะ ok");      //ยืนยันการบันทึก
            // console.log(result);
            //            console.log(result[0].id);
            //            if (result[0].id > 0)
            //                alert("OK");
        });



    });

    $("#clear-button").click(function() {
            alert("ยังไม่ทำที");
    });

    $("#brand-dropdown li").click(function() {
        $("#brand text").text($(this).text());
    });

    $("#type-dropdown li").click(function() {
        $("#type text").text($(this).text());
    });


</script>
