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
                </tr>
            </thead>
            <tbody id="table-body-number">

            </tbody>
        </table>
    </div>

</div>


<script type="text/javascript">

    $(document).ready(function() {
        $("#date-start").val(moment().format("YYYY-MM-DD"));
        $("#date-end").val(moment().format("YYYY-MM-DD"));

    });

    $("#number").keyup(function() {
        $.ajax({
            url: 'db.php',
            type: "POST",
            dataType: "json",
            data: {
                "function": "get_available_number_retrieve",
                "number_part": $("#number").val()
            },
            beforeSend: function(){
                $("#number-loading").show();
            },
            success: function(results) {
                console
                $("#number").autocomplete({
                    source: results
                });
            },
            complete: function() {
                $("#number-loading").hide();
            }
        });
    });

    $("#number").keyup(function() {
        $.ajax({
            url: 'db.php',
            type: "POST",
            dataType: "json",
            data: {
                "function": "get_recommend_retrieve_number",
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

    // $("#number").on("blur change", checknumberFunction);
    $("#number").on('keypress', function() {
         if (event.which === 13) {
             search();
         }
    });

    $("#clear-button").click(function() {
        $("#number").val("");
        $("#date-start").val("");
        $("#date-end").val("");
    });

    $("#search-button").click(function() {
        $("#form-number, #form-brand, #form-model").removeClass("has-success");
        $("#form-number, #form-date, #form-number").removeClass("has-error");

        if ($("#brand").val() == "" || $("#model").val() == "") {
            $("#form-number").addClass("has-error");
        }
        if ($("#date").val() == "") {
            $("#form-date").addClass("has-error");
        }
        if ($("#number").val() == "") {
            $("#form-number").addClass("has-error");
        }
        if (!($("#brand").val() == "") && !($("#model").val() == "") && !($("#date").val() == "") && !($("#number").val() == "")) {
            $.ajax({
                url: 'db.php',
                type: "POST",
                data: {
                    "function": "retrieve",
                    "number": $("#number").val(),
                    "brand": $("#brand").val(),
                    "model": $("#model").val(),
                    "date": $("#date").val(),
                    "number": $("#number").val(),
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
