<?php
session_start();
include "config.php";
if(isset($_POST['topupmoney']) && isset($_POST['addmoney'] ))
{
	function checkMoney($data)
	{
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$addedmoney= checkMoney($_POST['topupmoney']);
	if(empty($addedmoney))
	{
		header("Location: profile.php?error=Please Enter Money");
		exit();

	}else{
		$id =$_SESSION["cid"];
		$prev_money= floatval( $_SESSION["prev_money"]);
		$total_money = $prev_money + $addedmoney;
		$sql = "UPDATE customer c SET c.wallet= $total_money WHERE cid='$id'";
		if ($conn->query($sql) === TRUE) {
  					echo "Money Record updated successfully";
			} else {
  				echo "Money Error updating record: " . $conn->error;
			}

		header("Location: profile.php?success=Money is added succesfully!");

	}
}
else
{
	header("Location: profile.php");
	exit();
}