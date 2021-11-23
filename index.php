<!DOCTYPE html>    
<html>    
<head>    
    <title>Login Form</title>    
    <link rel="stylesheet" type="text/css" href="style.css">    
</head>    
<body>    
    <h2>Login Page</h2><br>    
    <div class="login">    
    <form id="login" method="post" action="login.php"> 
        <?php if(isset($_GET['error'])){ ?>
            <p class="error" id= "err"><?php echo $_GET['error']; ?></p>
        <?php } ?>   
        <label><b>User Name     
        </b>    
        </label>    
        <input type="text" name="Uname" id="Uname" placeholder="Username">    
        <br><br>    
        <label><b>Password     
        </b>    
        </label>    
        <input type="Password" name="Pass" id="Pass" placeholder="Password">    
        <br><br>    
        <button name="log" id="log">Login</button>         
    </form>     
</div>    
</body>    
</html>     