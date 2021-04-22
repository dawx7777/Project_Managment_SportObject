<?php 
define("DB_SERVER", "192.168.1.10");
define("DB_USER", "dawid");
define("DB_PASSWORD", "admin123#");
define("DB_DATABASE", "orlikowa");

$connection =  new mysqli(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);
  if ($connection->connect_error) die("Błąd krytyczny");