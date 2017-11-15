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
      $this->sqlconf = parse_ini_file("sqlconf.ini", true)['sqlconf-user'];
      $this->hostname = $this->sqlconf['sql_hostname'];
      $this->sql_username = $this->sqlconf['sql_username'];
      $this->sql_password = $this->sqlconf['sql_password'];
      $this->database = $this->sqlconf['sql_database'];
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


?>
