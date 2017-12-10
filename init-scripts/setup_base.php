<?php

  $sqlconf_file = fopen("sqlconf.ini", "w");

  fwrite($sqlconf_file, "[sqlconf-root]\n");
  fwrite($sqlconf_file, "sql_hostname = \"".$_POST['MySQLServerHost']."\"\n");
  fwrite($sqlconf_file, "sql_username = \"".$_POST['MySQLUsername']."\"\n");
  fwrite($sqlconf_file, "sql_password = \"".$_POST['MySQLPassword']."\"\n");
  fwrite($sqlconf_file, "sql_database = \"".$_POST['MySQLDatabase']."\"\n");
  fwrite($sqlconf_file, "\n\n[sqlconf-prefixes]\n");
  fwrite($sqlconf_file, "sql_table_prefix = \"".$_POST['MySQLTablePrefix']."\"\n");
  fwrite($sqlconf_file, "sql_view_prefix = \"".$_POST['MySQLViewPrefix']."\"\n");

  fclose($sqlconf_file);

  $root_sql = parse_ini_file('sqlconf.ini', true)['sqlconf-root'];
  $prefixes = parse_ini_file('sqlconf.ini', true)['sqlconf-prefixes'];

  $hostname = $root_sql['sql_hostname'];
  $username = $root_sql['sql_username'];
  $password = $root_sql['sql_password'];
  $database = $root_sql['sql_database'];
  $table_prefix = $prefixes['sql_table_prefix'];
  $view_prefix = $prefixes['sql_view_prefix'];

  $connection_var = mysqli_connect($hostname, $username, $password);

  // Create database first
  $query = "create database " . $database;
  $result = mysqli_query($connection_var, $query);

  if ($result) {
    echo "Successfully created the database <br>";
  }
  else {
    echo "Error creating the database <br> Quitting!";
    return;
  }


  // Master tables list. Add table here and then define in t_struct (please maintain the same order)
  $t_list = array('cpanel_users', 'enduser_table', 'events_list', 'games_list', 'workshops_list', 'all_events', 'event_registration');

  //  Table Structure
  //
  //  cpanel_users :
  //    cpanel_username varchar(64) not null unique
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

  //  event_registration :
  //    event_id varchar(32) not null unique
  //    registered_users longtext

  $t_struct = array(
    'cpanel_users' => 'cpanel_username varchar(64) not null unique, user_password varbinary(512)',
    'enduser_table' => 'userid varchar(32) not null unique, enduser_mobile varchar(16) not null unique, enduser_name varchar(64) not null, enduser_email varchar(64) not null unique, enduser_college_name varchar(128), enduser_password varbinary(512) not null',
    'events_list' => 'event_name varchar(64), event_id varchar(32) not null unique, event_type varchar(32), event_department varchar(64), event_incharge varchar(128), incharge_contact varchar(128), event_fee varchar(16), event_prize varchar(16), event_description mediumtext',
    'games_list' => 'event_name varchar(64), event_id varchar(32) not null unique, event_incharge varchar(128), incharge_contact varchar(128), event_fee varchar(16), event_prize varchar(16), event_description mediumtext',
    'workshops_list' => 'event_name varchar(64), event_id varchar(32) not null unique, event_department varchar(64), event_incharge varchar(128), incharge_contact varchar(128), event_fee varchar(16), event_description mediumtext',
    'all_events' => 'event_name varchar(64), event_id varchar(32) not null unique, event_type varchar(32), category varchar(32), event_department varchar(64), event_incharge varchar(128), incharge_contact varchar(128), event_fee varchar(16), event_prize varchar(16), event_description mediumtext',
    'event_registration' => 'event_id varchar(32) not null unique, registered_users longtext'
  );


  // Create PDO object

  $dsn = "mysql:host=$hostname;dbname=$database;charset=utf8mb4";

  $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];

  $pdo = new PDO($dsn, $username, $password, $options);

  echo "Creating tables...<br>";
  foreach ($t_struct as $t_name => $t_config) {
    $stmt = $pdo->prepare("create table " . $table_prefix.$t_name . "(" . $t_config . ")");
    if ($stmt->execute()) {
      echo "Created table " . $table_prefix.$t_name . "<br>";
    }
    else {
      echo "Error creating table " . $table_prefix.$t_name . "<br>" . "Quitting!";
      return;
    }
  }

  foreach ($t_list as $table) {
    $stmt = $pdo->prepare("create view ".$view_prefix.$table." as select * from ".$table_prefix.$table);
    if ($stmt->execute()) {
      echo "Created view for ".$table_prefix.$table." as ".$view_prefix.$table."<br>";
    }
    else {
      echo "Error creating view for ".$table_prefix.$table."...<br>Quitting!";
      return;
    }
  }

  echo "<a href=\"createusers.php\">Go Ahead</a>";

?>
