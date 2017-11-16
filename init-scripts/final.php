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
  fwrite($sqlconf_file, "sql_view_prefix = \"".$_POST['MySQLViewPrefix']."\"\n");

  fclose($sqlconf_file);

  copy("sqlconf.ini", "../cms/sqlconf.ini");

  $user_sql = parse_ini_file('sqlconf.ini', true)['sqlconf-user'];
  $connection_var = mysqli_connect($user_sql['sql_hostname'], $user_sql['sql_username'], $user_sql['sql_password']);
  $table_list = array('cpanel_users', 'enduser_table', 'events_list', 'games_list', 'workshops_list', 'all_events');
  $table_config = array(
                  "username varchar(64), password varbinary(512)",
                  "userid varchar(32) not null unique, mobile varchar(16) not null unique, name varchar(64) not null, email varchar(64) not null unique, college varchar(128), password varbinary(512) not null",
                  "event_name varchar(64), event_id varchar(32) not null unique, event_type varchar(32), department varchar(64), event_incharge varchar(128), incharge_contact varchar(128), event_fee varchar(16), event_prize varchar(16), description mediumtext",
                  "event_name varchar(64), event_id varchar(32) not null unique, department varchar(64), event_incharge varchar(128), incharge_contact varchar(128), event_fee varchar(16), event_prize varchar(16), description mediumtext",
                  "event_name varchar(64), event_id varchar(32) not null unique, department varchar(64), event_incharge varchar(128), incharge_contact varchar(128), event_fee varchar(16), event_prize varchar(16), description mediumtext",
                  "event_name varchar(64), event_id varchar(32) not null unique, event_type varchar(32), category varchar(32), department varchar(64), event_incharge varchar(128), incharge_contact varchar(128), event_fee varchar(16), event_prize varchar(16), description mediumtext"
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

  echo "Creating tables...<br>";
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

  foreach ($table_list as $table) {
    $query = "create view ".$user_sql['sql_view_prefix'].$table." as select * from ".$user_sql['sql_table_prefix'].$table;
    $result = mysqli_query($connection_var, $query);
    if ($result) {
      echo "Created view for ".$user_sql['sql_table_prefix'].$table." as ".$user_sql['sql_view_prefix'].$table."<br>";
    }
    else {
      echo "Error creating view...<br>Quitting!";
      break;
    }
  }

?>
