<!DOCTYPE html>
  <html>

  <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
  <link href="css/base.css" type="text/css" rel="stylesheet">
  <link href="style/login.css" type="text/css" rel="stylesheet">
  <script src="js/jquery-1.12.2.min.js"></script>

  <title> Create Account </title>

  <?php
    include 'php/Queries.php';
    session_start();
    function createAccount()
    {
        session_start();
        
        $conn =  ConnectToDB();
        $allNecessaryFieldsSet = !empty($_POST["clid"]) && !empty($_POST["name"]) && !empty($_POST["password"])  
            && !empty($_POST["checkingaccountnumber"]);
        
		//We need to check if the necessary primary keys are already in use
						
		$querySstring = "";

        if($allNecessaryFieldsSet)
        {
            $username = $_POST["clid"];
            $name = $_POST["name"];
            $password = $_POST["password"];
            $checkingnum = $_POST["checkingaccountnumber"];
			$superUser = $_POST["superUser"];
            
            $queryString = "select * from user where CLID = '$username';";
            $userNonExist = ($conn->query($queryString)->num_rows == 0);
            $queryString = "select * from checkingAccount where accountNumber = '$checkingnum';";
            $checkingNonExist = ($conn->query($queryString)->num_rows == 0);
            if(!empty($_POST["savingsaccountnumber"]))
            {
                $savingsnum = $_POST["savingsaccountnumber"];
                $queryString = "select * from savingsAccount where accountNumber = '$savingsnum';";
                $savingsNonExist = ($conn->query($queryString)->num_rows == 0);
                if($userNonExist && $checkingNonExist && $savingsNonExist)
                {
                    $checkingbalance = 0.0;
                    $savingsbalance = 0.0;
                    if(!empty($_POST["checkingaccountbalance"]))
                    {
                        $checkingbalance = $_POST["checkingaccountbalance"];
                    }
                    
                    if(!empty($_POST["savingsaccountbalance"]))
                    {
                        $savingsbalance = $_POST["savingsaccountbalance"];
                    }
                    
                    $queryString = "insert into user values ('$username', '$password', '$name', '$superUser'); ";
                    $conn->query($queryString);
                    $queryString = " insert into checkingAccount values ('$checkingnum', '$checkingbalance', '$username'); ";
                    $conn->query($queryString);
                    $queryString = " insert into savingsAccount values ('$savingsnum', '$savingsbalance', '$username');";
                    $conn->query($queryString);
                    if(AddDefaultCategoriesForUser($username))
                    {
                        
                        $_SESSION["errorMessage"] = "Account Successfully Created!";                
                    }
                    else
                    {
                        $queryString = "delete from checkingAccount where accountNumber = '$checkingnum';";
                        $conn->query($queryString);
                        $queryString = "delete from savingsAccount where accountNumber = '$savingsnum';";
                        $conn->query($queryString);
                        $queryString = "delete from user where CLID = '$username';";
                        $conn->query($queryString);
                    }
                }
                else
                {
                $_SESSION["errorMessage"] = "An error has occurred";
                    
                }
            }
            else if($userNonExist && $checkingNonExist)
            {
                $checkingbalance = 0.0;
                if(!empty($_POST["checkingaccountbalance"]) )
                {
                    $checkingbalance = $_POST["checkingaccountbalance"];
                }
                $queryString = "insert into user values ('$username', '$password', '$name', 0); ";
                $conn->query($queryString);
                $queryString = " insert into checkingAccount values ('$checkingnum', '$checkingbalance', '$username'); ";
                $conn->query($queryString);
                if(AddDefaultCategoriesForUser($username))
                {
                    
                    $_SESSION["errorMessage"] = "Account Successfully Created!";                
                }
                else
                {
                    $queryString = "delete from checkingAccount where accountNumber = '$checkingnum';";
                    $conn->query($queryString);
                    $queryString = "delete from user where CLID = '$username';";
                    $conn->query($queryString);
                }
                
            }
            else
            {
                $_SESSION["errorMessage"] = "An error has occurred";
            }
            //$querystring = "select * from user where CLID = '$username';";
            //$savingsNonExist = (($conn->query($queryString))->num_rows == 0);
            
        }
        else
        {
            $_SESSION["errorMessage"] = "A required field was not filled out";
        }
		
        $conn->close();
        		
        header("Location: superHome.php");
		exit();
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
                <div class="col-sm-4"> Super User?:</div>
                <div class="col-sm-6"><input type="checkbox" name="superUser"></div>
              </div>
              <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-6"><input type="submit" value="submit" name="submit"/></div>
                <div class="col-sm-1"><a href="Login.php"><input type="button" value="Cancel" name="Cancel"/></a></div>
              </div>
            </div>
          </form>

    </div>

    <div class="row" style="height:33vh">
    </div>

  </div>
  </html>