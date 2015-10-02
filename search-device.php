<h1 class="page-header">Summary</h1>
<h2 class="sub-header">Section title</h2>
<div class="row">

    ยี่ห้อ *
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="brand" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <text>All</text>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="brand-dropdown" >
            <li><a href="#">All</a></li>
            <li><a href="#">OPNET</a></li>
            <li><a href="#">ERICSSON</a></li>
            <li><a href="#">HUAWEI</a></li>
            <li><a href="#">FORTH</a></li>
            <li><a href="#">ZTE</a></li>
            <li><a href="#">KEMINE</a></li>
            <li><a href="#">ZYXEL</a></li>
        </ul>
    </div>



    ชื่ออุปกรณ์*
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">@</span>
        <input type="text" class="form-control" placeholder="Username" id="model" aria-describedby="basic-addon1" value="All">
    </div>



    Type *
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="type" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <text>All</text>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="type-dropdown">
            <li><a href="#">All</a></li>
            <li><a href="#">เลขหมาย </a></li>
            <li><a href="#">CPU </a></li>
            <li><a href="#">POWER </a></li>
            <li><a href="#">TSW </a></li>
            <li><a href="#">EMRP </a></li>
            <li><a href="#">SLCT </a></li>
            <li><a href="#">RP </a></li>
            <li><a href="#">DCI </a></li>
            <li><a href="#">CONTROL </a></li>
            <li><a href="#">ADSL </a></li>
        </ul>
    </div>
    สถานะ
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="status" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <text>All</text>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="status-dropdown">
            <li><a href="#">All</a></li>
            <li><a href="#">In stock</a></li>
            <li><a href="#">Claiming</a></li>

        </ul>
    </div>
    <!-- ปุ่ม -->
    <div class="btn-group">
        <button type="button" class="btn btn-danger" ID="clear-button">Clear</button>
    </div>

    <div class="btn-group">
        <button type="button" class="btn btn-success" id="search-button">Search</button>
    </div>

    <div class="panel panel-default">
        <!-- Default panel contents -->

        <!-- สร้างตารางรายงาน -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>S/N</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="table-body">

            </tbody>
        </table>
    </div>

    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
                                <th>Date</th>
                                <th>Number</th>
                                <th>Location</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody id="table-body-modal">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>






</div>

<script type="text/javascript">
    $("#search-button").click(function() {
        //        alert( $("#brand text").text()  +$("#model").val() + $("#sn").val() + $("#type text").text());
        // ส่งข้อมูลไป php
        $.ajax({
            url: 'db.php',
            type: "POST",
            dataType: 'json',
            data: {
                "function": "search",
                "brand": $("#brand text").text(),
                "model": $("#model").val(),
                "type": $("#type text").text(),
                "status": $("#status text").text()
            }
        }).done(function(results) {
            // console.log(results);

            $("#table-body").empty();
            for (var i = 0; i < results.length; i++) {
                $("#table-body").append("<tr><th>" + (i+1) + "</th><td>" + results[i].brand + "</td><td>" + results[i].model + "</td><td><a href=\"#\" data-toggle=\"modal\" data-target=\"#detailModal\" data-sn=\"" + results[i].sn + "\">" + results[i].sn + "</a></td><td>" + results[i].type + "</td><td>" +
                results[i].status + "</td><td>" + "<div class=\"btn-group\"><a class=\"btn btn-default" + (results[i].status == "Claiming" ? " a-disabled" : "") + "\" href=\"?page=claim-device&amp;sn=" + results[i].sn + "\"><span class=\"glyphicon glyphicon-open\"></span></a>" +
                "<a class=\"btn btn-default" + (results[i].status == "In stock" ? " a-disabled" : "") +"\" href=\"?page=retrieve-device&amp;sn=" + results[i].sn + "\"><span class=\"glyphicon glyphicon-save\"></span></a></div></td></tr>");
            }

        });



    });

    $("#brand-dropdown li").click(function() {
        $("#brand text").text($(this).text());
    });

    $("#model-dropdown li").click(function() {
        $("#model text").text($(this).text());
    });

    $("#type-dropdown li").click(function() {
        $("#type text").text($(this).text());
    });

    $("#status-dropdown li").click(function() {
        $("#status text").text($(this).text());
    });

    $('#detailModal').on('show.bs.modal', function (event) {
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
        });

        $.ajax({
            url: 'db.php',
            type: "POST",
            dataType: 'json',
            data: {
                "function": "get_transactions",
                "sn": sn
            }
        }).done(function(results) {
            $("#table-body-modal").empty();
            for (var i = 0; i < results.length; i++) {
                $("#table-body-modal").append("<tr " + (results[i].type == 0 ? "class=\"info\"" : "class=\"success\"") + "><td>" + results[i].date + "</td><td>" + results[i].number + "</td><td>" + results[i].location + "</td><td>" + results[i].type + "</td></tr>");
            }
        });
    });


</script>
