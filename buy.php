<?php
session_start();
include "config.php";
$clickedbutton= (array_keys($_COOKIE)[0]);
// find the clicked button
$num = substr($clickedbutton,9);
//check wheter amount is entered or not
	function check($data)
	{
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$value= check($_POST[$num]); //this is amount
	if(empty($value)){ //If there is no entered value for amount show error
		header("Location: welcome.php?error=Please Enter Amount");
		exit();
	}else{
		// if entered amount is bigger than the stock of that product
		//get the stock number of that
		if( $value > $_SESSION["stock".$num]){
			header("Location: welcome.php?error=This amount exceeds the number of items in the stock!");
			exit();
		}
		else{
			//check the price and the wallet of the customer
			$total_price = $value * $_SESSION["price".$num];
			//get the money of the user	
			$id =$_SESSION["cid"];
			$sqlmoney ="SELECT * FROM customer  WHERE cid='$id'" ;
			$resultmoney = mysqli_query($conn,$sqlmoney);
			$row = mysqli_fetch_assoc($resultmoney);
			$wallet = $row['wallet'];
			if($total_price > $wallet ){
				header("Location: welcome.php?error=You cannot afford this!");
				exit();
			}
			else{
				echo "do the shopping";
				//how to do the shopping
				//first update the wallet
				$id =$_SESSION["cid"];
				$remaining_money = $wallet  - $total_price;
				$sql = "UPDATE customer c SET c.wallet=$remaining_money WHERE c.cid='$id'" ;
				if ($conn->query($sql) === TRUE) {
  					echo "Money Record updated successfully";
				} else {
  				echo "Money Error updating record: " . $conn->error;
				}
				//then remove it from the stock
				$id2 =$_SESSION["pid".$num]; //id of the product
				$remaining_stock= $_SESSION["stock".$num] - $value;
				$sql2 = "UPDATE product p SET p.stock=$remaining_stock WHERE p.pid='$id2'" ;
				if ($conn->query($sql2) === TRUE) {
  					echo "Stock updated successfully";
				} else {
  				echo "Stock Error updating record: " . $conn->error;
				}
				//add it to the buy table 
				//first find whether there is previous shopping for this product
				$sql3 = "SELECT * FROM buy  WHERE cid='$id' AND pid='$id2'";
				$result3 = mysqli_query($conn,$sql3);
				if(mysqli_num_rows($result3) === 1){
				//then update the quantity value of cid,pid pair
				$row = mysqli_fetch_assoc($result3);
				$total_quantity = $row['quantity'] + $value;
				echo $total_quantity;
				$sql4 = "UPDATE buy b SET b.quantity=$total_quantity WHERE b.pid='$id2' AND b.cid='$id' " ;
					if ($conn->query($sql4) === TRUE) {
  						echo "Buy Table updated successfully";
					} else {
  					echo "Buy Table Error updating record: " . $conn->error;
					}
				}
				else{ // there is no pre shopping for this pid and cid insert it to the buy table
					$sql5 = "INSERT INTO buy(cid,pid,quantity) VALUES ('$id','$id2',$value) " ;
					if ($conn->query($sql5) === TRUE) {
  						echo "Inserted to Buy Table successfully";
					} else {
  					echo "Insertion to Buy Table Error updating record: " . $conn->error;
					}
				}
				//show successfully bought mesage 
				header("Location: welcome.php?success=Successfully bought!");
				exit();

				//customer return to welcome page

			}

		}
	}



?>