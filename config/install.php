<?php

/**
  * Open a connection via PDO to create a
  * new database and table with structure.
  *
  */
error_reporting(E_ALL);
ini_set('display_errors',1);
require "config.php";

try {
  $connection = new PDO("mysql:host=$host", $username, $password, $options);
  $sql = file_get_contents("../data/init.sql");
  $connection->exec($sql);

  echo "Database and table user created successfully.";
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}