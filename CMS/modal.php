<?php 
	$id = $_POST['id'];


?>
<html>
	<head> 
		<title> Teste Modal </title>
	</head>
	
	<script>
$(document).ready(function() {

  $(".fechar").click(function() {
    //$(".modalContainer").fadeOut();
	$(".modalContainer").slideToggle(1000);
  });
});
	
	</script>
	
<body>

	<div>
		<a href="#" class="fechar">Fechar(x)</a>
	</div>
	<div>

	</div>

</body>
</html>