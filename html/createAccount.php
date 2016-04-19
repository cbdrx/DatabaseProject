<!DOCTYPE html>
  <html>

  <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
  <link href="css/base.css" type="text/css" rel="stylesheet">
  <link href="style/login.css" type="text/css" rel="stylesheet">
  <script src="js/jquery-1.12.2.min.js"></script>

  <title> Create Account </title>

  <?php
    session_start();
    session_destroy();
    function createAccount()
    {
        session_start();
        $username = $_POST["clid"];
        $name = $_POST["name"];
        $password = $_POST["password"];
        $checkingnum = $_POST["checkingaccountnumber"];
        $checkingbalance = $_POST["checkingaccountbalance"];
        $savingsnum = $_POST["savingsaccountnumber"];
        $savingsbalance = $_POST["savingsaccountbalance"];
        
        include 'php/Queries.php';
        $conn =  ConnectToDB();
        $querystring = "insert into user values ('$username', '$password', '$name', 0);";
        $result = $conn->query($querystring);
        $querystring = "insert into checkingAccount values('$checkingnum', '$checkingbalance', '$username');"
        $result = $conn->query($querystring);
        if (isset($_POST["savingsaccountnumber"];))
        {
            if (isset($_POST["savingsaccountbalance"]))
                $querystring = "insert into savingsAccount values('$savingsnum', '$savingsbalance', '$username');"
            else
                $querystring = "insert into savingsAccount values('$savingsnum', 0.00, '$username');"
            $result = $conn->query($querystring);
        }
            
        //Do a check for success here? each time? idk.
        if ($numRows > 0) {
            $_SESSION["loggedInUser"] = $username;
            $_SESSION["errorMessage"] = "";
            header("Location: index.php");
        }
        else {
            $_SESSION["errorMessage"] = "Incorrect CLID and password combination.";
            header("Location: Login.php");
        }
    }
    if (isset($_POST['submit']))
    {
        echo 'Here';
        createAccount();
    }
  ?>

  <div class="container">
    <div class="row" style="height:33vh">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <head><h1>Create New Account</h1></head>
      </div>
    </div>

    <div class="row" style="height:33vh">

      <div class="col-sm-2">

      </div>

      <div class="col-sm-8">
          <form action="createAccount.php" method="post">
            <div class="roundGrayAccountCreateBox" style="padding-top:15px">
              <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">CLID:</div>
                <div class="col-sm-6"><input type="text" name="clid" required></div>
              </div>
              <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">Full Name:</div>
                <div class="col-sm-6"><input type="text" name="name" required></div>
              </div>
              <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">Password:</div>
                <div class="col-sm-6"><input type="text" name="password" required></div>
              </div>
              <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">Checking Account Number:</div>
                <div class="col-sm-6"><input type="text" name="checkingaccountnumber" required></div>
              </div>
              <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">Checking Balance:</div>
                <div class="col-sm-6"><input type="text" name="checkingaccountbalance" required></div>
              </div>
              <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">Savings Account Number:</div>
                <div class="col-sm-6"><input type="text" name="savingsaccountnumber"></div>
              </div>
              <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4"> Savings Balance:</div>
                <div class="col-sm-6"><input type="text" name="savingsaccountbalance"></div>
              </div>
              <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-6"><input type="submit" value="submit" name="submit"/></div>
              </div>
            </div>
          </form>

    </div>

    <div class="row" style="height:33vh">
    </div>

  </div>
  </html>
