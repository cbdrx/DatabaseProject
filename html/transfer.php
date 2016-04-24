<?php session_start(); require 'php/CheckUser.php'; isUserLoggedIn(); ?>

<!DOCTYPE html>

<html>

<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
<link href="css/base.css" type="text/css" rel="stylesheet">
<script src="js/jquery-1.12.2.min.js"></script>

  <?php
    function transfer()
    {
        session_start();
        
        include 'php/Queries.php';
        $conn =  ConnectToDB();
        
        $user = $_SESSION["loggedInUser"];
        $amount = $_POST["amount"];
        $type = $_POST["type"];
        $date = date("Y/m/d");
        
        if ($type == "toChecking")      
        {  
            // get cat for mis income
            $querystring = "select id from category where FK_createdBy = '$user' and name = 'Miscellaneous Income';";
            $result = $conn->query($querystring);
            $currentTuple = $result->fetch_row();
            $category = $currentTuple[0];
            
            $querystring = "insert into incomeTransaction(amount, date, FK_user, FK_category) values('$amount', '$date', '$user', '$category');";
            $result = $conn->query($querystring);
            if ($result) {
            
                $querystring = "select accountNumber from checkingAccount where FK_user = '$user';";
                $result = $conn->query($querystring);
                $currentTuple = $result->fetch_row();
                $accountNumber = $currentTuple[0];
                
                //update the number value in checking
                $querystring = "update checkingAccount set balance = balance + '$amount' where accountNumber = '$accountNumber';";
                $conn->query($querystring);
                
                
                $querystring = "select accountNumber from savingsAccount where FK_user = '$user';";
                $result = $conn->query($querystring);
                $currentTuple = $result->fetch_row();
                $accountNumber = $currentTuple[0];
                
                //update the number value in savings
                $querystring = "update savingsAccount set balance = balance - '$amount' where accountNumber = '$accountNumber';";
                $conn->query($querystring);
            
            
                header("Location: index.php");
            }
            else {
                echo "<script> alert(\"Transfer failed.\");</script>";
            }
        }
        else  
        {  
            // get cat id for Mis Expense
            $querystring = "select id from category where FK_createdBy = '$user' and name = 'Miscellaneous Expense';";
            $result = $conn->query($querystring);
            $currentTuple = $result->fetch_row();
            $category = $currentTuple[0];
           
            // get check account num for user
            $querystring = "select accountNumber from checkingAccount where FK_user = '$user';";
            $result = $conn->query($querystring);
            $currentTuple = $result->fetch_row();
            $accountNumber = $currentTuple[0]; 
            
            $business = "Checking To Savings";
            
            $querystring = "insert into expenseTransaction(amount, date, FK_user, FK_category, FK_business, FK_accountNumber, checkNumber) values('$amount', '$date', '$user', '$category', '$business', '$accountNumber', null);";
            $result = $conn->query($querystring);
            if ($result) {
            
                $querystring = "select accountNumber from checkingAccount where FK_user = '$user';";
                $result = $conn->query($querystring);
                $currentTuple = $result->fetch_row();
                $accountNumber = $currentTuple[0];
                
                //update the number value in checking
                $querystring = "update checkingAccount set balance = balance - '$amount' where accountNumber = '$accountNumber';";
                $conn->query($querystring);
                
                
                $querystring = "select accountNumber from savingsAccount where FK_user = '$user';";
                $result = $conn->query($querystring);
                $currentTuple = $result->fetch_row();
                $accountNumber = $currentTuple[0];
                
                //update the number value in savings
                $querystring = "update savingsAccount set balance = balance + '$amount' where accountNumber = '$accountNumber';";
                $conn->query($querystring);
            
            
                header("Location: index.php");
            }
            else {
                echo "<script> alert(\"Transfer failed.\");</script>";
            }
        }
    }
    if (isset($_POST['submit']))
    {
        echo 'Here';
        transfer();
    }
  ?>

<title> Transfer </title>

    <?php include 'navbar.php';?>
    <?php include 'php/Queries.php'; ConnectToDB(); ?>

        <body>
            <div class="container">
                <div class="row" style="height: 20vh;"> </div>
                <div class="row" style="height: 60vh;">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8 tableWrapper" style="height: 100%;">
                        <div class="row areaHeader" style="height: 15%;">
                            <div class="col-sm-6"> <h2> Transfer Money </h2> </div>
                        </div>
                        <form action="transfer.php" method="post" class="vparent" style="height: 80%; width: 100%;">
                            <div class="vchild row" style="width: 100%">
                                <div class="col-sm-12 col-center">
                                    <div class="row">
                                        <div class="col-sm-6">Amount:</div>
                                        <div class="col-sm-6">
                                            <input type="text" name="amount" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">Type</div>
                                        <div class="col-sm-6">
                                            <input type="radio" name="type" checked value="toChecking">Savings to Checking
                                            <input type="radio" name="type" value="toSavings">Checking to Savings
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="submit" value="submit" name="submit"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </body>
</html>