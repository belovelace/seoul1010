<?php


if(isset($_GET["state"]) && isset($_GET["code"])){
   $state = $_GET["state"]; // get state value from HTTP GET
   $code = $_GET["code"];

   $servername = "localhost";
   $username = "root";
   $password = "1111";
   $dbname = "seoul2024";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);
   // Check connection
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }

 //  $sql = "INSERT INTO machin (CODE, STATE_NUM) VALUES ($code,$state) ON //DUPLICATE KEY UPDATE  STATE_NUM = $state ";
   $sql = "UPDATE machine SET STATE_NUM='$state' WHERE CODE='$code'";
 // $sql = "UPDATE machin SET STATE_NUM = :state WHERE CODE = :code";

   if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
   } else {
      echo "Error: " . $sql . " => " . $conn->error;
   }

   $conn->close();
} else {
   echo "state is not set";
}
?>
