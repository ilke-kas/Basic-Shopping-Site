<?php
session_start();
if(isset($_SESSION['cid']) && isset($_SESSION['cname'])){ ?>

<!DOCTYPE html>    
<html>    
<head>    
    <title>Welcome Page</title>    
    <link rel="stylesheet" type="text/css" href="welcomestyle.css">    
</head>    
<body> 
    <div>
        <br>
            <a id="logoutbutton" href="logout.php">Logout</a>  
            <h2>Welcome, <?php echo $_SESSION['cname']; ?> !</h2>
    </div>
    <div clas="buy">
        
        <?php if(isset($_GET['error'])){ ?>
            <p class="error" id= "err2"><?php echo $_GET['error']; ?></p>
        <?php } ?>  
        <?php if(isset($_GET['success'])){ ?>
            <p class="error" id= "err3"><?php echo $_GET['success']; ?></p>
        <?php } ?>  

        <form id= "form" action="buy.php" method="post">
        <table>
            <tr>
                <th>Product Id</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Amount</th>
                <th>Buy Button</th>
            </tr>
            <! Now connect dtabase for products>
            <?php 
            include "config.php";
            $sql = "SELECT * FROM product WHERE stock <> 0";
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
                    <th> <?php print_r($row['price']); ?></th>
                    <th> 
                        <input type="text" onChange="reply_text(this.id)" name=<?php  echo $num;?> >
                    </th>
                        <th> <button onClick="reply_click(this.id)" id =<?php echo "buybutton$num"?>>Buy</button></th>
                </div>
            </tr>
             <?php  
                $pid = 'pid'.$num;
                $pname= 'pname'.$num;
                $price = 'price'.$num;
                $stock = 'stock'.$num;
                $_SESSION[$pid] =$row['pid'];
                $_SESSION[$pname] =$row['pname'];
                $_SESSION[$price] =$row['price'];
                $_SESSION[$stock] =$row['stock'];
                $num--;
            }

            ?>
        </table>
    <script type="text/javascript">
        function reply_click(clicked_id)
        {
            document.cookie=  clicked_id;
        }
    </script>
    </form>
    </div>    
    <div>
         <a id="profilebutton" href="profile.php">Profile</a>  
    </div>
</body>    
</html>    

<?php
}else{
    header("Location: index.php");
    exit();
}
?> 