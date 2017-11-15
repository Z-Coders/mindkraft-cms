<?php
  require 'cms.php';
  $sql = new SQL();
  $name = $_POST['ev_name'];
  $dept = $_POST['department'];
  $co = $_POST['ev_incharge'];
  $mobile = $_POST['incharge_con'];
  $fee = $_POST['ev_fee'];
  $prize = $_POST['ev_prize'];
  $description = $_POST['ev_description'];
  $id = generateUniqueId();
  $table_prefix = $sql->getTeblePrefix();
  $query = "insert into ".$table_prefix."events_list values ('".$name."', '".$dept."', '".$co."', '".$mobile."', '".$fee."', '".$prize."', '".$description."', '".$id."')";
  $query2 = "insert into ".$table_prefix."all_events values ('".$name."', '".$id."')";
  $result = $sql->execQuery($query);
  $result2 = $sql->execQuery($query2);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Add Event</title>
  </head>
  <style media="screen">
    .container{
      display: block;
      margin: auto;
      text-align: center;
      margin-top: 15%;
    }
  </style>
  <body>
    <div class="container">
      <?php
        if ($result && $result2) {
          echo "<h1>Added event Successfully...</h1>";
        }
        else {
          echo "<h1>Error inserting data!<h1>";
        }
      ?>
      <a href="console.php">Home</a>
    </div>
  </body>
</html>
