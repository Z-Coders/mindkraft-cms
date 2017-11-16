<?php
  require 'cms.php';
  $sql = new SQL();
  $name = $_POST['gm_name'];
  $id = generateUniqueId();
  $type = "";
  $category = "game";
  $dept = "";
  $co = $_POST['gm_incharge'];
  $mobile = $_POST['incharge_con'];
  $fee = $_POST['gm_fee'];
  $prize = $_POST['gm_prize'];
  $description = $_POST['gm_description'];
  $table_prefix = $sql->getTeblePrefix();
  $query = "insert into ".$table_prefix."games_list values ('".$name."', '".$id."', '".$co."', '".$mobile."', '".$fee."', '".$prize."', '".$description."')";;
  $query2 = "insert into ".$table_prefix."all_events values ('".$name."', '".$id."', '".$type."', '".$category."', '".$dept."', '".$co."', '".$mobile."', '".$fee."', '".$prize."', '".$description."')";
  $result = $sql->execQuery($query);
  $result2 = $sql->execQuery($query2);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Add Game</title>
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
          echo "<h1>Game added successfully...</h1>";
        }
        else {
          echo "<h1>Error inserting data!</h1>";
        }
      ?>
      <a href="game.php">Go Back</a>
    </div>
  </body>
</html>
