 <!DOCTYPE html>
 <html>
 <head>
 	<title>Test Page</title>
 </head>
 <body>

 	<input type="text" id="test" name="uname" value="test_value">
 	
 	<script type="text/javascript" src="js/jquery.min.js"></script> 
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/utils.js"></script>
	<script type="text/javascript">
		var data={"x":"product","max_anoms":"riserva wine glass"};

		$.ajax({
		   type: "POST",
		   url: "test1.php",
		   async: false,
		   data: {jsondata: JSON.stringify(data)},
		   success: function(data){
		      console.log(data);
		      return true;
		   },
		   complete: function() {},
		   error: function(xhr, textStatus, errorThrown) {
		     console.log('ajax loading error...');
		     return false;
		   }
		});

	</script>
 </body>
 </html>