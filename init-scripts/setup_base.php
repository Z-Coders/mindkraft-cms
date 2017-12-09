<?php
  $sqlconf_file = fopen("sqlconf.ini", "w");
  $prefix_text =
"; SQL Configuration file. Automatically generated when init.php is run\n
; Do not edit or modify this file\n
; Copyright (C) Z-Coders 2017\n";
  fwrite($sqlconf_file, $prefix_text);

  fwrite($sqlconf_file, "\n");
  fwrite($sqlconf_file, "[sqlconf-root]\n");
  fwrite($sqlconf_file, "sql_hostname = \"".$_POST['MySQLServerHost']."\"\n");
  fwrite($sqlconf_file, "sql_username = \"".$_POST['MySQLUsername']."\"\n");
  fwrite($sqlconf_file, "sql_password = \"".$_POST['MySQLPassword']."\"\n");
  fwrite($sqlconf_file, "sql_database = \"".$_POST['MySQLDatabase']."\"\n");
  fwrite($sqlconf_file, "sql_table_prefix = \"".$_POST['MySQLTablePrefix']."\"\n");
  fwrite($sqlconf_file, "sql_view_prefix = \"".$_POST['MySQLViewPrefix']."\"\n");

  fclose($sqlconf_file);

  copy("sqlconf.ini", "../cms/sqlconf.ini");

  $root_sql = parse_ini_file('sqlconf.ini', true)['sqlconf-root'];
  $connection_var = mysqli_connect($root_sql['sql_hostname'], $root_sql['sql_username'], $root_sql['sql_password']);

  // Master tables list. Add table here and then define in t_struct (please maintain the same order)
  $t_list = array('cpanel_users', 'enduser_table', 'events_list', 'games_list', 'workshops_list', 'all_events');

  //  Table Structure
  //
  //  cpanel_users :
  //    cpanel_username varchar(64)
  //    user_password varbinary(512)
  //
  //  enduser_table :
  //    userid varchar(32) not null unique
  //    enduser_mobile varchar(16) not null unique
  //    enduser_name varchar(64) not null
  //    enduser_email varchar(64) not null unique
  //    enduser_college_name varchar(128)
  //    enduser_password varbinary(512) not null
  //
  //  events_list :
  //    event_name varchar(64)
  //    event_id varchar(32) not null unique
  //    event_type varchar(32)
  //    event_department varchar(64)
  //    event_incharge varchar(128)
  //    incharge_contact varchar(128)
  //    event_fee varchar(16)
  //    event_prize varchar(16)
  //    event_description mediumtext
  //
  //  games_list :
  //    event_name varchar(64)
  //    event_id varchar(32) not null unique
  //    event_incharge varchar(128)
  //    incharge_contact varchar(128)
  //    event_fee varchar(16)
  //    event_prize varchar(16)
  //    event_description mediumtext
  //
  //  workshops_list :
  //    event_name varchar(64)
  //    event_id varchar(32) not null unique
  //    event_department varchar(64)
  //    event_incharge varchar(128)
  //    incharge_contact varchar(128)
  //    event_fee varchar(16)
  //    event_description mediumtext
  //
  //  all_events :
  //    event_name varchar(64)
  //    event_id varchar(32) not null unique
  //    event_type varchar(32)
  //    category varchar(32)
  //    event_department varchar(64)
  //    event_incharge varchar(128)
  //    incharge_contact varchar(128)
  //    event_fee varchar(16)
  //    event_prize varchar(16)
  //    event_description mediumtext

  $t_struct = array(
    'cpanel_users' => 'cpanel_username varchar(64), user_password varbinary(512)',
    'enduser_table' => 'userid varchar(32) not null unique, enduser_mobile varchar(16) not null unique, enduser_name varchar(64) not null, enduser_email varchar(64) not null unique, enduser_college_name varchar(128), enduser_password varbinary(512) not null',
    'events_list' => 'event_name varchar(64), event_id varchar(32) not null unique, event_type varchar(32), event_department varchar(64), event_incharge varchar(128), incharge_contact varchar(128), event_fee varchar(16), event_prize varchar(16), event_description mediumtext',
    'games_list' => 'event_name varchar(64), event_id varchar(32) not null unique, event_incharge varchar(128), incharge_contact varchar(128), event_fee varchar(16), event_prize varchar(16), event_description mediumtext',
    'workshops_list' => 'event_name varchar(64), event_id varchar(32) not null unique, event_department varchar(64), event_incharge varchar(128), incharge_contact varchar(128), event_fee varchar(16), event_description mediumtext',
    'all_events' => 'event_name varchar(64), event_id varchar(32) not null unique, event_type varchar(32), category varchar(32), event_department varchar(64), event_incharge varchar(128), incharge_contact varchar(128), event_fee varchar(16), event_prize varchar(16), event_description mediumtext',
  );

  // Create database first
  $query = "create database " . $root_sql['sql_database'];
  $result = mysqli_query($connection_var, $query);

  if ($result) {
    echo "Successfully created the database <br>";
  }
  else {
    echo "Error creating the database <br> Quitting!";
    return;
  }

  $connection_var = mysqli_connect($root_sql['sql_hostname'], $root_sql['sql_username'], $root_sql['sql_password'], $root_sql['sql_database']);

  echo "Creating tables...<br>";
  foreach ($t_struct as $t_name => $t_config) {
    $query = "create table " . $root_sql['sql_table_prefix'].$t_name . "(" . $t_config . ")";
    $result = mysqli_query($connection_var, $query);
    if ($result) {
      echo "Created table " . $root_sql['sql_table_prefix'].$t_name . "<br>";
    }
    else {
      echo "Error creating table " . $root_sql['sql_table_prefix'].$t_name . "<br>" . "Quitting!";
      return;
    }
  }

  foreach ($t_list as $table) {
    $query = "create view ".$root_sql['sql_view_prefix'].$table." as select * from ".$root_sql['sql_table_prefix'].$table;
    $result = mysqli_query($connection_var, $query);
    if ($result) {
      echo "Created view for ".$root_sql['sql_table_prefix'].$table." as ".$root_sql['sql_view_prefix'].$table."<br>";
    }
    else {
      echo "Error creating view for ".$root_sql['sql_table_prefix'].$table."...<br>Quitting!";
      return;
    }
  }

  echo "<a href=\"create_users.php\">Go Ahead</a>";

?>
