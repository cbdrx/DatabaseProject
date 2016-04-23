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
        
        $query = "select * from business where name = '$business';";
        $res = $conn->query($query);
        if ($res->num_rows == 0)
        {
            $res = "insert into business values ('$business')";
            $conn->query($query);
        }
        
        //$query = "select FK_createdBy from Category where categoryName = '$parentCategory';";
        //$parentCategoryCreator = $conn->query($query);
        
        $querystring = "insert into UserBusinessClassification (FK_business, FK_user, FK_category) " . 
                        " values('$business', '$user', '$category');";

	   echo $querystring;        

        $conn->query($querystring);
        
        header("Location: businesses.php");
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
                                        <div class="col-sm-6">Business:</div>
                                        <div class="col-sm-6">
                                            <input type="text" name="business" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">Parent Category:</div>
                                        <div class="col-sm-6">
                                            <select name="parentCategory" required>
                                                <option value="No Parent" selected>No Parent</option>;
                                                <?php        
                                                    session_start();
                                                    $userName = $_SESSION["loggedInUser"];
                                                    $conn =  ConnectToDB();
                                                    
                                                    $query = ("select id, name from category" .
                                                                " where FK_createdBy = '$userName'" .
                                                                " order by name;");
                                                    $result = $conn->query($query);
                                                    for($i = 0; $i < $result->num_rows; $i++)
                                                    {
                                                        $currentTuple = $result->fetch_row();
                                                        echo "<option value=\"" . $currentTuple[0] . "\">" . $currentTuple[1] . "</option>";
                                                    }
                                                    
                                                    $conn->close();
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
