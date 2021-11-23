<?php
session_start();
include "config.php";
if(isset($_POST['Uname']) && isset($_POST['Pass'] ))
{
	function checkLogin($data)
	{
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$uname= checkLogin($_POST['Uname']);
	$pass= checkLogin($_POST['Pass']);

	if(empty($uname))
	{
		header("Location: index.php?error=Please Enter User Name");
		exit();

	}else if(empty($pass))
	{
		header("Location: index.php?error=Please Enter Password");
		exit();
	}
	else
	{
		$sql = "SELECT * FROM customer WHERE cname='$uname' AND cid='$pass'";
		$result= mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) === 1){
			//to make login incase sensitive
			$row = mysqli_fetch_assoc($result);
			$fromdbcname = strtolower($row['cname']);
			$fromdbcid= strtolower($row['cid']);
			$frominputuname= strtolower($uname);
			$frominputpass = strtolower($pass);
			if($fromdbcname === $frominputuname && $fromdbcid == $frominputpass) {
				echo "Logged In!";
				$_SESSION['cid'] =$row['cid'];
				$_SESSION['cname'] =$row['cname'];
				$_SESSION['bdate'] =$row['bdate'];
				$_SESSION['address'] =$row['address'];
				$_SESSION['city'] =$row['city'];
				$_SESSION['wallet'] =$row['wallet'];
				header("Location: welcome.php");
				exit();
			}
			else{
			header("Location: index.php?error=Incorrect User Name or Pasword");
			exit();
		}

		}else{
			header("Location: index.php?error=Incorrect User Name or Pasword");
			exit();
		}
	}
}
else
{
	header("Location: index.php");
	exit();
}