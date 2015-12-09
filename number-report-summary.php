<h2 class="sub-header">รายการ</h2>
<div class="row">
    <p>เลขที่หนังสือ: <?php echo $_GET["number"]; ?></p>
    <p id="date">วันที่: </p>
    <p id="from-location">ส่งจาก: </p>
    <p id="to-location">ส่งไปยัง: </p>
    <p id="note">หมายเหตุ: </p>
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
            <tbody id="table-body">

            </tbody>
        </table>
    </div>
    <div class="btn-group btn-outline">
        <button type="button" class="btn btn-info" onclick="location.href='<?php echo "?page=number-report-detail&number=" .$_GET["number"]; ?>'"><span class="glyphicon glyphicon-search"></span> แสดงรายละเอียด</button>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function() {
    $.ajax({
        url: 'db.php',
        type: "POST",
        dataType: 'json',
        data: {
            "function": "get_number_description",
            "number": "<?php echo $_GET["number"] ?>"
        }
    }).done(function(results) {
        $("#date").text("วันที่: " + results[0].date);
        if (results[0].type == 0) {
            $("#from-location").text("ส่งจาก: " + results[0].from_location);
            $("#to-location").text("ส่งไปยัง: " + results[0].to_location);
        }
        else {
            $("#from-location").remove();
            $("#to-location").remove();
        }
    });

    $.ajax({
        url: 'db.php',
        type: "POST",
        dataType: 'json',
        data: {
            "function": "get_number_summary",
            "number": "<?php echo $_GET["number"] ?>"
        }
    }).done(function(results) {
        $("#table-body").empty();

        if (results.length == 0) {
            $("#table-body").append("<tr><th></th><td>ไม่พบ!</td><td></td><td></td></tr>");
        }

        for (var i = 0; i < results.length; i++) {
            $("#table-body").append("<tr><th>" + (i+1) + "</th><td>" + results[i].brand + "</td><td>" + results[i].model + "</td><td>" + results[i].amount + "</td></tr>");
        }
    });
});

</script>
