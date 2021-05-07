<?php
    $servername="localhost";
    $username="root";
    $password="Sahyak@11";

    try{
        $conn=new PDO("mysql:host=$servername;dbname=BankSystem",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e) {
        echo "Connection failed: Some error is occured please check the data ";
      }
?>