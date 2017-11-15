<?php

  /**
   *  Main CMS script.
   *  Copyright (C) Z-Coders 2017
   */
  class SQL
  {
    $sqlconf = parse_ini_file("sqlconf.ini", true)['sqlconf-user'];
    protected $hostname = $sqlconf['sql_hostname'];
    protected $sql_username = $sqlconf['sql_hostname'];
    protected $sql_password = $sqlconf['sql_hostname'];
    protected $database = $sqlconf['sql_hostname'];
    protected $table_prefix = $sqlconf['sql_table_prefix'];

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
