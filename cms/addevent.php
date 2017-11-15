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
  if ($result && $result2) {
    echo "Inserted Successfully";
  }
  else {
    echo "Error inserting data!";
  }
?>
