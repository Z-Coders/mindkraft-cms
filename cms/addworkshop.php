<?php
  require 'cms.php';
  $sql = new SQL();
  $name = $_POST['wr_name'];
  $co = $_POST['wr_incharge'];
  $mobile = $_POST['incharge_con'];
  $fee = $_POST['wr_fee'];
  $description = $_POST['wr_description'];
  $id = generateUniqueId();
  $table_prefix = $sql->getTeblePrefix();
  $query = "insert into ".$table_prefix."workshops_list values ('".$name."', '".$co."', '".$mobile."', '".$fee."', '".$description."', '".$id."')";
  $query2 = "insert into ".$table_prefix."all_events values ('".$name."', '".$id."')";
  $result = $sql->execQuery($query);
  $result2 = $sql->execQuery($query2);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Add Workshop</title>
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
          echo "<h1>Workshop added successfully...</h1>";
        }
        else {
          echo "<h1>Error inserting data!</h1>";
        }
      ?>
      <a href="workshop.php">Go Back</a>
    </div>
  </body>
</html>
