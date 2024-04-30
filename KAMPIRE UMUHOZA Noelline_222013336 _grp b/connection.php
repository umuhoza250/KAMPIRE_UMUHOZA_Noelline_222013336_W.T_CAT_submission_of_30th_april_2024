<?php
      $host = "localhost";
      $user = "Nelly";
      $pass = "222013336";
      $database = "handcraft_business_consulting_system";

      $connection = new mysqli($host, $user, $pass, $database);

      if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
      }
?>