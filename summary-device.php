<h1 class="page-header">ยอดในคลัง</h1>
<h2 class="sub-header">แบ่งตามรุ่นบอร์ด</h2>
<div class="row">
    <div class="panel panel-default">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody id="table-body-model-instock">

            </tbody>
        </table>
    </div>
</div>

<h2 class="sub-header">แบ่งตามประเภทการใช้งาน</h2>
<div class="row">
    <div class="panel panel-default">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody id="table-body-type-instock">

            </tbody>
        </table>
    </div>
</div>

<h1 class="page-header">ยอดส่งเคลม</h1>
<h2 class="sub-header">แบ่งตามรุ่นบอร์ด</h2>
<div class="row">
    <div class="panel panel-default">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody id="table-body-model-claiming">

            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {
        $.ajax({
            url: 'db.php',
            type: "POST",
            dataType: 'json',
            data: {
                "function": "count_by_model"
            }
        }).done(function(results) {
            $("#table-body-model-instock").empty();
            if (results.length == 0) {
                $("#table-body-model-instock").append("<tr><th></th><td>Not found!</td><td></td><td></td></tr>");
            }
            else {
                for (var i = 0; i < results.length; i++) {
                    $("#table-body-model-instock").append("<tr><th>" + (i+1) + "</th><td>" + results[i].brand + "</td><td>" + results[i].model + "</td><td>" + results[i].amount + "</td></tr>");
                }
            }
        });

        $.ajax({
            url: 'db.php',
            type: "POST",
            dataType: 'json',
            data: {
                "function": "count_by_type"
            }
        }).done(function(results) {
            $("#table-body-type").empty();
            if (results.length == 0) {
                $("#table-body-type-instock").append("<tr><th></th><td>Not found!</td><td></td></tr>");
            }
            else {
                for (var i = 0; i < results.length; i++) {
                    $("#table-body-type-instock").append("<tr><th>" + (i+1) + "</th><td>" + results[i].type + "</td><td>" + results[i].amount + "</td></tr>");
                }
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
