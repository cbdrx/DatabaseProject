<!DOCTYPE HTML>
<html>
  <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
  <link href="css/base.css" type="text/css" rel="stylesheet">
  <link href="style/login.css" type="text/css" rel="stylesheet">
  <script src="js/jquery-1.12.2.min.js"></script>

  <title>Log In </title>

  <?php
    session_start();
    include 'php/Queries.php';
    function deleteAccountPage()
    {
        $username = $_SESSION["loggedInUser"];
        DeleteAccount($username);
    }
    if (isset($_POST['delete']))
    {
        echo 'Here';
        deleteAccountPage();
    }
  ?>

  <div class="container">
    <div class="row" style="height:33vh">
      <div class="col-sm-3">
      </div>
      <div class="col-sm-8">
      <h1>Delete your account</h1>
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
                        <div class="col-sm-6"><input type="submit" value="delete" name="Delete"/></div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-6"><a href="index.php">Back To Summary</div>
                </div>
                </div> 
            </div>
        </div>
    </div>
</div>


</html>
