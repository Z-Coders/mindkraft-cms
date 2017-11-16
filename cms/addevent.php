<?php
  require 'cms.php';
  $sql = new SQL();
  $name = $_POST['ev_name'];
  $id = generateUniqueId();
  $type = $_POST['ev_type'];
  $category = "event";
  $dept = $_POST['ev_department'];
  $co = $_POST['ev_incharge'];
  $mobile = $_POST['incharge_con'];
  $fee = $_POST['ev_fee'];
  $prize = $_POST['ev_prize'];
  $description = $_POST['ev_description'];
  $table_prefix = $sql->getTeblePrefix();
  $query = "insert into ".$table_prefix."events_list values ('".$name."', '".$id."', '".$type."', '".$dept."', '".$co."', '".$mobile."', '".$fee."', '".$prize."', '".$description."')";
  $query2 = "insert into ".$table_prefix."all_events values ('".$name."', '".$id."', '".$type."', '".$category."', '".$dept."', '".$co."', '".$mobile."', '".$fee."', '".$prize."', '".$description."')";
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
          echo "<h1>Error inserting data!</h1>";
        }
      ?>
      <a href="console.php">Go Back</a>
    </div>
  </body>
</html>
