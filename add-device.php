<h1 class="page-header">Add Device</h1>
<h2 class="sub-header">Section title</h2>
<div class="row">

    ยี่ห้อ *
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="brand" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <text>Dropdown</text>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="brand-dropdown" >
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
        <input type="text" class="form-control" placeholder="Model" id="model" aria-describedby="basic-addon1">
    </div>

    S/N
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">@</span>
        <input type="text" class="form-control" placeholder="Serial Number" id="sn" aria-describedby="basic-addon1">
    </div>

    Type *
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="type" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <text>Dropdown</text>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="type-dropdown">
            <li><a href="#">เลขหมาย</a></li>
            <li><a href="#">CPU</a></li>
            <li><a href="#">POWER</a></li>
            <li><a href="#">TSW</a></li>
            <li><a href="#">EMRP</a></li>
            <li><a href="#">SLCT</a></li>
            <li><a href="#">RP</a></li>
            <li><a href="#">DCI</a></li>
            <li><a href="#">CONTROL</a></li>
            <li><a href="#">ADSL</a></li>
        </ul>
    </div>

    วันที่นำเข้า
    <div class="input-group">
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
        </span>

        <input type="text" class="form-control" placeholder="Username" id="date" aria-describedby="basic-addon1">
    </div>


    เลขที่สินทรัพย์
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">@</span>
        <input type="text" class="form-control" placeholder="Username" id="number" aria-describedby="basic-addon1">
    </div>

    รหัสพัสดุ
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">@</span>
        <input type="text" class="form-control" placeholder="Username" id="code" aria-describedby="basic-addon1">
    </div>

    <div class="filthypillow"></div>
    <script type="text/javascript">
        var $fp = $(".filthypillow");
        var now = moment().subtract("seconds", 1);

        $fp.filthypillow({ minDateTime: function() {
                return now;
        }});

        $fp.on("focus", function() {
            $fp.filthypillow("show");
        });

        $fp.on("fp:save", function(e, dateObj) {
            $fp.val(dateObj.format("MMM DD YYYY hh:mm A"));
            $fp.filthypillow("hide");
        });
    </script>



    <!-- ปุ่ม -->
    <div class="btn-group">
        <button type="button" class="btn btn-danger" ID="clear-button">Clear</button>
    </div>

    <div class="btn-group">
        <button type="button" class="btn btn-success" id="submit-button">Submit</button>
    </div>


</div>
<script type="text/javascript">
$("#submit-button").click(function() {
    //        alert( $("#brand text").text()  +$("#model").val() + $("#sn").val() + $("#type text").text());
    // ส่งข้อมูลไป php
    $.ajax({
        url: 'db.php',
        type: "POST",
        //            contentType: "application/json",
        //            dataType: "json",
        data: {
            "function": "add",
            "brand": $("#brand text").text(),
            "model": $("#model").val(),
            "sn": $("#sn").val(),
            "type": $("#type text").text(),
            "date": $("#date").val(),
            "number": $("#number").val(),
            "code": $("#code").val(),
        }
    }).done(function(result) {
        alert("น่าจะ ok");      //ยืนยันการบันทึก
        console.log(result);
        //            console.log(result[0].id);
        //            if (result[0].id > 0)
        //                alert("OK");
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


</script>
