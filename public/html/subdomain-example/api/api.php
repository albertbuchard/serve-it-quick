<?php

  if (isset($apiString)) {
      var_dump($apiString);

      $username = "root";
      $password = "aziz4444";
      $hostname = "localhost:/tmp/mysql.sock";

      //connection to the database
      $dbhandle = mysql_connect($hostname, $username, $password)
        or die("Unable to connect to MySQL");
      echo "Connected to MySQL<br>";
  }
