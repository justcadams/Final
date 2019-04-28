<?php

    chdir('../../../inc');
    require 'login.php';
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbConn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $status = $dbConn->getAttribute(PDO::ATTR_CONNECTION_STATUS);
    require 'top.php';
?>

    <h2>Enter Username and Password</h2>
        <div class = "container form-signin center">
            <?php
                $msg = '';
                if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
                    if ($_POST['username'] == 'tutorialspoint' && $_POST['password'] == '1234') {
                        $_SESSION['valid'] = true;
                        $_SESSION['timeout'] = time();
                        $_SESSION['username'] = 'tutorialspoint';
                        echo 'You have entered a valid username and password.';
                    }
                    else {
                        $msg = 'Wrong username or password.';
                    }
                }
            ?>
        </div>
        <div class = "container center">
        <form class = "form-signin" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?>&nbsp;</h4>
            <input type = "text" class = "form-control" name = "username" placeholder = "username" required autofocus><br>
            <input type = "password" class = "form-control" name = "password" placeholder = "password" required><br>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" name = "login">Login</button>
         </form>            
        </div>
            <div class="container center">
                <span class="uname"><a href="#Recover-Username.php">Forgot username?</a></span>
            </div>
            <div class="container center">
                <span class="psw"><a href="#Recover-Password.php">Forgot password?</a></span>
            </div>
            <div class="container center">
                <h6 hidden>Click here to <a href = "logout.php" title = "Logout" class="center">logout.</a></h6>
            </div>
        <h2 class="center">Viridian G.P. &copy; 21 January 2019</h2>
    </main>
<?php include 'footer.php';?>