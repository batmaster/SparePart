<h1 class="page-header">User</h1>
<h2 class="sub-header">Section title</h2>
<div class="row">
 Username
    <div class="input-group">
       
  <span class="input-group-addon" id="basic-addon1">@</span>
   <input type="text" class="form-control" placeholder="Username" id="username" aria-describedby="basic-addon1">
</div>
    Password
    <div class="input-group">
       
  <span class="input-group-addon" id="basic-addon1">@</span>
   <input type="text" class="form-control" placeholder="Username" id="password" aria-describedby="basic-addon1">
</div>
   Name*
    <div class="input-group">
       
  <span class="input-group-addon" id="basic-addon1">@</span>
   <input type="text" class="form-control" placeholder="Username" id="name" aria-describedby="basic-addon1">
</div>
  Surename*
    <div class="input-group">
       
  <span class="input-group-addon" id="basic-addon1">@</span>
   <input type="text" class="form-control" placeholder="Username" id="surename" aria-describedby="basic-addon1">
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
                "function": "user",
                "username": $("username").val(),
				"password": $("#password ").val(),
				"name": $("#name").val(),
                "surename": $("#surename ").val(),
               
        
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
