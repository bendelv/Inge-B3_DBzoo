<?php
$serverName = "localhost";
$username = "root";
$password = "aV5aDHKD48";
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
  echo "Table \" institution\" created successfully!<br>";

  $sql = "CREATE TABLE IF NOT EXISTS Espece(
    nom_scientifique VARCHAR(50),
    nom_courant VARCHAR(50),
    regime_alimentaire VARCHAR(50),
    PRIMARY KEY(nom_scientifique)
  )";
  $BDD->exec($sql);
  echo "Table \"Espece\" created successfully!<br>";

  $sql = "CREATE TABLE IF NOT EXISTS Climat(
    nom_scientifique VARCHAR(50),
    nom_climat VARCHAR(50),
    PRIMARY KEY(nom_scientifique, nom_climat),
    FOREIGN KEY (nom_scientifique) REFERENCES Espece(nom_scientifique)
  )";
  $BDD->exec($sql);
  echo "Table \"climat\" created successfully!<br>";

  $sql = "CREATE TABLE IF NOT EXISTS Animal(
    nom_scientifique VARCHAR(50),
    n_puce INT,
    taille INT,
    sexe CHAR,
    date_naissance VARCHAR(20),
    n_enclos INT,
    PRIMARY KEY(nom_scientifique, n_puce),
    FOREIGN KEY(nom_scientifique) REFERENCES Espece(nom_scientifique),
    FOREIGN KEY(n_enclos) REFERENCES Enclos(n_enclos)
  )";
  $BDD->exec($sql);
  echo "Table \"Animal\" created successfully!<br>";

  $sql = "CREATE TABLE IF NOT EXISTS Enclos(
    n_enclos INT,
    climat VARCHAR(50),
    taille INT,
    PRIMARY KEY(n_enclos)
  )";
  $BDD->exec($sql);
  echo "Table \"Enclos\"created successfully!<br>";

  $sql = "CREATE TABLE IF NOT EXISTS Materiel(
    n_materiel INT,
    état VARCHAR(20),
    local CHAR(2),
    PRIMARY KEY(n_materiel)
  )";
  $BDD->exec($sql);
  echo "Table \"Materiel\" created successfully!<br>";

}catch(PDOException $e){
  echo $sql . "<br>" . $e->getMessage();
  exit;
}
$BDD = null;
 ?>
