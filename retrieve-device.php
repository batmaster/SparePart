<h2 class="sub-header">เลขที่หนังสือ</h2>

<div class="form-group" id="form-number">
    <label>เลขที่หนังสือรับ *</label>
    <div class="row">
        <div class="col-xs-10">
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle form-control" type="button" id="number" data-toggle="dropdown" style="width: 100%">
                    <text>เลือกเลขที่หนังสือรับ</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="number-dropdown" style="width: 100%">
                </ul>
            </div>
        </div>
        <div class="col-xs-2">
            <div class="btn-group btn-outline">
                <a href="#" data-toggle="modal" data-target="#add-number-modal"><button type="button" class="btn btn-info" id="clear-button"><span class="glyphicon glyphicon glyphicon-tag"></span> เพิ่มเลขที่หนังสือรับ</button></a>
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
            <label>ยี่ห้อ</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-barcode"></span>
                </span>
                <input type="text" class="form-control" id="brand" disabled>
            </div>
        </div>

        <div class="form-group" id="form-model">
            <label>ชื่ออุปกรณ์</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-barcode"></span>
                </span>
                <input type="text" class="form-control" id="model" disabled>
            </div>
        </div>

        <div class="form-group" id="form-type">
            <label>ประเภทการใช้งาน</label>
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
            <label>เสียโดยชิ้นเชิง</label>
            <div class="input-group">
                <input type="checkbox" id="broken">
            </div>
        </div>

    </div>

    <div class="btn-group btn-outline">
        <button type="button" class="btn btn-warning" id="clear-button"><span class="glyphicon glyphicon-remove-circle"></span> ล้างฟอร์ม</button>
    </div>

    <div class="btn-group btn-outline">
        <button type="button" class="btn btn-success" id="submit-button"><span class="glyphicon glyphicon-save"></span> รับคืน</button>
    </div>

</div>

<div class="modal fade" id="add-number-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                เพิ่มเลขที่หนังสือรับ
            </div>
            <div class="modal-body">
                <div class="form-group" id="form-number-add">
                    <label>เลขที่หนังสือรับ *</label>
                    <span id="error-number" style="color: red"></span>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-tag"></span>
                        </span>
                        <input type="text" class="form-control" id="number-add">
                    </div>
                </div>

                <div class="form-group" id="form-date">
                    <label>วันที่รับ</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        <input type="text"class="form-control" id="date">
                    </div>
                    <div class="filthypillow" id="calendar"></div>
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
            "function": "get_retrieve_number"
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

$("#date").on("focus", function() {
    $("#calendar").filthypillow("show");
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
                    "function": "add_number_retrive",
                    "number": $("#number-add").val(),
                    "date": $("#date").val(),
                    "note_number": $("#note-number").val()
                }
            }).done(function(results) {
                // console.log(results);
                location.reload();
            });
        }
    }
});

function validateNumber() {
    if ($("#number-add").val() == "") {
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
            "function": "check_has_number_retrieve",
            "number": $("#number-add").val()
        }
    }).done(function(results) {
        if (results[0].count > 0) {
            $("#form-number-add").addClass("has-error");
            $("#error-number").text("เลขที่หนังสือรับซ้ำ");
            return false;
        }
        else {
            $("#form-number-add").removeClass("has-error");
            $("#error-number").text("");
            return true;
        }
    });
}



$("#sn").on("blur change", checkSnAvailableForRetrieve);
$("#sn").on('keyup', function() {
    $("#form-sn").removeClass("has-error");
    if (event.which === 13) {
        checkSnAvailableForRetrieve();
    }
});

$("#submit-button").click(function() {
    if (validate()) {
        if (!checkSnAvailableForRetrieve()) {
            $.ajax({
                url: 'db.php',
                type: "POST",
                data: {
                    "function": "retrieve",
                    "number": $("#number text").text(),
                    "sn": $("#sn").val(),
                    "note": $("#note").val(),
                    "broken": $("#broken").is(":checked")
                }
            }).done(function(results) {
                location.reload();
            });
        }
    }
});

function validate() {
    if ($("#number text").text() == "เลือกเลขที่หนังสือรับ") {
        $("#form-number").addClass("has-error");
    }
    if ($("#sn").val() == "") {
        $("#form-sn").addClass("has-error");
    }
    return !$("#form-sn").hasClass("has-error") && !$("#form-number").hasClass("has-error");
}

function checkSnAvailableForRetrieve() {
    $.ajax({
        url: 'db.php',
        type: "POST",
        dataType: "json",
        data: {
            "function": "check_sn_available_for_retrieve",
            "sn": $("#sn").val()
        }
    }).done(function(results) {
        console.log(results);
        if (results.length == 0) {
            $("#form-sn").addClass("has-error");
            $("#error-sn").text("S/N ไม่พร้อมรับคืน หรือไม่มีอยู่ในระบบ");

            $("#brand").val("");
            $("#model").val("");
            $("#type").val("");
            return false;
        }
        else {
            $("#form-sn").removeClass("has-error");
            $("#error-sn").text("");

            $("#brand").val(results[0].brand);
            $("#model").val(results[0].model);
            $("#type").val(results[0].type);
            return true;
        }
    });
}

</script>
