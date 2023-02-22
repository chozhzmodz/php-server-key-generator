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
<title>Hyupai</title>
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
    border-bottom: 5px solid black;
  }
    .container {
        width: 100%;
    }
    input[type=number] {
display:  inline-block;
padding: 1px;
    }
    
</style>
<h2>Exibindo Ordem Alfabetica</h2>
  <table class="table table-hover">
    <thead>
      <tr class="info">
        <th>Usuario</th>
        <th>Senha</th>
        <th>Vendedor</th>
        <th>UID</th>
    <th>Data de Registro</th>
        <th>Validade</th>
    <th>Status</th>
        <th>Eliminar</th>
        <th>Resetar</th>
        <th>Adicionar dias</th>
        <th>Dias</th>
        <th>Time</th>
      </tr>
    </thead>
    <tbody>
<?php
include 'DB.php';
$fetchqry = "SELECT * FROM `tokens` ORDER BY Username ASC";
$result=mysqli_query($conn,$fetchqry);
$num=mysqli_num_rows($result);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
     <tr>
        <td><?php echo $row['Username'];?></td>
        <td><?php echo $row['Password'];?></td>
        <td><?php echo $row['Vendedor'];?></td>
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
         echo "<td> <a href='mrz.php?no=".$row['Username']."'><button type='button' class='btn btn-danger'>Eliminar</button></a> </td>";
      }

      ?>
      <?php
      {
         echo "<td> <a href='mrz2.php?no=".$row['Username']."'><button type='button' class='btn btn-danger'>Resetar</button></a> </td>";
      }


      ?>
 <?php
 
    echo "<td> <a href='adddias.php'><button type='submit' name='adicionardias' class='btn btn-danger'>Adicionar dias</button></a> </td>";
    

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
echo "Adicionado há: $time dias $time22 horas $time3 minutos";
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
