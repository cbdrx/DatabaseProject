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
        $bisID = $_GET['id'];
        $user = $_SESSION['loggedInUser'];
        $category = $_POST['category'];
        $parentID = $_POST['parentID'];
        
        include 'php/Queries.php';
        $conn =  ConnectToDB();
        $querystring = "update business set FK_category = '$category' where FK_business = '$bisID' and FK_user = '$user'";

        $result = $conn->query($querystring);
        if ($result) {
            header("Location: businesses.php");
        }
        else {
            $_SESSION["errorMessage"] = "Failed creating Income";
            header("Location: businesses.php");
        }
    }
    if (isset($_POST['submit']))
    {
        echo 'Here';
        edit();
    }
  ?>

<title> New Income </title>

    <?php include 'navbar.php';?>
    

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
                                    <?php 
                                         session_start();
                                         $userName = $_SESSION["loggedInUser"];
                                         $bisID = $_GET['id'];
                                         $conn =  ConnectToDB();
                                         $querystring = "select FK_business, FK_category, from userBusinessCategory where FK_business = '$bisID' and FK_user = '$userName';";
                                         $result = $conn->query($querystring);
                                         $currentTuple = $result->fetch_row();
                                         
                                         $id = $currentTuple[0]; $name = $currentTuple[0]; $goal = $currentTuple[0];
                                         $isDefault = $currentTuple[0]; $parentID = $currentTuple[0];
                                         
                                         echo  "<div class=\"row\"> \n" . 
                                                    "<div class=\"col-sm-6\">Business:</div>" .
                                                    "<div class=\"col-sm-6\">";
                                                        echo "<input type=\"text\" name=\"business\" value=\"'$bisID'\" readonly=\"readonly\">";
                                         echo        "</div>" . 
                                                "</div>";
                                         echo  "<div class=\"row\"> \n" . 
                                                    "<div class=\"col-sm-6\">Goal:</div>" .
                                                    "<div class=\"col-sm-6\">";
                                                        echo "<input type=\"text\" name=\"goal\" value=\"'$goal'\">";
                                         echo        "</div>" . 
                                                "</div>";   
                                         echo  "<div class=\"row\"> \n" . 
                                                    "<div class=\"col-sm-6\">Parent Category:</div>" .
                                                    "<div class=\"col-sm-6\">";
                                                    if ($currentTuple[3])
                                                        echo "<input type=\"text\" name=\"parentID\" value=\"'$parentID'\" readonly=\"readonly\">";
                                                    else
                                                    {
                                                        echo "<select name=\"parentID\">";
                                                            echo "<option value=\"No Parent\">No Parent</option>";
                                                            $query = ("select id, name from category where FK_createdBy = '$username' and id != '$id' and FK_parentID = null order by name;");
                                                            $results = $conn->query($query);
                                                            for($i = 0; $i < $query_result->num_rows; $i++)
                                                            {
                                                                $currentTuple = $query_result->fetch_row();
                                                                echo "<option value=\"" . $currentTuple[0] . "\">" . $currentTuple[1] . "</option>";
                                                            }
                                                        echo "</select>";
                                                    }
                                         echo        "</div>" . 
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