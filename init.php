<?php
  $sqlconf_admin = parse_ini_file("init-scripts/sqlconf.ini", true)['sqlconf-admin'];
  $connection_var = mysqli_connect($sqlconf_admin['sql_hostname'], $sqlconf_admin['sql_username'], $sqlconf_admin['sql_password'], $sqlconf_admin['sql_database']);
  $query = "";
  $result = mysqli_query($connection_var, $query);
?>
