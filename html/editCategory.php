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
        
        if ($parentID != "No Parent" && $goal != "")
            $querystring = "update category set name = '$name', goal = '$goal', FK_parentID = '$parentID' where id = '$catID'";
        if ($parentID != "No Parent" && $goal == "")
            $querystring = "update category set name = '$name', goal = null, FK_parentID = '$parentID' where id = '$catID'";
        if ($parentID == "No Parent" && $goal == "")
            $querystring = "update category set name = '$name', goal = null, FK_parentID = null where id = '$catID'";
        if ($parentID == "No Parent" && $goal != "")
            $querystring = "update category set name = '$name', goal = $goal, FK_parentID = null where id = '$catID'";

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
                                         
                                         $id = $currentTuple[0]; $name = $currentTuple[1]; $goal = $currentTuple[2];
                                         $isDefault = $currentTuple[3]; $parentID = $currentTuple[4];
                                         
                                         echo  "<div class=\"row\"> \n" . 
                                                    "<div class=\"col-sm-6\">Name:</div>" .
                                                    "<div class=\"col-sm-6\">";
                                                    if ($currentTuple[3])
                                                        echo "<input type=\"text\" name=\"name\" value=\"$name\" readonly=\"readonly\">";
                                                    else
                                                        echo "<input type=\"text\" name=\"name\" value=\"$name\">";
                                         echo        "</div>" . 
                                                "</div>";
                                         echo  "<div class=\"row\"> \n" . 
                                                    "<div class=\"col-sm-6\">Goal:</div>" .
                                                    "<div class=\"col-sm-6\">";
                                                        echo "<input type=\"text\" name=\"goal\" value=\"$goal\">";
                                         echo        "</div>" . 
                                                "</div>";   
                                         echo  "<div class=\"row\"> \n" . 
                                                    "<div class=\"col-sm-6\">Parent Category:</div>" .
                                                    "<div class=\"col-sm-6\">";
                                                    if ($currentTuple[3])
                                                    {
                                                        $query = ("select c2.id, c2.name from category c1, category c2" .
                                                                    " where c1.id = '$id'". 
                                                                    " and c2.id = c1.FK_parentID;");
                                                        $result = $conn->query($query);
                                                        if ($result->num_rows > 0)
                                                        {
                                                            $currentTuple = $result->fetch_row();
                                                            $parentID = $currentTuple[0];
                                                            $parentName = $currentTuple[1];
                                                            echo "<span type=\"text\" name=\"parentID\" value=\"$parentID\">$parentName</span>";
                                                        }
                                                        else
                                                            echo "<span type=\"text\" name=\"parentID\" value=\"No Parent\">No Parent</span>";
                                                    }
                                                    else
                                                    {
                                                        echo "<select name=\"parentID\">";
                                                        
                                                            $query = ("select c2.id, c2.name from category c1, category c2" .
                                                                        " where c1.id = '$id'". 
                                                                        " and c2.id = c1.FK_parentID;");
                                                            $parentResult = $conn->query($query);
                                                            if ($parentResult->num_rows == 0)
                                                                echo "<option value=\"No Parent\" selected>No Parent</option>";
                                                            else
                                                            {
                                                                $parentTuple = $parentResult->fetch_row();
                                                                echo "<option value=\"No Parent\">No Parent</option>";
                                                            }
                                                            
                                                            $query = ("select id, name from category" .
                                                                        " where FK_createdBy = '$username' and " .
                                                                        " id != '$id' and FK_parentID is null order by name;");
                                                            $result = $conn->query($query);
                                                            for($i = 0; $i < $result->num_rows; $i++)
                                                            {
                                                                $currentTuple = $query_result->fetch_row();
                                                                if ($parentResult->num_rows > 0)
                                                                {
                                                                    if ($parentTuple[0] == $currentTuple[0])
                                                                        echo "<option value=\"" . $currentTuple[0] . "\" selected>" . $currentTuple[1] . "</option>";
                                                                    else
                                                                        echo "<option value=\"" . $currentTuple[0] . "\">" . $currentTuple[1] . "</option>";
                                                                }
                                                                else
                                                                    echo "<option value=\"" . $currentTuple[0] . "\">" . $currentTuple[1] . "</option>";
                                                            }
                                                        echo "</select>";
                                                    }
                                                echo "</div>" . 
                                                "</div>";   
                                         $conn->close();                  
                                    ?>
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