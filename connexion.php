<?php
$dsn = "mysql:host=localhost;dbname=biblio";
$username='root';
$password='';
try{
$conn= new PDO($dsn,$username,$password);
}
catch (PDOException $e) {
    echo 'failed '. $e->getMessage();

}
?>