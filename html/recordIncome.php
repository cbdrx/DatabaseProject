<?php session_start(); require 'php/CheckUser.php'; isUserLoggedIn(); ?>

<!DOCTYPE html>

<html>

<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
<link href="css/base.css" type="text/css" rel="stylesheet">
<script src="js/jquery-1.12.2.min.js"></script>

  <?php
    // function login()
    // {
    //     session_start();
    //     $amount
    //     $date
    //     $user
    //     $category
    //     
    //     include 'php/Queries.php';
    //     $conn =  ConnectToDB();
    //     $querystring = "select * from user where CLID = '$username' and password = '$password';";
    //     $result = $conn->query($querystring);
    //     $numRows = $result->num_rows;
    //     if ($numRows > 0) {
    //         $_SESSION["loggedInUser"] = $username;
    //         $_SESSION["errorMessage"] = "";
    //         header("Location: index.php");
    //     }
    //     else {
    //         $_SESSION["errorMessage"] = "Incorrect CLID and password combination.";
    //         header("Location: Login.php");
    //     }
    // }
    // if (isset($_POST['submit']))
    // {
    //     echo 'Here';
    //     login();
    // }
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
                        <form class="vparent" style="height: 80%; width: 100%;">
                            <div class="vchild row" style="width: 100%">
                                <div class="col-sm-12 col-center">
                                    <div class="row">
                                        <div class="col-sm-6">Amount:</div>
                                        <div class="col-sm-6">
                                            <input class="blackText" type="text" name="amount">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">Date:</div>
                                        <div class="col-sm-6">
                                            <input class="blackText" type="text" name="date">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">Category:</div>
                                        <div class="blackText" class="col-sm-6">
                                            <select name="category">
                                                <?php 
                                                    session_start();
                                                    $userName = $_SESSION["loggedInUser"];
                                                    $query_result = AllCategoriesForUser($userName);
                                                    for($i = 0; $i < $query_result->num_rows; $i++)
                                                    {
                                                        $currentTuple = $query_result->fetch_row();
                                                        if ($currentTuple[3] && $currentTuple[2] != "Default")
                                                            echo '<option value="' . $currentTuple[1] . "'>" . $currentTuple[0] . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="submit" value="Submit" />
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