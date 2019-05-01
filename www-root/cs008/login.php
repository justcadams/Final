<?php

    chdir('../../../inc');
    require 'login.php';
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbConn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $status = $dbConn->getAttribute(PDO::ATTR_CONNECTION_STATUS);
    require 'top.php';
?>

    <h2 class="center">Enter Username and Password</h2>
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
                <label class = "float left alignInput <?php if($usernameERROR) print $highlight; else print $noHighlight; ?>" id="usernameLabel">Username:</label>
                <input type = "text" class = "form-control <?php if($usernameERROR) print $highlight; else print $noHighlight; ?>" name = "username" placeholder = "username" required autofocus><br>
                <label class = "alignInput" id="passwordLabel <?php if($passwordERROR) print $highlight; else print $noHighlight; ?>">Password:</label>
                <input type = "password" class = "form-control <?php if($passwordERROR) print $highlight; else print $noHighlight; ?>" name = "password" placeholder = "password" required><br>
                <button class = "btn btn-lg btn-primary btn-block" type = "submit" name = "login">Login</button>
            </form>
        </div>
        <span class="center">
            <button class="inline" id="forgotUsername">
                <span class="uname"><a href="#Recover-Username.php">Forgot Username</a></span>
            </button>
            <button class="inline" id="forgotPassword">
                <span class="psw"><a href="#Recover-Password.php">Forgot Password</a></span>
            </button>
            <section hidden class="flex button" id="logout">
                <h6 hidden class="logout">Logout</h6>
            </section>
        </span>
    </main>
<?php require 'footer.php';?>