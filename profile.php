<?php
session_start();
if(isset($_SESSION['cid']) && isset($_SESSION['cname'])){ ?>

<!DOCTYPE html>    
<html>    
<head>    
    <title>Profile Page</title>    
    <link rel="stylesheet" type="text/css" href="profilestyle.css">    
</head>    
<body> 
    <div>
        <br>
            <a id="logoutbutton" href="logout.php">Logout</a>  
            <h2>Profile: <?php echo $_SESSION['cname']; ?></h2>
    </div>

    <div clas="bought">
        
        <?php if(isset($_GET['error'])){ ?>
            <p class="error" id= "err2"><?php echo $_GET['error']; ?></p>
        <?php } ?>  
        <?php if(isset($_GET['success'])){ ?>
            <p class="error" id= "err3"><?php echo $_GET['success']; ?></p>
        <?php } ?>  

        <form id= "form" action="return.php" method="post">
        <table>
            <tr>
                <th>Product Id</th>
                <th>Product Name</th>
                <th>Quantity</th>
            </tr>
            <! Now connect dtabase for products>
            <?php 
            include "config.php";
            $id = $_SESSION['cid'];
            $sql = "SELECT * FROM buy b NATURAL JOIN product p WHERE b.cid='$id' AND b.quantity<>0";
            $result= mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result);
            $_SESSION['num'] = $num;
            while($num !== 0){
                $row = mysqli_fetch_assoc($result);
            ?> 
            <tr>
                <div>
                    <th> <?php print_r($row['pid']); ?></th>
                    <th> <?php print_r($row['pname']); ?></th>
                    <th> <?php print_r($row['quantity']); ?></th>
                </div>
            </tr>
             <?php  
                $num--;
            }

            ?>
        </table>
    </form>
    </div>  
      <div> <!Increase the money part>
        <form id="addmoneyform" method="post" action="addmoney.php"> 
        <h3>Wallet: <?php 
            include("config.php");
            $id =$_SESSION["cid"];
            $sqlmoney ="SELECT * FROM customer  WHERE cid='$id'" ;
            $resultmoney = mysqli_query($conn,$sqlmoney);
            $row = mysqli_fetch_assoc($resultmoney);
            $wallet = $row['wallet'];
            echo $wallet;
            $_SESSION["prev_money"] = $wallet;
         ?></h3>
          <input type="text" name="topupmoney" id="topupmoney" placeholder="added money">
           <button name="addmoney" id="addmoney">Add Money</button> 
       </form>
    </div>  
    <div> <!Return part>
         <form id="returnform" method="post" action="returnitem.php"> 
            <h3>Return</h3>
             <input type="text" name="returneditem" id="returneditem" placeholder="Product Id">
             <input type="text" name="returnedamount" id="returnedamount" placeholder="Returned Amount">
             <button name="returnbutton" id="returnbutton">Return</button>
        </form>
    </div>
    <div>
         <a id="welcomebutton" href="welcome.php">Back to Welcome Page</a>
    </div>
</body>    
</html>    

<?php
}else{
    header("Location: index.php");
    exit();
}
?> 