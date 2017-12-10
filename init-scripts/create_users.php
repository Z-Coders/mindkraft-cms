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

  $query = "GRANT ALL PRIVILEGES ON $database.* to $adminuser@'$hostname' IDENTIFIED BY '$adminpass'; GRANT SELECT, INSERT, UPDATE ON $database.* to $clientuser@'$hostname' IDENTIFIED BY '$clientpass';";

  $stmt = $pdo->prepare($query);

  if ($stmt->execute()) {

    // Write to sqlconf.ini
    $sqlconf_file = fopen("sqlconf.ini", "w");
    $prefix_text = "; SQL Configuration file. Automatically generated when init.php is run\n; Do not edit or modify this file\n; Copyright (C) Z-Coders 2017\n";

    fwrite($sqlconf_file, $prefix_text);

    fwrite($sqlconf_file, "\n[sqlconf-root]\n");
    fwrite($sqlconf_file, "sql_hostname = \"".$hostname."\"\n");
    fwrite($sqlconf_file, "sql_database = \"".$database."\"\n");

    fwrite($sqlconf_file, "\n\n[sqlconf-cpanel]\n");
    fwrite($sqlconf_file, "sql_username = \"".$adminuser."\"\n");
    fwrite($sqlconf_file, "sql_password = \"".$adminpass."\"\n");

    fwrite($sqlconf_file, "\n\n[sqlconf-client]\n");
    fwrite($sqlconf_file, "sql_username = \"".$clientuser."\"\n");
    fwrite($sqlconf_file, "sql_password = \"".$clientpass."\"\n");

    fwrite($sqlconf_file, "\n\n[sqlconf-prefixes]\n");
    fwrite($sqlconf_file, "sql_table_prefix = \"".$table_prefix."\"\n");
    fwrite($sqlconf_file, "sql_view_prefix = \"".$view_prefix."\"\n");

    fclose($sqlconf_file);


    // Write to sqlconf.php
    $php_sqlconf = fopen("sqlconf.php", "w");

    $prefix_text = "\n\t// SQL configuration file, do not edit!\n\t// This file was automatically generated when init script was run.\n\t// Copyright (c) 2017 Z-Coders";

    fwrite($php_sqlconf, "<?php\n");

    fwrite($php_sqlconf, $prefix_text . "\n");

    fwrite($php_sqlconf, "\n\t" . '$hostname = "'. $hostname .'";');
    fwrite($php_sqlconf, "\n\t" . '$username = "'. $clientuser .'";');
    fwrite($php_sqlconf, "\n\t" . '$password = "'. $clientpass .'";');
    fwrite($php_sqlconf, "\n\t" . '$database = "'. $database .'";');
    fwrite($php_sqlconf, "\n\t" . '$table_prefix = "'. $table_prefix .'";');
    fwrite($php_sqlconf, "\n\t" . '$view_prefix = "'. $view_prefix .'";');

    fwrite($php_sqlconf, "\n\n?>");

    fclose($php_sqlconf);

    copy("sqlconf.ini", "../cms/sqlconf.ini");

    echo "All users created successfully. <br><br>SQL configuration saved to /cms/sqlconf.ini";
    echo "<br><br>PHP version of the SQL configuration file is written to sqlconf.php<br>You will have to manually copy it to /src/php/ in your TLd";
  }

  else {
    echo "Error creating users! <br><br>Please try again...";
  }



?>
