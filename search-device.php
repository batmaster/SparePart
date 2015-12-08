<h2 class="sub-header">ค้นหาอุปกรณ์</h2>
<div class="row">
    <div class="col-xs-6">
        <div class="form-group" id="form-brand">
            <label>ยี่ห้อ</label>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="brand" data-toggle="dropdown" style="width: 100%">
                    <text>ทั้งหมด</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="brand-dropdown" style="width: 100%">
                    <li><a href="#">ทั้งหมด</a></li>
                </ul>
            </div>
        </div>

        <div class="form-group" id="form-brand">
            <label>ชื่ออุปกรณ์</label>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="model" data-toggle="dropdown" style="width: 100%">
                    <text>ทั้งหมด</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="model-dropdown" style="width: 100%">
                    <li><a href="#">ทั้งหมด</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xs-6">
        <div class="form-group" id="form-brand">
            <label>ประเภทการใช้งาน</label>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="type" data-toggle="dropdown" style="width: 100%">
                    <text>ทั้งหมด</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="type-dropdown" style="width: 100%">
                    <li><a href="#">ทั้งหมด</a></li>
                </ul>
            </div>
        </div>

        <div class="form-group" id="form-brand">
            <label>สถานะ</label>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="status" data-toggle="dropdown" style="width: 100%">
                    <text>ในคลังและส่งซ่อม</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="status-dropdown" style="width: 100%">
                    <li><a href="#">ในคลังและส่งซ่อม</a></li>
                    <li><a href="#">ในคลัง</a></li>
                    <li><a href="#">ส่งซ่อม</a></li>
                    <li class="divider"></li>
                    <li><a href="#">ส่งโอน</a></li>
                    <li class="divider"></li>
                    <li><a href="#">เสียโดยสิ้นเชิง</a></li>
                </ul>
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
                    <th>ยี่ห้อ</th>
                    <th>ชื่ออุปกรณ์</th>
                    <th>S/N</th>
                    <th>ประเภทการใช้งาน</th>
                    <th>สถานะ</th>
                    <th>หมายเหตุ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="table-body">
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModทั้งหมดabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModทั้งหมดabel">New message</h4>
                </div>
                <div class="modal-body">
                    <label class="control-label" id="brand">Brand:</label>
                    <label class="control-label" id="model">Model:</label>
                    <label class="control-label" id="sn">S/N:</label>
                    <label class="control-label" id="type">Type:</label>
                    <label class="control-label" id="date-added">Date added:</label>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>วันที่</th>
                                <th>เลขที่หนังสือ</th>
                                <th>สถานที่ส่งเคลม</th>
                                <th>ประเภท</th>
                                <th>หมายเหตุ</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="table-body-modal">

                        </tbody>
                    </table>

                    <div class="btn-group btn-outline">
                        <button type="button" class="btn btn-info" id="edit-button"><span class="glyphicon glyphicon-pencil"></span> แก้ไขรายละเอียดบอร์ด</button>
                    </div>

                    <div class="btn-group btn-outline">
                        <a href="#" data-toggle="modal" data-target="#confirm-modal" id="ahref">
                            <button type="button" class="btn btn-danger" id="broken-button"><span class="glyphicon glyphicon-trash"></span> แจ้งเสียโดยชิ้นเชิง</button>
                        </a>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="myModทั้งหมดabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    ยืนยันการแจ้งเสียโดยสิ้นเชิง
                </div>
                <div class="modal-body">
                    หมายเลข  จะไม่สามารถนำกลับมาใช้ได้อีก
                    ยืนยัน?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                    <a class="btn btn-danger btn-ok">ยืนยัน</a>
                </div>
            </div>
        </div>
    </div>
</div>


<div value="ss" id="sd"></div>

<script type="text/javascript">

$(document).ready(function() {
    getBrands();
    $("#search-button").click();
});

function getBrands() {
    $.ajax({
        url: 'db.php',
        type: "POST",
        dataType: "json",
        data: {
            "function": "get_search_brands"
        }
    }).done(function(results) {
        $("#brand-dropdown").empty();
        $("#brand-dropdown").append("<li><a href=\"#\">ทั้งหมด</a></li>");

        for (var i = 0; i < results.length; i++) {
            $("#brand-dropdown").append("<li><a href=\"#\">" + results[i].brand + "</a></li>");
        }

        $("#brand-dropdown li").click(function() {
            $("#brand text").text($(this).text());
            $("#model text").text("ทั้งหมด");
            $("#type text").text("ทั้งหมด");

            getModels();
            getTypes();
        });
    });
}

function getModels() {
    $.ajax({
        url: 'db.php',
        type: "POST",
        dataType: "json",
        data: {
            "function": "get_search_models",
            "brand": $("#brand text").text()
        }
    }).done(function(results) {
        $("#model-dropdown").empty();
        $("#model-dropdown").append("<li><a href=\"#\">ทั้งหมด</a></li>");

        for (var i = 0; i < results.length; i++) {
            $("#model-dropdown").append("<li><a href=\"#\">" + results[i].model + "</a></li>");
        }

        $("#model-dropdown li").click(function() {
            $("#model text").text($(this).text());
            $("#type text").text("ทั้งหมด");

            getTypes();
        });
    });
}

function getTypes() {
    $.ajax({
        url: 'db.php',
        type: "POST",
        dataType: "json",
        data: {
            "function": "get_search_types",
            "brand": $("#brand text").text(),
            "model": $("#model text").text()
        }
    }).done(function(results) {
        $("#type-dropdown").empty();
        $("#type-dropdown").append("<li><a href=\"#\">ทั้งหมด</a></li>");

        for (var i = 0; i < results.length; i++) {
            $("#type-dropdown").append("<li><a href=\"#\">" + results[i].type + "</a></li>");
        }

        $("#type-dropdown li").click(function() {
            $("#type text").text($(this).text());
            getTypes();
        });
    });
}

$("#status-dropdown li").click(function() {
    $("#status text").text($(this).text());
});

$("#clear-button").click(function() {
    location.reload();
});

$("#search-button").click(function() {
    $.ajax({
        url: 'db.php',
        type: "POST",
        dataType: "json",
        data: {
            "function": "search",
            "brand": $("#brand text").text(),
            "model": $("#model text").text(),
            "type": $("#type text").text(),
            "status": $("#status text").text()
        }
    }).done(function(results) {
        console.log(results);
        // $("#table-body-modal").append("<tr><th>" + (i+1) + "</th><td>" + results[i].brand + "</td><td>" + results[i].model + "</td><td>" + results[i].amount + "</td></tr>");
    });
});


</script>
