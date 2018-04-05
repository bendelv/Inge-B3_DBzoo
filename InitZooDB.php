<?php
$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "zooDB";
$BDD = null;

try{
  //initiate connection
  $BDD = new PDO("mysql:host=$serverName", $username, $password);
  $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected to DB server.. <br>";

}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
    exit;
}

try{
  //Creation of the database
  $sql = "CREATE DATABASE IF NOT EXISTS $dbName";
  $BDD->exec($sql);
  echo "Database \"$dbName\" created! <br>";
  $BDD = null;

}catch(PDOException $e){
  echo "$sql failed: " . $e->getMessage();
  exit;
}

try{
  //initiate connection to specific DB
  $BDD = new PDO("mysql:host=$serverName;dbname=$dbName", $username, $password);
  $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected to DB \"$dbName\".. <br>";

  //Creation of tables
  $sql = "CREATE TABLE IF NOT EXISTS Institution(
  nom_institution VARCHAR(50),
  rue VARCHAR(50),
  code_postal int,
  pays VARCHAR(50),
  PRIMARY KEY(nom_institution)
  )";
  $BDD->exec($sql);
  echo "Table \" institution\" created successfully";

  $sql = "CREATE TABLE IF NOT EXISTS (

  PRIMARY KEY(),
  FOREIGN KEY() REFERENCES ()
  )";
  $BDD->exec($sql);
  echo "Table created successfully";



}catch(PDOException $e){
  echo $sql . "<br>" . $e->getMessage();
  exit;
}
$BDD = null;
 ?>
