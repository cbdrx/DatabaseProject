<?php session_start(); require 'php/CheckUser.php'; isUserLoggedIn(); ?>

<!DOCTYPE html>

<html>

<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
<link href="css/base.css" type="text/css" rel="stylesheet">
<script src="js/jquery-1.12.2.min.js"></script>

  <?php
    function record()
    {
        session_start();
        
        include 'php/Queries.php';
        $conn =  ConnectToDB();
       
       $amount = $_POST["amount"];
        $date = $_POST["date"];
        $user = $_SESSION["loggedInUser"];
        $category = $_POST["category"];
        $business = $_POST["business"];
        $accountNumber;
        $checkNumber; 
        
        $querystring = "select accountNumber from checkingAccount where FK_user = '$user';";
        $result = $conn->query($querystring);
        $currentTuple = $query_result->fetch_row();
        $accountNumber = $currentTuple[0];
        
        $querystring = "insert into expenseTransaction(amount, date, FK_user, FK_category, FK_business, FK_accountNumber, checkNumber) values('$amount', '$date', '$user', '$category', '$business', '$accountNumber', '$checkNumber');";
        
        header("Location: index.php");
    }
    if (isset($_POST['submit']))
    {
        echo 'Here';
        record();
    }
  ?>

<title> New Income </title>

    <?php include 'navbar.php';?>
    <?php include 'php/Queries.php'; ConnectToDB(); ?>

        <body>
            <div class="container">
                <div class="row" style="height: 20vh;"> </div>
                <div class="row" style="height: 60vh;">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8 tableWrapper" style="height: 100%;">
                        <div class="row areaHeader" style="height: 15%;">
                            <div class="col-sm-6"> <h2> Record New Income </h2> </div>
                        </div>
                        <form action="recordExpense.php" method="post" class="vparent" style="height: 80%; width: 100%;">
                            <div class="vchild row" style="width: 100%">
                                <div class="col-sm-12 col-center">
                                    <div class="row">
                                        <div class="col-sm-6">Amount:</div>
                                        <div class="col-sm-6">
                                            <input type="text" name="amount" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">Date:</div>
                                        <div class="col-sm-6">
                                            <input type="date" name="date" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">Category:</div>
                                        <div class="col-sm-6">
                                            <select name="category">
                                                <?php 
                                                    session_start();
                                                    $userName = $_SESSION["loggedInUser"];
                                                    $query_result = AllCategoriesForUser($userName);
                                                    for($i = 0; $i < $query_result->num_rows; $i++)
                                                    {
                                                        $currentTuple = $query_result->fetch_row();
                                                        if ($currentTuple[3])
                                                            echo '<option value="' . $currentTuple[0] . '">' . $currentTuple[2] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">Business:</div>
                                        <div class="col-sm-6">
                                            <select name="business">
                                                <?php 
                                                    session_start();
                                                    $userName = $_SESSION["loggedInUser"];
                                                    $query_result = AllBusinessesForCategory($userName);
                                                    for($i = 0; $i < $query_result->num_rows; $i++)
                                                    {
                                                        $currentTuple = $query_result->fetch_row();
                                                        echo '<option value="' . $currentTuple[0] . '">' . $currentTuple[0] . ", " . $currentTuple[1] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">Check Number:</div>
                                        <div class="col-sm-6">
                                            <input type="text" name="checkNumber" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-1"></div>
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