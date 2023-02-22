<?php
include 'DB.php';
include 'Global.php';

if($maintenance == false){
     $conn->query("UPDATE tokens SET UID=NULL WHERE `Username` = '".$_GET['no']."'");   
}

?>

<script type="text/javascript">
	alert("RESETADO");
	window.location.href='painel2.php';
</script>