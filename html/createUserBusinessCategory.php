<?php session_start(); require 'php/CheckUser.php'; isUserLoggedIn(); ?>

<!DOCTYPE html>

<html>

<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
<link href="css/base.css" type="text/css" rel="stylesheet">
<script src="js/jquery-1.12.2.min.js"></script>

  <?php
    function createBusinessClassification()
    {
        session_start();
        
        include 'php/Queries.php';
        $conn =  ConnectToDB();

        
        $user = $_SESSION["loggedInUser"];
        $category = $_POST["category"];
        $business = $_POST["business"];
        //$query = "select FK_createdBy from Category where categoryName = '$parentCategory';";
        //$parentCategoryCreator = $conn->query($query);
        
        $querystring = "insert into UserBusinessClassification (FK_businessName, FK_user, FK_categoryName) " . 
                        " values('$business', '$user', '$category');";

	echo $querystring;        

        $conn->query($querystring);
        
        header("Location: index.php");
    }
    if (isset($_POST['submit']))
    {
        echo 'Here';
        createBusinessClassification();
    }
  ?>

<title> New Business Classification </title>

    <?php include 'navbar.php';?>
    <?php include 'php/Queries.php'; ConnectToDB(); ?>

        <body>
            <div class="container">
                <div class="row" style="height: 20vh;"> </div>
                <div class="row" style="height: 60vh;">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8 tableWrapper" style="height: 100%;">
                        <div class="row areaHeader" style="height: 15%;">
                            <div class="col-sm-6"> <h2> Create New User Business Classification </h2> </div>
                        </div>
                        <form action="createUserBusinessCategory.php" method="post" class="vparent" style="height: 80%; width: 100%;">
                            <div class="vchild row" style="width: 100%">
                                <div class="col-sm-12 col-center">
                                    
                                    <div class="row">
                                        <div class="col-sm-6">Category:</div>
                                        <div class="col-sm-6">
                                            <input type="text" name="category" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-6">Business:</div>
                                        <div class="col-sm-6">
                                            <select name="business" required>
                                                <?php 
                                                //
                                                // Wasn't sure if I should've just deleted all this or if you could use this to write less code.
                                                //
                                                //
                                                    session_start();
                                                    $userName = $_SESSION["loggedInUser"];
                                                    $query_result = AllBusinessesForUser($userName);
                                                    for($i = 0; $i < $query_result->num_rows; $i++)
                                                    {
                                                        $currentTuple = $query_result->fetch_row();
                                                        echo '<option value="' . $currentTuple[0] . '">' . $currentTuple[0] . ", " . $currentTuple[2] . '</option>';
                                                    }
                                                ?>
                                            </select>
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
