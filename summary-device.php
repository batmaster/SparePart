<h2 class="sub-header">ยอดในคลัง</h2>
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

<h2 class="sub-header">ยอดส่งซ่อม</h2>
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

<h2 class="sub-header">ยอดส่งโอน</h2>
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
            <tbody id="table-body-model-transfer">

            </tbody>
        </table>
    </div>
</div>

<h2 class="sub-header">ยอดเสียโดยสิ้นเชิง</h2>
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
            <tbody id="table-body-model-broken">

            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function() {
    $.ajax({
        url: 'db.php',
        type: "POST",
        dataType: "json",
        data: {
            "function": "get_instock_summary"
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
        dataType: "json",
        data: {
            "function": "get_claiming_summary"
        }
    }).done(function(results) {
        $("#table-body-model-claiming").empty();
        if (results.length == 0) {
            $("#table-body-model-claiming").append("<tr><th></th><td>ไม่พบ!</td><td></td><td></td></tr>");
        }
        else {
            for (var i = 0; i < results.length; i++) {
                $("#table-body-model-claiming").append("<tr><th>" + (i+1) + "</th><td>" + results[i].brand + "</td><td>" + results[i].model + "</td><td>" + results[i].amount + "</td></tr>");
            }
        }
    });

    $.ajax({
        url: 'db.php',
        type: "POST",
        dataType: "json",
        data: {
            "function": "get_transfer_summary"
        }
    }).done(function(results) {
        $("#table-body-model-transfer").empty();
        if (results.length == 0) {
            $("#table-body-model-transfer").append("<tr><th></th><td>ไม่พบ!</td><td></td><td></td></tr>");
        }
        else {
            for (var i = 0; i < results.length; i++) {
                $("#table-body-model-transfer").append("<tr><th>" + (i+1) + "</th><td>" + results[i].brand + "</td><td>" + results[i].model + "</td><td>" + results[i].amount + "</td></tr>");
            }
        }
    });

    $.ajax({
        url: 'db.php',
        type: "POST",
        dataType: "json",
        data: {
            "function": "get_broken_summary"
        }
    }).done(function(results) {
        $("#table-body-model-broken").empty();
        if (results.length == 0) {
            $("#table-body-model-broken").append("<tr><th></th><td>ไม่พบ!</td><td></td><td></td></tr>");
        }
        else {
            for (var i = 0; i < results.length; i++) {
                $("#table-body-model-broken").append("<tr><th>" + (i+1) + "</th><td>" + results[i].brand + "</td><td>" + results[i].model + "</td><td>" + results[i].amount + "</td></tr>");
            }
        }
    });
});


</script>
