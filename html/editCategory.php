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
        
        $catID = $_GET['id'];
        $name = $_POST['name'];
        $goal = $_POST['goal'];
        $parentID = $_POST['parentID'];
        
        $querystring = "update category set name = '$name', goal = '$goal', FK_parentID = '$parentID' where id = '$catID'";
        if ($parentID == "No Parent")
            $querystring = "update category set name = '$name', goal = '$goal', FK_parentID = null where id = '$catID'";

        $result = $conn->query($querystring);
        if ($result) {
            header("Location: categories.php");
        }
        else {
            $_SESSION["errorMessage"] = "Failed creating Income";
            header("Location: categories.php");
        }
    }
    if (isset($_POST['submit']))
    {
        echo 'Here';
        edit();
    }
  ?>

<title> Edit Category </title>

    <?php include 'navbar.php';?>
    <?php include 'php/Queries.php'; ConnectToDB(); ?>
    
        <body>
            <div class="container">
                <div class="row" style="height: 20vh;"> </div>
                <div class="row" style="height: 60vh;">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8 tableWrapper" style="height: 100%;">
                        <div class="row areaHeader" style="height: 15%;">
                            <div class="col-sm-6"> <h2> Edit Category </h2> </div>
                        </div>
                        <form action="editCategory.php" method="post" class="vparent" style="height: 80%; width: 100%;">
                            <div class="vchild row" style="width: 100%">
                                <div class="col-sm-12 col-center">
                                    <?php 
                                         session_start();
                                         $userName = $_SESSION["loggedInUser"];
                                         $catID = $_GET['id'];
                                         $conn =  ConnectToDB();
                                         $querystring = "select id, name, goal, isDefault, FK_parentID, income from category where id = '$catID';";
                                         $result = $conn->query($querystring);
                                         $currentTuple = $result->fetch_row();
                                         
                                         $id = $currentTuple[0]; $name = $currentTuple[0]; $goal = $currentTuple[0];
                                         $isDefault = $currentTuple[0]; $parentID = $currentTuple[0];
                                         
                                         echo  "<div class=\"row\"> \n" . 
                                                    "<div class=\"col-sm-6\">Name:</div>" .
                                                    "<div class=\"col-sm-6\">";
                                                    if ($currentTuple[3])
                                                        echo "<input type=\"text\" name=\"name\" value=\"'$name'\" readonly=\"readonly\">";
                                                    else
                                                        echo "<input type=\"text\" name=\"name\" value=\"'$name'\">";
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