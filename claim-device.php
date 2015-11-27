<h2 class="sub-header">เลขที่หนังสือ</h2>

<div class="form-group" id="form-number">
    <label>เลขที่หนังสือส่ง *</label>
    <div class="row">
        <div class="col-xs-10">
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle form-control" type="button" id="number" data-toggle="dropdown" style="width: 100%">
                    <text>เลือกเลขที่หนังสือส่ง</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="number-dropdown" style="width: 100%">
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
            <span id="error-sn" style="color: red"></span>
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

        <div class="form-group" id="form-type">
            <label>ประเภทการใช้งาน *</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-barcode"></span>
                </span>
                <input type="text" class="form-control" id="type" disabled>
            </div>
        </div>
    </div>

    <div class="col-xs-6">
        <div class="form-group" id="form-note">
            <label>หมายเหตุ</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-pencil"></span>
                </span>
                <input type="text"class="form-control" id="note">
            </div>
        </div>

        <div class="form-group" id="form-location">
            <label>เสียถาวร</label>
            <div class="input-group">
                <input type="checkbox" id="broken">
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
                <div class="form-group" id="form-number-add">
                    <label>เลขที่หนังสือส่ง *</label>
                    <span id="error-number" style="color: red"></span>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-tag"></span>
                        </span>
                        <input type="text" class="form-control" id="number-add">
                    </div>
                </div>

                <div class="form-group" id="form-from-location">
                    <label>ส่งจาก</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-map-marker"></span>
                        </span>
                        <input type="text"class="form-control" id="from-location">
                    </div>
                </div>

                <div class="form-group" id="form-to-location">
                    <label>ส่งไปที่</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-map-marker"></span>
                        </span>
                        <input type="text"class="form-control" id="to-location">
                    </div>
                </div>

                <div class="form-group" id="form-date">
                    <label>วันที่ส่ง</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        <input type="text"class="form-control" id="date">
                    </div>
                </div>

                <div class="form-group" id="form-note-number">
                    <label>หมายเหตุ</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </span>
                        <input type="text"class="form-control" id="note-number">
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

$(document).ready(function() {
    $.ajax({
        url: 'db.php',
        type: "POST",
        dataType: "json",
        data: {
            "function": "get_claiming_number"
        }
    }).done(function(results) {
        $("#number-dropdown").empty();
        for (var i = 0; i < results.length; i++) {
            $("#number-dropdown").append("<li><a href=\"#\">" + results[i].number + "</a></li>");
        }

        $("#number-dropdown li").click(function() {
            $("#number text").text($(this).text());
            $("#form-number").removeClass("has-error");
        });
    });
});

$("#number-add").on("blur change", checkHasNumber);
$("#number-add").on('keyup', function() {
    $("#form-number-add").removeClass("has-error");
    if (event.which === 13) {
        checkHasNumber();
    }
});

$("#add-number-button").click(function() {
    if (validateNumber()) {
        if (!checkHasNumber()) {
            $.ajax({
                url: 'db.php',
                type: "POST",
                data: {
                    "function": "add_number_claiming",
                    "number": $("#number-add").val(),
                    "from_location": $("#from-location").val(),
                    "to_location": $("#to-location").val(),
                    "date": $("#date").val(),
                    "note_number": $("#note-number").val()
                }
            }).done(function(results) {
                location.reload();
            });
        }
    }
});

function validateNumber() {
    if ($("#number").val() == "") {
        $("#form-number-add").addClass("has-error");
    }
    return !$("#form-number-add").hasClass("has-error");
}

function checkHasNumber() {
    $.ajax({
        url: 'db.php',
        type: "POST",
        dataType: "json",
        data: {
            "function": "check_has_number_claiming",
            "number": $("#number").val()
        }
    }).done(function(results) {
        if (results[0].count > 0) {
            $("#form-number-add").addClass("has-error");
            $("#error-number").text("เลขที่หนังสือส่งซ้ำ");
            return false;
        }
        else {
            $("#form-number-add").removeClass("has-error");
            $("#error-number").text("");
            return true;
        }
    });
}



$("#sn").on("blur change", checkSnAvailableForClaim);
$("#sn").on('keyup', function() {
    $("#form-sn").removeClass("has-error");
    if (event.which === 13) {
        checkSnAvailableForClaim();
    }
});

$("#submit-button").click(function() {
    if (validate()) {
        if (!checkSnAvailableForClaim()) {
            $.ajax({
                url: 'db.php',
                type: "POST",
                data: {
                    "function": "claim",
                    "number": $("#number text").text(),
                    "sn": $("#sn").val(),
                    "note": $("#note").val()
                }
            }).done(function(results) {
                location.reload();
            });
        }
    }
});

function validate() {
    if ($("#number text").text() == "เลือกเลขที่หนังสือส่ง") {
        $("#form-number").addClass("has-error");
    }
    if ($("#sn").val() == "") {
        $("#form-sn").addClass("has-error");
    }
    return !$("#form-sn").hasClass("has-error") && !$("#form-number").hasClass("has-error");
}

function checkSnAvailableForClaim() {
    $.ajax({
        url: 'db.php',
        type: "POST",
        dataType: "json",
        data: {
            "function": "check_sn_available_for_claim",
            "sn": $("#sn").val()
        }
    }).done(function(results) {
        if (results[0].count == 0) {
            $("#form-sn").addClass("has-error");
            $("#error-sn").text("S/N ไม่พร้อมส่งซ่อม หรือไม่มีอยู่ในระบบ");
            return false;
        }
        else {
            $("#form-sn").removeClass("has-error");
            $("#error-sn").text("");
            return true;
        }
    });
}

</script>
