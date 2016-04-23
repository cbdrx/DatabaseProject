<!DOCTYPE HTML>
<html>
  <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
  <link href="css/base.css" type="text/css" rel="stylesheet">
  <link href="style/login.css" type="text/css" rel="stylesheet">
  <script src="js/jquery-1.12.2.min.js"></script>

  <title>Create Savings Account</title>

  <?php
    session_start();
    include 'php/Queries.php';
    function createSavingsAccount()
    {
        $username = $_SESSION["loggedInUser"];
        $accountNum = $_PSOT["accountNum"]
        $query = "insert into savingsAccount(accountNumber, balance, FK_user) " .
                    " values( '$accountNum', '0.00', '$username');";
        $conn->query($query);
        
        header("Location: createSavings.php");
    }
    if (isset($_POST['create']))
    {
        echo 'Here';
        createSavingsAccount();
    }
  ?>

  <div class="container">
    <div class="row" style="height:33vh">
      <div class="col-sm-3">
      </div>
      <div class="col-sm-8">
      <h1>Create a Savings Account</h1>
      </div>
      </div>
    <div class="row" style="height:33vh">
    <div class="row">
        <div class="col-sm-1">
            </div>
        <div class="col-sm-8">
            <div class="roundGrayLoginBox">
                <form action="createSavings.php" method="post">
                    <div class="row" style="height:2vh"></div>
                    <div class="row">
                        <?php echo $_SESSION["errorMessage"] ?>
                    </div>
                    <!-- Account Number -->
                    <div class="row">
                        <div class="col-sm-6">Saving Account Number:</div>
                        <div class="col-sm-6">
                            <input type="text" name="accountNum" required>
                        </div>
                    </div>
                    <!-- Create Button -->
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-6"><input type="submit" value="create" name="create"/></div>
                    </div>
                </form>
                <!-- Back to summary link -->
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
