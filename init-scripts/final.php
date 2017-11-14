<?php
  require 'Lite.php';
  $config = new Config_Lite('sqlconf.ini');
  $config->set('sqlconf-user', 'sql_hostname', $_POST['MySQLServerHost'])
         ->set('sqlconf-user', 'sql_username', $_POST['MySQLUsername'])
         ->set('sqlconf-user', 'sql_password', $_POST['MySQLPassword'])
         ->set('sqlconf-user', 'sql_database', $_POST['MySQLDatabase']);

  $config->save();
?>
