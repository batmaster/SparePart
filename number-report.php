<h1 class="page-header">รายงานผล</h1>
<h2 class="sub-header">เลขที่หนังสือรับส่งอุปกรณ์</h2>
<div class="row">
    <div class="col-xs-6">
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

    <div class="col-xs-6">
        <div class="form-group" id="form-date-start">
            <label>ช่วงวันที่</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <input type="text" class="form-control" id="date-start">
            </div>
        </div>

        <div class="form-group" id="form-date-end">
            <label>ถึงวันที่</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <input type="text" class="form-control" id="date-end">
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

<div class="modal fade" id="number-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New message</h4>
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


<script type="text/javascript">

$(document).ready(function() {
    $("#search-button").click();
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
            "date_to": $("#date-to").val()
        }
    }).done(function(results) {
        console.log(results);
        $("#table-body").empty();
        for (var i = 0; i < results.length; i++) {
            $("#table-body-number").append("<tr><th>" + (i+1) + "</th><td><a href=\"?page=number-report-summary&number=" + results[i].number + "\">" + results[i].number + "</a></td><td>" + (results[i].type == 0 ? "ส่งซ่อม" : (results[i].type == 1 ? "รับคืน" : "ส่งโอน")) + "</td><td>" + results[i].amount + "</td><td>" + results[i].date + "</td><td>" + results[i].note + "</td></tr>");
        }
    });
});




</script>
