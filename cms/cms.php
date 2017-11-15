<?php

  /**
   *  Main CMS script.
   *  Copyright (C) Z-Coders 2017
   */
  class SQL
  {
    protected $hostname = "localhost";
    protected $sql_username = "root";
    protected $sql_password = "";
    protected $database = "site_db";

    protected function newConnection()
    {
      return mysqli_connect($this->hostname, $this->sql_username, $this->sql_password, $this->database);
    }

    public function execQuery($query)
    {
      $result = mysqli_query($this->newConnection(), $query);
      return $result;
    }

  }


?>
