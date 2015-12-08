<h2 class="sub-header">รายการ</h2>
<div class="row">
    <p>เลขที่หนังสือ: <?php echo $_GET["number"]; ?></p>
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
</div>

<script type="text/javascript">

$(document).ready(function() {
    $.ajax({
        url: 'db.php',
        type: "POST",
        dataType: 'json',
        data: {
            "function": "number_summary",
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
