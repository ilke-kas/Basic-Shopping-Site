<?php
 $sname = "localhost";
 $uname = "root";
 $pass = "root";

 $db_name = "ilke_kas";

 $conn = mysqli_connect($sname,$uname,$pass,$db_name);

 if(!$conn){
 	echo "Connection Failed";
 }