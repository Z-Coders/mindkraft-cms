<?php
  require 'cms.php';
  $sql = new SQL();
  $user = $_POST['user'];
  $password = $_POST['password'];
  $query = "select * from user_table where mobile='".$user."' and password='".$password."'";
  $result = $sql->execQuery($query);
  if (mysqli_num_rows($result) == 1) {
    header("location:console.php");
  }
  else {
    header("location:../index.php");
  }
?>
