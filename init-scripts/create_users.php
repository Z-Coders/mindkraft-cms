<?php

  $adminuser = $_POST['adminUsername'];
  $adminpass = $_POST['adminPassword'];
  $clientuser = $_POST['enduserUsername'];
  $clientpass = $_POST['enduserPassword'];

  $root_sql = parse_ini_file('sqlconf.ini', true)['sqlconf-root'];
  $prefixes = parse_ini_file('sqlconf.ini', true)['sqlconf-prefixes'];

  $hostname = $root_sql['sql_hostname'];
  $username = $root_sql['sql_username'];
  $password = $root_sql['sql_password'];
  $database = $root_sql['sql_database'];
  $table_prefix = $prefixes['sql_table_prefix'];
  $view_prefix = $prefixes['sql_view_prefix'];

  // Create PDO object

  $dsn = "mysql:host=$hostname;dbname=$database;charset=utf8mb4";

  $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ];

  $pdo = new PDO($dsn, $username, $password, $options);

  $query = "GRANT ALL PRIVILEGES ON $database.* to $adminuser@'%' IDENTIFIED BY '$adminpass'; GRANT SELECT, INSERT, UPDATE ON $database.* to $clientuser@'%' IDENTIFIED BY '$clientpass';";

  $stmt = $pdo->prepare($query);

  if ($stmt->execute()) {
    echo "All users created successfully. <br><br>SQL configuration saved to /cms/sqlconf.ini";
  }

  else {
    echo "Error creating users! <br><br>Please try again...";
  }



?>
