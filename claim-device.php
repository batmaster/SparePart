<h2 class="sub-header">เลขที่หนังสือ</h2>

<div class="form-group" id="form-brand">
    <label>เลขที่หนังสือส่ง *</label>
    <div class="row">
        <div class="col-xs-10">
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="brand" data-toggle="dropdown" style="width: 100%">
                    <text>เลือกเลขที่หนังสือส่ง</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="brand-dropdown" style="width: 100%">
                </ul>
            </div>
        </div>
        <div class="col-xs-2">
            <div class="btn-group btn-outline">
                <a href="#" data-toggle="modal" data-target="#add-number-modal"><button type="button" class="btn btn-info" id="clear-button"><span class="glyphicon glyphicon glyphicon-tag"></span> เพิ่มเลขที่หนังสือส่ง</button></a>
            </div>
        </div>
    </div>
</div>

<h2 class="sub-header">เพิ่มรายการ</h2>
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

<div class="modal fade" id="add-number-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                เพิ่มเลขที่หนังสือส่ง
            </div>
            <div class="modal-body">
                <div class="form-group" id="form-number">
                    <label>เลขที่หนังสือส่ง *</label>
                    <img src="images/ajax-loader.gif" id="number-loading" style="display: none"/>
                    <span id="error" style="color: red"></span>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-tag"></span>
                        </span>
                        <input type="text" class="form-control" id="number-add">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-success" id="add-number-button">ยืนยัน</button>
            </div>
        </div>
    </div>
</div>
</div>


<script type="text/javascript">

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
                            $("#error").text("S/N ซ้ำ");
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

</script>
