<?php
  require 'sqlconf.php';
  $sql = new sqlConf();
  $name = $_POST['name'];
  $dept = $_POST['department'];
  $co = $_POST['incharge'];
  $mobile = $_POST['mobile'];
  $fee = $_POST['fee'];
  $prize = $_POST['prize'];
  $description = $_POST['description'];
  $query = "insert into mindkraft18_events values ('".$name."', '".$dept."', '".$co."', '".$mobile."', '".$fee."', '".$prize."', '".$description."')";
  $result = $sql->execQuery($query);
  if ($result) {
    echo "Inserted Successfully";
  }
?>
