<h1 class="page-header">Claim Devices</h1>
<h2 class="sub-header">Section title</h2>
<div class="row">
    <div class="col-xs-6">
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
            <label>ยี่ห้อ *</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-barcode"></span>
                </span>
                <input type="text" class="form-control" id="brand" disabled>
            </div>
        </div>

        <div class="form-group" id="form-model">
            <label>ชื่ออุปกรณ์ *</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-barcode"></span>
                </span>
                <input type="text" class="form-control" id="model" disabled>
            </div>
        </div>
    </div>

    <div class="col-xs-6">
        <div class="form-group" id="form-date">
            <label>วันที่ส่งซ่อม *</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <input type="text" class="form-control" id="date">
            </div>
        </div>

        <div class="form-group" id="form-number">
            <label>เลขที่หนังสือส่ง *</label>
            <img src="images/ajax-loader.gif" id="number-loading" style="display: none"/>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-tag"></span>
                </span>
                <input type="text" class="form-control" id="number">
            </div>
        </div>

        <div class="form-group" id="form-location">
            <label>ส่งไปที่ *</label>
            <img src="images/ajax-loader.gif" id="location-loading" style="display: none"/>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-map-marker"></span>
                </span>
                <input type="text"class="form-control" id="location">
            </div>
        </div>

        <div class="form-group" id="form-location">
            <label>หมายเหตุ</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-pencil"></span>
                </span>
                <input type="text"class="form-control" id="note">
            </div>
        </div>
    </div>

    <div class="btn-group btn-outline">
        <button type="button" class="btn btn-warning" id="clear-button"><span class="glyphicon glyphicon-remove-circle"></span> ล้างฟอร์ม</button>
    </div>

    <div class="btn-group btn-outline">
        <button type="button" class="btn btn-success" id="submit-button"><span class="glyphicon glyphicon-open"></span> ส่งซ่อม</button>
    </div>

</div>


<script type="text/javascript">

    $(document).ready(function() {
		<?php
            if (isset($_GET["sn"])) {
                echo "$(\"#sn\").val(\"{$_GET["sn"]}\");";
                echo "$(\"#sn\").change();";
                echo "$(\"#date\").focus();";
            }
            else {
                echo "$(\"#sn\").focus();";
            }
        ?>

	});

    $("#sn").keyup(function() {
        $.ajax({
            url: 'db.php',
            type: "POST",
            dataType: "json",
            data: {
                "function": "get_available_sn_claim",
                "sn_part": $("#sn").val()
            },
            beforeSend: function(){
                $("#sn-loading").show();
            },
            success: function(results) {
                $("#sn").autocomplete({
                    source: results
                });
            },
            complete: function() {
                $("#sn-loading").hide();
            }
        });
    });

    $("#number").keyup(function() {
        $.ajax({
            url: 'db.php',
            type: "POST",
            dataType: "json",
            data: {
                "function": "get_recommend_claim_number",
                "number_part": $("#number").val()
            },
            beforeSend: function(){
                $("#number-loading").show();
            },
            success: function(results) {
                $("#number").autocomplete({
                    source: results
                });
            },
            complete: function(results) {
                $("#number-loading").hide();
            }
        });
    });

    $("#location").keyup(function() {
        $.ajax({
            url: 'db.php',
            type: "POST",
            dataType: "json",
            data: {
                "function": "get_recommend_claim_location",
                "location_part": $("#location").val()
            },
            beforeSend: function(){
                $("#location-loading").show();
            },
            success: function(results) {
                $("#location").autocomplete({
                    source: results
                });
            },
            complete: function(results) {
                $("#location-loading").hide();
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
                    $.ajax({
                        url: 'db.php',
                        type: "POST",
                        dataType: "json",
                        data: {
                            "function": "check_sn_available_for_claim",
                            "sn": $("#sn").val()
                        },
                        beforeSend: function(){
                            $("#sn-loading").show();
                        },
                        success: function(results) {
                            if (results[0].count > 0) {
                                $.ajax({
                                    url: 'db.php',
                                    type: "POST",
                                    dataType: "json",
                                    data: {
                                        "function": "get_detail_by_sn",
                                        "sn": $("#sn").val()
                                    },
                                    beforeSend: function(){
                                        $("#sn-loading").show();
                                    },
                                    success: function(result) {
                                        $("#brand").val(result[0].brand);
                                        $("#model").val(result[0].model);

                                        $("#form-sn").removeClass("has-error");
                                        $("#form-sn, #form-brand, #form-model").addClass("has-success");
                                        $("#error").text("");
                                        // console.log($("#form div:nth-child(4)")[0]);
                                    },
                                    complete: function() {
                                        $("#sn-loading").hide();
                                    }
                                });
                            }
                            else {
                                $("#brand").val("");
                                $("#model").val("");

                                $("#form-sn, #form-brand, #form-model").removeClass("has-success");
                                $("#form-sn").addClass("has-error");
                                $("#error").text("SN ไม่อยู่ในสถานะพร้อมส่งเครม");
                            }
                        },
                        complete: function() {
                            $("#sn-loading").hide();
                        }
                    });
                }
                else {
                    $("#brand").val("");
                    $("#model").val("");

                    $("#form-sn, #form-brand, #form-model").removeClass("has-success");
                    $("#form-sn").addClass("has-error");
                    $("#error").text("ไม่พบ SN");
                }

            },
            complete: function() {
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

    $("#clear-button").click(function() {
        $("#sn").val("");
        $("#brand").val("");
        $("#model").val("");
        $("#date").val("");
        $("#number").val("");
        $("#location").val("");
        $("#note").val("");

        $("#form-sn, #form-brand, #form-model").removeClass("has-success");
        $("#form-sn, #form-date, #form-number, #form-location").removeClass("has-error");
    });

    $("#submit-button").click(function() {
        $("#form-sn, #form-brand, #form-model").removeClass("has-success");
        $("#form-sn, #form-date, #form-number, #form-location").removeClass("has-error");

        if ($("#brand").val() == "" || $("#model").val() == "") {
            $("#form-sn").addClass("has-error");
        }
        if ($("#date").val() == "") {
            $("#form-date").addClass("has-error");
        }
        if ($("#number").val() == "") {
            $("#form-number").addClass("has-error");
        }
        if ($("#location").val() == "") {
            $("#form-location").addClass("has-error");
        }
        if (!($("#brand").val() == "") && !($("#model").val() == "") && !($("#date").val() == "") && !($("#number").val() == "") && !($("#location").val() == "")) {
            $.ajax({
                url: 'db.php',
                type: "POST",
                data: {
                    "function": "claim",
                    "sn": $("#sn").val(),
                    "brand": $("#brand").val(),
                    "model": $("#model").val(),
                    "date": $("#date").val(),
                    "number": $("#number").val(),
                    "location": $("#location").val(),
                    "note": $("#note").val()

                }
            }).done(function(result) {
                location.reload();
                // console.log(result);
                // alert("น่าจะ ok");                  //ยืนยันการบันทึก
            });
        }
    });


</script>
