<h2 class="sub-header">อุปกรณ์</h2>
<div class="row">
    <div class="col-xs-6">
        <div class="form-group" id="form-brand">
            <label>ยี่ห้อ *</label>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle form-control" type="button" id="brand" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="width: 100%">
                    <text>เลือกยี่ห้อ</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="brand-dropdown" style="width: 100%">
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

        <div class="form-group" id="form-type">
            <label>ประเภทการใช้งาน *</label>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle form-control" type="button" id="type" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="width: 100%">
                    <text>เลือกประเภท</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="type-dropdown" style="width: 100%">
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
            <div class="filthypillow" id="calendar"></div>
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

    $("#calendar").filthypillow({
        calendar: {
            saveOnDateSelect: false,
            isPinned: true
        },
        exitOnBackgroundClick: false
    });

    $("#calendar").on("fp:save", function(e, dateObj) {
        $("#date").val(dateObj.format("YYYY-MM-DD HH:mm"));
        $("#calendar").filthypillow("hide");
    });



    $("#brand-dropdown").click(function() {
        $("#form-brand").removeClass("has-error");

    });

    $("#model").keyup(function() {
        $("#form-model").removeClass("has-error");
    });

    $("#sn").keyup(function() {
        $("#form-sn").removeClass("has-error");
    });

    $("#type-dropdown").click(function() {
        $("#form-type").removeClass("has-error");
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
                    if ($("#sn").val() == "") {
                        $("#form-sn").addClass("has-error");
                        $("#error").text("");
                    }
                    else {
                        $("#form-sn").removeClass("has-error");
                        $("#form-sn").addClass("has-success");
                        $("#error").text("");
                    }
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
        $("#calendar").filthypillow("show");
    });

    function validate() {
        if ($("#brand text").text() == "เลือกยี่ห้อ") {
            $("#form-brand").addClass("has-error");
        }

        if ($("#type text").text() == "เลือกประเภท") {
            $("#form-type").addClass("has-error");
        }

        if ($("#model").val() == "") {
            $("#form-model").addClass("has-error");
        }

        if ($("#sn").val() == "") {
            $("#form-sn").addClass("has-error");
        }

        return !$("#form-brand").hasClass("has-error") && !$("#form-type").hasClass("has-error") && !$("#form-model").hasClass("has-error") && !$("#form-sn").hasClass("has-error");
    }

    $("#submit-button").click(function() {
        if (validate()) {
            $.ajax({
                url: 'db.php',
                type: "POST",
                data: {
                    "function": "add",
                    "brand": $("#brand text").text(),
                    "model": $("#model").val(),
                    "sn": $("#sn").val(),
                    "type": $("#type text").text(),
                    "date": $("#date").val(),
                    "note": $("#note").val()
                }
            }).done(function(results) {
                location.reload();
            });
        }
    });

    $("#clear-button").click(function() {
        location.reload();
    });

    $("#brand-dropdown li").click(function() {
        $("#brand text").text($(this).text());
    });

    $("#type-dropdown li").click(function() {
        $("#type text").text($(this).text());
    });

</script>
