<?php
  require 'Lite.php';
  $config = new Config_Lite('sqlconf.ini');
  $config->set('sqlconf-user', 'sql_hostname', $_POST['MySQLServerHost'])
         ->set('sqlconf-user', 'sql_username', $_POST['MySQLUsername'])
         ->set('sqlconf-user', 'sql_password', $_POST['MySQLPassword'])
         ->set('sqlconf-user', 'sql_database', $_POST['MySQLDatabase'])
         ->set('sqlconf-user', 'sql_table_prefix', $_POST['MySQLTablePrefix']);

  $config->save();

  $user_sql = $config->read('sqlconf.ini')['sqlconf-user'];
  $connection_var = mysqli_connect($user_sql['sql_hostname'], $user_sql['sql_username'], $user_sql['sql_password']);
  $table_list = array('enduser_table', 'events_list', 'workshops_list', 'games_list');
  $table_config = array(
                  "name varchar(50), mobile varchar(15), email varchar(50), college varchar(100), password varchar(50), userid varchar(20)",
                  "event_name varchar(50), department varchar(50), event_incharge varchar(50), incharge_contact varchar(50), event_fee varchar(10), event_prize varchar(20), description mediumtext",
                  "event_name varchar(50), event_incharge varchar(50), incharge_contact varchar(50), event_fee varchar(10), event_prize varchar(20), description text",
                  "event_name varchar(50), event_incharge varchar(50), incharge_contact varchar(50), event_fee varchar(10), event_prize varchar(20), description text"
                );
  $query = "create database " . $user_sql['sql_database'];
  $result = mysqli_query($connection_var, $query);
  if ($result) {
    echo "Successfully created the database <br>";
  }
  else {
    echo "Error creating the database <br> Quitting!";
    return;
  }
  $connection_var = mysqli_connect($user_sql['sql_hostname'], $user_sql['sql_username'], $user_sql['sql_password'], $user_sql['sql_database']);
  for ($i=0; $i < 4; $i++) {
    $query = "create table " . $user_sql['sql_table_prefix'].$table_list[$i] . "(" . $table_config[$i] . ")";
    $result = mysqli_query($connection_var, $query);
    if ($result) {
      echo "Created table " . $user_sql['sql_table_prefix'].$table_list[$i] . "<br>";
    }
    else {
      echo "Error creating table " . $user_sql['sql_table_prefix'].$table_list[$i] . "<br>" . "Quitting!";
      break;
    }
  }
?>
