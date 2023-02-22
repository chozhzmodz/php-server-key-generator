<?php
// Sessão
session_start();
// Verificação
if(!isset($_SESSION['logado'])):
	header('Location: verification.php');
endif;
?>
<html lang="pt-br" >
 
<head>
<meta charset="UTF-8">
<title>IDRAGON YT</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/index.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300'>
<style>
    body {
    background: url("wallpaper.jpg");
	display: table;
    width: 100%;
  height: 100vh;
  padding: 100px 0;
  
  

  background-position: 30% 45%;
  background-size: cover;
	}
	
	h2 {
	    color: red;
	}
	p {
	    color: red;
	    font-size: 20px;
	}
	
	td {
	    background-color: white;
	}
	
	.sair {
	    text-align: center;
	    padding: 10px;
	}
	.search {
		text-align: right;
	    margin-right: 20px;
	    padding: 10px;
	    display: inline-block;
	}
	.number {
		text-align: right;
	    margin-right: 20px;
	    padding: 10px;
	    display: inline-block;
	}
	.count {
		text-align: right;
	    margin-right: 20px;
	    padding: 10px;
	    display: inline-block;
	}
	.reset {
		text-align: right;
	    margin-right: 20px;
	    padding: 10px;
	    display: inline-block;
	}
	
	a {
	    font-size: 40px;
	    color: red;
	}
	h8 {
		color: green;
		font-size: 18px;
	}
    .container {
        width: 100%;
    }
    input[type=number] {
display:  inline-block;
padding: 1px;
    }
    
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
</head>
<body>
  <div id="registration-form">
	<div class='fieldset'>
    <legend>IDRAGON YT</legend>
		<form action="" method="post" data-validate="parsley">
			<div class='row'>
			<!--	<label for='firstname'>Username</label> -->
				<input type="text" placeholder="Key" name='firstname' id='firstname' data-required="true" data-error-message="Key is required" required>
			</div>
			<div class='row'>
			<!--	<label for="email">Expiration Time</label> -->
				<input type="datetime-local" name='email' data-required="true" data-error-message="Year - Month - Day" required>
			</div>
			<input type="submit" value="Register" name="register">
		</form>
	</div>
</div>
<div class='sair'>
 <a href="logout.php"> <button type='button' class='btn btn-danger'>Logout</button></a>
    
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/parsley.js/1.2.2/parsley.min.js'></script>
 
<?php   // this code is use to insert the form details and register and expiration date
include 'DB.php';
include 'Global.php';

$date_1_hora = date('Y-m-d H:i', strtotime('-4 Hours'));
//echo $date_1_hora;
if(isset($_POST['register'])){
$Username = $_POST['firstname'];
$Expiration = $_POST['email'];
$date      = $date_1_hora;//date("Y/m/d/h/m");
$true      = 2;
$fetch = "INSERT INTO `tokens`(`Username`, `Password`, `StartDate`, `EndDate`, `UID`, `Expiry`) VALUES ('$Username','$Username','$date','$Expiration', NULL, '$true')";
$fire = mysqli_query($conn,$fetch);
}
?>
<div class="container">
  <div class="search">
 <form method="GET" action="search.php">
<input type="text" placeholder="Enter User:" name="search"/>
<input type="submit" value="Search">
 </form>
 </div>
 <div class="number">
 <form method="GET" action="number.php">
<input type="number" placeholder="Number of Users" name="number"/>
<input type="submit" value="Number" data-required="true">
 </form>
</div>  
<div class="reset">
 <button type='button' id="reset" name="reset" class='btn btn-warning'>Server Reset</button>
 <script type="text/javascript">

  window.onload = function() {
    // var sound = new Audio('../Click.mp3');      // descomente esta linha quando criado apenas no script
    var mapa = document.getElementById("reset");
    mapa.onclick = function() {
        alert("Certeza?");
window.location.href = "reset.php";

      }
    }
  
</script>
 </div>    
 <div class="count">
<h8>Number of Users: <?php 
$sql12 = "SELECT COUNT(*) FROM tokens";
    $resulto = mysqli_query($conn,$sql12);
    $rows1 = mysqli_fetch_row($resulto);
    echo $rows1[0];
?>
</h8>
 </div>
  <div class="reset">
 <a href="order.php"><button type='button' id="order" name="order" class='btn btn-warning'>Order Alphabetically</button></a>
 </div>


  <table class="table table-hover">
    <thead>
      <tr class="info">
        <th>Key</th>
        <th>UID</th>
		<th>Registeration Date</th>
        <th>Validity</th>
		<th>Status</th>
        <th>Delete</th>
        <th>Reset</th>
        <th>Add Days</th>
        <th>Days</th>
        <th>Time</th>
      </tr>
    </thead>
    <tbody>
<?php
$fetchqry = "SELECT * FROM `tokens`";
$result=mysqli_query($conn,$fetchqry);
$num=mysqli_num_rows($result);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
	   <tr>
        <td><?php echo $row['Username'];?></td>
		<td><?php if ($row['UID'] == NULL) {
    echo "0/1";
 } else {
    echo "1/1";
} 
				?></td>
        <td><?php echo $date1 = $row['StartDate'];?></td>
		<td><?php echo $date2 = $row['EndDate'];?></td>
		<td><?php if(strtotime(date("Y/m/d")) < strtotime($date2)) echo "Online"; else { echo "Offline";} ?></td>
		<?php
      {
         echo "<td> <a href='mrz.php?no=".$row['Username']."'><button type='button' class='btn btn-danger'>Delete</button></a> </td>";
      }

      ?>
      <?php
      {
         echo "<td> <a href='mrz2.php?no=".$row['Username']."'><button type='button' class='btn btn-danger'>Reset</button></a> </td>";
      }


      ?>
 <?php
 
    echo "<td> <a href='adddias.php'><button type='submit' name='adicionardias' class='btn btn-danger'>Add Days</button></a> </td>";
    

		?>
        <?php 
$database = date_create($date2);
$datadehoje = date_create();
$resultado = date_diff($database, $datadehoje);
echo "<td>";
echo date_interval_format($resultado, '%a');
echo "</td>";
        ?>
        <?php 
$database = date_create($date1);
$datadehoje = date_create();
$resultado = date_diff($database, $datadehoje);
echo "<td>";
$time = date_interval_format($resultado, '%a');
$time2 = date_interval_format($resultado, '%h');
$a = 4;
$time22 = $time2 - $a;
$time3 = date_interval_format($resultado, '%i');
echo "Added: $time Days $time22 Hours $time3 Minutes Ago!";
echo "</td>";
        ?>
       
        <?php
    
  if(isset($_POST['adicionardiass'])){
$dias = $_POST['dias'];
$mod_date = strtotime($date2."+ 1 days");
$adicionardias = date("Y/m/d h:m",$mod_date);
$nome = $row['Username'];
echo $nome;

//$adicionardias = date('Y/m/d h:m', strtotime('+$dias days', strtotime($date2)));;
  }
  ?>

      </tr>

      
      <?php } ?>
    </tbody>
  </table>

</div>
<script>
function myFunction($lol) {
<?php
$delete = "SELECT * FROM `tokens`";
?>
    
}
</script>
</body>
</html>
