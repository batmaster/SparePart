<h1 class="page-header">Retrieve Devices</h1>
<h2 class="sub-header">Section title</h2>
<div class="row">

     S/N
    <div class="input-group">
  <span class="input-group-addon" id="basic-addon1">@</span>
  <input type="text" class="form-control" placeholder="Username" id="sn" aria-describedby="basic-addon1">
</div>

     ยี่ห้อ
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

ชื่ออุปกรณ์
<div class="input-group">
  <span class="input-group-addon" id="basic-addon1">@</span>
  <input type="text" class="form-control" placeholder="Username" id="model" aria-describedby="basic-addon1">
</div>

    วันที่รับคืน
<div class="input-group">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
    </span>

  <input type="text" class="form-control" placeholder="Username" id="date" aria-describedby="basic-addon1">
</div>

เลขที่หนังสือรับ
<div class="input-group">
  <span class="input-group-addon" id="basic-addon1">@</span>
  <input type="text" class="form-control" placeholder="Username" id="number" aria-describedby="basic-addon1">
</div>


      <div class="btn-group">
  <button type="button" class="btn btn-danger" ID="clear-button">Clear</button>
</div>

    <div class="btn-group">
  <button type="button" class="btn btn-success" id="submit-button">Submit</button>
</div>

    </div>
<script type="text/javascript">
    $("#submit-button").click(function() {
        $.ajax({
			url: 'db.php',
			type: "POST",
//            contentType: "application/json",
//            dataType: "json",
			data: {
                "function": "retrieve",
                "sn": $("#sn").val(),
				"brand": $("#brand text").text(),
				"model": $("#model").val(),
                "date": $("#date ").val(),
                "number": $("#number ").val(),

            }
		}).done(function(result) {
            console.log(result);
            alert("น่าจะ ok");                  //ยืนยันการบันทึก
        });



    });

    $("#brand-dropdown li").click(function() {
		$("#brand text").text($(this).text());
	});


</script>




</div>
