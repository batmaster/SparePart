<h1 class="page-header">Summary</h1>
<h2 class="sub-header">Section title</h2>
<div class="row">
    <div class="col-xs-6">
        <div class="form-group" id="form-brand">
            <label>ยี่ห้อ</label>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="brand" data-toggle="dropdown" style="width: 100%">
                    <text>All</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="brand-dropdown" style="width: 100%">
                    <li><a href="#">All</a></li>
                </ul>
            </div>
        </div>

        <div class="form-group" id="form-brand">
            <label>ชื่ออุปกรณ์</label>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="model" data-toggle="dropdown" style="width: 100%">
                    <text>All</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="model-dropdown" style="width: 100%">
                    <li><a href="#">All</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xs-6">
        <div class="form-group" id="form-brand">
            <label>ประเภทการใช้งาน</label>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="type" data-toggle="dropdown" style="width: 100%">
                    <text>All</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="type-dropdown" style="width: 100%">
                    <li><a href="#">All</a></li>
                </ul>
            </div>
        </div>

        <div class="form-group" id="form-brand">
            <label>สถานะ</label>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="status" data-toggle="dropdown" style="width: 100%">
                    <text>All</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="status-dropdown" style="width: 100%">
                    <li><a href="#">All</a></li>
                    <li><a href="#">In stock</a></li>
                    <li><a href="#">Claiming</a></li>
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
        <!-- Default panel contents -->

        <!-- สร้างตารางรายงาน -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ยี่ห้อ</th>
                    <th>ชื่ออุปกรณ์</th>
                    <th>S/N</th>
                    <th>ประเภทการใช้งาน</th>
                    <th>สถานะ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="table-body">
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">New message</h4>
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

    <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

<script type="text/javascript">
    $(document).ready(function() {
        getBrands();
        // getModels();

        $("#search-button").click();
    });

    $("#search-button").click(function() {
        $.ajax({
            url: 'db.php',
            type: "POST",
            dataType: 'json',
            data: {
                "function": "search",
                "brand": $("#brand text").text(),
                "model": $("#model text").text(),
                "type": $("#type text").text(),
                "status": $("#status text").text()
            }
        }).done(function(results) {
            $.ajax({
                url: 'db.php',
                type: "POST",
                dataType: 'json',
                data: {
                    "function": "search_rows"
                }
            }).done(function(results) {
                // console.log(results);
            });

            $("#table-body").empty();
            for (var i = 0; i < results.length; i++) {
                $("#table-body").append("<tr><th>" + (i+1) + "</th><td>" + results[i].brand + "</td><td>" + results[i].model + "</td><td><a href=\"#\" data-toggle=\"modal\" data-target=\"#detail-modal\" data-sn=\"" + results[i].sn + "\">" + results[i].sn + "</a></td><td>" + results[i].type + "</td><td>" +
                results[i].status + "</td><td>" + "<div class=\"btn-group\"><a class=\"btn btn-default" + (results[i].status == "Claiming" ? " a-disabled" : "") + "\" href=\"?page=claim-device&amp;sn=" + results[i].sn + "\"><span class=\"glyphicon glyphicon-open\"></span></a>" +
                "<a class=\"btn btn-default" + (results[i].status == "In stock" ? " a-disabled" : "") +"\" href=\"?page=retrieve-device&amp;sn=" + results[i].sn + "\"><span class=\"glyphicon glyphicon-save\"></span></a></div></td></tr>");
            }

        });
    });

    function getBrands() {
        $.ajax({
            url: 'db.php',
            type: "POST",
            dataType: "json",
            data: {
                "function": "get_search_brands"
            },
            beforeSend: function(){
                // $("#sn-loading").show();
            },
            success: function(results) {
                $("#brand-dropdown").empty();
                $("#brand-dropdown").append("<li><a href=\"#\">All</a></li>");
                for (var i = 0; i < results.length; i++) {
                    $("#brand-dropdown").append("<li><a href=\"#\">" + results[i].brand + "</a></li>");
                }

                $("#brand-dropdown li").click(function() {
                    $("#brand text").text($(this).text());

                    $("#model text").text("All");
                    $("#type text").text("All");
                    getModels();
                    getTypes();
                });
            },
            complete: function() {
                // $("#sn-loading").hide();
            }
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
            },
            beforeSend: function(){
                // $("#sn-loading").show();
            },
            success: function(results) {
                $("#model-dropdown").empty();
                $("#model-dropdown").append("<li><a href=\"#\">All</a></li>");
                for (var i = 0; i < results.length; i++) {
                    $("#model-dropdown").append("<li><a href=\"#\">" + results[i].model + "</a></li>");
                }
                $("#model-dropdown li").click(function() {
                    $("#model text").text($(this).text());

                    $("#type text").text("All");
                    getTypes();
                });
            },
            complete: function() {
                // $("#sn-loading").hide();
            }
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
            },
            beforeSend: function(){
                // $("#sn-loading").show();
            },
            success: function(results) {
                $("#type-dropdown").empty();
                $("#type-dropdown").append("<li><a href=\"#\">All</a></li>");
                for (var i = 0; i < results.length; i++) {
                    $("#type-dropdown").append("<li><a href=\"#\">" + results[i].type + "</a></li>");
                }
                $("#type-dropdown li").click(function() {
                    $("#type text").text($(this).text());

                    getTypes();
                    $("#type text").text("All");
                });
            },
            complete: function() {
                // $("#sn-loading").hide();
            }
        });
    }



    $("#model-dropdown li").click(function() {
        $("#model text").text($(this).text());
    });

    $("#type-dropdown li").click(function() {
        $("#type text").text($(this).text());
    });

    $("#status-dropdown li").click(function() {
        $("#status text").text($(this).text());
    });

    $("#detail-modal").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var sn = button.data('sn');

        var modal = $(this);
        modal.find('.modal-title').text('S/N ' + sn);

        $.ajax({
            url: 'db.php',
            type: "POST",
            dataType: 'json',
            data: {
                "function": "get_description",
                "sn": sn
            }
        }).done(function(result) {
            modal.find('.modal-body #brand').text("Brand: " + result.brand);
            modal.find('.modal-body #model').text("Model: " + result.model);
            modal.find('.modal-body #sn').text("S/N: " + result.sn);
            modal.find('.modal-body #type').text("Type: " + result.type);
            modal.find('.modal-body #date-added').text("Date added: " + result.date);

            modal.find("#ahref").data("sn", sn);

        });

        $.ajax({
            url: 'db.php',
            type: "POST",
            dataType: 'json',
            data: {
                "function": "get_transactions_for_sn",
                "sn": sn
            }
        }).done(function(results) {
            $("#table-body-modal").empty();
            for (var i = 0; i < results.length; i++) {
                $("#table-body-modal").append("<tr " + (results[i].type == 0 ? "class=\"info\"" : (results[i].type == 1 ? "class=\"success\"" : "class=\"danger\"")) + "><td>" + results[i].date + "</td><td>" + results[i].number + "</td><td>" +
                (results[i].location == null ? "" : results[i].location) + "</td><td>" + (results[i].type == 0 ? "ส่งเคลม" : (results[i].type == 1 ? "รับเข้า" : "แจ้งเสีย")) + "</td><td>" + results[i].note + "</td>" +
                "<td><a href=\"#\" data-toggle=\"modal\" data-target=\"#edit-claim-transaction-modal\" data-sn=\"op441\">ไม่อยากให้แก้ได้เลย -_-</a>" + "</td></tr>");
            }
        });
    });

    $("#confirm-modal").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var sn = button.data('sn');

        var modal = $(this);
        modal.find('.modal-header').text("ยืนยันการแจ้งเสียโดยสิ้นเชิง");
        modal.find('.modal-body').text("บอร์ด S/N " + sn + " จะไม่สามารถกลับมาใช้งานได้อีก");

        modal.find('.btn-ok').click(function() {
            $.ajax({
                url: 'db.php',
                type: "POST",
                // dataType: 'json',
                data: {
                    "function": "broken",
                    "sn": sn
                }
            }).done(function(result) {
                // console.log(result);
                 location.reload();
            });
        });
    });


</script>
