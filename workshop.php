<?php
  require 'sqlconf.php';
  $sql = new sqlConf();
  $name = $_POST['name'];
  $co = $_POST['incharge'];
  $mobile = $_POST['mobile'];
  $fee = $_POST['fee'];
  $prize = $_POST['prize'];
  $description = $_POST['description'];
  $query = "insert into mindkraft18_workshops values ('".$name."', '".$co."', '".$mobile."', '".$fee."', '".$prize."', '".$description."')";
  $result = $sql->execQuery($query);
  if ($result) {
    echo "Inserted Successfully";
  }
?>
