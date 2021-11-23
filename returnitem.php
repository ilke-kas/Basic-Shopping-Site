<?php
session_start();
include "config.php";
if(isset($_POST['returneditem']) && isset($_POST['returnedamount'] ))
{
	function checkInput($data)
	{
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$returneditem= checkInput($_POST['returneditem']);
	$returnedamount= checkInput($_POST['returnedamount']);
	if(empty($returneditem))
	{
		header("Location: profile.php?error=Please Enter Product Id to return");
		exit();

	}else if(empty($returnedamount))
	{
		header("Location: profile.php?error=Please Enter Product amount to return");
		exit();
	}
	else{
		//do the return
		//if returned amount is bigger than the quantity give error
		//find the quantity from buy table
		$id =$_SESSION["cid"];
        $sqlquantity ="SELECT * FROM buy  WHERE cid='$id' AND pid='$returneditem' " ;
        $resultquantity = mysqli_query($conn,$sqlquantity);
        if(mysqli_num_rows($resultquantity) === 0){ //If you do not bought that
			header("Location: profile.php?error=You do not have that item!");
			exit();
        }
        else{
        $row = mysqli_fetch_assoc($resultquantity);
        $quantity= floatval($row['quantity']);
        if($returnedamount > $quantity){
        	header("Location: profile.php?error=This amount exceeds the number of items you bought");
			exit();
        }
        else{
        	//continue to return
        	//how to do the return
        	//1.first update the wallet
        	//1.1 get the price of the product
        	$sqlprice ="SELECT * FROM product  WHERE pid='$returneditem'" ;
       		$resultprice = mysqli_query($conn,$sqlprice);
        	$row = mysqli_fetch_assoc($resultprice);
        	$price= floatval($row['price']);
        	$total_price = $price * $returnedamount;
        	//1.2 add it to the wallet of the customer
        	//1.2.1 find the wallet value of the customer
        	$sqlmoney ="SELECT * FROM customer  WHERE cid='$id'" ;
			$resultmoney = mysqli_query($conn,$sqlmoney);
			$row = mysqli_fetch_assoc($resultmoney);
			$wallet = floatval($row['wallet']);
			$final_wallet = $wallet + $total_price;
			//1.2.2 update it
			$sql2 = "UPDATE customer c SET c.wallet=$final_wallet WHERE c.cid='$id'" ;
				if ($conn->query($sql2) === TRUE) {
  					echo "Money Record updated successfully";
				} else {
  				echo "Money Error updating record: " . $conn->error;
				}

        	//2.then remove it from the buy table
				$final_quantity = $quantity - $returnedamount;
				$sql3 = "UPDATE buy b SET b.quantity=$final_quantity WHERE b.cid='$id' AND b.pid='$returneditem'" ;
				if ($conn->query($sql3) === TRUE) {
  					echo "Quantity updated successfully";
				} else {
  				echo "Quantity updating record: " . $conn->error;
				}
        	//3.add it to the product table
			//3.1first find how many in there the stock
			$sqlstock ="SELECT * FROM product  WHERE pid='$returneditem'" ;
			$resultstock = mysqli_query($conn,$sqlstock);
			$row = mysqli_fetch_assoc($resultstock);
			$stock = intval($row['stock']);
			$final_stock = $stock + $returnedamount;
			//3.2 update the product table
			$sql4 = "UPDATE product p SET p.stock=$final_stock WHERE p.pid='$returneditem'";
				if ($conn->query($sql4) === TRUE) {
  					echo "Stock updated successfully";
				} else {
  				echo "Stock updating record: " . $conn->error;
				}

				header("Location: profile.php?success=Successfully returned!");
				exit();
            }
		}
	}

}
else
{
	//header("Location: profile.php");
	//exit();
}