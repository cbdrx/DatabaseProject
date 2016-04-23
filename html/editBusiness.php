<?php session_start(); require 'php/CheckUser.php'; isUserLoggedIn(); ?>

<!DOCTYPE html>

<html>

<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
<link href="css/base.css" type="text/css" rel="stylesheet">
<script src="js/jquery-1.12.2.min.js"></script>

  <?php    
    function edit()
    {
        session_start();
        
        include 'php/Queries.php';
        $conn =  ConnectToDB();
        
        $bisID = $_POST['bisID'];
        $user = $_SESSION['loggedInUser'];
        $category = $_POST['catID'];
        
        
        $querystring = "update business set FK_category = '$category' where FK_business = '$bisID' and FK_user = '$user'";

        $result = $conn->query($querystring);
        
        header("Location: businesses.php");
        // if ($result) {
        //     header("Location: businesses.php");
        // }
        // else {
        //     $_SESSION["errorMessage"] = "Failed creating Income";
        //     header("Location: businesses.php");
        // }
    }
    if (isset($_POST['submit']))
    {
        echo 'Here';
        edit();
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
                        <form action="editBusiness.php" method="post" class="vparent" style="height: 80%; width: 100%;">
                            <div class="vchild row" style="width: 100%">
                                <div class="col-sm-12 col-center">
                                    <?php 
                                         session_start();
                                         $userName = $_SESSION["loggedInUser"];
                                         $bisID = $_GET['bisID'];
                                         $catID = $_GET['catID'];
                                         $conn =  ConnectToDB();
                                         //$querystring = "select FK_business, FK_category, from userBusinessCategory where FK_business = '$bisID' and FK_user = '$userName';";
                                         //$result = $conn->query($querystring);
                                         //$currentTuple = $result->fetch_row();
                                                                                 
                                         echo  "<div class=\"row\"> \n" . 
                                                    "<div class=\"col-sm-6\">Business:</div>" .
                                                    "<div class=\"col-sm-6\">";
                                                        echo "<input type=\"text\" name=\"bisID\" value=\"$bisID\" readonly=\"readonly\">";
                                         echo        "</div>" . 
                                                "</div>"; 
                                         echo "<div class=\"row\">" .
                                                    "<div class=\"col-sm-6\">Category:</div>" .
                                                    "<div class=\"col-sm-6\">" .
                                                        "<select name=\"catID\">"; 
                                                    $query_result = AllCategoriesForUser($userName);
                                                    for($i = 0; $i < $query_result->num_rows; $i++)
                                                    {
                                                        $currentTuple = $query_result->fetch_row();
                                                        if ($currentTuple[0] == $catID)
                                                            echo '<option value="' . $currentTuple[0] . '" selected>' . $currentTuple[2] . '</option>';
                                                        else
                                                            echo '<option value="' . $currentTuple[0] . '">' . $currentTuple[2] . '</option>';
                                                    }
                                         echo   "</select>" .
                                        "</div>" .
                                    "</div>"; 
                                    $conn->close();                  
                                    ?>
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