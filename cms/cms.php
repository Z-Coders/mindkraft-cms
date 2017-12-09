<?php

  /**
   *  Main CMS script.
   *  Copyright (C) Z-Coders 2017
   */
  class SQL
  {
    protected $sqlconf;
    protected $hostname;
    protected $sql_username;
    protected $sql_password;
    protected $database;
    protected $table_prefix;
    public function __construct()
    {
      $this->sqlconf = parse_ini_file("sqlconf.ini", true)['sqlconf-root'];
      $this->hostname = $this->sqlconf['sql_hostname'];
      $this->database = $this->sqlconf['sql_database'];

      $this->sqlconf = parse_ini_file("sqlconf.ini", true)['sqlconf-cpanel'];
      $this->sql_username = $this->sqlconf['sql_username'];
      $this->sql_password = $this->sqlconf['sql_password'];

      $this->sqlconf = parse_ini_file("sqlconf.ini", true)['sqlconf-prefixes'];
      $this->table_prefix = $this->sqlconf['sql_table_prefix'];
    }

    protected function newConnection()
    {
      return mysqli_connect($this->hostname, $this->sql_username, $this->sql_password, $this->database);
    }

    public function execQuery($query)
    {
      $result = mysqli_query($this->newConnection(), $query);
      return $result;
    }

    public function getTeblePrefix()
    {
      return $this->table_prefix;
    }

  }

  function generateUniqueId($length = 16) {
    $sql = new SQL();
    $table_prefix = $sql->getTeblePrefix();
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    $query = "select * from ".$table_prefix."all_events where event_id='" . $randomString . "'";
    $result = $sql->execQuery($query);
    if (mysqli_num_rows($result) > 0) {
      generateUniqueUserId();
    }
    else {
      return $randomString;
    }
  }


?>
