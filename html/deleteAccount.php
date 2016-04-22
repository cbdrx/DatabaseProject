<!DOCTYPE HTML>
<html>
  <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
  <link href="css/base.css" type="text/css" rel="stylesheet">
  <link href="style/login.css" type="text/css" rel="stylesheet">
  <script src="js/jquery-1.12.2.min.js"></script>

  <title>Log In </title>

  <?php
    function deleteAccount()
    {
        session_start();
        $username = $_SESSION["loggedInUser"];
        
        
        include 'php/Queries.php';
            DeleteAccount($username);
    }
    if (isset($_POST['delete']))
    {
        echo 'Here';
        DeleteAccount();
    }
  ?>

  <div class="container">
    <div class="row" style="height:33vh">
      <div class="col-sm-3">
      </div>
      <div class="col-sm-8">
      <h1>Log in to your account</h1>
      </div>
      </div>
    <div class="row" style="height:33vh">
    <div class="row">
        <div class="col-sm-1">
            </div>
        <div class="col-sm-8">
            <div class="roundGrayLoginBox">
                <form action="deleteAccount.php" method="post">
                    <div class="row" style="height:2vh"></div>
                    <div class="row">
                        <?php echo $_SESSION["errorMessage"] ?>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">CLID:</div>
                        <div class="col-sm-6" style="padding:1px"><input type="text" name="clid" required></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">Password: </div>
                        <div class="col-sm-6" style="padding:1px"><input type="password" name="password" required></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-6"><input type="submit" value="delete" name="Delete"/></div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-6"><a href="createAccount.php">Create Account</div>
                </div>
                </div> 
            </div>
        </div>
    </div>
</div>


</html>
