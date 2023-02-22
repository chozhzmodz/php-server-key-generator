<?php 
include 'DB.php';

     $conn->query("UPDATE tokens SET UID=NULL");   
?>
<script type="text/javascript">
	alert("RESETADO");
	window.location.href='painel2.php';
</script>