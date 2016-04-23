<?php session_start(); require 'php/CheckUser.php'; isUserLoggedIn(); ?>

<!DOCTYPE html>

<html>

<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
<link href="css/base.css" type="text/css" rel="stylesheet">
<script src="js/jquery-1.12.2.min.js"></script>

  <?php
    function createCategory()
    {
        session_start();
        
        include 'php/Queries.php';
        $conn =  ConnectToDB();

        $goal = $_POST["goal"];
        $user = $_SESSION["loggedInUser"];
        $category = $_POST["category"];
        $parentCategory = $_POST["parentCategory"];
        $query = "select FK_createdBy from Category where categoryName = '$parentCategory';";
        $parentCategoryCreator = $conn->query($query);
        
        $querystring = "insert into Category(categoryName, FK_createdBy, goal, default, FK_parentName, FK_parentCreatedBy) " . 
                        " values('$category', '$user', '$goal', '0', '$parentCategory', '$parentCategoryCreator');";

	echo $querystring;        

        $conn->query($querystring);
        
        header("Location: index.php");
    }
    if (isset($_POST['submit']))
    {
        echo 'Here';
        createCategory();
    }
  ?>

<title> New Category </title>

    <?php include 'navbar.php';?>
    <?php include 'php/Queries.php'; ConnectToDB(); ?>

        <body>
            <div class="container">
                <div class="row" style="height: 20vh;"> </div>
                <div class="row" style="height: 60vh;">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8 tableWrapper" style="height: 100%;">
                        <div class="row areaHeader" style="height: 15%;">
                            <div class="col-sm-6"> <h2> Create New Category </h2> </div>
                        </div>
                        <form action="createCategory.php" method="post" class="vparent" style="height: 80%; width: 100%;">
                            <div class="vchild row" style="width: 100%">
                                <div class="col-sm-12 col-center">
                                    
                                    <div class="row">
                                        <div class="col-sm-6">Category:</div>
                                        <div class="col-sm-6">
                                            <input type="text" name="category" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-6">Parent Category:</div>
                                        <div class="col-sm-6">
                                            <select name="parentCategory" required>
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
                                        <div class="col-sm-6">Goal:</div>
                                        <div class="col-sm-6">
                                            <input type="text" name="goal" required>
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
