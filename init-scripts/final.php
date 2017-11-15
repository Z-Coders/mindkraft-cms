<?php

  $sqlconf_file = fopen("sqlconf.ini", "w");
  $prefix_text =
"; SQL Configuration file. Automatically generated when init.php is run\n
; Do not edit or modify this file\n
; Copyright (C) Z-Coders 2017\n";
  fwrite($sqlconf_file, $prefix_text);

  fwrite($sqlconf_file, "\n");
  fwrite($sqlconf_file, "[sqlconf-user]\n");
  fwrite($sqlconf_file, "sql_hostname = \"".$_POST['MySQLServerHost']."\"\n");
  fwrite($sqlconf_file, "sql_username = \"".$_POST['MySQLUsername']."\"\n");
  fwrite($sqlconf_file, "sql_password = \"".$_POST['MySQLPassword']."\"\n");
  fwrite($sqlconf_file, "sql_database = \"".$_POST['MySQLDatabase']."\"\n");
  fwrite($sqlconf_file, "sql_table_prefix = \"".$_POST['MySQLTablePrefix']."\"\n");

  fclose($sqlconf_file);

  copy("sqlconf.ini", "../cms/sqlconf.ini");

  $user_sql = parse_ini_file('sqlconf.ini', true)['sqlconf-user'];
  $connection_var = mysqli_connect($user_sql['sql_hostname'], $user_sql['sql_username'], $user_sql['sql_password']);
  $table_list = array('cpanel_users', 'enduser_table', 'events_list', 'workshops_list', 'games_list');
  $table_config = array(
                  "username varchar(50), password varchar(50)",
                  "name varchar(50), mobile varchar(15), email varchar(50), college varchar(100), password varchar(50), userid varchar(20)",
                  "event_name varchar(50), department varchar(50), event_incharge varchar(50), incharge_contact varchar(50), event_fee varchar(10), event_prize varchar(20), description mediumtext, event_id varchar(20)",
                  "event_name varchar(50), event_incharge varchar(50), incharge_contact varchar(50), event_fee varchar(10), event_prize varchar(20), description text, event_id varchar(20)",
                  "event_name varchar(50), event_incharge varchar(50), incharge_contact varchar(50), event_fee varchar(10), event_prize varchar(20), description text, event_id varchar(20)"
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
  for ($i=0; $i < count($table_list); $i++) {
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
