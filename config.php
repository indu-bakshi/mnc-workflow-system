<?php
   $servername = "localhost:3307";
   $username = "root";
   $password = "";
   $db="workflow_system";
   
   // Create connection
   $conn = new mysqli($servername, $username, $password, $db);
   
   // Check connection
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
?>